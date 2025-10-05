@extends('frontend')

@section('css_before')
<link href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@400;600;700&display=swap" rel="stylesheet">
<style>
  body { font-family: 'Kodchasan', sans-serif; background-color: #fff8da; }

  .section-heading{
    text-align:center; font-size:5rem; font-weight:700;
    margin-top:50px; margin-bottom:30px; letter-spacing:2px;
  }

  .card{
    border:none; border-radius:15px; overflow:hidden;
    box-shadow:0 2px 8px rgba(0,0,0,0.1); transition:.3s;
  }
  .card:hover{ transform:translateY(-5px); box-shadow:0 6px 15px rgba(0,0,0,0.15); }
  .card img{ width:100%; height:auto; object-fit:contain; background:#f8f9fa; }

  /* ===== THEMED PAGINATION (coffee & cream) ===== */
  .pagination{
    display:inline-flex; gap:6px; padding-left:0; list-style:none;
    justify-content:center; margin:0;
  }
  .page-item .page-link{
    display:inline-flex; justify-content:center; align-items:center;
    min-width:42px; height:42px; border-radius:50%;
    border:none; background:#fff; color:#6b4226; font-weight:600;
    padding:0 12px; transition:all .15s ease; box-shadow:0 1px 3px rgba(0,0,0,.08);
  }
  .page-item .page-link:hover,
  .page-item .page-link:focus{
    background:#6b4226; color:#fff8da;
  }
  .page-item.active .page-link{
    background:#6b4226; color:#fff8da; box-shadow:0 2px 6px rgba(0,0,0,.12);
  }
  .page-item.disabled .page-link{
    background:#f2e9d2; color:#9e8a78; box-shadow:none; cursor:not-allowed;
  }
  @media (max-width:576px){
    .page-item .page-link{ min-width:36px; height:36px; }
  }
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
    {{ $promotions->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection

@section('footer')
@endsection

@section('js_before')
@endsection
