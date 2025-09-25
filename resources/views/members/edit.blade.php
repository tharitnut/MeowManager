@extends('home')
@section('css_before')
@endsection
@section('header')
@endsection
@section('sidebarMenu')
@endsection

@section('content')

<h3> Form Edit Member </h3>

<form action="/member/{{ $member->member_id }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Username </label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="username" required maxlength="50"
                value="{{ old('username', optional($member->user)->username) }}">
            @if(isset($errors))
            @if($errors->has('username')) <div class="text-danger">{{ $errors->first('username') }}</div> @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Password (change?) </label>
        <div class="col-sm-7">
            <input type="password" class="form-control" name="password" minlength="6" maxlength="50"
                placeholder="Leave blank to keep current">
            @if(isset($errors))
            @if($errors->has('password')) <div class="text-danger">{{ $errors->first('password') }}</div> @endif
            @endif
        </div>
    </div>

    <input type="hidden" name="role" value="Member">

    <div class="form-group row mb-2">
        <label class="col-sm-2"> First Name </label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="first_name" required maxlength="50"
                value="{{ old('first_name', $member->first_name) }}">
            @if(isset($errors))
            @if($errors->has('first_name')) <div class="text-danger">{{ $errors->first('first_name') }}</div> @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Last Name </label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="last_name" required maxlength="50"
                value="{{ old('last_name', $member->last_name) }}">
            @if(isset($errors))
            @if($errors->has('last_name')) <div class="text-danger">{{ $errors->first('last_name') }}</div> @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Telephone </label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="telephone" required maxlength="10"
                value="{{ old('telephone', $member->telephone) }}">
            @if(isset($errors))
            @if($errors->has('telephone')) <div class="text-danger">{{ $errors->first('telephone') }}</div> @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Email </label>
        <div class="col-sm-7">
            <input type="email" class="form-control" name="email" required maxlength="50"
                value="{{ old('email', $member->email) }}">
            @if(isset($errors))
            @if($errors->has('email')) <div class="text-danger">{{ $errors->first('email') }}</div> @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Birth Date </label>
        <div class="col-sm-7">
            <input type="date" class="form-control" name="birth_date" required
                value="{{ old('birth_date', $member->birth_date) }}">
            @if(isset($errors))
            @if($errors->has('birth_date')) <div class="text-danger">{{ $errors->first('birth_date') }}</div> @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Register Date </label>
        <div class="col-sm-7">
            <input type="date" class="form-control" name="register_date" required
                value="{{ old('register_date', $member->register_date) }}">
            @if(isset($errors))
            @if($errors->has('register_date')) <div class="text-danger">{{ $errors->first('register_date') }}</div>
            @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Point </label>
        <div class="col-sm-7">
            <input type="number" class="form-control" name="point" min="0" value="{{ old('point', $member->point) }}">
            @if(isset($errors))
            @if($errors->has('point')) <div class="text-danger">{{ $errors->first('point') }}</div> @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Picture </label>
        <div class="col-sm-7">
            @if($member->member_pic)
            <div class="mb-2">
                <img src="{{ asset('storage/'.$member->member_pic) }}" width="120">
            </div>
            @endif
            <input type="file" name="member_pic" accept="image/*">
            @if(isset($errors))
            @if($errors->has('member_pic')) <div class="text-danger">{{ $errors->first('member_pic') }}</div> @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> </label>
        <div class="col-sm-5">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/member" class="btn btn-danger">Cancel</a>
        </div>
    </div>

</form>

@endsection

@section('footer')
@endsection
@section('js_before')
@endsection
{{-- devbanban.com --}}