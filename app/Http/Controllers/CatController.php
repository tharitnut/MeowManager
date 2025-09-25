<?php

namespace App\Http\Controllers;

use App\Models\CatModel;
use Illuminate\Http\Request; //รับค่าจากฟอร์ม
use Illuminate\Support\Facades\Validator; //form validation
use RealRashid\SweetAlert\Facades\Alert; //sweet alert
use Illuminate\Support\Facades\Storage; //สำหรับเก็บไฟล์ภาพ
use Illuminate\Pagination\Paginator; //แบ่งหน้า



class CatController extends Controller
{

    public function index()
    {
        Paginator::useBootstrap(); // ใช้ Bootstrap pagination
        $cats = CatModel::orderBy('cat_id', 'desc')->paginate(5); //order by & pagination
        //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        return view('cats.list', compact('cats'));
    }


    public function adding()
    {
        return view('cats.create');
    }


    public function create(Request $request)
    {
        //msg
        $messages = [
            'cat_name.required' => 'กรุณากรอกชื่อแมว',
            'cat_name.unique' => 'ชื่อแมวห้ามซ้ำ',
            'breed.required' => 'กรุณากรอกสายพันธุ์',
            'age.required' => 'กรุณากรอกอายุ',
            'age.integer' => 'อายุต้องเป็นตัวเลข',
            'age.min' => 'อายุต้องไม่ต่ำกว่า 0',
            'age.max' => 'อายุต้องไม่เกิน 100',
            'health_status.required' => 'กรุณากรอกสถานะสุขภาพ',
            'cat_pic.image' => 'กรุณาเลือกไฟล์รูปภาพ',
            'cat_pic.mimes' => 'รองรับเฉพาะ jpeg, png, jpg เท่านั้น',
            'cat_pic.max' => 'ขนาดไฟล์ไม่เกิน 5MB',
        ];

        //rule ตั้งขึ้นว่าจะเช็คอะไรบ้าง
        $validator = Validator::make($request->all(), [
            'cat_name' => 'required|unique:tbl_cats,cat_name',
            'breed' => 'required',
            'age' => 'required|integer|min:0|max:100',
            'health_status' => 'required',
            'cat_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);




        //ถ้าผิดกฏให้อยู่หน้าเดิม และแสดง msg ออกมา
        if ($validator->fails()) {
            return redirect('cat/adding')
                ->withErrors($validator)
                ->withInput();
        }


        //ถ้ามีการอัพโหลดไฟล์เข้ามา ให้อัพโหลดไปเก็บยังโฟลเดอร์ uploads/product
        try {
            $imagePath = null;
            if ($request->hasFile('cat_pic')) {
                $imagePath = $request->file('cat_pic')->store('uploads/cat', 'public');
            }

            //insert เพิ่มข้อมูลลงตาราง
            CatModel::create([
                'cat_name' => strip_tags($request->cat_name),
                'breed' => strip_tags($request->breed),
                'age' => $request->age,
                'health_status' => strip_tags($request->health_status),
                'cat_pic' => $imagePath,
            ]);

            //แสดง sweet alert
            Alert::success('Insert Successfully');
            return redirect('/cat');
        } catch (\Exception $e) {  //error debug
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //create 

    public function edit($cat_id)
    {
        try {
            $cats = CatModel::findOrFail($cat_id); // ใช้ findOrFail เพื่อให้เจอหรือ 404

            //ประกาศตัวแปรเพื่อส่งไปที่ view
            if (isset($cats)) {
                $cat_id = $cats->cat_id;
                $cat_name = $cats->cat_name;
                $breed = $cats->breed;
                $age = $cats->age;
                $health_status = $cats->health_status;
                $cat_pic = $cats->cat_pic;
                return view('cats.edit', compact('cat_id', 'cat_name', 'breed', 'age', 'health_status', 'cat_pic'));
            }
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //func edit

    public function update($cat_id, Request $request)
    {

        //error msg
        $messages = [
            'cat_name.required' => 'กรุณากรอกชื่อแมว',
            'breed.required' => 'กรุณากรอกสายพันธุ์',
            'age.required' => 'กรุณากรอกอายุ',
            'age.integer' => 'อายุต้องเป็นตัวเลข',
            'age.min' => 'อายุต้องไม่ต่ำกว่า 0',
            'age.max' => 'อายุต้องไม่เกิน 100',
            'health_status.required' => 'กรุณากรอกสถานะสุขภาพ',
            'cat_pic.image' => 'กรุณาเลือกไฟล์รูปภาพ',
            'cat_pic.mimes' => 'รองรับเฉพาะ jpeg, png, jpg เท่านั้น',
            'cat_pic.max' => 'ขนาดไฟล์ไม่เกิน 5MB',
        ];


        // ตรวจสอบข้อมูลจากฟอร์มด้วย Validator
        $validator = Validator::make($request->all(), [
            'cat_name' => 'required',
            'breed' => 'required',
            'age' => 'required|integer|min:0|max:100',
            'health_status' => 'required',
            'cat_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);

        // ถ้า validation ไม่ผ่าน ให้กลับไปหน้าฟอร์มพร้อมแสดง error และข้อมูลเดิม
        if ($validator->fails()) {
            return redirect('cat/' . $cat_id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // ดึงข้อมูลสินค้าตามไอดี ถ้าไม่เจอจะ throw Exception
            $cats = CatModel::findOrFail($cat_id);

            // ตรวจสอบว่ามีไฟล์รูปใหม่ถูกอัปโหลดมาหรือไม่
            if ($request->hasFile('cat_pic')) {
                // ถ้ามีรูปเดิมให้ลบไฟล์รูปเก่าออกจาก storage
                if ($cats->cat_pic) {
                    Storage::disk('public')->delete($cats->cat_pic);
                }
                // บันทึกไฟล์รูปใหม่ลงโฟลเดอร์ 'uploads/product' ใน disk 'public'
                $imagePath = $request->file('cat_pic')->store('uploads/cat', 'public');
                // อัปเดต path รูปภาพใหม่ใน model
                $cats->cat_pic = $imagePath;
            }

            $cats->cat_name = strip_tags($request->cat_name);
            $cats->breed = strip_tags($request->breed);
            $cats->age = $request->age;
            $cats->health_status = strip_tags($request->health_status);

            // บันทึกการเปลี่ยนแปลงในฐานข้อมูล
            $cats->save();

            // แสดง SweetAlert แจ้งว่าบันทึกสำเร็จ
            Alert::success('Update Successfully');

            // เปลี่ยนเส้นทางกลับไปหน้ารายการสินค้า
            return redirect('/cat');
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');

            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            //return view('errors.404');
        }
    } //update  



    public function remove($cat_id)
    {
        try {
            $cats = CatModel::find($cat_id); //คิวรี่เช็คว่ามีไอดีนี้อยู่ในตารางหรือไม่

            if (!$cats) {   //ถ้าไม่มี
                Alert::error('Cat not found.');
                return redirect('cat');
            }

            //ถ้ามีภาพ ลบภาพในโฟลเดอร์ 
            if ($cats->cat_pic && Storage::disk('public')->exists($cats->cat_pic)) {
                Storage::disk('public')->delete($cats->cat_pic);
            }

            // ลบข้อมูลจาก DB
            $cats->delete();

            Alert::success('Delete Successfully');
            return redirect('cat');
        } catch (\Exception $e) {
            Alert::error('เกิดข้อผิดพลาด: ' . $e->getMessage());
            return redirect('cat');
        }
    } //remove 


    public function home_index()
    {
        Paginator::useBootstrap(); // ใช้ Bootstrap pagination
        $cats = CatModel::orderBy('cat_id', 'desc')->paginate(12); //order by & pagination
        //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        return view('pages.cat_index', compact('cats'));
    }

    public function detail($cat_name)
    {
        try {
            $cats = CatModel::where('cat_name', $cat_name)->firstOrFail(); // ใช้ findOrFail เพื่อให้เจอหรือ 404

            //ประกาศตัวแปรเพื่อส่งไปที่ view
            if (isset($cats)) {
                $cat_id = $cats->cat_id;
                $cat_name = $cats->cat_name;
                $breed = $cats->breed;
                $age = $cats->age;
                $health_status = $cats->health_status;
                $cat_pic = $cats->cat_pic;
                return view('pages.cat_detail', compact('cat_id', 'cat_name', 'breed', 'age', 'health_status', 'cat_pic'));
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            // return view('errors.404');
        }
    } //func edit
} //class