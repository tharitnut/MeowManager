<?php

namespace App\Http\Controllers;

use App\Models\MemberModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Pagination\Paginator;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MemberController extends Controller
{
    public function index()
    {
        Paginator::useBootstrap();
        $members = MemberModel::with('user')->orderBy('member_id', 'desc')->paginate(10);
        return view('members.list', compact('members'));
    }

    public function adding()
    {
        return view('members.create');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50|unique:tbl_users,username',
            'password' => 'required|string|min:6|max:50',
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'telephone'  => 'required|string|max:10',
            'email'      => 'required|email|max:50|unique:tbl_members,email',
            'birth_date' => 'required|date',
            'point'      => 'nullable|integer|min:0',
            'register_date' => 'required|date',
            'member_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect('member/adding')->withErrors($validator)->withInput();
        }

        try {
            $imagePath = null;
            if ($request->hasFile('member_pic')) {
                $imagePath = $request->file('member_pic')->store('uploads/member', 'public');
            }

            DB::transaction(function () use ($request, $imagePath) {
                $user = UserModel::create([
                    'username' => strip_tags($request->username),
                    'password' => password_hash($request->password, PASSWORD_BCRYPT),
                    'role'     => 'Member', // fix ค่า
                ]);

                MemberModel::create([
                    'user_id'    => $user->user_id,
                    'first_name' => strip_tags($request->first_name),
                    'last_name'  => strip_tags($request->last_name),
                    'telephone'  => strip_tags($request->telephone),
                    'email'      => strip_tags($request->email),
                    'birth_date' => $request->birth_date,
                    'point'      => $request->point ?? 0,
                    'register_date' => $request->register_date,
                    'member_pic' => $imagePath,
                ]);
            });

            Alert::success('Insert Successfully');
            return redirect('/member');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            // return view('errors.404');
        }
    }

    public function edit($member_id)
    {
        $member = MemberModel::with('user')->findOrFail($member_id);
        return view('members.edit', compact('member'));
    }

    public function update($member_id, Request $request)
    {
        $member = MemberModel::with('user')->findOrFail($member_id);

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50|unique:tbl_users,username,' . $member->user_id . ',user_id',
            'password' => 'nullable|string|min:6|max:50',
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'telephone'  => 'required|string|max:10',
            'email'      => 'required|email|max:50|unique:tbl_members,email,' . $member->member_id . ',member_id',
            'birth_date' => 'required|date',
            'point'      => 'nullable|integer|min:0',
            'register_date' => 'required|date',
            'member_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect('member/' . $member_id)->withErrors($validator)->withInput();
        }
        try {
            DB::transaction(function () use ($request, $member) {
                $member->user->username = strip_tags($request->username);
                if ($request->filled('password')) {
                    $member->user->password = password_hash($request->password, PASSWORD_BCRYPT);
                }
                $member->user->role = 'Member';
                $member->user->save();

                if ($request->hasFile('member_pic')) {
                    if ($member->member_pic) {
                        Storage::disk('public')->delete($member->member_pic);
                    }
                    $member->member_pic = $request->file('member_pic')->store('uploads/member', 'public');
                }

                $member->first_name = strip_tags($request->first_name);
                $member->last_name  = strip_tags($request->last_name);
                $member->telephone  = strip_tags($request->telephone);
                $member->email      = strip_tags($request->email);
                $member->birth_date = $request->birth_date;
                $member->point      = $request->point ?? 0;
                $member->register_date = $request->register_date;
                $member->save();
            });

            Alert::success('Update Successfully');
            return redirect('/member');
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    }

    public function remove($member_id)
    {
        $member = MemberModel::with('user')->find($member_id);
        if (!$member) {
            Alert::error('Member not found.');
            return redirect('/member');
        }
        try {
            DB::transaction(function () use ($member) {
                if ($member->member_pic) {
                    Storage::disk('public')->delete($member->member_pic);
                }
                $member->delete();
                if ($member->user) {
                    $member->user->delete();
                }
            });

            Alert::success('Delete Successfully');
            return redirect('/member');
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    }
}