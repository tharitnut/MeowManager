<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table = 'tbl_orders';
    protected $primaryKey = 'order_id';
    public $timestamps = false; // ใช้คอลัมน์ timestamp เอง

    protected $fillable = [
        'member_id',
        'employee_id',
        'order_date',
        'total_price',
    ];

    public function details()
    {
        return $this->hasMany(OrderDetailModel::class, 'order_id', 'order_id');
    }

    public function member()
    {
        return $this->belongsTo(MemberModel::class, 'member_id', 'member_id');
    }

    public function employee()
    {
        return $this->belongsTo(EmployeeModel::class, 'employee_id', 'employee_id');
    }
}
