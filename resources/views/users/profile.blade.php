{{-- resources/views/users/profile.blade.php --}}

@extends('home')

@section('css_before')
<style>
.profile-card img {
    width: 140px; height: 140px; object-fit: cover; border-radius: 50%;
    border: 3px solid #e9ecef;
}
</style>
@endsection

@section('content')
<h3>User Profile</h3>

<div class="card profile-card mb-3">
  <div class="card-body">
    <div class="row align-items-center">
      <div class="col-auto">
        <img src="{{ session('profile_photo_url') }}" alt="Profile Photo"
             onerror="this.onerror=null;this.src='{{ asset('images/default-avatar.png') }}';">
      </div>

      <div class="col">
        <h5 class="mb-1">
          {{ session('profile_display_name') }}
          <span class="badge bg-info ms-2">{{ session('login_role') }}</span>
          @if(session('login_role') === 'Employee' && session('emp_position'))
            <span class="badge bg-secondary ms-1">{{ session('emp_position') }}</span>
          @endif
        </h5>

        <div class="text-muted small">
          <div><b>Username:</b> {{ Auth::user()->username }}</div>
          @if(session('profile_email'))
            <div><b>Email:</b> {{ session('profile_email') }}</div>
          @endif
        </div>

        @if(session('login_role') === 'Member' && !is_null(session('profile_points')))
          <div class="mt-2">
            <span class="badge bg-success">Points: {{ number_format(session('profile_points')) }}</span>
          </div>
        @endif
      </div>

      <div class="col-auto">
        <a href="/" class="btn btn-outline-secondary btn-sm">Back</a>
      </div>
    </div>
  </div>
</div>
@endsection
