<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Meow Manager Admin Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  @yield('css_before')
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
        $dashUrl = '/profile'; // member “dashboard” experience
    }

    $who = 'User';
    if ($role === 'Employee' && $pos === 'Admin') $who = 'Admin';
    elseif ($role === 'Employee' && $pos === 'Staff') $who = 'Staff';
    elseif ($role === 'Member') $who = 'Member';

    $isProfile = request()->is('profile');
@endphp

  <div class="container">
    <div class="row">
      <div class="col">
        <div class="alert alert-success text-center" role="alert">
            @if ($role === 'Employee')
                <h4>Back Office || Meow Manager || Welcome {{ $who }}</h4>
            @elseif ($role === 'Member')
                <h4>Meow Manager || Welcome {{ $who }}</h4>
            @endif
          
        </div>
      </div>
    </div>
  </div>

  @yield('header')

  <div class="container">
    <div class="row">

      <div class="col-md-3">
        <div class="list-group">

          {{-- Admin: ALL --}}
          @if($role === 'Employee' && $pos === 'Admin')
            <a href="{{ $dashUrl }}" class="list-group-item list-group-item-action {{ request()->is('admin/dashboard') || request()->is('staff/dashboard') ? 'active' : '' }}">
            Dashboard
            </a>
            <a href="/profile" class="list-group-item list-group-item-action {{ $isProfile ? 'active' : '' }}">
              Profile
            </a>
            <a href="/user" class="list-group-item list-group-item-action"> - User </a>
            <a href="/employee" class="list-group-item list-group-item-action"> - Employee </a>
            <a href="/member" class="list-group-item list-group-item-action"> - Member </a>
            <a href="/menuitem" class="list-group-item list-group-item-action"> - Menu Item </a>
            <a href="/cat" class="list-group-item list-group-item-action"> - Cat </a>
            <a href="/promotion" class="list-group-item list-group-item-action"> - Promotion </a>
            <a href="/orders" class="list-group-item list-group-item-action"> - Order </a>
          @endif

          {{-- Staff: Cat + Order --}}
          @if($role === 'Employee' && $pos === 'Staff')
            <a href="{{ $dashUrl }}" class="list-group-item list-group-item-action {{ request()->is('admin/dashboard') || request()->is('staff/dashboard') ? 'active' : '' }}">
            Dashboard
            </a>
            <a href="/profile" class="list-group-item list-group-item-action {{ $isProfile ? 'active' : '' }}">
              Profile
            </a>
            <a href="/cat" class="list-group-item list-group-item-action"> - Cat </a>
            <a href="/orders" class="list-group-item list-group-item-action"> - Order </a>
          @endif

          {{-- Profile link for everyone; active only when on /profile --}}
          @if($role === 'Member')
            <a href="/profile" class="list-group-item list-group-item-action {{ $isProfile ? 'active' : '' }}">
              Profile
            </a>
          @endif

          {{-- Logout (POST) --}}
          @auth
            <a href="#" class="list-group-item list-group-item-action list-group-item-danger"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          @endauth
        </div>

        @yield('sidebarMenu')
      </div>

      <div class="col-md-9">
        @yield('content')
      </div>

    </div>
  </div>

  <footer class="mt-5 mb-2">
    <p class="text-center">by devbanban.com @2025</p>
    <p class="text-center">
      This page is intended for educational and non-commercial use only. Some
      images or content displayed may be subject to copyright or licensing
      restrictions. All rights remain with their respective owners.
    </p>
  </footer>

  @yield('footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  @yield('js_before')
  @include('sweetalert::alert')
</body>
</html>
