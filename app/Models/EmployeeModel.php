<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    protected $table = 'tbl_employees';
    protected $primaryKey = 'employee_id';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'nickname',
        'telephone',
        'email',
        'birth_date',
        'hire_date',
        'position',
        'employee_pic',
        'timestamps'
    ];
    public $incrementing = true; // ถ้า primary key เป็นตัวเลข auto increment
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
}