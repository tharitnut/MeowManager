@extends('home')

@section('css_before')
<style>
  /* Mobile fallback: stack the button full-width */
  @media (max-width: 767.98px) {
    .btn-remove-item {
      width: 100%;
      margin-top: 8px;
    }
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
            {{-- Swapped: show cap text first, then button on the right --}}
            <small class="text-muted me-2 align-middle">Max 10 items</small>
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
        const btnAdd   = document.getElementById('btn-add-item');
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
                disp.classList.add('text-body');
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
        if (btnAdd) {
            btnAdd.addEventListener('click', function (e) {
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
