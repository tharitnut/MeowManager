@extends('home')
@section('css_before')
@endsection
@section('header')
@endsection
@section('sidebarMenu')
@endsection
@section('content')



<h3> Form Add Promotion </h3>

<form action="/promotion/" method="post" enctype="multipart/form-data">
    @csrf


    <div class="form-group row mb-2">
        <label class="col-sm-2"> Promotion Detail </label>
        <div class="col-sm-7">
            <textarea name="promotion_detail" class="form-control" rows="4" required
                placeholder="Detail ">{{ old('promotion_detail') }}</textarea>
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
            <input type="file" name="promotion_pic" required placeholder="promotion_pic" accept="image/*">
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

            <button type="submit" class="btn btn-primary"> Insert Promotion </button>
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