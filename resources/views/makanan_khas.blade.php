<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Makanan Khas Indonesia</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .section-space {
      padding-top: 80px;
      padding-bottom: 80px;
    }
    #hero {
      background: linear-gradient(0deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("img/spice.jpg") no-repeat; /*gambarBG*/
      background-size: cover;
      height: 100vh;
    }
    #hero p {
      line-height: 1.5rem;
    }
    #makanan-khas h2 {
      margin-bottom: 4rem;
      font-family: 'Courier New', Courier, monospace
    }
    #form-tambah {
      background-color: #EFE3D0;
    }
    #form-tambah .subheading {
      font-size: 20px;
      font-style: oblique;
      
    }
    footer {
      padding-top: 5px;
      padding-bottom: 5px;
    }
    #deskripsi-count {
      margin-top: 2px;
    }
   
  </style>
</head>
<body>
  @if ($errors->any())
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>
  @endif
  <section id="hero">
    <div class="container h-100">
      <div class="h-100 align-items-center row">
        <div class="text-white col-12 col-md-6">
          <h1 class="display-3 fw-bold">Makanan Khas Indonesia</h1>
          <p>Makanan khas daerah adalah makanan yang biasa dikonsumsi di suatu daerah dan
             cocok dengan lidah masyarakat setempat. Biasanya, setiap daerah memiliki cita rasanya
             masing-masing yang membuatnya menjadi suatu ciri khas dari daerah tersebut. </p>
        </div>
          <!-- AMBIL VIDEO DARI YOUTUBE -->
        <div class="col-12 col-md-6">
          <iframe width="460" height="215" src="https://www.youtube.com/eLR4Bw-xdyA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </section>

 <!-- TAMBAH MAKANAN -->
  <section id="form-tambah" class="section-space">
    <div class="container">
      <p class="text-center subheading">Makanan Khas Daerahmu Belum Masuk Daftar?</p>
      <h2 class="text-center">Tambahkan Makanan Khas Daerahmu</h2>
      <form action="{{ route('tambah.makanan.khas') }}" method="POST" enctype="multipart/form-data">
        @csrf
       
        <div class="mb-3">
       
          <label for="nama-makanan-khas" class="form-label">Nama Makanan</label>
          <input type="text" class="form-control" id="nama-makanan-khas" name="nama" required>
        
        </div>
        <div class="mb-3">
          <label for="daerah-makanan-khas" class="form-label">Daerah</label>
          <input type="text" class="form-control" id="daerah-makanan-khas" name="daerah" required>
        </div>
        <div class="mb-3">
          <label for="deskripsi-makanan-khas" class="form-label">Deskripsi Singkat</label>
          <textarea type="text" class="form-control" id="deskripsi-makanan-khas" name="deskripsi" maxlength="300" rows="4" required></textarea>
          <span id="deskripsi-count">0 / 300</span>
        </div>
        <div class="mb-3">
          <label for="gambar-makanan-khas" class="form-label">Gambar Makanan</label>
          <input class="form-control" type="file" name="gambar" id="gambar-makanan-khas" required>
        </div>
        <button type="submit" class="btn btn-warning">Submit</button>
      </form>
    </div>
  </section>
  
   <!-- TAMPIL MAKANAN -->
   <section id="makanan-khas" class="section-space">
    <div class="container">
      <h2 class="text-center text- ">Daftar Makanan Khas Indonesia</h2>
      @if (count($makanan_khas) > 0)
      <div class="row g-3">
        @foreach ($makanan_khas as $makanan)
        <div class="col-lg-3 col-md-4 col-12">
          <div class="card border-dark h-100">
            <img src="{{$makanan->gambar}}" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">{{$makanan->nama}}</h5>
              <h6 class="mb-2 card-subtitle text-muted">{{$makanan->daerah}}</h6>
              <p class="card-text">{{$makanan->deskripsi}}</p>
            </div>
            <div class="card-footer border-dark ">
              <div class="row">
                <div class="col-6">
                  <!-- tombol hapus makanan khas -->
                  <form action="{{ route('hapus.makanan.khas', $makanan->id),  }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100">Hapus</button>
                  </form>
                </div>
                <div class="col-6">
                  <!-- tombol update makanan khas -->
                  <button data-bs-toggle="modal" data-bs-target="#editMakananKhas" class="btn btn-outline-primary w-100" 
                  onclick="updateEditMakananForm('{{ $makanan->id }}', '{{ $makanan->nama }}', '{{ $makanan->daerah }}', 
                  '{{ $makanan->deskripsi }}')">Edit</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @else
      <p class="text-center text-muted">Belum ada Makanan Khas yang terdaftar</p>
      @endif
    </div>
  </section>

  <footer>
    <p class="m-0 text-center">Made with ❤️ by Berlynda</p>
  </footer>

  <!-- Modal edit makanan khas -->
  <div class="modal fade" id="editMakananKhas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editMakananKhasLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editMakananKhasLabel">Edit Makanan Khas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formUpdateMakanan" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="update-nama-makanan-khas" class="form-label">Nama Makanan</label>
              <input type="text" class="form-control" id="update-nama-makanan-khas" name="nama" required>
            </div>
            <div class="mb-3">
              <label for="update-daerah-makanan-khas" class="form-label">Daerah</label>
              <input type="text" class="form-control" id="update-daerah-makanan-khas" name="daerah" required>
            </div>
            <div class="mb-3">
              <label for="update-deskripsi-makanan-khas" class="form-label">Deskripsi Singkat</label>
              <textarea type="text" class="form-control" id="update-deskripsi-makanan-khas" name="deskripsi" maxlength="254" rows="4" required></textarea>
              <span id="update-deskripsi-count">0 / 300</span>
            </div>
            <div class="mb-3">
              <label for="update-gambar-makanan-khas" class="form-label">Gambar Makanan</label>
              <input class="form-control" type="file" name="gambar" id="update-gambar-makanan-khas">
            </div>
            <button type="submit" class="btn btn-success">Update</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Script Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Script custom -->
  <script src="js/main.js"></script>
</body>
</html>