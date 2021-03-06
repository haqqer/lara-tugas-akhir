
<div class="row justify-content-center mt-5">
    <div class="col-8">
        <center><h2>Informasi</h2></center>
    </div>
</div>
@foreach($data as $berita)
<div class="row justify-content-center mt-3">
    <div class="col-10">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-10">
                        <h1>{{ $berita->judul }}</h1>
                        <h5><small>{{ $berita->created_at->diffForHumans() }} - {{ $berita->user->name }}</small></h5>
                        <hr>
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
@endforeach