@extends('home')
@section('css_before')
@endsection
@section('header')
@endsection
@section('sidebarMenu')
@endsection
@section('content')



<h3> Form Add Cat </h3>

<form action="/cat/" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Name </label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="cat_name" required placeholder="Cat Name"
                value="{{ old('cat_name') }}">
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
            <input type="text" class="form-control" name="breed" required placeholder="Cat Breed"
                value="{{ old('breed') }}">
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
                value="{{ old('age') }}">
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
                placeholder="Health Status ">{{ old('health_status') }}</textarea>
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
            <input type="file" name="cat_pic" required placeholder="cat_pic" accept="image/*">
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

            <button type="submit" class="btn btn-primary"> Insert Cat </button>
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