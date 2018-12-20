<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Berita;

class BeritaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        
    }
}
