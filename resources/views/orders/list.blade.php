@extends('home')

@section('css_before')
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
                <a href="/orders/{{ $row->order_id }}" class="btn btn-info btn-sm">View</a>
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