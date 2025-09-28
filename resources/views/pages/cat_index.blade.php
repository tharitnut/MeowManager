@extends('frontend')

@section('css_before')
<link href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Kodchasan', sans-serif; background-color: #fff8da; }

    .menu-title {
        font-size: 5rem; font-weight: 700;
        margin-top: 50px; margin-bottom: 30px;
        letter-spacing: 2px; text-align: center;
    }

    /* Card */
    .card { border: none; border-radius: 15px; overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: .3s; background: #fff;
        max-width: 100%; margin: auto; display: flex; flex-direction: column;
    }
    .card:hover { transform: translateY(-5px); box-shadow: 0 6px 15px rgba(0,0,0,0.15); }

    .card-img-top { height: 220px; object-fit: cover; width: 100%; }

    .card-body { padding: 15px; flex: 1 1 auto; display: flex; flex-direction: column; justify-content: space-between; }

    .card-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 10px; }

    .btn-detail { font-size: .9rem; font-weight: 600; padding: 6px 12px; border-radius: 8px; align-self: center; }

    .row > [class*='col-'] { display: flex; flex-direction: column; }
</style>
@endsection

@section('navbar')
@endsection

@section('showProduct')
<div class="col-12 mb-4">
    <h2 class="menu-title">Our Cats</h2>
</div>

<div class="row">
    @foreach($cats as $data)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100 text-center">
                <a href="/cat_page/detail/{{ $data->cat_name }}">
                    <img src="{{ asset('storage/' . $data->cat_pic) }}"
                         class="card-img-top"
                         alt="{{ $data->cat_name }}">
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/cat_page/detail/{{ $data->cat_name }}"
                           class="stretched-link text-decoration-none text-dark">
                            {{ $data->cat_name }}
                        </a>
                    </h5>
                    <a href="/cat_page/detail/{{ $data->cat_name }}" class="btn btn-warning btn-detail">
                        More Detail
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="row mt-4">
    <div class="col text-center">
        {{ $cats->links() }}
    </div>
</div>
@endsection

@section('footer')
@endsection

@section('js_before')
@endsection
