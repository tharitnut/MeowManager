@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')
<h3> Cat Managements
    <a href="/cat/adding" class="btn btn-primary btn-sm"> Add Cat </a>
</h3>

<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr class="table-info">
            <th width="5%" class="text-center">No.</th>
            <th width="15%">Name</th>
            <th width="15%">Picture</th>
            <th width="5%" class="text-center">Age</th>
            <th width="15%">Breed</th>
            <th width="30%">Health Status</th>
            <th width="7.5%" class="text-center">Edit</th>
            <th width="7.5%" class="text-center">Delete</th>
        </tr>
    </thead>

    <tbody>
        @foreach($cats as $row)
        <tr>
            <td align="center">{{ $loop->iteration }}.</td>

            <td>
                <b>{{ $row->cat_name }}</b>
            </td>

            <td>
                <img src="{{ asset('storage/' . $row->cat_pic) }}" width="100">
            </td>

            <td align="right">{{ number_format($row->age) }}</td>

            <td>{{ $row->breed }}</td>

            <td>{{ $row->health_status }}</td>

            <td align="center">
                <a href="/cat/{{ $row->cat_id }}" class="btn btn-warning btn-sm">Edit</a>
            </td>

            <td align="center">
                <button type="button" class="btn btn-danger btn-sm"
                    onclick="deleteConfirm({{ $row->cat_id }})">Delete</button>

                <form id="delete-form-{{ $row->cat_id }}" action="/cat/remove/{{$row->cat_id}}" method="POST"
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
    {{ $cats->links() }}
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