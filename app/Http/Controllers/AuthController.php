<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // <-- for photo URL building
use App\Models\EmployeeModel;
use App\Models\MemberModel;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100',
            'password' => 'required|string|min:3',
        ], [
            'username.required' => 'กรุณากรอกชื่อผู้ใช้',
            'password.required' => 'กรุณากรอกรหัสผ่าน',
            'password.min'      => 'กรอกรหัสผ่านขั้นต่ำ :min ตัว',
        ]);

        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'username' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง',
            ])->withInput();
        }

        // success
        $request->session()->regenerate();
        $user = Auth::user();

        // Load related row
        $emp = null;
        $mem = null;
        if ($user->role === 'Employee') {
            $emp = EmployeeModel::where('user_id', $user->user_id)->first();
        } else { // Member
            $mem = MemberModel::where('user_id', $user->user_id)->first();
        }

        // Compute “helpers” here and stash them in session
        $displayName = $this->buildDisplayName($user->role, $emp, $mem, $user->username);
        $photoUrl    = $this->buildPhotoUrl($user->role, $emp, $mem);
        $email       = $this->buildPrimaryEmail($user->role, $emp, $mem);
        $points      = $this->buildPoints($user->role, $mem);

        session([
            // your existing keys
            'login_user_id'        => $user->user_id,
            'login_role'           => $user->role,                     // 'Employee'|'Member'
            'emp_position'         => $emp->position ?? null,          // 'Admin'|'Staff'
            'login_name'           => ($emp->first_name ?? $mem->first_name ?? $user->username),

            // profile helpers moved from model accessors
            'profile_display_name' => $displayName,
            'profile_photo_url'    => $photoUrl,
            'profile_email'        => $email,
            'profile_points'       => $points,                         // null for Employee
        ]);

        // Landing per role
        if ($user->role === 'Member') {
            return redirect()->route('member.detail');
        }

        // Employees need an employee row
        if (!$emp) {
            Auth::logout();
            return back()->withErrors([
                'username' => 'ไม่พบข้อมูลพนักงานของผู้ใช้นี้',
            ])->withInput();
        }

        if ($emp->position === 'Admin') {
            return redirect()->intended('/admin/dashboard');
        }
        return redirect()->intended('/staff/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // -------------------------
    // Helper builders (moved here)
    // -------------------------

    private function buildDisplayName(string $role, ?EmployeeModel $emp, ?MemberModel $mem, string $fallbackUsername): string
    {
        if ($role === 'Employee' && $emp) {
            $name = trim(($emp->first_name ?? '') . ' ' . ($emp->last_name ?? ''));
            return $name !== '' ? $name : $fallbackUsername;
        }
        if ($role === 'Member' && $mem) {
            $name = trim(($mem->first_name ?? '') . ' ' . ($mem->last_name ?? ''));
            return $name !== '' ? $name : $fallbackUsername;
        }
        return $fallbackUsername;
    }

    private function buildPrimaryEmail(string $role, ?EmployeeModel $emp, ?MemberModel $mem): ?string
    {
        if ($role === 'Employee' && $emp) {
            return $emp->email ?? null;
        }
        if ($role === 'Member' && $mem) {
            return $mem->email ?? null;
        }
        return null;
    }

    private function buildPoints(string $role, ?MemberModel $mem): ?int
    {
        return $role === 'Member' && $mem ? ($mem->point ?? 0) : null;
    }

    private function buildPhotoUrl(string $role, ?EmployeeModel $emp, ?MemberModel $mem): string
    {
        $default = asset('images/default_avatar.png');

        // pick a relative DB path based on role
        $path = null;
        if ($role === 'Employee' && $emp) {
            $path = $emp->employee_pic;  // e.g. 'uploads/employee/xxx.jpg'
        } elseif ($role === 'Member' && $mem) {
            $path = $mem->member_pic;    // e.g. 'uploads/member/yyy.jpg'
        }
        if (!$path) return $default;

        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('public');

        // Case A: file saved to storage/app/public/... (recommended)
        if ($disk->exists($path)) {
            return $disk->url($path);    // -> '/storage/uploads/...'
        }

        // Case B: file is physically under public/uploads/...
        if (file_exists(public_path($path))) {
            return asset($path);         // -> '/uploads/...'
        }

        return $default;
    }
}