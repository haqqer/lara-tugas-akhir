<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

use App\Publikasi;

use Auth;

class PublikasiController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $publikasi = new Publikasi;
        $publikasis = $publikasi->all();
        $i = 1;
        return view('publikasi.index', compact('publikasis', 'i'));
    }

    public function create() {
        return view('publikasi.create');
    }

    public function store(Request $request, $id=0) {
        // Validasi data yang masuk
        $publikasi = new Publikasi;
        $validatedData = Validator::make($request->all(),   [
            'nama' => ['required', 'string', 'max:100'],
            'deskripsi' => ['required']
        ]);
        if($id != 0) {
            $publikasi = Publikasi::findOrFail($id);
        }

        //Apabila Error maka halaman akan redirect ke halaman sebelumnya
        if($validatedData->fails()) {
            Session::flash('error', $validatedData->messages()->first());
            return redirect()
                    ->back()
                    ->withErrors($validatedData)
                    ->withInput();
        }
        // Proses save
        $publikasi->user_id = Auth::user()->id;
        $publikasi->nama = $request->nama;
        $publikasi->deskripsi = $request->deskripsi;

        // Apabila sukses di save
        if($publikasi->save()) {
            // return redirect()->json($publikasi);
            return redirect('admin/publikasi')->with('success-msg', 'Data berhasil disimpan');
        }
    }

    public function view($id) {
        $publikasi = Publikasi::findOrFail($id);
        return response()->json($publikasi);
    }

    public function edit($id) {
        $publikasi = Publikasi::findOrFail($id);
        return view('publikasi.edit', compact('publikasi'));
    }

    public function show($id) {
        $publikasi = Publikasi::findOrFail($id);
        return view('publikasi.view', compact('publikasi'));
    }

    public function delete($id) {
        $publikasi = Publikasi::findOrFail($id);
        $publikasi->delete();
        return response()->json($publikasi);
    }
}
