<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MeowManager Back Office Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  @yield('css_before')

  <!-- Minimal, modern type + design tokens -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --bg: #f7f7f8;
      --card: #ffffff;
      --text: #0f1728;
      --muted: #667085;
      --border: #e6e7eb;
      --accent: #3b82f6;
      --danger-soft:#ffe9e9;
      --radius-lg: 16px;
      --radius-md: 12px;
      --shadow: 0 10px 32px rgba(0,0,0,.06);
      --sidebar-w: 260px;

      --topbar-h: 64px;
      --accent-ink: #ffffff;
    }

    /* Base */
    html, body { height: 100%; }
    body{
      background: var(--bg);
      color: var(--text);
      font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji","Segoe UI Emoji", sans-serif;
      -webkit-font-smoothing: antialiased;
      text-rendering: optimizeLegibility;
      letter-spacing: .1px;
    }

    /* App shell */
    .app{
      display: grid;
      grid-template-columns: var(--sidebar-w) 1fr;
      min-height: 100dvh;
    }
    @media (max-width: 991.98px){
      .app{ grid-template-columns: 1fr; }
    }

    /* === Topbar refresh === */
    .topbar{
      position: sticky;
      top: 0;
      z-index: 50;
      height: var(--topbar-h);
      background: color-mix(in srgb, var(--card) 85%, transparent);
      backdrop-filter: saturate(140%) blur(8px);
      border-bottom: 1px solid color-mix(in srgb, var(--border) 70%, transparent);
    }
    /* 3-zone header: left brand, centered title, right actions */
    .topbar-inner{
      max-width: 1200px;
      margin: 0 auto;
      height: 100%;
      padding: 0 16px;
      display: grid;
      grid-template-columns: 1fr auto 1fr;
      align-items: center;
      gap: 12px;
    }
    .topbar-left{ display:flex; align-items:center; gap:.6rem; }
    .topbar-center{
      justify-self: center;
      font-weight: 700;
      letter-spacing:.2px;
      color: var(--text);
    }
    .topbar-right{
      justify-self: end;
      display:flex; align-items:center; gap:.5rem;
    }
    .brand-badge{
      width: 28px; height: 28px; border-radius: 8px;
      background: #eff6ff; color:#3b82f6; font-weight:700;
      display:grid; place-items:center; font-size:.9rem;
    }
    /* Mobile menu button */
    .sidenav-toggle{
      border: 1px solid var(--border);
      background: var(--card);
      border-radius: 999px;
      padding: .45rem .7rem;
      font-weight: 600;
      display: none;
    }
    @media (max-width: 991.98px){
      .sidenav-toggle{ display:inline-flex; }
    }
    /* Visible, high-contrast Logout button */
/* Logout: muted red base → soft rose hover (dark-UI friendly) */
    .btn-logout{
      background: #b84b57;          /* desaturated red */
      color: #ffffff;
      border: 1px solid #b84b57;
      border-radius: 999px;
      padding: .5rem 1rem;
      font-weight: 700;
      line-height: 1;
      box-shadow: 0 6px 18px rgba(184, 75, 87, .18);
      transition: background-color .15s ease, border-color .15s ease, transform .06s ease, box-shadow .15s ease;
    }
    .btn-logout:hover{
      background: #cf7e92;          /* soft, muted pink */
      border-color: #cf7e92;
      box-shadow: 0 8px 22px rgba(207, 126, 146, .22);
    }
    .btn-logout:active{ transform: translateY(0); }

    /* Focus ring (subtle for dark UI) */
    .btn-logout:focus-visible{
      outline: 3px solid rgba(207,126,146,.35);
      box-shadow: 0 0 0 3px rgba(207,126,146,.35);
    }


    /* Sidebar */
    aside.sidenav{
      background: var(--card);
      border-right: 1px solid var(--border);
      box-shadow: var(--shadow);
      position: sticky; top: var(--topbar-h); align-self: start; height: calc(100dvh - var(--topbar-h));
      display: flex; flex-direction: column;
    }
    .sidenav .nav-wrap{
      padding: 14px;
      overflow: auto;
    }
    .nav-card{
      border: 1px solid var(--border);
      border-radius: var(--radius-lg);
      background: var(--card);
      overflow: hidden;
    }
    .nav-item{
      display: block;
      padding: .9rem 1rem;
      font-weight: 600;
      color: var(--text);
      text-decoration: none;
      transition: background-color .16s ease, transform .06s ease;
      border-top: 1px solid #f0f1f3;
    }
    .nav-item:first-child{ border-top: 0; }
    .nav-item:hover{ background: #fafafb; transform: translateX(2px); }

    .nav-item[style*="rgb(159, 238, 208)"]{
      background: #ebfff7 !important;
      color: #0f5132 !important;
    }
    .nav-item.danger{ background: var(--danger-soft); color: #b02a37; }
    .nav-item.danger:hover{ background: #ffdede; }

    /* Mobile: sidebar overlay drawer */
    @media (max-width: 991.98px){
      aside.sidenav{
        position: fixed; inset: var(--topbar-h) 0 0 auto;
        width: min(88vw, 320px);
        transform: translateX(105%);
        transition: transform .22s ease;
        height: calc(100dvh - var(--topbar-h));
      }
      body.nav-open aside.sidenav{ transform: translateX(0); }
      .sidenav-backdrop{
        position: fixed; inset: var(--topbar-h) 0 0 0; background: rgba(15,23,40,.35);
        opacity: 0; pointer-events: none; transition: opacity .2s ease;
      }
      body.nav-open .sidenav-backdrop{ opacity: 1; pointer-events: auto; }
    }

    /* Main content */
    main.content{ padding: 24px 16px 48px; }
    .content-inner{ max-width: 1200px; margin: 0 auto; }

    /* Welcome strip */
    .welcome{
      border: 1px solid var(--border);
      border-radius: var(--radius-lg);
      background: var(--card);
      box-shadow: var(--shadow);
      padding: 16px 18px;
      margin-bottom: 16px;
      display: flex; align-items: center; justify-content: center;
      text-align: center;
    }
    .welcome h4{ margin: 0; font-weight: 700; font-size: clamp(18px, 2vw, 20px); letter-spacing: .2px; }

    /* Footer */
    footer{ color: var(--muted); font-size: .95rem; padding: 24px 0 32px; }

    /* Focus */
    a.nav-item:focus-visible, .sidenav-toggle:focus-visible, .btn-logout:focus-visible{
      outline: 3px solid #e0e7ff; box-shadow: 0 0 0 3px #e0e7ff55;
    }

    /* Dark mode */
    @media (prefers-color-scheme: dark){
      :root{
        --bg:#0b0f14; --card:#0f141a; --text:#e6e7eb; --muted:#98a2b3; --border:#1f2937;
        --accent:#60a5fa; --shadow: 0 12px 36px rgba(0,0,0,.35); --danger-soft:#3c1f23;
      }
      .brand-badge{ background:#153057; color:#bcd8ff; }
      .sidenav-toggle{ background:#0f141a; border-color:#1f2937; color:#e6e7eb; }
      .nav-item{ border-top: 1px solid #1b2531; }
      .nav-item:hover{ background:#0d131a; }
      .nav-item[style*="rgb(159, 238, 208)"]{ background:#0f231e !important; color:#d1fae5 !important; }
    }
  </style>
</head>
<body>
@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user(); // App\Models\UserModel or null
    $role = $user->role ?? null; // 'Employee' | 'Member'
    $pos  = optional($user->employee)->position; // 'Admin' | 'Staff' | null

    $dashUrl = '/';
    if ($role === 'Employee' && $pos === 'Admin') {
        $dashUrl = '/admin/dashboard';
    } elseif ($role === 'Employee' && $pos === 'Staff') {
        $dashUrl = '/staff/dashboard';
    } elseif ($role === 'Member') {
        $dashUrl = '/profile'; // member experience
    }

    $who = 'User';
    if ($role === 'Employee' && $pos === 'Admin') $who = 'Admin';
    elseif ($role === 'Employee' && $pos === 'Staff') $who = 'Staff';
    elseif ($role === 'Member') $who = 'Member';

    $isProfile = request()->is('profile');
@endphp

  <!-- Top Bar -->
  <header class="topbar">
    <div class="topbar-inner">
      <div class="topbar-left">
        <button class="sidenav-toggle d-lg-none" id="btnNav" aria-label="Toggle navigation">☰</button>
        <img src="{{ asset('images/MeowMoment_logo.png') }}" alt="MeowMoment Logo" 
            style="height:60px; width:auto; margin-right:10px;">
      </div>
      <div class="topbar-center">MeowManager Back Office · Welcome {{ $who }}</div>
      <div class="topbar-right">
        @auth
          <form id="logout-form-top" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
          <button class="btn-logout" onclick="document.getElementById('logout-form-top').submit()">Logout</button>
        @endauth
      </div>
    </div>
  </header>

  <!-- App Shell -->
  <div class="app">

    <!-- Sidebar -->
    <aside class="sidenav" aria-label="Sidebar navigation">
      <div class="nav-wrap">
        <div class="nav-card">

          {{-- Admin: ALL --}}
          @if($role === 'Employee' && $pos === 'Admin')
            <a href="{{ $dashUrl }}" class="nav-item" style="background-color: rgb(159, 238, 208)">Dashboard</a>
            <a href="/profile" class="nav-item">Profile</a>
            <a href="/user" class="nav-item"> - User </a>
            <a href="/employee" class="nav-item"> - Employee </a>
            <a href="/member" class="nav-item"> - Member </a>
            <a href="/menuitem" class="nav-item"> - Menu Item </a>
            <a href="/cat" class="nav-item"> - Cat </a>
            <a href="/promotion" class="nav-item"> - Promotion </a>
            <a href="/orders" class="nav-item"> - Order </a>
          @endif

          {{-- Staff: Cat + Order --}}
          @if($role === 'Employee' && $pos === 'Staff')
            <a href="{{ $dashUrl }}" class="nav-item" style="background-color: rgb(159, 238, 208)">Dashboard</a>
            <a href="/profile" class="nav-item">Profile</a>
            <a href="/cat" class="nav-item"> - Cat </a>
            <a href="/orders" class="nav-item"> - Order </a>
          @endif

          {{-- Member: Profile only --}}
          @if($role === 'Member')
            <a href="/profile" class="nav-item" style="background-color: rgb(159, 238, 208)">Profile</a>
          @endif
        </div>

        {{-- Keep your sidebar hook --}}
        @yield('sidebarMenu')
      </div>
    </aside>

    <!-- Mobile overlay -->
    <div class="sidenav-backdrop d-lg-none" id="navBackdrop"></div>

    <!-- Main content -->
    <main class="content">
      <div class="content-inner">

        @yield('header')

        @yield('content')

        <footer class="mt-5">
          <p class="text-center">by MeowManager @2025</p>
          <p class="text-center">
            This page is intended for educational and non-commercial use only. Some
            images or content displayed may be subject to copyright or licensing
            restrictions. All rights remain with their respective owners.
          </p>
        </footer>

        @yield('footer')
      </div>
    </main>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

  <!-- Mobile nav toggle -->
  <script>
    (function(){
      const btn = document.getElementById('btnNav');
      const backdrop = document.getElementById('navBackdrop');
      const toggle = () => document.body.classList.toggle('nav-open');
      if(btn){ btn.addEventListener('click', toggle); }
      if(backdrop){ backdrop.addEventListener('click', toggle); }
    })();
  </script>

  @yield('js_before')
  @include('sweetalert::alert')
</body>
</html>
