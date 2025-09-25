@extends('frontend')
@section('css_before')
@section('navbar')
@endsection
@section('showProduct')

<div class="col-12">
    <div class="alert alert-info text-center">
        Our Cats
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-4 mb-3">
        <div class="card shadow-sm border-0">
            <img src="{{ asset('storage/' . $cat_pic) }}" 
                 class="card-img-top rounded" 
                 alt="{{ $cat_name }}" 
                 style="height: 280px; object-fit: cover;">
        </div>
    </div>

    <div class="col-12 col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h3 class="card-title mb-3">{{ $cat_name }}</h3>
                <p class="mb-1"><strong>Age:</strong> {{ $age }}</p>
                <p class="mb-1"><strong>Breed:</strong> {{ $breed }}</p>
                <a href="/cat_page" class="btn btn-outline-primary mt-3">← Back to Cats</a>
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