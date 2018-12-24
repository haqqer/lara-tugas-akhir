<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index($id) {
        $class = '\App\\'.ucfirst($id);
        $data = $class::all();
        return response()->json($data);
    }
}
