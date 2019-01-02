@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="p-2">
            <a class="btn btn-outline-primary" href="{{ url('admin/publikasi/create') }}">Create</a>          
        </div>
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
                            <th>Author</th>   
                            <th>Created</th>
                            <th>Update</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($publikasis as $publikasi)
                            <tr id="{{ $publikasi->id }}">
                                <td>{{ $i++ }}</td>
                                <td>{{ $publikasi->nama }}</td>
                                <td>{{ $publikasi->user->name }}</td>
                                <td>{{ $publikasi->created_at->diffForHumans() }}</td>
                                <td>{{ $publikasi->updated_at->diffForHumans() }}</td>
                                <td><a class="show btn btn-outline-primary" href="{{ url('admin/publikasi') }}/{{ $publikasi->id }}/show" id="{{ $publikasi->id }}">View</a>
                                    <button type="button" class="delete btn btn-outline-danger" id="{{ $publikasi->id }}">Hapus</button>|
                                    <a class="edit btn btn-outline-success" id="{{ $publikasi->id }}" href="{{ url('admin/publikasi') }}/{{ $publikasi->id }}/edit">Edit</button></td>
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
                    url: 'publikasi/'+id+'/delete',
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