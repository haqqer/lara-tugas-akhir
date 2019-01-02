@extends('layouts.admin')

@section('content')
<div class="row">
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
        <div class="card">
            <div class="card-header">{{ __('Input Topik') }}</div>

                <div class="card-body">
                    <!-- Form Input Anggota -->
                    <form method="POST" action="{{ url('admin/topik') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="nama" class="col-md-4 col-form-label text-md-right">Nama</label>

                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}" required autofocus>

                                @if ($errors->has('nama'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deskripsi" class="col-md-4 col-form-label text-md-right">Deskripsi</label>

                            <div class="col-md-6">
                                <input id="deskripsi" type="text" class="form-control{{ $errors->has('deskripsi') ? ' is-invalid' : '' }}" name="deskripsi" value="{{ old('deskripsi') }}" required>

                                @if ($errors->has('deskripsi'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('deskripsi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                  

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM -->
                </div>
            </div>
        </div>

        </div>

        <div class="col-12">
            <div class="card mt-5">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Created</th>
                            <th>Update</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topiks as $topik)
                            <tr id="{{  $topik->id }}">
                                <td>{{ $i++ }}</td>
                                <td>{{ $topik->nama }}</td>
                                <td>{{ substr($topik->deskripsi, 0, 30) }}...</td>
                                <td>{{ $topik->created_at->diffForHumans() }}</td>
                                <td>{{ $topik->updated_at->diffForHumans() }}</td>
                                <td><button type="button" class="show btn btn-outline-primary" data-toggle="modal" data-target="#View" id="{{ $topik->id }}">View</button>|
                                    <button type="button" class="delete btn btn-outline-danger" id="{{ $topik->id }}">Hapus</button>|
                                    <button type="button" class="edit btn btn-outline-success" id="{{ $topik->id }}">Edit</button></td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>        
            </div>
        </div>
    </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="View" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <table class="table table-responsive">
                    <tr>
                        <th>ID</th>
                        <td id="id-view"></td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td id="nama-view"></td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td id="deskripsi-view"></td>
                    </tr>
                </table>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
    // Modal Trigger
    $('#View').on('shown.bs.modal', function () {  
        $('#View').trigger('focus');
    });

    // Menampilkan Detail topik dengan Modal
    $('.show').click(function(e) {
        let id = $(this).attr('id');
        $.ajax({
            type: "GET",
            url: "{{ url('admin/topik') }}/"+id,
            dataType: "JSON",
            success: function(data) {
                $("#id-view").html(data.id);
                $('#nama-view').html(data.nama);
                $('#deskripsi-view').html(data.deskripsi);
            }
        })
    })

    // Edit Handler, ketika tombol Edit, di klik akan otomatis mengisi form diatas
    $('.edit').click(function(e) {
        let id = $(this).attr('id');
        $.ajax({
            type: "GET",
            url: "{{ url('admin/topik') }}/"+id,
            dataType: "JSON",
            success: function(data) {
                $('#nama').val(data.nama);
                $('#deskripsi').val(data.deskripsi);
                $('form').attr('action', "{{ url('admin/topik') }}"+"/"+id);
                $('#file').prop('required', false);
            }
        });
    });

    // Delete Handler, ketika tombol Delete, di klik akan otomatis mengisi form diatas
    $('.delete').click(function(e) {
        var id = $(this).attr('id');
        console.log(id);
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
                    url: id+'/delete',
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