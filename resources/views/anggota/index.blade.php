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
            <div class="card-header">{{ $id_name }}</div>

                <div class="card-body">
                    <!-- Form Input Anggota -->
                    <form method="POST" action="{{ url('admin/anggota/'.$id_name) }}" enctype="multipart/form-data">
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
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_identitas" class="col-md-4 col-form-label text-md-right">NIM/NPP</label>

                            <div class="col-md-6">
                                <input id="no_identitas" type="text" class="form-control{{ $errors->has('no_identitas') ? ' is-invalid' : '' }}" name="no_identitas" value="{{ old('no_identitas') }}" required>

                                @if ($errors->has('no_identitas'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('no_identitas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-md-4 col-form-label text-md-right">File Foto</label>

                            <div class="col-md-6">
                                <input id="foto" type="file" accept="image/*" class="form-control-file{{ $errors->has('foto') ? ' is-invalid' : '' }}" name="foto" required>

                                @if ($errors->has('foto'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('foto') }}</strong>
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
                            <th>Username</th>
                            <th>Email</th>
                            <th>Created</th>
                            <th>Update</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($anggotas as $anggota)
                                @php
                                    $identitas = $anggota->nim;
                                    if($id_name == 'dosen') {
                                        $identitas = $anggota->npp;
                                    }
                                @endphp
                            <tr id="{{ $id_name }}_{{ $anggota->id }}">
                                <td>{{ $i++ }}</td>
                                <td>{{ $anggota->nama }}</td>
                                <td>{{ $anggota->email }}</td>
                                <td>{{ $anggota->created_at->diffForHumans() }}</td>
                                <td>{{ $anggota->updated_at->diffForHumans() }}</td>
                                <td><button type="button" class="show btn btn-outline-primary" data-toggle="modal" data-target="#View" id="{{ $anggota->id }}">View</button>|
                                    <!-- <button type="button" class="btn btn-outline-danger" onclick="deleteData(`{{ url('admin/anggota/'.$id_name.'/'.$anggota->id) }}`)">Hapus</button>| -->
                                    <button type="button" class="delete btn btn-outline-danger" id="{{ $anggota->id }}">Hapus</button>|
                                    <button type="button" class="edit btn btn-outline-success" id="{{ $anggota->id }}">Edit</button></td>
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
            <div class="col-4">
                <img src="" alt="profile" class="img-thumbnail" id="foto-view">
            </div>
            <div class="col-8">
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
                        <th>Email</th>
                        <td id="email-view"></td>
                    </tr>
                    <tr>
                        <th>NIM/NPP</th>
                        <td id="identitas-view"></td>
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

    // Menampilkan Detail anggota dengan Modal
    $('.show').click(function(e) {
        let id = $(this).attr('id');
        let express = $('{{ $id_name }}'+"_"+id).val();
        $.ajax({
            type: "GET",
            url: '{{ $id_name }}'+"/"+id,
            dataType: "JSON",
            success: function(data) {
                $("#id-view").html(data.id);
                $('#nama-view').html(data.nama);
                $('#email-view').html(data.email);
                @if($id_name == 'dosen')
                $('#identitas-view').html(data.npp);
                @else
                $('#identitas-view').html(data.nim);
                @endif
                $('#foto-view').attr('src', "{{ asset('uploads/images') }}"+"/"+"{{ $id_name }}"+"/"+data.foto)

            }
        })
    })

    // Edit Handler, ketika tombol Edit, di klik akan otomatis mengisi form diatas
    $('.edit').click(function(e) {
        let id = $(this).attr('id');
        let express = $('{{ $id_name }}'+"_"+id).val();
        $.ajax({
            type: "GET",
            url: '{{ $id_name }}'+"/"+id,
            dataType: "JSON",
            success: function(data) {
                $('#nama').val(data.nama);
                $('#email').val(data.email);
                @if($id_name == 'dosen')
                $('#no_identitas').val(data.npp);
                @else
                $('#no_identitas').val(data.nim);
                @endif
                $('form').attr('action', "{{ url('admin/anggota/'.$id_name) }}"+"/"+id);
                $('#foto').prop('required', false);
            }
        })
    });

    // Delete Handler, ketika tombol Delete, di klik akan otomatis mengisi form diatas
    $('.delete').click(function(e) {
        var id = $(this).attr('id');
        console.log(id);
        var express = $('{{ $id_name }}'+"_"+id).val();
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
                    url: '{{ $id_name }}'+'/'+id+'/delete',
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