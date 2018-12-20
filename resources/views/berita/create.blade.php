@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">Input Berita</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <!-- Form Input Anggota -->
                            <form method="POST" action="{{ url('admin/berita') }}" enctype="multipart/form-data">
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
                                    <label for="kategori" >kategori</label>
                                    <div class="">
                                        <select class="form-control" id="kategori" name="kategori_id">
                                        </select>                                        

                                        @if ($errors->has('kategori_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('judul_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="deskripsi" >Content</label>

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
    $(document).ready(function(e) {
        $.ajax({
            type: 'GET',
            url: '{{ url("admin/kategori") }}',
            dataType: 'JSON',
            success: function(data) {
                var kategori = $('#kategori');
                kategori.empty();
                kategori.append('<option selected>-- Pilih Kategori --</option>')
                for(var i=0;i<data.length;i++) {
                    kategori.append('<option value='+data[i].id+'>'+data[i].nama+'</option>');
                }
            }
        })
    });
    $('#editor').ckeditor();
    // $('.textarea').ckeditor(); // if class is prefered.
</script>
@endsection