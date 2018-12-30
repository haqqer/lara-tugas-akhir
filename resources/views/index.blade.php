<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LabRPL - Website</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>    
    <style>
        body {
          padding-top: 54px;
        }        
    </style>

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.html">LabRPL</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="Penelitian" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Penelitian
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Penelitian">
                <a class="dropdown-item" href="#">Topik Research</a>
                <a class="dropdown-item" href="#">Publikasi</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="Anggota" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Anggota
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Anggota">
                <a class="dropdown-item" href="#dosen">Dosen</a>
                <a class="dropdown-item" href="#mahasiswa">Mahasiswa</a>
                <a class="dropdown-item" href="#alumni">Alumni</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#berita">Informasi</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="Download" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Download
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Download">
                <a class="dropdown-item" href="#downloadjurnal">Jurnal</a>
                <a class="dropdown-item" href="#downloadebook">EBooks</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#materi">Materi</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#kegiatan" id="Kegiatan" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Kegiatan
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Kegiatan">
                <a class="dropdown-item" href="#kegiatanworkshop">Workshop</a>
                <a class="dropdown-item" href="#kegiatanklinik">Klinik</a>
                <a class="dropdown-item" href="#kegiatanlomba">Lomba</a>
              </div>
            </li>
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest

          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container" id="content">
      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Lab
        <small>Rekayasa Perangkat Lunak</small>
      </h1>

      <!-- Image Header -->
      <img class="img-fluid rounded mb-4" src="http://placehold.it/1200x300" alt="">

      <!-- Marketing Icons Section -->
      <div class="row">
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header">Card Title</h4>
            <div class="card-body">
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque.</p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary">Learn More</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header">Card Title</h4>
            <div class="card-body">
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis ipsam eos, nam perspiciatis natus commodi similique totam consectetur praesentium molestiae atque exercitationem ut consequuntur, sed eveniet, magni nostrum sint fuga.</p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary">Learn More</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header">Card Title</h4>
            <div class="card-body">
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque.</p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary">Learn More</a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-3 mt-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Haqqer 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <script>

      $('a[href="#mahasiswa"]').click(function() {
        loadPHP('mahasiswa');
      });

      $('a[href="#dosen"]').click(function() {
        loadPHP('dosen');
      });

      $('a[href="#alumni"]').click(function() {
        loadPHP('alumni');
      });

      $('a[href="#berita"]').click(function() {
        loadPHP('berita');
      });

      $('a[href="#materi"]').click(function() {
        loadPHP('materi');
      });
      
      $('a[href="#kegiatanworkshop"]').click(function() {
        loadPHP('kegiatanworkshop');
      });

      $('a[href="#kegiatanklinik"]').click(function() {
        loadPHP('kegiatanklinik');
      });

      $('a[href="#downloadjurnal"]').click(function() {
        loadPHP('downloadjurnal');
      });

      $('a[href="#downloadebook"]').click(function() {
        loadPHP('downloadebook');
      });            

      function loadPHP(id_name) {
          $.ajax({
            type: "GET",
            url: "api/"+id_name,
            success: function(data) {
              $('#content').empty();
              $('#content').html(data);
            }
          })
      }
    </script>
  </body>

</html>
