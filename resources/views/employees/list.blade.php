@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')
<h3> Employee Managements
    <a href="/employee/adding" class="btn btn-primary btn-sm"> Add Employee </a>
</h3>

<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr class="table-info">
            <th width="5%" class="text-center">No.</th>
            <th width="20%">Name</th>
            <th width="15%">Username</th>
            <th width="15%" class="text-center">Position</th>
            <th width="20%">Email</th>
            <th width="15%">Telephone</th>
            <th width="5%" class="text-center">Edit</th>
            <th width="5%" class="text-center">Delete</th>
        </tr>
    </thead>

    <tbody>
        @foreach($employees as $row)
        <tr>
            <td align="center">{{ $loop->iteration }}.</td>
            <td><b>{{ $row->first_name }} {{ $row->last_name }}</b></td>
            <td>{{ optional($row->user)->username }}</td>
            <td align="center">{{ $row->position }}</td>
            <td>{{ $row->email }}</td>
            <td>{{ $row->telephone }}</td>
            <td align="center">
                <a href="/employee/{{ $row->employee_id }}" class="btn btn-warning btn-sm">Edit</a>
            </td>
            <td align="center">
                <button type="button" class="btn btn-danger btn-sm"
                    onclick="deleteConfirm({{ $row->employee_id }})">Delete</button>
                <form id="delete-form-{{ $row->employee_id }}" action="/employee/remove/{{ $row->employee_id }}"
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
    {{ $employees->links() }}
</div>
@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function deleteConfirm(employee_id) {
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
                document.getElementById('delete-form-' + employee_id).submit();
            }
        })
    }
</script>