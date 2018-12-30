
<div class="row justify-content-center mt-5">
    <div class="col-8">
        <center><h2>Materi</h2></center>
    </div>
</div>
@foreach($data as $materi)
<div class="row justify-content-center mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-10">
                        <h2>{{ $materi->judul }}</h2>
                        <hr>
                        <div class="content mt-5">
                            {!! $materi->deskripsi !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endforeach