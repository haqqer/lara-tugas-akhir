<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kategori;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $kategori = new Kategori;
        $kategoris = $kategori->all();
        return response()->json($kategoris);
    }
}
