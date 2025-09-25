@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')
<h3> Dashboard (This Month) </h3>

{{-- KPI CARDS --}}
<div class="row">
    <!-- Row 1 -->
    <div class="col-md-3 mb-3 d-flex">
        <div class="card text-center h-100 flex-fill">
            <div class="card-body d-flex align-items-center justify-content-center flex-column">
                <h6>Total Orders (This Month)</h6>
                <h3>{{ number_format($totalOrders) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3 d-flex">
        <div class="card text-center h-100 flex-fill">
            <div class="card-body d-flex align-items-center justify-content-center flex-column">
                <h6>Total Revenue (This Month)</h6>
                <h3>฿{{ number_format($totalRevenue, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3 d-flex">
        <div class="card text-center h-100 flex-fill">
            <div class="card-body d-flex align-items-center justify-content-center flex-column">
                <h6>Orders Today</h6>
                <h3>{{ number_format($ordersToday) }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-2 mb-3 d-flex">
        <div class="card text-center h-100 flex-fill">
            <div class="card-body d-flex align-items-center justify-content-center flex-column">
                <h6>Total Employees</h6>
                <h3>{{ number_format($employeesCount) }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-2 mb-3 d-flex">
        <div class="card text-center h-100 flex-fill">
            <div class="card-body d-flex align-items-center justify-content-center flex-column">
                <h6>Total Members</h6>
                <h3>{{ number_format($membersCount) }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3 d-flex">
    <div class="card text-center h-100 flex-fill">
        <div class="card-body d-flex align-items-center justify-content-center flex-column">
            <h6>Top Seller (This Month)</h6>
            @if($topSeller && $topSellerItem)
                <div><b>{{ $topSellerItem->item_name }}</b></div>
                <small>Qty: {{ number_format($topSeller->total_qty) }}</small>
            @else
                <div><small class="text-muted">No data</small></div>
            @endif
        </div>
    </div>
</div>

</div>


{{-- CHARTS --}}
<div class="row mt-3">
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <h5>Sales (From start of month → Today)</h5>
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <h5>Top 5 Items (This Month)</h5>
                <canvas id="topItemsChart"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- RECENT ORDERS --}}
<h5 class="mt-4">Recent 10 Orders (This Month)</h5>
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr class="table-info">
            <th width="5%" class="text-center">No.</th>
            <th width="25%">Order</th>
            <th width="30%">Customer</th>
            <th width="20%" class="text-center">Date</th>
            <th width="20%" class="text-center">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($recentOrders as $row)
        <tr>
            <td align="center">{{ $loop->iteration }}.</td>
            <td><b>#{{ $row->order_id }}</b></td>
            <td>
                {{ $row->member->first_name ?? '' }} {{ $row->member->last_name ?? '' }}
            </td>
            <td align="center">{{ $row->order_date }}</td>
            <td align="right">฿{{ number_format($row->total_price, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('footer')
@endsection

@section('js_before')
{{-- ใช้ Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Sales chart (startOfMonth -> today)
    const salesCtx = document.getElementById('salesChart');
    if (salesCtx) {
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Revenue (This Month)',
                    data: @json($data),
                    fill: false,
                    tension: 0.2
                }]
            },
            options: {
                responsive: true,
                scales: { y: { beginAtZero: true } }
            }
        });
    }

    // Top items chart (This Month)
    const topCtx = document.getElementById('topItemsChart');
    if (topCtx) {
        new Chart(topCtx, {
            type: 'bar',
            data: {
                labels: @json($topItemLabels),
                datasets: [{
                    label: 'Qty (This Month)',
                    data: @json($topItemData)
                }]
            },
            options: {
                responsive: true,
                indexAxis: 'y',
                scales: { x: { beginAtZero: true } }
            }
        });
    }
});
</script>
@endsection
