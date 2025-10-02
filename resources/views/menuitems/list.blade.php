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
<h3> Menu Item Managements
    <a href="/menuitem/adding" class="btn btn-primary btn-sm"> Add Menu Item </a>
</h3>

<form method="GET" action="{{ url('/menuitem') }}" class="mb-3" id="filterForm">
  <div class="row g-2 align-items-center">
    <!-- Category -->
    <div class="col-md-2">
      <select name="category" class="form-control rounded-pill text-center"
              onchange="document.getElementById('filterForm').submit()">
        <option value="">-- Category --</option>
        <option value="Food"  {{ request('category') == 'Food'  ? 'selected' : '' }}>Food</option>
        <option value="Drink" {{ request('category') == 'Drink' ? 'selected' : '' }}>Drink</option>
      </select>
    </div>

    <!-- Keyword -->
    <div class="col-md-7">
      <input type="text"
             name="keyword"
             class="form-control rounded-pill"
             placeholder="Menu Name"
             value="{{ request('keyword') }}">
    </div>

    <!-- Buttons side by side full width -->
    <div class="col-md-3">
      <div class="row g-2">
        <div class="col-6">
          <button type="submit" class="btn btn-primary rounded-pill w-100">Search</button>
        </div>
        <div class="col-6">
          <a href="{{ url('/menuitem') }}" class="btn btn-secondary rounded-pill w-100">Clear</a>
        </div>
      </div>
    </div>
  </div>
</form>



</form>

<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr class="table-info">
            <th width="5%" class="text-center">No.</th>
            <th width="35%">Menu Item</th>
            <th width="15%">Category</th>
            <th width="15%" class="text-center">Price</th>
            <th width="15%">Picture</th>
            <th width="7.5%" class="text-center">Edit</th>
            <th width="7.5%" class="text-center">Delete</th>
        </tr>
    </thead>

    <tbody>
        @foreach($menu_items as $row)
        <tr>
            <td align="center">{{ $loop->iteration }}.</td>
            <td>
                <b>{{ $row->item_name }}</b> <br>
            </td>
            <td>{{ $row->category }}</td>
            <td align="right">฿{{ number_format($row->item_price, 2) }}</td>
            <td align="center">
                <img src=" {{ asset('storage/' . $row->item_pic) }}" width="100">
            </td>
            <td align="center">
                <a href="/menuitem/{{ $row->item_id }}" class="btn btn-warning btn-sm" style="color: #000">Edit</a>
            </td>
            <td align="center">

                {{-- <form action="/menuitem/remove/{{$row->item_id}}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('Sure to Delete !!');">Delete</button>
                </form> --}}

                <button type="button" class="btn btn-danger btn-sm"
                    onclick="deleteConfirm({{ $row->item_id }})">Delete</button>

                <form id="delete-form-{{ $row->item_id }}" action="/menuitem/remove/{{$row->item_id}}" method="POST"
                    style="display: none;">
                    @csrf
                    @method('delete')
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div>
    {{ $menu_items->links() }}
</div>
@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

@section('js_before')
@endsection




<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function deleteConfirm(item_id) {
    Swal.fire({
        title: 'แน่ใจหรือไม่?',
        text: "คุณต้องการลบข้อมูลนี้จริง ๆ หรือไม่",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่, ลบเลย!',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            // ถ้ากด "ลบเลย" ให้ submit form ที่ซ่อนไว้
            document.getElementById('delete-form-' + item_id).submit();
        }
    })
}
</script>