@extends('frontend')

@section('css_before')
<link href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@400;600;700&display=swap" rel="stylesheet">
<style>
  body { font-family: 'Kodchasan', sans-serif; background-color: #fff8da; color:#5c4630; }

  .section-heading{
    text-align:center; font-weight:700; letter-spacing:2px;
    font-size: clamp(2.25rem, 6vw, 5rem);
    margin-top: 40px; margin-bottom: 24px;
  }

  /* Card */
  .card{
    border:none; border-radius:16px; overflow:hidden;
    box-shadow:0 2px 8px rgba(0,0,0,.1); transition:.25s;
    background:#fff;
  }
  .card:hover{ transform:translateY(-3px); box-shadow:0 6px 16px rgba(0,0,0,.12); }

  /* Banner image — fully responsive, keeps aspect without distortion */
  .card-img-top{
    width:100%; height: auto; object-fit: contain; background:#f8f9fa;
  }

  /* Responsive gutters */
  .row{ --bs-gutter-x: 1rem; --bs-gutter-y: 1rem; }

  /* Themed, centered pagination */
  .pagination{
    display:inline-flex; gap:6px; padding-left:0; list-style:none;
    justify-content:center; margin:0;
  }
  .page-item .page-link{
    display:inline-flex; justify-content:center; align-items:center;
    min-width:42px; height:42px; border-radius:50%;
    border:none; background:#fff; color:#6b4226; font-weight:600;
    padding:0 12px; box-shadow:0 1px 3px rgba(0,0,0,.08); transition:.15s;
  }
  .page-item .page-link:hover, .page-item .page-link:focus{
    background:#6b4226; color:#fff8da;
  }
  .page-item.active .page-link{
    background:#6b4226; color:#fff8da; box-shadow:0 2px 6px rgba(0,0,0,.12);
  }
  .page-item.disabled .page-link{ background:#f2e9d2; color:#9e8a78; }
  @media (max-width:576px){
    .page-item .page-link{ min-width:36px; height:36px; }
  }
</style>
@endsection

@section('navbar')
@endsection

@section('showProduct')
<div class="container">
  <div class="row">
    <div class="col-12">
      <h2 class="section-heading">Promotion</h2>
    </div>

    {{-- Grid of promotions (1 per row on mobile, 2 on md, 3 on lg if banners aren’t super tall) --}}
    @foreach($promotions as $data)
      <div class="col-12 col-md-10 col-lg-8 mx-auto mb-3">
        <div class="card border-0 shadow-sm">
          <a href="/promotion_page/detail/{{ $data->promotion_id }}" class="d-block">
            <img
              src="{{ asset('storage/' . $data->promotion_pic) }}"
              class="card-img-top img-fluid"
              alt="Promotion Banner"
              loading="lazy">
          </a>
        </div>
      </div>
    @endforeach

    {{-- Pagination --}}
    <div class="col-12 mt-3 mb-4 text-center">
      {{ $promotions->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>
@endsection

@section('footer')
@endsection

@section('js_before')
@endsection
