<?php

namespace App\Http\Controllers;

use Mail; 
use App\Mail\DepartemenMail; /* import model mail */ 
use App\Models\Departemen; /* import model departemen */ 
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    /**
     * index
     * 
     * @return void
     */

    public function index() 
    {
        //get posts 
        $departemen = Departemen::latest()->paginate(5); 
        
        //render view with posts 
        return view('departemen.index', compact('departemen')); 
    }

    /** 
     * create 
     * @return void 
    */ 
    public function create() 
    { 
        return view('departemen.create'); 
    } 
    /** 
     * store 
     * 
     * @param Request $request 
     * @return void 
    */ 
    public function store(Request $request) 
    { 
        //Validasi Formulir 
        $this->validate($request, [ 
            'nama_departemen' => 'required', 
            'nama_manager' => 'required', 
            'jumlah_pegawai' => 'required' 
        ]); 
        
        //Fungsi Simpan Data ke dalam Database 
        Departemen::create([ 
            'nama_departemen' => $request->nama_departemen, 
            'nama_manager' => $request->nama_manager, 
            'jumlah_pegawai' => $request->jumlah_pegawai 
        ]); 
        
        try{ 
            //Mengisi variabel yang akan ditampilkan pada view mail 
            $content = [ 
                'body' => $request->nama_departemen, 
            ];
        
            //Mengirim email ke emailtujuan@gmail.com 
            Mail::to('yohanesrestuwahyu@gmail.com')->send(new DepartemenMail($content)); 
            
            //Redirect jika berhasil mengirim email 
            return redirect()->route('departemen.index')->with(['success' => 'Data Berhasil Disimpan, email telah terkirim!']); 
        }catch(Exception $e){ 
            //Redirect jika gagal mengirim email 
            return redirect()->route('departemen.index')->with(['success' => 'Data Berhasil Disimpan, namun gagal mengirim email!']); 
        } 
    }
}