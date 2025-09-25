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

@foreach($cats as $data)
<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
    <div class="card h-100 shadow-sm border-0">
        <a href="/cat_page/detail/{{ $data->cat_name }}">
            <img src="{{ asset('storage/' . $data->cat_pic) }}" 
                 class="card-img-top img-fluid rounded-top" 
                 alt="{{ $data->cat_name }}" 
                 style="height: 200px; object-fit: cover;">
        </a>
        <div class="card-body text-center">
            <h5 class="card-title mb-2">
                <a href="/cat_page/detail/{{ $data->cat_name }}" 
                   class="stretched-link text-decoration-none text-dark">
                    {{ $data->cat_name }}
                </a>
            </h5>
            <button class="btn btn-success btn-sm mt-2">
                More Detail
            </button>
        </div>
    </div>
</div>
@endforeach




<div class="row mt-2 mb-2">
    <!-- Pagination links -->
    <div class="col-sm-5 col-md-5"></div>
    <div class="col-sm-3 col-md-3">
        <center>
            {{ $cats->links() }}
        </center>
    </div>
</div>




@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

{{-- devbanban.com --}}