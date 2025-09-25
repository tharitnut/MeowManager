@extends('frontendAuth')

@section('css_before')
@endsection

@section('navbar')
@endsection

@section('showProduct')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-8 col-md-6 col-lg-5">
      <div class="card shadow-sm border-0">
        <div class="card-body p-4">
          <h3 class="mb-3 text-center">Login</h3>

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

            <button class="btn btn-primary">Login</button>
            </form>


          {{-- Generic auth error surfaced on "username" --}}
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
