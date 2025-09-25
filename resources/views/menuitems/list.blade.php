@extends('home')

@section('css_before')
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
                <a href="/menuitem/{{ $row->item_id }}" class="btn btn-warning btn-sm">Edit</a>
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