<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

use App\Materi;

use Auth;

class MateriController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $materi = new Materi;
        $materis = $materi->all();
        $i = 1;
        return view('materi.index', compact('materis', 'i'));
    }

    public function create() {
        return view('materi.create');
    }

    public function store(Request $request, $id=0) {
        // Validasi data yang masuk
        $materi = new Materi;
        $validatedData = Validator::make($request->all(),   [
            'judul' => ['required', 'string', 'max:100'],
            'deskripsi' => ['required']
        ]);
        if($id != 0) {
            $materi = Materi::findOrFail($id);
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
        $materi->user_id = Auth::user()->id;
        $materi->judul = $request->judul;
        $materi->deskripsi = $request->deskripsi;

        // Apabila sukses di save
        if($materi->save()) {
            // return redirect()->json($materi);
            return redirect('admin/materi')->with('success-msg', 'Data berhasil disimpan');
        }
    }

    public function view($id) {
        $materi = Materi::findOrFail($id);
        return response()->json($materi);
    }

    public function edit($id) {
        $materi = Materi::findOrFail($id);
        return view('materi.edit', compact('materi'));
    }

    public function show($id) {
        $materi = Materi::findOrFail($id);
        return view('materi.view', compact('materi'));
    }

    public function delete($id) {
        $materi = Materi::findOrFail($id);
        $materi->delete();
        return response()->json($materi);
    }
}
