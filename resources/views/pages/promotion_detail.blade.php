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

<div class="row">
    <div class="col-12 col-md-5 mb-3">
        <div class="card shadow-sm border-0">
            <img src="{{ asset('storage/' . $promotion_pic) }}" 
                 class="card-img-top rounded" 
                 alt="Promotion Banner"
                 style="height: 280px; object-fit: cover;">
        </div>
    </div>

    <div class="col-12 col-md-7">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h3 class="card-title mb-3">Promotion #{{ $promotion_id }}</h3>
                <p class="mb-2">
                    <strong>Details:</strong> <br>
                    {!! nl2br(e($promotion_detail)) !!}
                </p>
                <a href="/promotion_page" class="btn btn-outline-primary mt-3">← Back to Promotions</a>
            </div>
        </div>
    </div>
</div>



@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

{{-- devbanban.com --}}