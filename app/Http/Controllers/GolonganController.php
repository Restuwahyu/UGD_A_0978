<?php

namespace App\Http\Controllers;

/* Import Model */
use App\Models\Golongan;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index() 
    {
        //get posts 
        $golongan = Golongan::paginate(5); 
        
        //render view with posts 
        return view('golongan.index', compact('golongan')); 
    }
}