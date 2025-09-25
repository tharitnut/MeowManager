@extends('home')
@section('js_before')
@include('sweetalert::alert')
@section('header')
@section('sidebarMenu')
@section('content')

<h3> :: form Update Cat :: </h3>

<form action="/cat/{{ $cat_id }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Name </label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="cat_name" required placeholder="Cat Name"
                value="{{ $cat_name }}">
            @if(isset($errors))
            @if($errors->has('cat_name'))
            <div class="text-danger"> {{ $errors->first('cat_name') }}</div>
            @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Breed </label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="breed" required placeholder="Cat Breed" value="{{ $breed }}">
            @if(isset($errors))
            @if($errors->has('breed'))
            <div class="text-danger"> {{ $errors->first('breed') }}</div>
            @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Age </label>
        <div class="col-sm-7">
            <input type="number" class="form-control" name="age" required placeholder="Age" min="0" max='100'
                value="{{ $age }}">
            @if(isset($errors))
            @if($errors->has('age'))
            <div class="text-danger"> {{ $errors->first('age') }}</div>
            @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Health Status </label>
        <div class="col-sm-7">
            <textarea name="health_status" class="form-control" rows="4" required
                placeholder="Health Status ">{{ $health_status }}</textarea>
            @if(isset($errors))
            @if($errors->has('health_status'))
            <div class="text-danger"> {{ $errors->first('health_status') }}</div>
            @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Picture </label>
        <div class="col-sm-6">
            Old Picture <br>
            <img src="{{ asset('storage/' . $cat_pic) }}" width="200px"> <br>
            Choose New Picture <br>
            <input type="file" name="cat_pic" placeholder="cat_pic" accept="image/*">
            @if(isset($errors))
            @if($errors->has('cat_pic'))
            <div class="text-danger"> {{ $errors->first('cat_pic') }}</div>
            @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> </label>
        <div class="col-sm-5">
            <input type="hidden" name="oldImg" value="{{ $cat_pic }}">
            <button type="submit" class="btn btn-primary"> Update </button>
            <a href="/cat" class="btn btn-danger">Cancel</a>
        </div>
    </div>

</form>
</div>


@endsection


@section('footer')
@endsection

@section('js_before')
@endsection

{{-- devbanban.com --}}