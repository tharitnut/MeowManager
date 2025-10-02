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
    // Eager load to avoid N+1 and make checks easy
    $user = UserModel::with(['employee', 'member'])->find($user_id);

    if (!$user) {
        Alert::error('User not found.');
        return redirect('/users');
    }

    // Will we be deleting ourselves? (support both Auth and your session fallback)
    $currentId = Auth::id() ?? session('login_user_id');
    $deletingSelf = $currentId && (intval($currentId) === intval($user_id));

    try {
        DB::transaction(function () use ($user) {
            // If role is Employee → remove employee + photo (if any)
            if ($user->role === 'Employee' && $user->employee) {
                if ($user->employee->employee_pic && Storage::disk('public')->exists($user->employee->employee_pic)) {
                    Storage::disk('public')->delete($user->employee->employee_pic);
                }
                $user->employee->delete();
            }

            // If role is Member → remove member + photo (if any)
            if ($user->role === 'Member' && $user->member) {
                if ($user->member->member_pic && Storage::disk('public')->exists($user->member->member_pic)) {
                    Storage::disk('public')->delete($user->member->member_pic);
                }
                $user->member->delete();
            }

            // Finally delete the user
            $user->delete();
        });

        // If the deleted user is the current user, force logout and redirect to login
        if ($deletingSelf) {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            Alert::success('Your account has been deleted.');
            return redirect('/login');
        }

        Alert::success('Delete Successfully');
        return redirect('/user');

    } catch (\Throwable $e) {
        Alert::error('Error: '.$e->getMessage());
        return redirect('/user');
    }
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