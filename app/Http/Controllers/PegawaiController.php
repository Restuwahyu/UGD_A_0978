<?php
namespace App\Http\Controllers;

/* Import Model */
use App\Models\Pegawai;
use App\Models\Departemen; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller{
    /**
    * index
    *
    * @return void
    */
    public function index(){
        $pegawai=Pegawai::get();
        $departemen=Departemen::get();
        
        $pegawai = Pegawai::latest()->paginate(5);           
        //render view with posts
        return view('pegawai.index', compact(['pegawai','departemen']));
    }

    /** 
     * create 
     * @return void 
    */ 
    public function create() 
    { 
        $departemen=Departemen::all();
        return view('pegawai.create', compact('departemen')); 
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
            'id_departemen' => 'required',
            'email' => 'required|email', 
            'telepon' => 'required|starts_with:08|alpha-dash|min:6|max:7', 
            'gender' => 'required', 
            'tanggal_bergabung' => 'required|date', 
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
        return redirect()->route('pegawai.index')->with(['success'=> 'Data Berhasil Disimpan']);
    }

    public function edit($id)
    {
        $pegawai = Pegawai::find($id);
        $departemen = Departemen::all();
        return view('pegawai.edit', compact(['pegawai','departemen']));
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::where('id', $id)->firstorfail();
        $pegawai->delete();
        return redirect()->route('pegawai.index')->with('success', 'Data Berhasil Dihapus!');
    }

    public function update (Request $request, $id)
    {
        $this->validate($request, [ 
            'nomor_induk_pegawai' => 'required', 
            'nama_pegawai' => 'required|alpha-dash|max:15', 
            'id_departemen' => 'required',
            'email' => 'required|email', 
            'telepon' => 'required|starts_with:08|alpha-dash|min:6|max:7', 
            'gender' => 'required', 
            'tanggal_bergabung' => 'required|date', 
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
        return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Diedit!']);
    }
}