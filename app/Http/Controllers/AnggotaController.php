<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

use App\Dosen;

use App\Mahasiswa;

use App\Alumni;

class AnggotaController extends Controller
{
    public function index($id_name) {
        $anggota = $this->filter($id_name);
        $anggotas = $anggota->all();
        $i = 1;
        return view('anggota.index', compact('anggotas', 'i', 'id_name'));
    }

    public function filter($id_name) {
        // Method untuk mefitler jenis anggota
        if($id_name == 'mahasiswa') {
            $anggota = new Mahasiswa;
        } else if($id_name == 'dosen') {
            $anggota = new Dosen;
        } else if($id_name == 'alumni') {
            $anggota = new Alumni;
        } else {
            return view('anggota.landing');
        }
        return $anggota;
    }

    public function store(Request $request, $id_name, $id=0) {
        // Validasi data yang masuk
        $model = $this->filter($id_name);
        if($id != 0) {
            $anggota = $model->findOrFail($id);
            $validatedData = Validator::make($request->all(),   [
                'nama' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.$id_name.',email,'.$anggota->id],
                'no_identitas' => ['required', 'string', 'max:20'],
                'foto' => ['mimes:jpeg,jpg,png']
            ]);
        } else {
            $anggota = $model;
            $validatedData = Validator::make($request->all(),   [
                'nama' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.$id_name],
                'no_identitas' => ['required', 'string', 'max:20'],
                'foto' => ['mimes:jpeg,jpg,png']
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
        
        
        
        
        $anggota->nama = $request->nama;
        $anggota->email = $request->email;
        if($id_name == 'dosen') {
            $anggota->npp = $request->no_identitas;
        } else {
            $anggota->nim = $request->no_identitas;
        }

        // Image File Handler
        if($request->hasFile('foto')) {
            $image_file = $request->file('foto');
            $image_name = $id_name.time().".jpg";
            $uploaded = $image_file->move(public_path('uploads/images/'.$id_name.'/'),$image_name);
            if($uploaded) {
                $anggota->foto = $image_name;
            } else {
                return redirect()->back()->with('fail-msg','failed to upload image');
            }
        }
        // Apabila sukses di save
        if($anggota->save()) {
            return back()->with('success-msg', 'Data Berhasil di simpan');
        }
    }
    // Show Detail Method
    public function show($id_name,$id) {
        $anggota = $this->filter($id_name);
        $data = $anggota->findOrFail($id);
        return response()->json($data);
    }

    public function delete($id_name, $id) {
        $anggota = $this->filter($id_name);
        $data = $anggota->findOrFail($id);
        $data->delete();
        return response()->json($data);
        // return back();
    }
}
