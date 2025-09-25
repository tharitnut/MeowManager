@extends('home')
@section('js_before')
@include('sweetalert::alert')
@section('header')
@section('sidebarMenu')
@section('content')

<h3> Form Update Product </h3>

<form action="/menuitem/{{ $item_id }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Menu Item Name </label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="item_name" required placeholder="Menu Item Name"
                value="{{ $item_name }}">
            @if(isset($errors))
            @if($errors->has('item_name'))
            <div class="text-danger"> {{ $errors->first('item_name') }}</div>
            @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Category </label>
        <div class="col-sm-7">
            <select name="category" class="form-control" required>
                <option value="">-- Select Category --</option>
                <option value="Food" {{ $category == 'Food' ? 'selected' : '' }}>Food</option>
                <option value="Drink" {{ $category == 'Drink' ? 'selected' : '' }}>Drink</option>
            </select>

            @if(isset($errors))
            @if($errors->has('category'))
            <div class="text-danger"> {{ $errors->first('category') }}</div>
            @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2">Price </label>
        <div class="col-sm-6">
            <input type="number" class="form-control" name="item_price" required placeholder="Price" min="0"
                value="{{ $item_price }}">
            @if(isset($errors))
            @if($errors->has('item_price'))
            <div class="text-danger"> {{ $errors->first('item_price') }}</div>
            @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Picture </label>
        <div class="col-sm-6">
            Old Picture <br>
            <img src="{{ asset('storage/' . $item_pic) }}" width="200px"> <br>
            Choose New Picture <br>
            <input type="file" name="item_pic" placeholder="item_pic" accept="image/*">
            @if(isset($errors))
            @if($errors->has('item_pic'))
            <div class="text-danger"> {{ $errors->first('item_pic') }}</div>
            @endif
            @endif
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> </label>
        <div class="col-sm-5">
            <input type="hidden" name="oldImg" value="{{ $item_pic }}">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/menuitem" class="btn btn-danger">Cancel</a>
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