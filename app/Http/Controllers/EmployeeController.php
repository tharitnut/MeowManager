<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmployeeModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Pagination\Paginator;
use Illuminate\Foundation\Auth\User as Authenticatable;

class EmployeeController extends Controller
{
    public function index()
    {
        Paginator::useBootstrap();
        $employees = EmployeeModel::with('user')->orderBy('employee_id', 'desc')->paginate(10);
        return view('employees.list', compact('employees'));
    }

    public function adding()
    {
        return view('employees.create');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50|unique:tbl_users,username',
            'password' => 'required|string|min:6|max:50',
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'telephone'  => 'required|string|max:10',
            'email'      => 'required|email|max:50|unique:tbl_employees,email',
            'birth_date' => 'required|date',
            'hire_date'  => 'required|date',
            'position'   => 'required|in:Admin,Staff',
            'employee_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect('employee/adding')->withErrors($validator)->withInput();
        }

        try {
            $imagePath = null;
            if ($request->hasFile('employee_pic')) {
                $imagePath = $request->file('employee_pic')->store('uploads/employee', 'public');
            }

            DB::transaction(function () use ($request, $imagePath) {
                $user = UserModel::create([
                    'username' => strip_tags($request->username),
                    'password' => password_hash($request->password, PASSWORD_BCRYPT),
                    'role'     => 'Employee', // fix ค่า
                ]);

                EmployeeModel::create([
                    'user_id' => $user->user_id,
                    'first_name' => strip_tags($request->first_name),
                    'last_name'  => strip_tags($request->last_name),
                    'nickname'   => strip_tags($request->nickname),
                    'telephone'  => strip_tags($request->telephone),
                    'email'      => strip_tags($request->email),
                    'birth_date' => $request->birth_date,
                    'hire_date'  => $request->hire_date,
                    'position'   => $request->position,
                    'employee_pic' => $imagePath,
                ]);
            });

            Alert::success('Insert Successfully');
            return redirect('/employee');
        } catch (\Exception $e) {
            // return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    }

    public function edit($employee_id)
    {
        $employee = EmployeeModel::with('user')->findOrFail($employee_id);
        return view('employees.edit', compact('employee'));
    }

    public function update($employee_id, Request $request)
    {
        $employee = EmployeeModel::with('user')->findOrFail($employee_id);

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50|unique:tbl_users,username,' . $employee->user_id . ',user_id',
            'password' => 'nullable|string|min:6|max:50',
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'telephone'  => 'required|string|max:10',
            'email'      => 'required|email|max:50|unique:tbl_employees,email,' . $employee->employee_id . ',employee_id',
            'birth_date' => 'required|date',
            'hire_date'  => 'required|date',
            'position'   => 'required|in:Admin,Staff',
            'employee_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect('employee/' . $employee_id)->withErrors($validator)->withInput();
        }

        try {
            DB::transaction(function () use ($request, $employee) {
                $employee->user->username = strip_tags($request->username);
                if ($request->filled('password')) {
                    $employee->user->password = password_hash($request->password, PASSWORD_BCRYPT);
                }
                $employee->user->role = 'Employee';
                $employee->user->save();

                if ($request->hasFile('employee_pic')) {
                    if ($employee->employee_pic) {
                        Storage::disk('public')->delete($employee->employee_pic);
                    }
                    $employee->employee_pic = $request->file('employee_pic')->store('uploads/employee', 'public');
                }

                $employee->first_name = strip_tags($request->first_name);
                $employee->last_name  = strip_tags($request->last_name);
                $employee->nickname   = strip_tags($request->nickname);
                $employee->telephone  = strip_tags($request->telephone);
                $employee->email      = strip_tags($request->email);
                $employee->birth_date = $request->birth_date;
                $employee->hire_date  = $request->hire_date;
                $employee->position   = $request->position;
                $employee->save();
            });

            Alert::success('Update Successfully');
            return redirect('/employee');
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    }

    public function remove($employee_id)
    {
        $employee = EmployeeModel::with('user')->find($employee_id);
        if (!$employee) {
            Alert::error('Employee not found.');
            return redirect('/employee');
        }
        try {


            DB::transaction(function () use ($employee) {
                if ($employee->employee_pic) {
                    Storage::disk('public')->delete($employee->employee_pic);
                }
                $employee->delete();
                if ($employee->user) {
                    $employee->user->delete();
                }
            });

            Alert::success('Delete Successfully');
            return redirect('/employee');
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    }
}