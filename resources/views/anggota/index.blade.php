@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
            @if(session('success-msg'))
            <div class="alert alert-success">
              {{session('success-msg')}}
            </div>
            @elseif(session('fail-msg'))
            <div class="alert alert-danger">
              {{session('fail-msg')}}
            </div>
            @endif
        <div class="card">
            <div class="card-header">{{ $id_name }}</div>

                <div class="card-body">
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
                            <th>NIM / NPP</th>
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
                            <tr id="mahasiswa_{{ $anggota->id }}">
                                <td>{{ $i++ }}</td>
                                <td>{{ $anggota->nama }}</td>
                                <td>{{ $anggota->email }}</td>
                                <td>{{ $identitas }}</td>
                                <td>{{ $anggota->created_at->diffForHumans() }}</td>
                                <td>{{ $anggota->updated_at->diffForHumans() }}</td>
                                <td><button type="button" class="edit btn btn-outline-primary" data-toggle="modal" data-target="#View" id="{{ $anggota->id }}">View</button>|<button type="button" class="btn btn-outline-danger">Hapus</button></td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>        
            </div>
        </div>
    </div>
</div>

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
            <div class="col-8">
                
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
    $('#View').on('shown.bs.modal', function () {  
        $('#View').trigger('focus');
    });
    $('.edit').click(function(e) {
        let id = $(this).attr('id');
        let data = $('#mahasiswa_'+id).val();
        $.ajax({
            type: "GET",
            url: id,
            dataType: "JSON",
            success: function(data) {
                $('#nama').val(data.nama);
                $('#email').val(data.email);
                @if($id_name == 'dosen')
                $('#identitas').val(data.npp);
                @else
                $('#identitas').val(data.nim);
                @endif

            }
        })
    })    
</script>
@endsection