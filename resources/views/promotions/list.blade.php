@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')
<h3> Promotion Managements
    <a href="/promotion/adding" class="btn btn-primary btn-sm"> Add Promotion </a>
</h3>

<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr class="table-info">
            <th width="5%" class="text-center">No.</th>
            <th width="65%">Promotion Detail</th>
            <th width="15%">Picture</th>
            <th width="7.5%" class="text-center">Edit</th>
            <th width="7.5%" class="text-center">Delete</th>
        </tr>
    </thead>

    <tbody>
        @foreach($promotions as $row)
        <tr>
            <td align="center">{{ $loop->iteration }}.</td>

            <td>
                <b>{{ $row->promotion_detail }}</b>
            </td>

            <td align="center">
                <img src="{{ asset('storage/' . $row->promotion_pic) }}" width="100">
            </td>

            <td align="center">
                <a href="/promotion/{{ $row->promotion_id }}" class="btn btn-warning btn-sm">Edit</a>
            </td>

            <td align="center">
                <button type="button" class="btn btn-danger btn-sm"
                    onclick="deleteConfirm({{ $row->promotion_id }})">Delete</button>

                <form id="delete-form-{{ $row->promotion_id }}" action="/promotion/remove/{{$row->promotion_id}}"
                    method="POST" style="display: none;">
                    @csrf
                    @method('delete')
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>

<div>
    {{ $promotions->links() }}
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
    function deleteConfirm(id) {
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
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>