@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
    </div>
    <div class="col-12">
            <!-- Flash Message baik sukses maupun error -->
            @if(session('success-msg'))
            <div class="alert alert-success">
              {{session('success-msg')}}
            </div>
            @elseif(session('fail-msg'))
            <div class="alert alert-danger">
              {{session('fail-msg')}}
            </div>
            @endif
            <!-- EndFlash -->
            <div class="card mt-5">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>deskripsi</th>
                            <th>foto</th>
                            <th>Created</th>
                            <th>Update</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($beritas as $berita)
                            <tr id="{{ $berita->id }}">
                                <td>{{ $i++ }}</td>
                                <td>{{ $berita->judul }}</td>
                                <td>{{ $berita->kategori->nama }}</td>
                                <td>{{ substr($berita->deskripsi, 0, 30) }}</td>
                                <td>
                                    <img width="100px" height="auto" src="{{ asset('uploads/images/berita') }}/{{ $berita->foto }}" alt="">
                                </td>
                                <td>{{ $berita->created_at->diffForHumans() }}</td>
                                <td>{{ $berita->updated_at->diffForHumans() }}</td>
                                <td><button type="button" class="show btn btn-outline-primary" data-toggle="modal" data-target="#View" id="{{ $berita->id }}">View</button>|
                                    <button type="button" class="delete btn btn-outline-danger" id="{{ $berita->id }}">Hapus</button>|
                                    <button type="button" class="edit btn btn-outline-success" id="{{ $berita->id }}">Edit</button></td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>        
            </div>
    </div>
</div>
@endsection