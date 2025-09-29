@extends('frontendAuth')

@section('css_before')
<link href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@400;600;700&display=swap" rel="stylesheet">
<style>
  /* Global theme */
  body { font-family: 'Kodchasan', sans-serif; background-color: #fff8da; }

  /* ===== Navbar: center like public pages ===== */
  /* Make the bar span full width and center its inner container */
  header .navbar,
  nav.navbar {
    width: 100%;
    margin-left: 0 !important;
    margin-right: 0 !important;
  }
  /* Center the inner container and match the public max width */
  /* .navbar > .container,
  .navbar > .container-fluid,
  header .navbar > .container,
  header .navbar > .container-fluid {
    margin-left: auto !important;
    margin-right: auto !important;
    max-width: 1200px;              match your public pages
    padding-left: 16px;
    padding-right: 16px;
  } */
  /* Kill any auth layout left offset that nudges the bar to the right */
  header, .navbar {
    left: auto !important;
  }
  .auth-wrap, .page-content, .content, body {
    margin-left: 0 !important;
    padding-left: 0 !important;
  }

  /* Card */
  .card { border-radius: 20px; border: none; overflow: hidden;
          box-shadow: 0 6px 18px rgba(0,0,0,0.08); }
  .card-body h3 { color: #2c5b3f; font-weight: 700; letter-spacing: .5px; }
  .form-label { color: #5c4630; font-weight: 600; }

  /* Inputs */
  .form-control {
    height: 46px; border-radius: 30px; padding: 0 16px;
    border: 1px solid #ddd; background: #fff;
  }
  .form-control:focus {
    border-color: #1940ff; box-shadow: 0 0 0 .2rem rgba(25,64,255,.15);
  }
  .is-invalid { border-color: #dc3545; }

  /* Buttons */

  .btn-warning { background-color: #ffc107; border-color: #ffc107; }
  .btn-warning:hover { filter: brightness(0.95); }

  /* Container spacing */
  .auth-wrap { margin-top: 56px; margin-bottom: 56px; }
</style>
@endsection

@section('navbar')
@endsection

@section('showProduct')
<div class="container auth-wrap">
  <div class="row justify-content-center">
    <div class="col-12 mb-4">
      <h2 class="menu-title" style="font-size:5rem; font-weight:700; letter-spacing:2px; text-align:center;">Login</h2>
    </div>

    <div class="col-12 col-sm-8 col-md-6 col-lg-5">
      <div class="card">
        <div class="card-body p-4">
          <h3 class="mb-3 text-center">Welcome back</h3>

          <form action="/login" method="post">
            @csrf
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" class="form-control @error('username') is-invalid @enderror"
                     name="username" value="{{ old('username') }}" required>
              @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror"
                     name="password" required>
              @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button class="btn btn-warning w-100" style="border-radius: 30px; padding: 10px 20px; font-weight: 600;">Login</button>
          </form>

          @if ($errors->has('username') && !old('username'))
            <div class="alert alert-danger mt-3">
              {{ $errors->first('username') }}
            </div>
          @endif
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
