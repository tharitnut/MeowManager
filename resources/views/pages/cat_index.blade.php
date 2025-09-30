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
  .card {
    border: none; border-radius: 15px; overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: .3s; background: #fff;
    max-width: 100%; margin: auto; display: flex; flex-direction: column;
  }
  .card:hover { transform: translateY(-5px); box-shadow: 0 6px 15px rgba(0,0,0,0.15); }

  .card-img-top { height: 220px; object-fit: cover; width: 100%; }

  .card-body {
    padding: 15px; flex: 1 1 auto; display: flex; flex-direction: column; justify-content: space-between;
  }

  .card-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 10px; }

  .btn-detail { font-size: .9rem; font-weight: 600; padding: 6px 12px; border-radius: 8px; align-self: center; }

  .row > [class*='col-'] { display: flex; flex-direction: column; }

  /* Theme button: light cream → coffee on hover (if needed elsewhere) */
  .btn-coffee {
    background-color: #FFDD72;   /* light cream */
    border-color: #FFDD72;
    color: #6b4226;              /* coffee text */
    transition: background-color .15s ease, border-color .15s ease, color .15s ease;
  }
  .btn-coffee:hover,
  .btn-coffee:focus {
    background-color: #6b4226;   /* darker coffee */
    border-color: #6b4226;
    color: #fff8da;              /* cream text */
  }

  /* Pagination – round pills, café theme */
  .pagination {
    display: inline-flex;
    gap: 6px;
    padding-left: 0;
    list-style: none;
    justify-content: center;
    margin: 0;
  }
  .page-item .page-link {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    min-width: 42px;
    height: 42px;
    border-radius: 50%;
    border: none;
    background: #fff;           /* light base */
    color: #6b4226;             /* coffee text */
    font-weight: 600;
    padding: 0 12px;
    transition: all .15s ease;
    box-shadow: 0 1px 3px rgba(0,0,0,.08);
  }
  .page-item .page-link:hover,
  .page-item .page-link:focus {
    background: #6b4226;        /* coffee on hover */
    color: #fff8da;             /* cream text */
  }
  .page-item.active .page-link {
    background: #6b4226;        /* active = coffee */
    color: #fff8da;
    box-shadow: 0 2px 6px rgba(0,0,0,.12);
  }
  .page-item.disabled .page-link {
    background: #f2e9d2;        /* soft cream-grey */
    color: #9e8a78;
    box-shadow: none;
    cursor: not-allowed;
  }

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
          <a href="/cat_page/detail/{{ $data->cat_name }}" class="btn btn-coffee btn-detail">
            More Detail
          </a>
        </div>
      </div>
    </div>
  @endforeach
</div>

<div class="row mt-4">
  <div class="col text-center">
    {{ $cats->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection

@section('footer')
@endsection

@section('js_before')
@endsection
