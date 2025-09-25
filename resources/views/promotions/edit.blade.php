@extends('home')
@section('js_before')
@include('sweetalert::alert')
@section('header')
@section('sidebarMenu')
@section('content')

<h3> :: form Update Promotion :: </h3>

<form action="/promotion/{{ $promotion_id }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Promotion Detail </label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="promotion_detail" required placeholder="Promotion Detail"
                value="{{ $promotion_detail }}">
            @if(isset($errors))
            @if($errors->has('promotion_detail'))
            <div class="text-danger"> {{ $errors->first('promotion_detail') }}</div>
            @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Picture </label>
        <div class="col-sm-6">
            Old Picture <br>
            <img src="{{ asset('storage/' . $promotion_pic) }}" width="200px"> <br>
            Choose New Picture <br>
            <input type="file" name="promotion_pic" placeholder="promotion_pic" accept="image/*">
            @if(isset($errors))
            @if($errors->has('promotion_pic'))
            <div class="text-danger"> {{ $errors->first('promotion_pic') }}</div>
            @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> </label>
        <div class="col-sm-5">
            <input type="hidden" name="oldImg" value="{{ $promotion_pic }}">
            <button type="submit" class="btn btn-primary"> Update </button>
            <a href="/promotion" class="btn btn-danger">Cancel</a>
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