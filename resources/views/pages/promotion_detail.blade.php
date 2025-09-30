@extends('frontend')

@section('css_before')
<link href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Kodchasan', sans-serif; background-color: #fff8da; }

    .btn-coffee {
        background-color: #FFDD72;
        border-color: #FFDD72;
        color: #6b4226;
        transition: background-color .15s ease, border-color .15s ease, color .15s ease;
    }

    .btn-coffee:hover,
    .btn-coffee:focus {
        background-color: #6b4226;
        border-color: #6b4226;
        color: #fff8da;
    }
</style>
@endsection

@section('navbar')
@endsection

@section('showProduct')
<div class="container my-4">
    <div class="row align-items-center">
        <div class="col-12 col-md-6 mb-3">
            <img src="{{ asset('storage/' . $promotion_pic) }}"
                 class="img-fluid rounded shadow-sm"
                 alt="Promotion Banner">
        </div>

        <div class="col-12 col-md-6">
            <h1 class="fw-bold fs-1 mb-4">Promotion #{{ $promotion_id }}</h1>

            <p class="fs-4 mb-4">
                <strong>Details:</strong><br>
                {!! nl2br(e($promotion_detail)) !!}
            </p>

            <a href="{{ url('/promotion_page') }}"
               class="btn btn-coffee rounded-pill px-4 py-2 fs-5">
               ← Back to Promotions
            </a>
        </div>
    </div>
</div>
@endsection

@section('footer')
@endsection

@section('js_before')
@endsection
