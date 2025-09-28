@extends('frontend')

@section('css_before')
<link href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Kodchasan', sans-serif; background-color: #fff8da; }
</style>
@endsection

@section('navbar')
@endsection

@section('showProduct')
<div class="container my-4">
    <div class="row align-items-center">
        <div class="col-12 col-md-6 mb-3">
            <img src="{{ asset('storage/' . $cat_pic) }}"
                 class="img-fluid rounded shadow-sm"
                 alt="{{ $cat_name }}">
        </div>

        <div class="col-12 col-md-6">
            <h1 class="fw-bold fs-1 mb-4">{{ $cat_name }}</h1>
            <p class="fs-4 mb-2"><strong>Age:</strong> {{ $age }}</p>
            <p class="fs-4 mb-4"><strong>Breed:</strong> {{ $breed }}</p>

            <a href="{{ url('/cat_page') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 fs-5">
                ← Back to Cats
            </a>
        </div>
    </div>
</div>
@endsection

@section('footer')
@endsection

@section('js_before')
@endsection
