<div class="card mt-5">
    <div class="card-header">
        Mahasiswa
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                <th>No</th>w
                <th>Username</th>
                <th>Email</th>
                <th>Created</th>
                <th>Update</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $mahasiswa)
                    @php
                        $identitas = $mahasiswa->nim;
                    @endphp
                <tr id="{{ $mahasiswa->id }}">
                    <td>{{ $i++ }}</td>
                    <td>{{ $mahasiswa->nama }}</td>
                    <td>{{ $mahasiswa->email }}</td>
                    <td>{{ $mahasiswa->created_at->diffForHumans() }}</td>
                    <td>{{ $mahasiswa->updated_at->diffForHumans() }}</td>
                    <td><button type="button" class="show btn btn-outline-primary" data-toggle="modal" data-target="#View" id="{{ $mahasiswa->id }}">View</button>|
                </tr>
                @endforeach
        </tbody>
    </table>        
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

        $.ajax({
            type: "GET",
            url: "{{ url('api/mahasiswa') }}/"+id,
            dataType: "JSON",
            success: function(data) {
                $("#id-view").html(data.id);
                $('#nama-view').html(data.nama);
                $('#email-view').html(data.email);
                $('#identitas-view').html(data.nim);
                $('#foto-view').attr('src', "{{ asset('uploads/images') }}"+"/mahasiswa/"+data.foto)

            }
        })
    })    
</script>