<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use App\Models\OrderDetailModel;
use App\Models\MenuItemModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use RealRashid\SweetAlert\Facades\Alert;

class OrdersController extends Controller
{
    public function index()
    {
        Paginator::useBootstrap();
        $orders = OrderModel::with(['member', 'employee'])
            ->orderBy('order_id', 'desc')
            ->paginate(10);

        return view('orders.list', compact('orders'));
    }

    public function adding()
    {
        $menuItems = MenuItemModel::orderBy('item_id', 'asc')
            ->get(['item_id','item_name','category','item_price','item_pic']);

        return view('orders.create', compact('menuItems'));
    }


    public function create(Request $request)
{
    // validate input
    $request->validate([
        'member_id'              => 'required|integer|min:1|exists:tbl_members,member_id',
        'employee_id'            => 'required|integer|min:1|exists:tbl_employees,employee_id',
        'order_date'             => 'required|date',
        'items'                  => 'required|array|min:1|max:10',
        'items.*.item_id'        => 'required|integer|min:1|exists:tbl_menu_items,item_id',
        'items.*.quantity'       => 'required|integer|min:1',
    ], [
        // (optional) custom messages
        'member_id.exists'       => 'Member ID not found.',
        'employee_id.exists'     => 'Employee ID not found.',
        'items.*.item_id.exists' => 'Selected Menu Item not found.',
    ], [
        // attribute names
        'member_id'              => 'member_id',
        'employee_id'            => 'employee_id',
        'order_date'             => 'order_date',
        'items.*.item_id'        => 'item_id',
        'items.*.quantity'       => 'quantity',
    ]);

    try {
        DB::transaction(function () use ($request) {
            // สร้างคำสั่งซื้อก่อน (total_price จะคำนวณจากรายละเอียด)
            $order = OrderModel::create([
                'member_id'   => $request->member_id,
                'employee_id' => $request->employee_id,
                'order_date'  => $request->order_date,
                'total_price' => 0,
            ]);

            $grandTotal = 0;

            foreach ($request->items as $it) {
                $item     = MenuItemModel::findOrFail($it['item_id']); // safe because of validate|exists
                $qty      = (int) $it['quantity'];
                $price    = (float) $item->item_price;  // ราคาปัจจุบันของเมนู
                $subtotal = $qty * $price;

                OrderDetailModel::create([
                    'order_id' => $order->order_id,
                    'item_id'  => $item->item_id,
                    'quantity' => $qty,
                    'price'    => $price, // เก็บราคา ณ วันที่ขาย
                ]);

                $grandTotal += $subtotal;
            }

            // อัปเดตยอดรวมในตาราง orders
            $order->total_price = $grandTotal;
            $order->save();
        });

        Alert::success('Order Create Successfully');
        return redirect('/orders');
    } catch (\Exception $e) {
        // return response()->json(['error' => $e->getMessage()], 500); // สำหรับ debug
        return view('errors.404');
    }
}


    public function show($order_id)
    {
        $order = OrderModel::with(['member', 'employee', 'details.item'])
            ->findOrFail($order_id);

        try {
            $computed_total = $order->details->reduce(function ($sum, $d) {
                return $sum + ($d->quantity * $d->price);
            }, 0);

            return view('orders.detail', compact('order', 'computed_total'));
        } catch (\Exception $e) {
            // return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    }

    
}