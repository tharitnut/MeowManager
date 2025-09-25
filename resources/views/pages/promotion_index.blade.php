@extends('frontend')
@section('css_before')
@section('navbar')
@endsection

@section('showProduct')

<div class="col-12">
    <div class="alert alert-info text-center">
        Promotion
    </div>
</div>

@foreach($promotions as $data)
<div class="col-12 mb-3">
    <div class="card border-0 shadow-sm">
        <a href="/promotion_page/detail/{{ $data->promotion_id }}">
        <img src="{{ asset('storage/' . $data->promotion_pic) }}"
             class="card-img-top img-fluid rounded"
             alt="Promotion Banner"
             style="max-height: 350px; object-fit: cover; width: 100%;">
        </a>
    </div>
</div>
@endforeach





<div class="row mt-2 mb-2">
    <!-- Pagination links -->
    <div class="col-sm-5 col-md-5"></div>
    <div class="col-sm-3 col-md-3">
        <center>
            {{ $promotions->links() }}
        </center>
    </div>
</div>




@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

{{-- devbanban.com --}}