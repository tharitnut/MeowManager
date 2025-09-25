@extends('home')

@section('css_before')
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
            <td align="center">{{ $loop->iteration }}.</td>
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
            <td align="center">{{ $row->role }}</td>
            <td>{{ $row->timestamp }}</td>
            <td align="center">
                <button type="button" class="btn btn-danger btn-sm"
                    onclick="deleteConfirm({{ $row->user_id }})">Delete</button>

                <form id="delete-form-{{ $row->user_id }}" action="/users/remove/{{ $row->user_id }}" method="POST"
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
                document.getElementById('delete-form-' + user_id).submit();
            }
        })
    }
</script>