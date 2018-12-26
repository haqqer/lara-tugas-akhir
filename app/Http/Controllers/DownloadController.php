<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

use Auth;

use App\Daftardl;

class DownloadController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $daftardl = new Daftardl;
        $daftardls = $daftardl->all();
        $i = 1;
        
        return view('daftardl.index', compact('daftardls', 'i'));
    }

    public function kategori() {
        $data = ['ebook','jurnal'];
        return response()->json($data);
    }

    public function store(Request $request, $id=0) {
        $daftardl = new Daftardl;
        // Validasi data yang masuk
        if($id != 0) {
            $daftardl = Daftardl::findOrFail($id);
            $validatedData = Validator::make($request->all(),   [
                'nama' => ['required', 'string', 'max:100'],
                'deskripsi' => ['required']
            ]);
        } else {
            $validatedData = Validator::make($request->all(),   [
                'nama' => ['required', 'string', 'max:100'],
                'deskripsi' => ['required'],
                'file' => ['required']
            ]);    
        }
        
        //Apabila Error maka halaman akan redirect ke halaman sebelumnya
        if($validatedData->fails()) {
            Session::flash('error', $validatedData->messages()->first());
            return redirect()
                    ->back()
                    ->withErrors($validatedData)
                    ->withInput();
        }

        $daftardl->user_id = Auth::user()->id;
        $daftardl->nama = $request->nama;
        $daftardl->deskripsi = $request->deskripsi;
        $daftardl->kategori = $request->kategori;
        // Image File Handler
        if($request->hasFile('file')) {
            $image_file = $request->file('file');
            $image_name = 'file'.time().'.'.$image_file->getClientOriginalExtension();
            $uploaded = $image_file->move(public_path('uploads/download/'),$image_name);
            if($uploaded) {
                $daftardl->file = $image_name;
            } else {
                return redirect()->back()->with('fail-msg','failed to upload file');
            }
        }
        // Apabila sukses di save
        if($daftardl->save()) {
            return back()->with('success-msg', 'Data Berhasil di simpan');
        }
    }
    // Show Detail Method
    public function show($id) {
        $daftardl = new Daftardl;
        $data = $daftardl->findOrFail($id);
        return response()->json($data);
    }

    public function delete($id) {
        $daftardl = new Daftardl;
        $data = $daftardl->findOrFail($id);
        $data->delete();
        return response()->json($data);
        // return back();
    }
}
