@extends('home')

@section('css_before')
<style>
  /* ===== Theme tokens (match your back-office dark minimal theme) ===== */
  :root{
    --bg:#0b0f14;
    --card:#0f141a;
    --text:#e6e7eb;
    --muted:#98a2b3;
    --border:#1f2937;
    --accent:#60a5fa;
    --accent-ink:#0b1220;
    --danger:#b84b57;          /* desaturated red */
    --danger-hover:#cf7e92;    /* soft rose */
    --danger-ink:#ffffff;
    --row-alt:#0d131a;
    --row-hover:#131a22;
    --table-shadow:0 10px 28px rgba(0,0,0,.35);
  }

  body{ background: var(--bg); }

  /* Page heading */
  h3{
    color: var(--text);
    font-weight: 700;
    letter-spacing: .2px;
    margin-bottom: 1rem;
  }

  /* ===== Table base ===== */
  .table{
    color: var(--text);
    background: var(--card);
    border-color: var(--border);
    box-shadow: var(--table-shadow);
    /* Force Bootstrap table variables to our colors */
    --bs-table-bg: transparent;
    --bs-table-color: var(--text);
    --bs-table-striped-bg: var(--row-alt);
    --bs-table-striped-color: var(--text);
    --bs-table-hover-bg: var(--row-hover);
    --bs-table-hover-color: var(--text);
    --bs-table-border-color: var(--border);
  }
  .table > :not(caption) > * > *{
    color: var(--text) !important;
    background-color: transparent;   /* let our own striping/hover show */
    border-color: var(--border);
    vertical-align: middle;
  }

  /* Header (override .table-info) */
  .table thead tr.table-info th{
    background: #111823 !important;
    color: var(--text) !important;
    border-color: var(--border) !important;
    font-weight: 700;
  }
  .table thead th{ color: var(--text) !important; }

  /* Borders */
  .table-bordered{
    border: 1px solid var(--border);
  }
  .table-bordered > :not(caption) > *{
    border-width: 1px 0;
  }
  .table-bordered > :not(caption) > * > *{
    border-width: 0 1px;
  }

  /* Striping + hover tuned for dark UI */
  .table-striped > tbody > tr:nth-of-type(odd) > *{
    background: var(--row-alt) !important;
  }
  .table-hover > tbody > tr:hover > *{
    background: var(--row-hover) !important;
  }

  /* Emphasis colors inside table */
  .text-danger{ color: #ff8da1 !important; }
  .table a{ color: #cdd5df; text-decoration: none; }
  .table a:hover{ color: #e6e7eb; text-decoration: underline; }
  .table b, .table strong{ color: var(--text); }

  /* ===== Buttons ===== */
  .btn-danger{
    --bs-btn-color: var(--danger-ink);
    --bs-btn-bg: var(--danger);
    --bs-btn-border-color: var(--danger);
    --bs-btn-hover-bg: var(--danger-hover);
    --bs-btn-hover-border-color: var(--danger-hover);
    --bs-btn-active-bg: var(--danger);
    --bs-btn-active-border-color: var(--danger);
    box-shadow: 0 6px 18px rgba(184,75,87,.18);
    font-weight: 700;
    border-radius: 999px;
  }
  .btn-danger.btn-sm{ padding: .3rem .6rem; }

  /* ===== Pagination (Laravel Bootstrap default) ===== */
  .pagination{ gap:.25rem; }
  .page-link{
    background: var(--card);
    color: var(--text);
    border: 1px solid var(--border);
    border-radius: 10px !important;
  }
  .page-link:hover{ background: var(--row-hover); color: var(--text); }
  .page-item.active .page-link{
    background: var(--accent);
    color: var(--accent-ink);
    border-color: var(--accent);
  }
  .page-item.disabled .page-link{
    color: var(--muted);
    background: #0d1218;
    border-color: var(--border);
  }

  /* Small screens */
  @media (max-width: 575.98px){
    .table{ font-size: .92rem; }
  }
</style>
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')
<h3> User Managements </h3>

<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr class="table-info">
            <th width="5%" class="text-center">No.</th>
            <th width="30%">Username</th>
            <th width="30%">Name</th>
            <th width="10%" class="text-center">Role</th>
            <th width="20%">Created At</th>
            <th width="5%" class="text-center">Delete</th>
        </tr>
    </thead>

    <tbody>
        @foreach($users as $row)
        <tr>
            <td class="text-center">{{ $loop->iteration }}.</td>
            <td><b>{{ $row->username }}</b></td>
            <td>
                @if($row->role === 'Employee' && $row->employee)
                  {{ $row->employee->first_name }} {{ $row->employee->last_name }}
                @elseif($row->role === 'Member' && $row->member)
                  {{ $row->member->first_name }} {{ $row->member->last_name }}
                @else
                  <span class="text-danger">-</span>
                @endif
            </td>
            <td class="text-center">{{ $row->role }}</td>
            <td>{{ $row->timestamp }}</td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm"
                    onclick="deleteConfirm({{ $row->user_id }})">Delete</button>

                <form id="delete-form-{{ $row->user_id }}" action="/users/remove/{{ $row->user_id }}" method="POST"
                      class="d-none">
                    @csrf
                    @method('delete')
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div>
    {{ $users->links() }}
</div>
@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  function deleteConfirm(user_id) {
    const css = getComputedStyle(document.documentElement);
    Swal.fire({
      title: 'แน่ใจหรือไม่?',
      text: "คุณต้องการลบข้อมูลนี้จริง ๆ หรือไม่",
      icon: 'warning',
      background: css.getPropertyValue('--card').trim() || '#0f141a',
      color: css.getPropertyValue('--text').trim() || '#e6e7eb',
      showCancelButton: true,
      confirmButtonColor: css.getPropertyValue('--danger').trim() || '#b84b57',
      cancelButtonColor: css.getPropertyValue('--border').trim() || '#1f2937',
      confirmButtonText: 'ใช่, ลบเลย!',
      cancelButtonText: 'ยกเลิก'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('delete-form-' + user_id).submit();
      }
    });
  }
</script>
