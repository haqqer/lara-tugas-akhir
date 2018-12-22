@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">Input Kegiatan</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <!-- Form Input Anggota -->
                            <form method="POST" action="{{ url('admin/kegiatan') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="judul" >Judul</label>
                                    <div class="">
                                        <input id="judul" type="text" class="form-control{{ $errors->has('judul') ? ' is-invalid' : '' }}" name="judul" value="{{ old('judul') }}" required autofocus>

                                        @if ($errors->has('judul'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('judul') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="kegiatan" >kegiatan</label>
                                    <div class="">
                                        <select class="form-control" id="jenis" name="jenis">
                                            <option selected>-- Pilih Jenis Kegiatan --</option>
                                            <option value="workshop">Workshop</option>
                                            <option value="seminar">Seminar</option>
                                            <option value="diskusi">Diskusi</option>
                                        </select>                                        

                                        @if ($errors->has('jenis'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('judul') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="deskripsi" >Deskripsi</label>

                                    <div class="">
                                        <!-- <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="l" value="{{ old('email') }}" required> -->
                                        <textarea name="deskripsi" id="editor">{{ old('deskripsi') }}</textarea>

                                        @if ($errors->has('deskripsi'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('deskripsi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="waktu">waktu</label>
                                    <div class="">
                                        <input id="waktu" type="date" class="form-control{{ $errors->has('waktu') ? ' is-invalid' : '' }}" name="waktu" value="{{ old('waktu') }}" required autofocus>

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
                                        <input id="tempat" type="string" class="form-control{{ $errors->has('tempat') ? ' is-invalid' : '' }}" name="tempat" value="{{ old('tempat') }}" required autofocus>

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
                                        <input id="foto" type="file" accept="image/*" class="form-control-file{{ $errors->has('foto') ? ' is-invalid' : '' }}" name="foto" required>

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
    $('#editor').ckeditor();
    // $('.textarea').ckeditor(); // if class is prefered.
</script>
@endsection