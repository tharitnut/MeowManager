<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberModel extends Model
{
    protected $table = 'tbl_members';
    protected $primaryKey = 'member_id';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'telephone',
        'email',
        'birth_date',
        'point',
        'register_date',
        'member_pic',
        'timestamp'
    ];
    public $incrementing = true; // ถ้า primary key เป็นตัวเลข auto increment
    public $timestamps = false;



    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
}
