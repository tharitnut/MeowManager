{{-- resources/views/users/profile.blade.php --}}

@extends('home')

@section('css_before')
<style>
/* Container + card */
.profile-card {
  max-width: 560px;
  margin: 24px auto;
  border: 0;
  box-shadow: 0 8px 24px rgba(0,0,0,.06);
  border-radius: 16px;
}

/* Avatar */
.profile-avatar {
  width: clamp(140px, 28vw, 240px);
  height: clamp(140px, 28vw, 240px);
  object-fit: cover;
  border-radius: 50%;
  border: 6px solid #f1f3f5;
  display: block;
  margin: 8px auto 20px;
}

/* Name + username row spacing */
.profile-name {
  font-weight: 600;
  font-size: 1.25rem;
}

.profile-username {
  color: #6c757d;
  font-weight: 600;
}

/* Badges */
.badge-role {
  vertical-align: middle;
  margin-left: .5rem;
}

.badge-points {
  font-size: .95rem;
  padding: .45rem .8rem;
}
</style>
@endsection

@section('content')

<div class="card profile-card">
  <div class="card-body text-center py-5">

    {{-- Avatar --}}
    <img
      class="profile-avatar"
      @if($user->role === 'Employee' && $user->employee)
        <img src="{{ asset('storage/' . $user->employee->employee_pic) }}" alt="Profile Photo" class="img-fluid rounded" style="object-fit: contain;">
      @elseif($user->role === 'Member' && $user->member)
        <img src="{{ asset('storage/' . $user->member->member_pic) }}" alt="Profile Photo" class="img-fluid rounded" style="object-fit: contain;">
      @endif

    {{-- Name + role (and position for employees) --}}
    <div class="profile-name mb-2">
      <div>
        <h2>{{ session('profile_display_name') }}</h2>
      </div>

      <div class="mt-1">
        <span class="badge bg-info">
          {{ session('login_role') }}
        </span>
        @if(session('login_role') === 'Employee' && session('emp_position'))
          <span class="badge bg-secondary ms-1">{{ session('emp_position') }}</span>
        @endif
      </div>
    </div>

    {{-- Username + email (centered, muted) --}}
    <div class="mb-3">
      <div class="profile-username">Username: <span class="fw-normal">{{ Auth::user()->username }}</span></div>
      @if(session('profile_email'))
        <div class="text-muted">Email: <span class="fw-normal">{{ session('profile_email') }}</span></div>
      @endif
    </div>

    {{-- Points (members only) --}}
    @if(session('login_role') === 'Member' && !is_null(session('profile_points')))
      <div class="mb-2">
        <span class="badge rounded-pill bg-success badge-points">
          Points: {{ number_format(session('profile_points')) }}
        </span>
      </div>
    @endif

  </div>
</div>
@endsection
