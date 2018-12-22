<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

use App\Kegiatan;

use Auth;

class KegiatanController extends Controller
{
    public function index() {
        $kegiatan = new Kegiatan;
        $kegiatans = $kegiatan->all();
        $i = 1;
        return view('kegiatan.index', compact('kegiatans', 'i'));
    }

    public function create() {
        return view('kegiatan.create');
    }

    public function store(Request $request, $id=0) {
        // Validasi data yang masuk
        $kegiatan = new Kegiatan;
        $validatedData = Validator::make($request->all(),   [
            'judul' => ['required', 'string', 'max:100'],
            'deskrispsi' => ['required'],
            'jenis' => ['required', 'string'],
            'tempat' => ['required','string'],
            'foto' => ['mimes:jpeg,jpg,png']
        ]);
        if($id != 0) {
            $kegiatan = kegiatan::findOrFail($id);
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
        $kegiatan->user_id = Auth::user()->id;
        $kegiatan->jenis = $request->jenis;
        $kegiatan->judul = $request->judul;
        $kegiatan->deskripsi = $request->deskripsi;

        // Image File Handler
        if($request->hasFile('foto')) {
            $image_file = $request->file('foto');
            $image_name = 'kegiatan'.time().".jpg";
            $uploaded = $image_file->move(public_path('uploads/images/kegiatan/'),$image_name);
            if($uploaded) {
                $kegiatan->foto = $image_name;
            } else {
                return redirect()->back()->with('fail-msg','failed to upload image');
            }
        }
        // Apabila sukses di save
        if($kegiatan->save()) {
            // return redirect()->json($kegiatan);
            return redirect('admin/kegiatan')->with('success-msg', 'Data berhasil disimpan');
        }
    }
}
