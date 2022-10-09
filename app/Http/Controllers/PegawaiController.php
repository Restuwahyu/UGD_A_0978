<?php
namespace App\Http\Controllers;

/* Import Model */
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller{
    /**
    * index
    *
    * @return void
    */
    public function index(){
        $pegawai = Pegawai::join('departemens','pegawais.id_departemen','=','departemens.id')->paginate(5);
                            
            
            //$pegawai = Pegawai::paginate(5);
                      
            //render view with posts
            return view('pegawai.index', compact('pegawai'));
    }

    /** 
     * create 
     * @return void 
    */ 
    public function create() 
    { 
        return view('pegawai.create'); 
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
            'nomor_induk_pegawai' => 'required', 
            'nama_pegawai' => 'required|alpha-dash|max:15', 
            'id_departemen' => 'required|id_departemen|unique:departemens',
            'email' => 'required|email', 
            'telepon' => 'required|match:[0-9]|alpha-dash|min:6|max:7', 
            'gender' => 'required', 
            'tanggal_bergabung' => 'required|before:2022-10-9', 
            'status' => 'required'
        ]); 
        
        //Fungsi Simpan Data ke dalam Database 
        Pegawai::create([ 
            'nomor_induk_pegawai' => $request->nomor_induk_pegawai, 
            'nama_pegawai' => $request->nama_pegawai, 
            'id_departemen' => $request->id_departemen,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'gender' => $request->gender,
            'tanggal_bergabung' => $request->tanggal_bergabung,
            'status' => $request->status
        ]);
    }

    public function edit($id)
    {
        $pegawai = Pegawai::find($id);
        return view('pegawai.edit', compact('pegawai'));
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::where('id', $id)->firstorfail()->delete();
        return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Dihapus']);
    }

    public function update (Request $request, $id)
    {
        $this->validate($request, [ 
            'nomor_induk_pegawai' => 'required', 
            'nama_pegawai' => 'required|alpha-dash|max:15', 
            'id_departemen' => 'required|id_departemen|unique:departemens',
            'email' => 'required|email', 
            'telepon' => 'required|match:[0-9]|alpha-dash|min:6|max:7', 
            'gender' => 'required', 
            'tanggal_bergabung' => 'required|before:2022-10-9', 
            'status' => 'required'
        ]); 
        
        //Fungsi Update Data ke dalam Database 
        $pegawai = pegawai::find($id);
        $pegawai->nomor_induk_pegawai   = $request->nomor_induk_pegawai;
        $pegawai->nama_pegawai = $request->nama_pegawai;
        $pegawai->id_departemen = $request->id_departemen;
        $pegawai->email = $request->email;
        $pegawai->telepon = $request->telepon;
        $pegawai->gender = $request->gender;
        $pegawai->tanggal_bergabung = $request->tanggal_bergabung;
        $pegawai->status = $request->status;
        $pegawai->update();
        return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Diedit']);
    }
}