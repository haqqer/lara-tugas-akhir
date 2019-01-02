<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use DB;

use App\Topik;

use Auth;

class TopikController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $topik = new Topik;
        $topiks = $topik->all();
        $i = 1;
        
        return view('topik.index', compact('topiks', 'i'));
    }

    public function store(Request $request, $id=0) {
        $topik = new Topik;
        // Validasi data yang masuk
        if($id != 0) {
            $topik = Topik::findOrFail($id);
            $validatedData = Validator::make($request->all(),   [
                'nama' => ['required', 'string', 'max:100'],
                'deskripsi' => ['required']
            ]);
        } else {
            $validatedData = Validator::make($request->all(),   [
                'nama' => ['required', 'string', 'max:100'],
                'deskripsi' => ['required'],
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

        $topik->nama = $request->nama;
        $topik->deskripsi = $request->deskripsi;
        if($topik->jml != 0) {
            DB::table('topik')->where('nama', $request->nama)->increment('jml');
        } else {
            $topik->jml = 0;
        }
        

        // Apabila sukses di save
        if($topik->save()) {
            return back()->with('success-msg', 'Data Berhasil di simpan');
        }
    }
    // Show Detail Method
    public function show($id) {
        $topik = new Topik;
        $data = $topik->findOrFail($id);
        return response()->json($data);
    }

    public function delete($id) {
        $topik = new Topik;
        $data = $topik->findOrFail($id);
        $data->delete();
        return response()->json($data);
        // return back();
    }
}
