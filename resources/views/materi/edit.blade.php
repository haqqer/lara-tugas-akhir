@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="p-2">
            <a class="btn btn-outline-primary" href="{{ url('admin/materi/create') }}">Create</a>
            <a class="show btn btn-outline-success" href="{{ url('admin/materi') }}/{{ $materi->id }}/show" id="{{ $materi->id }}">View</a>
            <button type="button" class="delete btn btn-outline-danger" id="{{ $materi->id }}">Hapus</button>
            <a class="btn btn-outline-secondary" href="{{ url('admin/materi') }}">Back</a>          
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">Input materi</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <!-- Form Input Anggota -->
                            <form method="POST" action="{{ url('admin/materi') }}/{{ $materi->id }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="judul" >Judul</label>
                                    <div class="">
                                        <input id="judul" type="text" class="form-control{{ $errors->has('judul') ? ' is-invalid' : '' }}" name="judul" value="{{ $materi->judul }}" required autofocus>

                                        @if ($errors->has('judul'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('judul') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="deskripsi" >Content</label>

                                    <div class="">
                                        <!-- <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="l" value="{{ old('email') }}" required> -->
                                        <textarea name="deskripsi" id="editor">{{ $materi->deskripsi }}</textarea>

                                        @if ($errors->has('deskripsi'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('deskripsi') }}</strong>
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