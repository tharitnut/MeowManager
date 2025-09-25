<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\OrderModel;
use App\Models\OrderDetailModel;
use App\Models\MemberModel;
use App\Models\EmployeeModel;
use App\Models\MenuItemModel;

class DashboardController extends Controller
{
    public function index()
    {
        // ====== Monthly Range ======
        $today   = Carbon::today();
        $start   = $today->copy()->startOfMonth()->toDateString(); // เดือนนี้เริ่ม
        $end     = $today->toDateString();                        // วันนี้ (ไม่เอาวันอนาคต)

        // ====== KPIs ======
        $totalOrders   = OrderModel::whereBetween(DB::raw('DATE(order_date)'), [$start, $end])->count();
        $totalRevenue  = (float) OrderModel::whereBetween(DB::raw('DATE(order_date)'), [$start, $end])->sum('total_price');
        $ordersToday   = OrderModel::whereDate('order_date', $today->toDateString())->count();

        $membersCount   = MemberModel::count();
        $employeesCount = EmployeeModel::count();

        // ====== Top Seller (เดือนนี้) ======
        $topSeller = OrderDetailModel::select('tbl_order_details.item_id', DB::raw('SUM(tbl_order_details.quantity) AS total_qty'))
            ->join('tbl_orders', 'tbl_orders.order_id', '=', 'tbl_order_details.order_id')
            ->whereBetween(DB::raw('DATE(tbl_orders.order_date)'), [$start, $end])
            ->groupBy('tbl_order_details.item_id')
            ->orderByDesc('total_qty')
            ->first();

        $topSellerItem = $topSeller ? MenuItemModel::find($topSeller->item_id) : null;

        // ====== Sales Chart (startOfMonth -> today) ======
        $salesByDay = OrderModel::select(
            DB::raw('DATE(order_date) AS day'),
            DB::raw('SUM(total_price) AS total')
        )
            ->whereBetween(DB::raw('DATE(order_date)'), [$start, $end])
            ->groupBy(DB::raw('DATE(order_date)'))
            ->orderBy('day')
            ->get()
            ->keyBy('day');

        $labels = [];
        $data   = [];
        for ($d = Carbon::parse($start); $d->lte(Carbon::parse($end)); $d->addDay()) {
            $day = $d->toDateString();
            $labels[] = $day;
            $data[]   = isset($salesByDay[$day]) ? (float) $salesByDay[$day]->total : 0.0;
        }

        // ====== Top 5 Items (เดือนนี้) ======
        $topItems = OrderDetailModel::select('tbl_order_details.item_id', DB::raw('SUM(tbl_order_details.quantity) AS qty'))
            ->join('tbl_orders', 'tbl_orders.order_id', '=', 'tbl_order_details.order_id')
            ->whereBetween(DB::raw('DATE(tbl_orders.order_date)'), [$start, $end])
            ->groupBy('tbl_order_details.item_id')
            ->orderByDesc('qty')
            ->limit(5)
            ->get();

        $topItemLabels = [];
        $topItemData   = [];
        foreach ($topItems as $ti) {
            $item = MenuItemModel::find($ti->item_id);
            $topItemLabels[] = $item?->item_name ?? ('Item #' . $ti->item_id);
            $topItemData[]   = (int) $ti->qty;
        }

        // ====== Recent Orders (เดือนนี้ล่าสุด 10 รายการ) ======
        $recentOrders = OrderModel::with(['member', 'employee'])
            ->whereBetween(DB::raw('DATE(timestamp)'), [$start, $end])
            ->orderBy('timestamp', 'desc')
            ->limit(10)
            ->get();

        return view('dashboard.index', compact(
            'totalOrders',
            'totalRevenue',
            'ordersToday',
            'membersCount',
            'employeesCount',
            'topSeller',
            'topSellerItem',
            'labels',
            'data',
            'topItemLabels',
            'topItemData',
            'recentOrders'
        ));
    }
}