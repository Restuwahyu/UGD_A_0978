<?php

namespace App\Http\Controllers;

/* Import Model */
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index() 
    {
        //get posts 
        $pegawai = Pegawai::join('departemens','pegawais.id_departemen','=','departemens.id')->paginate(5); 
        
        //render view with posts 
        return view('pegawai.index', compact('pegawai')); 
    }
}