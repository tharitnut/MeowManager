@extends('frontend')

@section('css_before')
<link href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Kodchasan', sans-serif; background-color: #fff8da; }

    .section-heading {
        text-align: center; font-size: 5rem; font-weight: 700;
        margin-top: 50px; margin-bottom: 30px; letter-spacing: 2px;
    }

    .card { border: none; border-radius: 15px; overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: .3s;
    }
    .card:hover { transform: translateY(-5px); box-shadow: 0 6px 15px rgba(0,0,0,0.15); }
    .card img { width: 100%; height: auto; object-fit: contain; background: #f8f9fa; }
</style>
@endsection

@section('navbar')
@endsection

@section('showProduct')
<div class="col-12">
    <h2 class="section-heading">Promotion</h2>
</div>

@foreach($promotions as $data)
<div class="col-12 mb-3">
    <div class="card border-0 shadow-sm">
        <a href="/promotion_page/detail/{{ $data->promotion_id }}">
            <img src="{{ asset('storage/' . $data->promotion_pic) }}"
                 class="card-img-top img-fluid rounded"
                 alt="Promotion Banner">
        </a>
    </div>
</div>
@endforeach

<div class="row mt-4 mb-4">
    <div class="col text-center">
        {{ $promotions->links() }}
    </div>
</div>
@endsection

@section('footer')
@endsection

@section('js_before')
@endsection
