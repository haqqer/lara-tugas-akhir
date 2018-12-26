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
            <div class="card-header">{{ __('Input Download') }}</div>

                <div class="card-body">
                    <!-- Form Input Anggota -->
                    <form method="POST" action="{{ url('admin/download') }}" enctype="multipart/form-data">
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
                            <label for="kategori" class="col-md-4 col-form-label text-md-right">Kategori</label>

                            <div class="col-md-6">
                                <!-- <input id="kategori" type="text" class="form-control{{ $errors->has('kategori') ? ' is-invalid' : '' }}" name="kategori" value="{{ old('kategori') }}" required> -->
                                <select name="kategori" id="kategori" class="form-control">
                                        <option selected>-- Pilih Kategori --</option>
                                        <option value="jurnal">jurnal</option>
                                        <option value="ebook">ebook</option>
                                </select>
                                @if ($errors->has('kategori'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('kategori') }}</strong>
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

                        <div class="form-group row">
                            <label for="file" class="col-md-4 col-form-label text-md-right">File</label>

                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control-file{{ $errors->has('file') ? ' is-invalid' : '' }}" name="file" required>

                                @if ($errors->has('file'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('file') }}</strong>
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
                            <th>Kategori</th>
                            <th>File</th>
                            <th>Created</th>
                            <th>Update</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($daftardls as $download)
                            <tr id="{{  $download->id }}">
                                <td>{{ $i++ }}</td>
                                <td>{{ $download->nama }}</td>
                                <td>{{ $download->deskripsi }}</td>
                                <td>{{ $download->kategori }}</td>
                                <td><a href="{{ asset('uploads/donwload') }}/{{ $download->file }}" download>Download</a></td>
                                <td>{{ $download->created_at->diffForHumans() }}</td>
                                <td>{{ $download->updated_at->diffForHumans() }}</td>
                                <td><button type="button" class="show btn btn-outline-primary" data-toggle="modal" data-target="#View" id="{{ $download->id }}">View</button>|
                                    <button type="button" class="delete btn btn-outline-danger" id="{{ $download->id }}">Hapus</button>|
                                    <button type="button" class="edit btn btn-outline-success" id="{{ $download->id }}">Edit</button></td>
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

    // Menampilkan Detail download dengan Modal
    $('.show').click(function(e) {
        let id = $(this).attr('id');
        $.ajax({
            type: "GET",
            url: id,
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
            url: "{{ url('admin/download') }}/"+id,
            dataType: "JSON",
            success: function(data) {
                $('#nama').val(data.nama);
                $('#deskripsi').val(data.deskripsi);
                $('form').attr('action', "{{ url('admin/download') }}"+"/"+id);
                $('#file').prop('required', false);
            }
        });
        $.ajax({
            type: "GET",
            url: "download/kategori",
            dataType: "JSON",
            success: function(data) {
                var i;
                var kategori=$('#kategori');
                kategori.empty();
                kategori.append('<option>-- Pilih Kategori --</option>');
                for(i=0;i<data.length; i++) {
                    if(data[i] == '{{ $download->kategori }}') {
                        kategori.append('<option value='+data[i]+' selected>'+data[i]+'</option>');
                    } else {
                        kategori.append('<option value='+data[i]+'>'+data[i]+'</option>');
                    }
                }
            }
        })
        // $('#kategori option').text();
        console.log($('#kategori option').text())
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