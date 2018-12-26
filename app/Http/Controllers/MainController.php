<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index($id) {
        $class = '\App\\'.ucfirst($id);
        if($id == 'jurnal') {
            $data = $class::where('jenis' ,'=','jurnal');
        }
        $data = $class::all();
        $i=1;
        return view('main_page.'.$id, compact('data','i'));
    }

    public function show($id_name, $id) {  
        $class = '\App\\'.ucfirst($id_name);
        $data = $class::findOrFail($id);
        return response()->json($data);
    }
}
