<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MeowMoment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="{{ asset('images/MeowMoment_logo.png') }}">
  <link href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    /* ===== Café Theme + Responsive Booster (Public Layout) ===== */
    *,*::before,*::after{box-sizing:border-box}
    img,video,svg,canvas{max-width:100%;height:auto}
    :root{--coffee:#6b4226;--cream:#fff8da;--cream2:#FFF7E1;--accent:#FFDD72;--beige:#e6ccb2}

    body{background-color:var(--cream);color:#5c4630;font-family:'Kodchasan',sans-serif}

    /* Navbar */
    .navbar{background:var(--coffee)}
    .navbar-brand{color:var(--accent)!important;font-weight:700;font-size:36px}
    .navbar-nav .nav-link{color:var(--cream2)!important;font-weight:600;font-size:20px;margin:12px 6px 0 0}
    .navbar-nav .nav-link:hover,.navbar-nav .nav-link.active{color:var(--accent)!important}
    .btn-login{background:#F1D7A4;color:#4A2C2A;font-weight:600;border-radius:30px;padding:6px 18px}
    .btn-login:hover{background:#D08B49;color:#fff}

    /* Mobile navbar polish */
    .navbar .navbar-toggler{border-color:rgba(255,255,255,.45);padding:.35rem .5rem}
    .navbar .navbar-toggler:focus{box-shadow:none}
    .navbar .navbar-toggler-icon{filter:invert(100%);opacity:.9}
    @media (max-width: 991.98px){
      .navbar-brand{font-size:28px}
      .navbar-collapse{background:var(--coffee);padding:.5rem 0}
      .navbar-nav .nav-link{margin:.25rem 0;font-size:18px}
      .btn-login{width:100%;margin-top:.5rem}
    }

    /* Cards & grids */
    .card{border:none;border-radius:16px;box-shadow:0 2px 8px rgba(0,0,0,.1)}
    .card-img-top{width:100%;height:clamp(150px,22vw,240px);object-fit:cover}
    .row{--bs-gutter-x:1rem;--bs-gutter-y:1rem}

    /* Forms / filters compress nicely */
    @media (max-width:768px){
      .filter-wrap{row-gap:10px;column-gap:10px}
      .filter-wrap .form-select,.filter-wrap .form-control,.filter-wrap .btn{width:100%!important}
    }

    /* Tables scroll on small screens */
    table{display:block;width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch;border-collapse:collapse}

    /* Pagination – centered, café theme */
    .pagination{display:inline-flex;gap:6px;list-style:none;padding-left:0;justify-content:center;margin:0}
    .page-item .page-link{
      display:inline-flex;justify-content:center;align-items:center;
      min-width:42px;height:42px;border-radius:50%;border:none;background:#fff;color:var(--coffee);
      font-weight:600;padding:0 12px;transition:all .15s ease;box-shadow:0 1px 3px rgba(0,0,0,.08)
    }
    .page-item .page-link:hover,.page-item .page-link:focus{background:var(--coffee);color:var(--cream)}
    .page-item.active .page-link{background:var(--coffee);color:var(--cream);box-shadow:0 2px 6px rgba(0,0,0,.12)}
    .page-item.disabled .page-link{background:#f2e9d2;color:#9e8a78}
    @media (max-width:576px){.page-item .page-link{min-width:36px;height:36px}}
  </style>

  @yield('css_before')
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="/">
        <img src="{{ asset('images/MeowMoment_logo.png') }}" alt="MeowMoment Logo" style="height:60px;width:auto;margin-right:10px">
        MeowMoment
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/cat_page">Cat</a></li>
          <li class="nav-item"><a class="nav-link" href="/menu_page">Menu</a></li>
          <li class="nav-item"><a class="nav-link" href="/promotion_page">Promotion</a></li>
        </ul>
        <a href="/login" class="btn btn-login">Login</a>
      </div>
    </div>
  </nav>

  <div class="container mt-2">
    <div class="row">
      @yield('showProduct')
    </div>
  </div>

  <footer class="mt-5 mb-2 text-center" style="color:#6b4226;font-size:.9rem">
    <p>by MeowManager @2025</p>
    <p>This page is intended for educational and non-commercial use only. Some images or content displayed may be subject to copyright or licensing restrictions. All rights remain with their respective owners.</p>
  </footer>

  @yield('footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
          crossorigin="anonymous"></script>

  @yield('js_before')
</body>
</html>
