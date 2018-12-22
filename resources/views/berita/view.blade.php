@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="p-2">
            <a class="btn btn-outline-primary" href="{{ url('admin/berita/create') }}">Create</a>
            <a class="show btn btn-outline-success" href="{{ url('admin/berita') }}/{{ $berita->id }}/edit" id="{{ $berita->id }}">Edit</a>
            <button type="button" class="delete btn btn-outline-danger" id="{{ $berita->id }}">Hapus</button>          
            <a class="btn btn-outline-secondary" href="{{ url('admin/berita') }}">Back</a>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-10">
                        <h2>{{ $berita->judul }}</h2>
                        <img src="{{ asset('uploads/images/berita')}}/{{ $berita->foto }}" alt="{{ $berita->judul }}" class="img-thumbnail" width="800px">
                        <div class="content mt-5">
                            {!! $berita->deskripsi !!}
                        </div>
                    </div>

                </div>
            </div>
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
                    url: 'delete',
                    dataType: "JSON",
                    success: function(data) {
                        swal("Data Telah dihapus", {
                            icon: "success"
                        }).then(() => {
                            window.location.href = "{{ url('admin/berita') }}";
                        })
                    }
                })
            }
        });                     
    })        
</script>
@endsection