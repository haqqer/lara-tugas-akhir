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
                                <td>
                                    <img width="100px" height="auto" src="{{ asset('uploads/images/berita') }}/{{ $berita->foto }}" alt="">
                                </td>
                                <td>{{ $berita->created_at->diffForHumans() }}</td>
                                <td>{{ $berita->updated_at->diffForHumans() }}</td>
                                <td><a class="show btn btn-outline-primary" href="{{ url('admin/berita') }}/{{ $berita->id }}/show" id="{{ $berita->id }}">View</a>
                                    <button type="button" class="delete btn btn-outline-danger" id="{{ $berita->id }}">Hapus</button>|
                                    <a class="edit btn btn-outline-success" id="{{ $berita->id }}" href="{{ url('admin/berita') }}/{{ $berita->id }}/edit">Edit</button></td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>        
            </div>
    </div>
</div>
<script>
        $('.delete').click(function(e) {
            e.preventDefault();
            var id = $(this).attr('id');
            swal({
                title: "Hapus Data",
                text: "Anda yakin ingin menghapus data",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
            if(willDelete) {
                $.ajax({
                    type: 'GET',
                    url: 'berita/'+id+'/delete',
                    dataType: "JSON",
                    success: function(data) {
                        swal("Data Telah dihapus", {
                            icon: "success"
                        }).then(() => {
                            location.reload();
                        })
                    }
                })
            }
        });                     
    })        
</script>
@endsection