<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        Paginator::useBootstrap();

        // ดึง user พร้อม employee หรือ member ที่เกี่ยวข้อง
        $users = UserModel::with(['employee', 'member'])
            ->orderBy('user_id', 'desc')
            ->paginate(10);

        return view('users.list', compact('users'));
    }

    public function remove($user_id)
    {
        $user = UserModel::with(['employee', 'member'])->find($user_id);

        if (!$user) {
            Alert::error('User not found.');
            return redirect('/users');
        }

        try {
            DB::transaction(function () use ($user) {
                // ถ้าเป็น Employee → ลบ employee + รูป
                if ($user->role === 'Employee' && $user->employee) {
                    if ($user->employee->employee_pic && Storage::disk('public')->exists($user->employee->employee_pic)) {
                        Storage::disk('public')->delete($user->employee->employee_pic);
                    }
                    $user->employee->delete();
                }

                // ถ้าเป็น Member → ลบ member + รูป
                if ($user->role === 'Member' && $user->member) {
                    if ($user->member->member_pic && Storage::disk('public')->exists($user->member->member_pic)) {
                        Storage::disk('public')->delete($user->member->member_pic);
                    }
                    $user->member->delete();
                }

                // สุดท้ายลบ user
                $user->delete();
            });

            Alert::success('Delete Successfully');
        } catch (\Exception $e) {
            Alert::error('Error: ' . $e->getMessage());
        }

        return redirect('/users');
    }

    public function profile()
    {
        // use Auth::id() if you fully use Laravel auth; otherwise fallback to your session key
        $uid = Auth::id() ?? session('login_user_id');
        if (!$uid) return redirect('/login');

        $user = UserModel::with(['employee','member'])->findOrFail($uid);

        return view('users.profile', compact('user'));
    }
}