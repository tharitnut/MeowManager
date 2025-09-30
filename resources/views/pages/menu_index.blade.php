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

  .card-img-top { height: 220px; object-fit: cover; width: 100%; }
  .card-body { padding: 15px; flex: 1 1 auto; display: flex; flex-direction: column; justify-content: space-between; }
  .card-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 10px; }

  .row > [class*='col-'] { display: flex; flex-direction: column; }

  /* Filters */
  .filter-wrap { gap: 8px; }
  .filter-wrap .form-select,
  .filter-wrap .form-control { height: 46px; border-radius: 30px; }
  .filter-wrap .btn {
    display: inline-flex; align-items: center; justify-content: center;
    min-height: 46px; border-radius: 30px; padding: 0 18px; line-height: 1;
  }
  .filter-wrap .btn-reset {
    background-color: #fff8da; /* same cream bg */
    border: 2px solid #6b4226; /* coffee brown outline */
    color: #6b4226;            /* coffee brown text */
    font-weight: 600;
    border-radius: 30px;       /* pill look */
    padding: 6px 16px;
    transition: all 0.2s ease-in-out;
  }
  .filter-wrap .btn-reset:hover {
    background-color: #6b4226; /* coffee brown fill */
    color: #fff8da;            /* cream text */
  }
  .btn-search {
    background-color: #6b4226; color: #fff8da; border-color: #6b4226;
  }
  .btn-search:hover, .btn-search:focus {
    background-color: #5a371f; border-color: #5a371f; color: #fff8da;
  }

  /* Pagination – round pills, centered, café theme */
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
@php
    $categoryVal = request('category');
    $keywordVal  = request('keyword');
    $hasFilter = ($categoryVal !== null && $categoryVal !== '') || ($keywordVal !== null && trim($keywordVal) !== '');
@endphp

<div class="col-12 mb-3">
  <h2 class="menu-title">Our Menu</h2>
</div>

{{-- Filters (Category + Keyword) --}}
<div class="row mb-4">
  <div class="col-12">
    <form action="{{ url()->current() }}" method="GET" class="d-flex flex-wrap filter-wrap justify-content-center" id="filterForm">
      {{-- Category (auto submit on change) --}}
      <select name="category" class="form-select w-auto text-center"
              onchange="document.getElementById('filterForm').submit()">
        <option value="" {{ $categoryVal==='' || $categoryVal===null ? 'selected' : '' }}>All Categories</option>
        <option value="Food"  {{ $categoryVal==='Food'  ? 'selected' : '' }}>Food</option>
        <option value="Drink" {{ $categoryVal==='Drink' ? 'selected' : '' }}>Drink</option>
      </select>

      {{-- Keyword (manual search only) --}}
      <input type="text"
             name="keyword"
             class="form-control w-auto"
             placeholder="Search menu items"
             value="{{ $keywordVal }}"
             autocomplete="off"
             style="min-width: 260px; padding: 0 16px;">

      {{-- Buttons --}}
      <button type="submit" class="btn btn-search">Search</button>
      @if($hasFilter)
        <a href="{{ url()->current() }}" class="btn btn-outline-secondary btn-reset">Reset</a>
      @endif
    </form>
  </div>
</div>

{{-- Items --}}
<div class="row px-2">
  @forelse(($items ?? collect()) as $data)
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
      <div class="card h-100 text-center">
        <img src="{{ asset('storage/' . $data->item_pic) }}"
             class="card-img-top"
             alt="{{ $data->item_name }}">
        <div class="card-body">
          <h5 class="card-title">{{ $data->item_name }}</h5>
          <p class="card-text text-success fw-bold">฿{{ number_format($data->item_price, 2) }}</p>
        </div>
      </div>
    </div>
  @empty
    <div class="col-12">
      <div class="alert alert-warning text-center">
        No items found. Try changing filters or keywords.
      </div>
    </div>
  @endforelse
</div>

{{-- Pagination (centered) --}}
<div class="row mt-4">
  <div class="col text-center">
    {{ isset($items) ? $items->links('pagination::bootstrap-5') : '' }}
  </div>
</div>
@endsection

@section('footer')
@endsection

@section('js_before')
{{-- Category auto-submits; search uses the button --}}
@endsection
