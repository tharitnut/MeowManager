@extends('home')

@section('css_before')
<style>
        /* ========= Back Office Dark Minimal Theme (complete) ========= */
  :root{
    /* Base palette */
    --bg:#0b0f14; --card:#0f141a; --text:#e6e7eb; --muted:#98a2b3; --border:#1f2937;
    --shadow:0 10px 28px rgba(0,0,0,.35);
    --radius:16px;

    /* Accents */
    --accent:#60a5fa; --accent-ink:#0b1220;

    /* Buttons: distinct families */
    --logout-red:#b84b57;          /* Logout (top bar) base */
    --logout-rose:#cf7e92;          /* Logout hover */

    --danger-alt:#d05a6b;          /* Delete buttons (different red) */
    --danger-alt-hover:#e58593;

    /* Tables */
    --row-alt:#0d131a; --row-hover:#131a22;
  }

  body{ background:var(--bg); }

  /* Headings & cards */
  h1,h2,h3,h4,h5{ color:var(--text); font-weight:700; letter-spacing:.2px; }
  .mm-card{
    background:var(--card)!important; border:1px solid var(--border)!important;
    border-radius:var(--radius)!important; box-shadow:var(--shadow)!important;
  }

  /* ===== Tables ===== */
  .table{
    color:var(--text); background:var(--card); border-color:var(--border); box-shadow:var(--shadow);
    --bs-table-bg: transparent; --bs-table-color: var(--text);
    --bs-table-striped-bg: var(--row-alt); --bs-table-striped-color: var(--text);
    --bs-table-hover-bg: var(--row-hover); --bs-table-hover-color: var(--text);
    --bs-table-border-color: var(--border);
  }
  .table > :not(caption) > * > *{
    color:var(--text)!important; background:transparent; border-color:var(--border); vertical-align:middle;
  }
  .table thead tr.table-info th{
    background:#111823!important; color:var(--text)!important; border-color:var(--border)!important; font-weight:700;
  }
  .table thead th{ color:var(--text)!important; }
  .table-bordered{ border:1px solid var(--border); }
  .table-bordered > :not(caption) > *{ border-width:1px 0; }
  .table-bordered > :not(caption) > * > *{ border-width:0 1px; }
  .table-striped > tbody > tr:nth-of-type(odd) > *{ background:var(--row-alt)!important; }
  .table-hover > tbody > tr:hover > *{ background:var(--row-hover)!important; }
  .text-danger{ color:#ff8da1!important; }
  .table a{ color:#cdd5df; text-decoration:none; }
  .table a:hover{ color:#e6e7eb; text-decoration:underline; }

  /* ===== Forms ===== */
  label{ color:var(--text); font-weight:600; }
  .form-text,.form-hint,small{ color:var(--muted)!important; }
  .form-control,.form-select,.form-check-input{
    background:#0e1319; color:var(--text); border:1px solid var(--border); border-radius:12px;
  }
  .form-control::placeholder{ color:#8a97a6; }
  .form-control:focus,.form-select:focus{
    color:var(--text); background:#0e1319; border-color:#2b6cb0;
    box-shadow:0 0 0 .2rem rgba(96,165,250,.15);
  }
  .input-group-text{ background:#0e1319; color:var(--muted); border:1px solid var(--border); }
  .form-check-input:checked{ background-color:var(--accent); border-color:var(--accent); }
  .form-switch .form-check-input{ width:2.5em; height:1.25em; background-position:left center; }
  .form-switch .form-check-input:checked{ background-position:right center; }
  .invalid-feedback,.is-invalid ~ .invalid-feedback{ color:#ff8da1!important; }
  .is-invalid{ border-color:#f28497!important; }
  .form-control[type="file"]{ background:#0e1319; color:var(--text); border:1px solid var(--border); }

  /* ===== Buttons ===== */
  .btn{ border-radius:999px; font-weight:700; }
  .btn-primary{
    --bs-btn-color:var(--accent-ink); --bs-btn-bg:var(--accent); --bs-btn-border-color:var(--accent);
    --bs-btn-hover-bg:#7ab5ff; --bs-btn-hover-border-color:#7ab5ff;
    box-shadow:0 8px 22px rgba(96,165,250,.20);
  }
  .btn-outline-secondary{
    --bs-btn-color:#cdd5df; --bs-btn-border-color:var(--border);
    --bs-btn-hover-color:var(--text); --bs-btn-hover-bg:#0d131a; --bs-btn-hover-border-color:#334155;
  }

  /* Edit (warning) — improved contrast */
  .btn-warning{
    --bs-btn-bg:#f0b54a;           /* amber base */
    --bs-btn-border-color:#d89a33; /* outline */
    --bs-btn-color:#0b0f14;        /* dark label */
    --bs-btn-hover-bg:#f6c569;     /* hover */
    --bs-btn-hover-border-color:#e3ae4d;
    --bs-btn-active-bg:#e9b14d;
    --bs-btn-active-border-color:#d89a33;
    text-shadow:none;
    font-weight:800;
  }
  .btn-warning.btn-sm{ padding:.35rem .7rem; }

  /* Delete (danger) — raspberry, distinct from Logout */
  .btn-danger{
    --bs-btn-color:#ffffff;
    --bs-btn-bg:var(--danger-alt);
    --bs-btn-border-color:var(--danger-alt);
    --bs-btn-hover-bg:var(--danger-alt-hover);
    --bs-btn-hover-border-color:var(--danger-alt-hover);
    --bs-btn-active-bg:var(--danger-alt);
    --bs-btn-active-border-color:var(--danger-alt);
    box-shadow:0 6px 18px rgba(208,90,107,.18);
  }
  .btn-sm{ padding:.3rem .6rem; }

  input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(1); /* Turns the black calendar icon white */
    cursor: pointer;
    }

  /* Topbar Logout button (separate class) */
  .btn-logout{
    background:var(--logout-red); color:#ffffff; border:1px solid var(--logout-red);
    border-radius:999px; padding:.5rem 1rem; font-weight:700; line-height:1;
    box-shadow:0 6px 18px rgba(184,75,87,.18);
    transition:background-color .15s ease,border-color .15s ease,transform .06s ease,box-shadow .15s ease;
  }
  .btn-logout:hover{
    background:var(--logout-rose); border-color:var(--logout-rose);
    box-shadow:0 8px 22px rgba(207,126,146,.22); transform:translateY(-1px);
  }
  .btn-logout:active{ transform:translateY(0); }
  .btn-logout:focus-visible{ outline:3px solid rgba(207,126,146,.35); box-shadow:0 0 0 3px rgba(207,126,146,.35); }

  /* ===== Pagination ===== */
  .pagination{ gap:.25rem; }
  .page-link{
    background:var(--card); color:var(--text);
    border:1px solid var(--border); border-radius:10px!important;
  }
  .page-link:hover{ background:var(--row-hover); color:var(--text); }
  .page-item.active .page-link{ background:var(--accent); color:var(--accent-ink); border-color:var(--accent); }
  .page-item.disabled .page-link{ color:var(--muted); background:#0d1218; border-color:var(--border); }

  /* Alerts */
  .alert{ border-radius:12px; border:1px solid var(--border); }
  .alert-info{ background:#0e1b24; color:#cfe7ff; border-color:#1b3a5b; }
  .alert-warning{ background:#221a0d; color:#ffe1a6; border-color:#3b2b0e; }
  .alert-danger{ background:#2a1518; color:#ffc0ca; border-color:#4b2026; }

  /* SweetAlert2 (theme-aligned) */
  .swal2-popup{ background:var(--card)!important; color:var(--text)!important; border:1px solid var(--border); }
  .swal2-confirm{ background:var(--danger-alt)!important; border-color:var(--danger-alt)!important; }
  .swal2-cancel{ background:#0d1218!important; color:var(--text)!important; border:1px solid var(--border)!important; }

  /* Small screens */
  @media (max-width:575.98px){
    .table{ font-size:.92rem; }
    .btn{ font-weight:600; }
  }
</style>
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')
<h3> Order Managements
    <a href="/orders/adding" class="btn btn-primary btn-sm"> Add Order </a>
</h3>

<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr class="table-info">
            <th width="5%" class="text-center">No.</th>
            <th width="25%">Order</th>
            <th width="25%">Customer</th>
            <th width="15%" class="text-center">Date</th>
            <th width="15%" class="text-center">Total</th>
            <th width="15%" class="text-center">View Detail</th>
        </tr>
    </thead>

    <tbody>
        @foreach($orders as $row)
        <tr>
            <td align="center">{{ $loop->iteration }}.</td>
            <td><b>#{{ $row->order_id }}</b></td>
            <td>
                {{ $row->member->first_name ?? '' }} {{ $row->member->last_name ?? '' }}
            </td>
            <td align="center">{{ $row->order_date }}</td>
            <td align="right">฿{{ number_format($row->total_price, 2) }}</td>
            <td align="center">
                <a href="/orders/{{ $row->order_id }}" class="btn btn-info btn-sm" style="color: #000">View</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div>
    {{ $orders->links() }}
</div>
@endsection

@section('footer')
@endsection

@section('js_before')
@endsection