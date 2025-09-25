<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionModel extends Model
{
    protected $table = 'tbl_promotions';
    protected $primaryKey = 'promotion_id'; // ตั้งให้ตรงกับชื่อจริงใน DB
    protected $fillable = ['promotion_detail', 'promotion_pic', 'timestamp'];
    public $incrementing = true; // ถ้า primary key เป็นตัวเลข auto increment
    public $timestamps = false;
}
