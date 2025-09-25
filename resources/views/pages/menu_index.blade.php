@extends('frontend')
@section('css_before')
@section('navbar')
@endsection

@section('showProduct')

<div class="col-12">
    <div class="alert alert-info text-center">
        Menu
    </div>
</div>

@foreach($items as $data)
<div class="col-12 col-sm-4 col-md-4 col-lg-3 mb-2">
    <div class="card" style="width: 100%;">
        <img src="{{ asset('storage/' . $data->item_pic) }}" class="card-img-top" alt="{{ $data->item_name }}">
        <div class="card-body text-center">
            <h5 class="card-title mb-2">
                <span class="link-offset-2 link-underline link-underline-opacity-0">
                    {{ $data->item_name }}
                </span>
            </h5>
            <p class="card-text text-success fw-bold">
                ฿{{ number_format($data->item_price, 2) }}
            </p>
        </div>
    </div>
</div>
@endforeach




<div class="row mt-2 mb-2">
    <!-- Pagination links -->
    <div class="col-sm-5 col-md-5"></div>
    <div class="col-sm-3 col-md-3">
        <center>
            {{ $items->links() }}
        </center>
    </div>
</div>




@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

{{-- devbanban.com --}}