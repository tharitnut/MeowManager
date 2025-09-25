<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class UserModel extends Authenticatable
{
    protected $table = 'tbl_users';
    protected $primaryKey = 'user_id';
    protected $fillable = ['username', 'password', 'role','timestamp'];
    public $incrementing = true;
    public $timestamps = false;

    protected $hidden = ['password'];

    public function employee()
    {
        return $this->hasOne(EmployeeModel::class, 'user_id', 'user_id');
    }

    public function member()
    {
        return $this->hasOne(MemberModel::class, 'user_id', 'user_id');
    }

}