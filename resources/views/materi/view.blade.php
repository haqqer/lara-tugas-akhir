@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="p-2">
            <a class="btn btn-outline-primary" href="{{ url('admin/materi/create') }}">Create</a>
            <a class="show btn btn-outline-success" href="{{ url('admin/materi') }}/{{ $materi->id }}/edit" id="{{ $materi->id }}">Edit</a>
            <button type="button" class="delete btn btn-outline-danger" id="{{ $materi->id }}">Hapus</button>          
            <a class="btn btn-outline-secondary" href="{{ url('admin/materi') }}">Back</a>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-10">
                        <h2>{{ $materi->judul }}</h2>
                        <div class="content mt-5">
                            {!! $materi->deskripsi !!}
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
                            window.location.href = "{{ url('admin/materi') }}";
                        })
                    }
                })
            }
        });                     
    })        
</script>
@endsection