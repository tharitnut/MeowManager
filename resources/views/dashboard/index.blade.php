@extends('home')

@section('css_before')
<style>
  /* ===== Dark-only back office theme (dashboard-focused) ===== */
  :root{
    color-scheme: dark;
    --bg:#0b0f14; --card:#0f141a; --text:#e6e7eb; --muted:#98a2b3; --border:#1f2937;
    --shadow:0 10px 28px rgba(0,0,0,.35); --radius:16px;

    --accent:#60a5fa; --accent-ink:#0b1220;
    --row-alt:#0d131a; --row-hover:#131a22;

    /* chart palette */
    --ch-line:#93c5fd;
    --ch-fill:#93c5fd33;
    --ch-grid:#263241;
    --ch-grid-soft:#1d2733;
    --ch-bars:#7dd3fc;
  }

  body{ background:var(--bg); }
  h3,h5{ color:var(--text); font-weight:700; letter-spacing:.2px; }

  /* Cards (KPIs + chart wrappers) */
  .card{
    background:var(--card);
    border:1px solid var(--border);
    border-radius:var(--radius);
    box-shadow:var(--shadow);
  }
  .card h6{ color:var(--muted); margin-bottom:.35rem; }
  .card h3{ color:var(--text); margin:0; }

  /* Table (recent orders) */
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
  .table-bordered{ border:1px solid var(--border); }
  .table-bordered > :not(caption) > *{ border-width:1px 0; }
  .table-bordered > :not(caption) > * > *{ border-width:0 1px; }
  .table-striped > tbody > tr:nth-of-type(odd) > *{ background:var(--row-alt)!important; }
  .table-hover > tbody > tr:hover > *{ background:var(--row-hover)!important; }

  /* Canvas should sit on dark card cleanly */
  canvas{ background: transparent; }
</style>
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

  <div class="col-md-2 mb-3 d-flex">
    <div class="card text-center h-100 flex-fill">
      <div class="card-body d-flex align-items-center justify-content-center flex-column">
        <h6>Total Cats</h6>
        <h3>{{ number_format($catsCount) }}</h3>
      </div>
    </div>
  </div>

  <div class="col-md-3 mb-3 d-flex">
    <div class="card text-center h-100 flex-fill">
      <div class="card-body d-flex align-items-center justify-content-center flex-column">
        <h6>Top Seller (This Month)</h6>
        @if($topSeller && $topSellerItem)
          <div style="color: #e6e7eb"><b>{{ $topSellerItem->item_name }}</b></div>
          <small style="color: #e6e7eb">Qty: {{ number_format($topSeller->total_qty) }}</small>
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
    <div class="card h-100">
      <div class="card-body">
        <h5>Sales (From start of month → Today)</h5>
        <canvas id="salesChart"></canvas>
      </div>
    </div>
  </div>

  <div class="col-md-6 mb-3">
    <div class="card h-100">
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
      <td>{{ $row->member->first_name ?? '' }} {{ $row->member->last_name ?? '' }}</td>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  // ===== Chart.js dark defaults (no logic change) =====
  const css = getComputedStyle(document.documentElement);
  const cText   = css.getPropertyValue('--text').trim() || '#e6e7eb';
  const cGrid   = css.getPropertyValue('--ch-grid').trim() || '#263241';
  const cGrid2  = css.getPropertyValue('--ch-grid-soft').trim() || '#1d2733';
  const cLine   = css.getPropertyValue('--ch-line').trim() || '#93c5fd';
  const cFill   = css.getPropertyValue('--ch-fill').trim() || 'rgba(147,197,253,.2)';
  const cBars   = css.getPropertyValue('--ch-bars').trim() || '#7dd3fc';

  // Global defaults for dark UI
  Chart.defaults.color = cText;
  Chart.defaults.borderColor = cGrid2;
  Chart.defaults.plugins.legend.labels.color = cText;
  Chart.defaults.plugins.tooltip.backgroundColor = '#0f141a';
  Chart.defaults.plugins.tooltip.titleColor = cText;
  Chart.defaults.plugins.tooltip.bodyColor = cText;

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
          borderColor: cLine,
          backgroundColor: cFill,
          fill: true,
          tension: 0.25,
          pointRadius: 3,
          pointHoverRadius: 4
        }]
      },
      options: {
        responsive: true,
        scales: {
          x: {
            grid: { color: cGrid, drawBorder: false }
          },
          y: {
            beginAtZero: true,
            grid: { color: cGrid, drawBorder: false }
          }
        }
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
          data: @json($topItemData),
          backgroundColor: cBars,
          borderColor: cGrid2
        }]
      },
      options: {
        responsive: true,
        indexAxis: 'y',
        scales: {
          x: { beginAtZero: true, grid: { color: cGrid, drawBorder: false } },
          y: { grid: { color: cGrid, drawBorder: false } }
        }
      }
    });
  }
});
</script>
@endsection
