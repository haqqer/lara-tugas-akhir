<div class="row mt-5">
    @foreach($data as $kegiatan)
    <div class="col-4">
        <div class="card">
            <img class="card-img-top" src="{{ asset('uploads/images/kegiatan') }}/{{ $kegiatan->foto }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{ $kegiatan->judul }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $kegiatan->jenis }}</h6>
                <p class="card-text">{!! $kegiatan->deskripsi !!}</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>        
    </div>
    @endforeach
</div>