<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index($id) {
        if(substr($id, 0, 8) == 'kegiatan') {
            $class = '\App\Kegiatan';
            $data = $class::where('jenis', substr($id,8))->get();
            $page='kegiatan';
        } else if(substr($id, 0, 8) == 'download') {
            $class = '\App\Daftardl';
            $data = $class::where('kategori', substr($id,8))->get();
            $page='download';
        } else {
            $class = '\App\\'.ucfirst($id);
            $data = $class::all();  
            $page=$id;  
        }
        $i=1;
        return view('main_page.'.$page, compact('data','i'));
    }


    public function show($id_name, $id) {  
        $class = '\App\\'.ucfirst($id_name);
        $data = $class::findOrFail($id);
        return response()->json($data);
    }
    
    public function kegiatan($jenis) {

    }
}
