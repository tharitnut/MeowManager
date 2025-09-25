<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItemModel extends Model
{
    protected $table = 'tbl_menu_items';
    protected $primaryKey = 'item_id'; // ตั้งให้ตรงกับชื่อจริงใน DB
    protected $fillable = ['item_name', 'category', 'item_price', 'item_pic', 'timestamp'];
    public $incrementing = true; // ถ้า primary key เป็นตัวเลข auto increment
    public $timestamps = false;
}
