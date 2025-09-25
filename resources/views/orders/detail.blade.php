@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')
<h3> Order Detail : <b>#{{ $order->order_id }}</b> </h3>

<table class="table table-bordered mb-3">
    <tr>
        <th width="15%">Order ID</th>
        <td width="35%">#{{ $order->order_id }}</td>
        <th width="15%">Date & Time</th>
        <td width="35%">
            {{ \Carbon\Carbon::parse($order->timestamp)->format('m/d/Y H:i') }}
        </td>
    </tr>
    <tr>
        <th>Customer</th>
        <td>
            {{ $order->member->first_name ?? '' }} {{ $order->member->last_name ?? '' }} 
        </td>
        <th>Total</th>
        <td>฿{{ number_format($order->total_price, 2) }}</td>
    </tr>
</table>

<table class="table table-bordered table-striped">
    <thead>
        <tr class="table-info">
            <th width="5%" class="text-center">No.</th>
            <th width="35%">Menu Item</th>
            <th width="10%" class="text-center">Qty</th>
            <th width="15%" class="text-center">Price</th>
            <th width="15%" class="text-center">Subtotal</th>
            <th width="20%" class="text-center">Picture</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->details as $d)
        @php $subtotal = $d->quantity * $d->price; @endphp
        <tr>
            <td align="center">{{ $loop->iteration }}.</td>
            <td><b>{{ $d->item->item_name ?? ('Item #'.$d->item_id) }}</b></td>
            <td align="center">{{ number_format($d->quantity) }}</td>
            <td align="right">฿{{ number_format($d->price, 2) }}</td>
            <td align="right">฿{{ number_format($subtotal, 2) }}</td>
            <td align="center">
                @if(optional($d->item)->item_pic)
                <img src="{{ asset('storage/'.$d->item->item_pic) }}" width="100">
                @else
                <span class="text-muted">-</span>
                @endif
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4" align="right"><b>Total</b></td>
            <td align="right"><b>฿{{ number_format($computed_total, 2) }}</b></td>
            <td></td>
        </tr>
    </tbody>
</table>

<div class="mt-2">
    <a href="/orders" class="btn btn-secondary">Back</a>
</div>
@endsection

@section('footer')
@endsection

@section('js_before')
@endsection