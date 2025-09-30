@extends('frontendAuth')

@section('css_before')
<link href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@400;600;700&display=swap" rel="stylesheet">
<style>
  /* Global theme (keep your style) */
  body { font-family: 'Kodchasan', sans-serif; background-color: #fff8da; color:#2c2c2c; }

  /* Navbar alignment fixes (as you had) */
  header .navbar, nav.navbar { width: 100%; margin-left: 0 !important; margin-right: 0 !important; }
  header, .navbar { left: auto !important; }
  .auth-wrap, .page-content, .content, body { margin-left: 0 !important; padding-left: 0 !important; }

  /* Card */
  .profile-card {
    background: #fffef5; /* updated from white */
    border: none;
    border-radius: 22px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
  }
  .profile-card .card-body { padding: 48px 28px; }

  /* Avatar ring like the mock */
  .avatar-wrap { display:flex; justify-content:center; }
  .avatar {
    width: 190px; height: 190px; border-radius: 50%; object-fit: cover;
    border: 10px solid #f3f6fa;
    box-shadow: 0 6px 16px rgba(0,0,0,.06);
  }

  /* Name */
  .display-name {
    font-weight: 700; font-size: clamp(24px, 3.2vw, 36px);
    color:#2c5b3f; letter-spacing:.4px; text-align:center; margin: 18px 0 10px;
  }

  /* Badges row (role chips) */
  .role-row { display:flex; gap:10px; justify-content:center; margin-bottom: 18px; }
  .role-badge {
    display:inline-block; padding:8px 14px; border-radius:999px; font-weight:700; font-size:14px;
    color:#fff; background:#17a2b8;
  }
  .role-badge.member { background:#2c5b3f; }      /* deep green from your palette */
  .role-badge.admin  { background:#6c757d; }
  .role-badge.staff  { background:#0d6efd; }

  /* Meta lines (username/email) */
  .meta { text-align:center; color:#5c4630; }
  .meta .label { color:#6b6b6b; font-weight:700; }
  .meta p { margin: 6px 0; }

  /* Points chip (optional) */
  .points-chip {
    display:inline-block; margin-top:10px; padding:8px 14px; border-radius:999px;
    background:#eaf7ef; color:#2c5b3f; font-weight:700;
  }

  /* Buttons row */
  .actions { margin-top: 20px; display:flex; gap:10px; justify-content:center; flex-wrap:wrap; }

  /* Keep your button look */
  .btn-warning { background-color:#ffc107; border-color:#ffc107; }
  .btn-warning:hover { filter: brightness(.95); }
</style>
@endsection

@section('navbar')
@endsection

@section('showProduct')

<div class="container auth-wrap">
  <div class="row justify-content-center mt-5">
    <div class="col-12 col-md-10 col-lg-8 col-xl-7">
      <div class="card profile-card">
        <div class="card-body">

          <!-- Avatar -->
          <div class="avatar-wrap">
            <img class="avatar" src="{{ $photoUrl }}"
                 alt="Profile Photo"
                 onerror="this.onerror=null;this.src='{{ asset('images/default_avatar.png') }}'">
          </div>

          <!-- Name -->
          <h2 class="display-name">{{ $displayName }}</h2>

          <!-- Role badges (Member only by default, but easy to extend) -->
          <div class="role-row">
            <span class="role-badge member">Member</span>
            {{-- If you ever want to show extra roles, just toggle these: --}}
            {{-- <span class="role-badge staff">Staff</span> --}}
            {{-- <span class="role-badge admin">Admin</span> --}}
          </div>

          <!-- Meta -->
          <div class="meta">
            <p><span class="label">Username:</span> {{ $username }}</p>
            <p><span class="label">Email:</span> {{ $email }}</p>
            @isset($points)
              <div class="points-chip">Points: {{ $points }}</div>
            @endisset
          </div>

          <!-- Actions -->
          <div class="actions">
            {{-- add more actions if you need; kept minimal like the mock --}}
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-danger btn-sm">Logout</button>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('footer')
@endsection

@section('js_before')
@endsection
