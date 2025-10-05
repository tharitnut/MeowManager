<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MeowMoment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="{{ asset('images/MeowMoment_logo.png') }}">

  <!-- Cat Café Theme -->
  <style>
    body {
      background-color: #fff8da; /* cream background */
      color: #5c4630;            /* dark mocha text */
      font-family: 'Kodchasan', sans-serif;
    }

    .navbar { background-color: #6b4226; } /* coffee brown */

    .navbar-brand {
      color: #FFDD72 !important; /* cream */
      font-weight: 700;
      font-size: 36px;
    }

    .navbar-nav .nav-link {
      color: #FFF7E1 !important; /* cream */
      font-weight: 600;
      font-size: 20px;
      margin: 12px 6px 0 0; /* top right bottom left */
      transition: color 0.3s ease;
    }
    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active { color: #FFDD72 !important; }

    .btn-login {
      background-color: #F1D7A4;
      color: #4A2C2A;
      font-weight: 600;
      border-radius: 30px;
      padding: 6px 18px;
      transition: all 0.3s ease;
    }
    .btn-login:hover { background-color: #D08B49; color: #FFFFFF; }

    footer { color: #6b4226; font-size: 0.9rem; }

    /* === Mobile navbar polish === */
    .navbar .navbar-toggler {
      border-color: rgba(255,255,255,.45);
      padding: .35rem .5rem;
    }
    .navbar .navbar-toggler:focus { box-shadow: none; }
    /* .navbar-dark normally handles icon color; keep a safety net: */
    .navbar .navbar-toggler-icon { filter: invert(100%); opacity: .9; }

    @media (max-width: 991.98px) {
      .navbar-brand { font-size: 28px; }
      .navbar-collapse {
        background-color: #6b4226; /* same coffee brown */
        padding: .5rem 0;
      }
      .navbar-nav .nav-link {
        margin: .25rem 0;  /* tighter vertical spacing on mobile */
        font-size: 18px;
      }
      .btn-login {
        margin-top: .5rem;
        width: 100%;       /* easy tap target */
      }
    }
  </style>

  @yield('css_before')
</head>

<body>

  <!-- start navbar  -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid"> <!-- full width -->
      <a class="navbar-brand d-flex align-items-center" href="/">
        <img src="{{ asset('images/MeowMoment_logo.png') }}" alt="MeowMoment Logo"
             style="height:60px; width:auto; margin-right:10px;">
        MeowMoment
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" aria-current="page" href="/">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/cat_page">Cat</a></li>
          <li class="nav-item"><a class="nav-link" href="/menu_page">Menu</a></li>
          <li class="nav-item"><a class="nav-link" href="/promotion_page">Promotion</a></li>
        </ul>
        <a href="/login" class="btn btn-login">Login</a>
      </div>
    </div>
  </nav>
  <!-- end navbar  -->

  <div class="container mt-2">
    <div class="row">
      @yield('showProduct')
    </div>
  </div>

  <footer class="mt-5 mb-2 text-center">
    <p>by MeowManager @2025</p>
    <p>
      This page is intended for educational and non-commercial use only. Some
      images or content displayed may be subject to copyright or licensing
      restrictions. All rights remain with their respective owners.
    </p>
  </footer>

  @yield('footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
          crossorigin="anonymous"></script>

  @yield('js_before')
</body>
</html>
