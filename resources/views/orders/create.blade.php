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
    --logout-rose:#cf7e92;         /* Logout hover */

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

  /* Calendar icon white (Chromium/WebKit) */
  input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
    cursor: pointer;
  }

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

  /* =================== THEME PATCH (only what you asked) =================== */
  /* 1) Modal color to match theme */
  #menuPickerModal .modal-content{
    background: var(--card);
    color: var(--text);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
  }
  #menuPickerModal .modal-header{ border-bottom: 1px solid var(--border); }
  #menuPickerModal .btn-close{
    filter: invert(1) grayscale(1) brightness(1.2);
    opacity: .9;
  }
  #menuPickerModal .btn-close:hover{ opacity: 1; }

  /* Backdrop slightly darker */
  .modal-backdrop.show{
    background-color: #0b0f14 !important;
    opacity: .85 !important;
  }

  /* Override table-light inside modal to dark look */
  #menuPickerModal thead,
  #menuPickerModal .table thead.table-light,
  #menuPickerModal .table thead tr,
  #menuPickerModal .table thead th{
    background: #111823 !important;
    color: var(--text) !important;
    border-color: var(--border) !important;
  }

  /* 2) Item field: more white when selected */
  .form-control.pick-item{ color: var(--muted); } /* default muted */
  .form-control.pick-item.text-body{             /* when JS adds class */
    color: #ffffff !important;
    font-weight: 700;
  }
  /* also brighten when value exists (old() restore) */
  .form-control.pick-item:has(+ input[value]:not([value=""])){
    color: #ffffff !important;
    font-weight: 700;
  }

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

<h3> Form Add Order </h3>

<form action="/orders" method="post">
    @csrf

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Employee ID </label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="employee_id" min="1" placeholder="Employee ID"
                   value="{{ old('employee_id') }}" required>
            @if(isset($errors) && $errors->has('employee_id'))
                <div class="text-danger"> {{ $errors->first('employee_id') }}</div>
            @endif
        </div>
        <div class="col-sm-3"></div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Member ID </label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="member_id" min="1" placeholder="Member ID"
                   value="{{ old('member_id') }}" required>
            @if(isset($errors) && $errors->has('member_id'))
                <div class="text-danger"> {{ $errors->first('member_id') }}</div>
            @endif
        </div>
        <div class="col-sm-3"></div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> Order Date </label>
        <div class="col-sm-7">
            <input type="date" class="form-control" name="order_date" value="{{ old('order_date', date('Y-m-d')) }}"
                   required>
            @if(isset($errors) && $errors->has('order_date'))
                <div class="text-danger"> {{ $errors->first('order_date') }}</div>
            @endif
        </div>
        <div class="col-sm-3"></div>
    </div>

    {{-- Items --}}
    <div id="items-wrapper">
        {{-- item #1 --}}
        <div class="order-item-block" data-index="0">
            <div class="form-group row mb-2">
                <label class="col-sm-2"> Item <span class="item-number">1</span> </label>
                <div class="col-sm-7">
                    {{-- Click to pick (non-typable) --}}
                    <a href="#"
                       class="form-control pick-item text-start"
                       id="pick-display-0"
                       data-target-idx="0"
                       style="text-decoration: none; cursor: pointer;">
                       {{ old('items.0.item_id') ? 'Selected (ID: '.old('items.0.item_id').')' : 'Click to choose…' }}
                    </a>

                    {{-- Hidden field actually submitted --}}
                    <input type="hidden" name="items[0][item_id]" id="item-id-0" value="{{ old('items.0.item_id') }}" required>

                    @if(isset($errors))
                        @foreach($errors->get('items.0.item_id') as $msg)
                            <div class="text-danger">{{ $msg }}</div>
                        @endforeach
                    @endif
                </div>

                {{-- Right blank column: center the Remove button horizontally (and vertically in this row) --}}
                <div class="col-sm-3 d-flex align-items-center justify-content-center">
                    <button type="button" class="btn btn-outline-danger btn-sm btn-remove-item" data-remove-idx="0">
                        Remove
                    </button>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label class="col-sm-2"> Quantity </label>
                <div class="col-sm-7">
                    <input type="number" class="form-control" name="items[0][quantity]" min="1" placeholder="Quantity"
                           value="{{ old('items.0.quantity') }}" required>
                    @if(isset($errors))
                        @foreach($errors->get('items.0.quantity') as $msg)
                            <div class="text-danger">{{ $msg }}</div>
                        @endforeach
                    @endif
                </div>
                <div class="col-sm-3"></div>
            </div>

            <hr>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-sm-2"></div>
        <div class="col-sm-7 text-end">
            <small class="me-2 align-middle" style="color: #fff">Max 10 items</small>
            <button type="button" id="btn-add-item" class="btn btn-primary">
                Add more item
            </button>
        </div>
    </div>

    <div class="form-group row mb-2">
        <label class="col-sm-2"> </label>
        <div class="col-sm-5">
            <button type="submit" class="btn btn-success">Insert Order</button>
            <a href="/orders" class="btn btn-danger">Cancel</a>
        </div>
    </div>
</form>

{{-- Menu Picker Modal --}}
<div class="modal fade" id="menuPickerModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select Menu Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="mb-2">
          <input type="text" id="menuFilter" class="form-control" placeholder="Search menu...">
        </div>

        <div class="table-responsive">
          <table class="table table-hover align-middle" id="menuTable">
            <thead class="table-light">
              <tr>
                <th width="8%" class="text-center">ID</th>
                <th width="30%">Name</th>
                <th width="20%">Category</th>
                <th width="15%" class="text-end">Price</th>
                <th width="15%" class="text-center">Picture</th>
                <th width="12%" class="text-center">Pick</th>
              </tr>
            </thead>
            <tbody>
              @foreach($menuItems as $mi)
              <tr>
                <td class="text-center">{{ $mi->item_id }}</td>
                <td>{{ $mi->item_name }}</td>
                <td>{{ $mi->category }}</td>
                <td class="text-end">฿{{ number_format($mi->item_price, 2) }}</td>
                <td class="text-center">
                  @if($mi->item_pic)
                    <img src="{{ asset('storage/'.$mi->item_pic) }}" alt="" style="height:40px;object-fit:cover;border-radius:6px;">
                  @endif
                </td>
                <td class="text-center">
                  <button type="button"
                          class="btn btn-sm btn-primary btn-pick-item"
                          data-item-id="{{ $mi->item_id }}"
                          data-item-name="{{ $mi->item_name }}">
                    Select
                  </button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>

@endsection

@section('footer')
@endsection

@section('js_before')
    {{-- SweetAlert renderer (required for Swal.fire) --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const wrapper  = document.getElementById('items-wrapper');
        theBtnAdd   = document.getElementById('btn-add-item');
        const maxItems = 10;

        // Modal setup
        const menuModalEl = document.getElementById('menuPickerModal');
        const menuModal   = new bootstrap.Modal(menuModalEl);
        let activeIndex   = null;

        // Focus search on show
        menuModalEl.addEventListener('shown.bs.modal', function () {
            const f = document.getElementById('menuFilter');
            if (f) f.focus();
        });

        // Open modal when clicking pseudo-field
        function attachOpenModalEvents(scope) {
            scope.querySelectorAll('.pick-item').forEach(a => {
                a.addEventListener('click', function (ev) {
                    ev.preventDefault();
                    activeIndex = this.dataset.targetIdx;
                    menuModal.show();
                });
            });
        }
        attachOpenModalEvents(wrapper);

        // Duplicate check
        function isDuplicateItem(itemId, targetIdx) {
            return Array.from(document.querySelectorAll('input[id^="item-id-"]'))
                .some(inp => inp.value && inp.value === itemId && inp.id !== `item-id-${targetIdx}`);
        }

        // Renumber after add/remove
        function renumberItems() {
            wrapper.querySelectorAll('.order-item-block').forEach((block, i) => {
                block.dataset.index = i;
                const numberSpan = block.querySelector('.item-number');
                if (numberSpan) numberSpan.textContent = i + 1;

                const pick = block.querySelector('.pick-item');
                if (pick) {
                    pick.id = `pick-display-${i}`;
                    pick.dataset.targetIdx = `${i}`;
                }
                const hidden = block.querySelector('input[type="hidden"][id^="item-id-"]');
                if (hidden) {
                    hidden.id = `item-id-${i}`;
                    hidden.name = `items[${i}][item_id]`;
                }
                const qty = block.querySelector('input[type="number"][name^="items"][name$="[quantity]"]');
                if (qty) qty.name = `items[${i}][quantity]`;

                const btnRemove = block.querySelector('.btn-remove-item');
                if (btnRemove) btnRemove.dataset.removeIdx = `${i}`;
            });
        }

        // Pick item
        menuModalEl.addEventListener('click', function (e) {
            const btn = e.target.closest('.btn-pick-item');
            if (!btn || activeIndex === null) return;

            const id   = btn.dataset.itemId;
            const name = btn.dataset.itemName;

            if (isDuplicateItem(id, activeIndex)) {
                if (window.Swal) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Duplicate item',
                        text: 'This item is already in the order.',
                        toast: true,
                        position: 'top-end',
                        timer: 2200,
                        showConfirmButton: false
                    });
                }
                return;
            }

            const hidden = document.getElementById(`item-id-${activeIndex}`);
            const disp   = document.getElementById(`pick-display-${activeIndex}`);
            if (hidden && disp) {
                hidden.value = id;
                disp.textContent = `${name} (ID: ${id})`;
                disp.classList.add('text-body'); // makes the field whiter via CSS
            }
            activeIndex = null;
            menuModal.hide();
        });

        // Filter
        const filterInput = document.getElementById('menuFilter');
        const tableBody   = document.querySelector('#menuTable tbody');
        filterInput.addEventListener('input', function () {
            const q = this.value.toLowerCase();
            tableBody.querySelectorAll('tr').forEach(tr => {
                const text = tr.innerText.toLowerCase();
                tr.style.display = text.includes(q) ? '' : 'none';
            });
        });

        // Add item
        if (theBtnAdd) {
            theBtnAdd.addEventListener('click', function (e) {
                e.preventDefault();
                const count = wrapper.querySelectorAll('.order-item-block').length;
                if (count >= maxItems) {
                    if (window.Swal) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Order creation limit',
                            text: 'You can add up to 10 items per order. Please create a new order.',
                        });
                    } else {
                        alert('You can add up to 10 items per order. Please create a new order.');
                    }
                    return;
                }

                const idx = count;
                const number = idx + 1;

                const block = document.createElement('div');
                block.className = 'order-item-block';
                block.dataset.index = idx;
                block.innerHTML = `
                    <div class="form-group row mb-2">
                        <label class="col-sm-2"> Item <span class="item-number">${number}</span> </label>
                        <div class="col-sm-7">
                            <a href="#"
                               class="form-control pick-item text-start"
                               id="pick-display-${idx}"
                               data-target-idx="${idx}"
                               style="text-decoration: none; cursor: pointer;">
                               Click to choose…
                            </a>
                            <input type="hidden" name="items[${idx}][item_id]" id="item-id-${idx}" required>
                        </div>
                        <div class="col-sm-3 d-flex align-items-center justify-content-center">
                            <button type="button" class="btn btn-outline-danger btn-sm btn-remove-item" data-remove-idx="${idx}">
                                Remove
                            </button>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-2"> Quantity </label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control"
                                   name="items[${idx}][quantity]" min="1"
                                   placeholder="Quantity" required>
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                    <hr>
                `;
                wrapper.appendChild(block);
                attachOpenModalEvents(block);
            });
        }

        // Remove item (keep at least one row)
        wrapper.addEventListener('click', function (e) {
            const btn = e.target.closest('.btn-remove-item');
            if (!btn) return;
            const blocks = wrapper.querySelectorAll('.order-item-block');
            if (blocks.length <= 1) {
                if (window.Swal) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Minimum items',
                        text: 'At least one item is required in an order.',
                        toast: true,
                        position: 'top-end',
                        timer: 2200,
                        showConfirmButton: false
                    });
                }
                return;
            }
            const block = btn.closest('.order-item-block');
            if (block) {
                block.remove();
                renumberItems();
            }
        });
    });
    </script>
@endsection
