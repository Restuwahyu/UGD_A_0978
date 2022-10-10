<?php
namespace App\Http\Controllers;
use App\Models\Golongan; 
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GolonganController extends Controller
{
    /**
    * index
    *
    * @return void
    */
    public function index()
    {
        $golongan=Golongan::get();
        $pegawai=Pegawai::get();
        $golongan = Golongan::latest()->paginate(5);
        //render view with posts
        return view('golongan.index', compact(['golongan','pegawai']));
    }
    
    /**
    * create
    *
    * @return void
    */
    public function create()
    {
        $pegawai=Pegawai::all();
        return view('golongan.create', compact('pegawai'));
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
            'nama_golongan' => 'required',
            'pegawai_id' => 'required',
            'gaji_pokok' => 'required',
            'tunjangan_keluarga' => 'required|lte:gaji_pokok',
            'tunjangan_transport' => 'required|lte:gaji_pokok',
            'tunjangan_makan' => 'required|lte:gaji_pokok',         
        ]);
        
        //Fungsi Simpan Data ke dalam Database
        Golongan::create([
            'nama_golongan' => $request->nama_golongan,
            'pegawai_id' => $request->pegawai_id,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan_keluarga' => $request->tunjangan_keluarga,
            'tunjangan_transport' => $request->tunjangan_transport,
            'tunjangan_makan' => $request->tunjangan_makan,
           
        ]);
        return redirect()->route('golongan.index')->with(['success'=> 'Data Berhasil Disimpan']);
    }
    
    public function edit($id)
    {
        $golongan = Golongan::find($id);
        $pegawai=Pegawai::all();
        return view('golongan.edit', compact(['golongan','pegawai']));
    }

    public function update(Request $request, $id)
    {
        //validate form
        $request->validate([
            'nama_golongan' => 'required',
            'pegawai_id' => 'required',
            'gaji_pokok' => 'required',
            'tunjangan_keluarga' => 'required|lte:gaji_pokok',
            'tunjangan_transport' => 'required|lte:gaji_pokok',
            'tunjangan_makan' => 'required|lte:gaji_pokok',
        ]);
        $golongan = Golongan::find($id);
        $golongan->update([
            'nama_golongan' => $request->nama_golongan,
            'pegawai_id' => $request->pegawai_id,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan_keluarga' => $request->tunjangan_keluarga,
            'tunjangan_transport' => $request->tunjangan_transport,
            'tunjangan_makan' => $request->tunjangan_makan,
        ]);
        //redirect to index
        return redirect()->route('golongan.index')->with(['success' => 'Data Berhasil Diedit!']);
    }

    public function destroy($id) {
        Golongan::destroy($id);
        return redirect()->route('golongan.index')->with('success', 'Data Berhasil Dihapus!');
    }
}