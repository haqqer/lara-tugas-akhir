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
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $download)
                <tr id="{{  $download->id }}">
                    <td>{{ $i++ }}</td>
                    <td>{{ $download->nama }}</td>
                    <td>{{ $download->deskripsi }}</td>
                    <td>{{ $download->kategori }}</td>
                    <td><a href="{{ asset('uploads/donwload') }}/{{ $download->file }}" download>Download</a></td>
                    <td>{{ $download->created_at->diffForHumans() }}</td>
                    <td><button type="button" class="show btn btn-outline-primary" data-toggle="modal" data-target="#View" id="{{ $download->id }}">View</button>
                </tr>
                @endforeach
        </tbody>
    </table>        
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
    $('#View').on('shown.bs.modal', function () {  
        $('#View').trigger('focus');
    });
    // Menampilkan Detail download dengan Modal
    $('.show').click(function(e) {
        let id = 'api/daftardl/'+$(this).attr('id');
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
</script>