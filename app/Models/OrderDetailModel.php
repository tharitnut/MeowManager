<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetailModel extends Model
{
    protected $table = 'tbl_order_details';
    protected $primaryKey = 'order_detail_id';
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'item_id',
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(OrderModel::class, 'order_id', 'order_id');
    }

    public function item()
    {
        // ใช้ model เมนูที่มีอยู่แล้วในโปรเจกต์ของคุณ
        return $this->belongsTo(MenuItemModel::class, 'item_id', 'item_id');
    }
}
