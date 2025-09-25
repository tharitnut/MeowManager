<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatModel extends Model
{
    protected $table = 'tbl_cats';
    protected $primaryKey = 'cat_id'; // ตั้งให้ตรงกับชื่อจริงใน DB
    protected $fillable = ['cat_name', 'breed', 'age', 'health_status', 'cat_pic', 'timestamp'];
    public $incrementing = true; // ถ้า primary key เป็นตัวเลข auto increment
    public $timestamps = false;
}
