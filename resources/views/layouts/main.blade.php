<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apotek Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/73bcd336f4.js" crossorigin="anonymous"></script>
</head>
<body >
    <div class="min-vh-100">
        @yield('main')
    </div>

<footer class="bg-dark text-white pt-4 pb-2 mt-5">
    <div class="container text-center text-md-start">
      <div class="row">
        <!-- Kolom 1 -->
        <div class="col-md-4 mb-3">
          <h5>Apotek Jaya</h5>
          <p>Kami menyediakan solusi alat kesehatan terbaik untuk kebutuhan Anda.</p>
        </div>

        <!-- Kolom 2 -->
        <div class="col-md-4 mb-3">
          <h5>Menu</h5>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white text-decoration-none">Beranda</a></li>
            <li><a href="#" class="text-white text-decoration-none">Tentang Kami</a></li>
            <li><a href="#" class="text-white text-decoration-none">Layanan</a></li>
            <li><a href="#" class="text-white text-decoration-none">Kontak</a></li>
          </ul>
        </div>

        <!-- Kolom 3 -->
        <div class="col-md-4 mb-3">
          <h5>Kontak</h5>
          <p>Email: info@apotekjaya.com</p>
          <p>Telepon: +62124353535</p>
        </div>
      </div>
    </div>
    <div class="text-center py-3 border-top mt-3">
      &copy; 2025 Apotek Jaya. All rights reserved.
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  @stack('scripts')
</body>
</html>
