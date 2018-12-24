@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="p-2">
            <a class="btn btn-outline-primary" href="{{ url('admin/kegiatan/create') }}">Create</a>
            <a class="show btn btn-outline-success" href="{{ url('admin/kegiatan') }}/{{ $kegiatan->id }}/show" id="{{ $kegiatan->id }}">View</a>
            <button type="button" class="delete btn btn-outline-danger" id="{{ $kegiatan->id }}">Hapus</button>
            <a class="btn btn-outline-secondary" href="{{ url('admin/kegiatan') }}">Back</a>          
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">Input Kegiatan</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <!-- Form Input Anggota -->
                            <form method="POST" action="{{ url('admin/kegiatan') }}/{{ $kegiatan->id }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="judul" >Judul</label>
                                    <div class="">
                                        <input id="judul" type="text" class="form-control{{ $errors->has('judul') ? ' is-invalid' : '' }}" name="judul" value="{{ $kegiatan->judul }}" required autofocus>

                                        @if ($errors->has('judul'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('judul') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="kegiatan" >Jenis Kegiatan</label>
                                    <div class="">
                                        <select class="form-control" id="jenis" name="jenis">
                                        </select>                                        

                                        @if ($errors->has('jenis'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('judul') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="deskripsi" >Content</label>

                                    <div class="">
                                        <textarea name="deskripsi" id="editor">{{ $kegiatan->deskripsi }}</textarea>

                                        @if ($errors->has('deskripsi'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('deskripsi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">tanggal</label>
                                    <div class="">
                                        <input id="tanggal" type="date" class="form-control{{ $errors->has('tanggal') ? ' is-invalid' : '' }}" name="tanggal" value="{{ date('Y-m-d',strtotime($kegiatan->waktu)) }}" required autofocus>

                                        @if ($errors->has('tanggal'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('tanggal') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="waktu">waktu</label>
                                    <div class="">
                                        <input id="waktu" type="time" class="form-control{{ $errors->has('waktu') ? ' is-invalid' : '' }}" name="waktu" value="{{ date('H:i:s',strtotime($kegiatan->waktu)) }}" required autofocus>

                                        @if ($errors->has('waktu'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('waktu') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tempat">tempat</label>
                                    <div class="">
                                        <input id="tempat" type="string" class="form-control{{ $errors->has('tempat') ? ' is-invalid' : '' }}" name="tempat" value="{{ $kegiatan->tempat }}" required autofocus>

                                        @if ($errors->has('tempat'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('tempat') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="file" >File Foto</label>

                                    <div class="">
                                        <input id="foto" type="file" accept="image/*" class="form-control-file{{ $errors->has('foto') ? ' is-invalid' : '' }}" name="foto">

                                        @if ($errors->has('foto'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('foto') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>                        

                                <div class="form-group mt-2">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary" id="save">
                                            Submit
                                        </button>
                                        <button type="reset" class="btn btn-success">
                                            Reset
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END FORM -->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function(e) {
        $.ajax({
            type: 'GET',
            url: '{{ url("admin/kegiatan/jenis_kegiatan") }}',
            dataType: 'JSON',
            success: function(data) {
                var kategori = $('#jenis');
                kategori.empty();
                kategori.append('<option>-- Pilih Jenis Kegiatan --</option>');
                for(var i=0;i<data.length;i++) {
                    if(data[i] == "{{ $kegiatan->jenis }}") {
                        kategori.append('<option value='+data[i]+' selected>'+data[i]+'</option>');    
                    }
                    kategori.append('<option value='+data[i]+'>'+data[i]+'</option>');
                }      
            }
        })
    });
    $('#editor').ckeditor();
    // $('.textarea').ckeditor(); // if class is prefered.
</script>
@endsection