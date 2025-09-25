<?php

namespace App\Http\Controllers;

use App\Models\CatModel;
use App\Models\PromotionModel;
use Illuminate\Http\Request; //รับค่าจากฟอร์ม
use Illuminate\Support\Facades\Validator; //form validation
use RealRashid\SweetAlert\Facades\Alert; //sweet alert
use Illuminate\Support\Facades\Storage; //สำหรับเก็บไฟล์ภาพ
use Illuminate\Pagination\Paginator; //แบ่งหน้า



class PromotionController extends Controller
{

    public function index()
    {
        Paginator::useBootstrap(); // ใช้ Bootstrap pagination
        $promotions = PromotionModel::orderBy('promotion_id', 'desc')->paginate(8); //order by & pagination
        //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        return view('promotions.list', compact('promotions'));
    }

    public function adding()
    {
        return view('promotions.create');
    }


    public function create(Request $request)
    {
        //msg
        $messages = [
            'promotion_detail.required' => 'กรุณากรอกรายละเอียดโปรโมชั่น',
            'promotion_pic.image' => 'กรุณาเลือกไฟล์รูปภาพ',
            'promotion_pic.mimes' => 'รองรับเฉพาะ jpeg, png, jpg เท่านั้น',
            'promotion_pic.max' => 'ขนาดไฟล์ไม่เกิน 5MB',
        ];

        //rule ตั้งขึ้นว่าจะเช็คอะไรบ้าง
        $validator = Validator::make($request->all(), [
            'promotion_detail' => 'required',
            'promotion_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);


        //ถ้าผิดกฏให้อยู่หน้าเดิม และแสดง msg ออกมา
        if ($validator->fails()) {
            return redirect('promotion/adding')
                ->withErrors($validator)
                ->withInput();
        }


        //ถ้ามีการอัพโหลดไฟล์เข้ามา ให้อัพโหลดไปเก็บยังโฟลเดอร์ uploads/product
        try {
            $imagePath = null;
            if ($request->hasFile('promotion_pic')) {
                $imagePath = $request->file('promotion_pic')->store('uploads/promotion', 'public');
            }

            //insert เพิ่มข้อมูลลงตาราง
            PromotionModel::create([
                'promotion_detail' => strip_tags($request->promotion_detail),
                'promotion_pic' => $imagePath,
            ]);

            //แสดง sweet alert
            Alert::success('Insert Successfully');
            return redirect('/promotion');
        } catch (\Exception $e) {  //error debug
            // return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //create 

    public function edit($promotion_id)
    {
        try {
            $promotions = PromotionModel::findOrFail($promotion_id); // ใช้ findOrFail เพื่อให้เจอหรือ 404

            //ประกาศตัวแปรเพื่อส่งไปที่ view
            if (isset($promotions)) {
                $promotion_id = $promotions->promotion_id;
                $promotion_detail = $promotions->promotion_detail;
                $promotion_pic = $promotions->promotion_pic;
                return view('promotions.edit', compact('promotion_id', 'promotion_detail', 'promotion_pic'));
            }
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //func edit

    public function update($promotion_id, Request $request)
    {

        //error msg
        $messages = [
            'promotion_detail.required' => 'กรุณากรอกรายละเอียดโปรโมชั่น',
            'promotion_pic.image' => 'กรุณาเลือกไฟล์รูปภาพ',
            'promotion_pic.mimes' => 'รองรับเฉพาะ jpeg, png, jpg เท่านั้น',
            'promotion_pic.max' => 'ขนาดไฟล์ไม่เกิน 5MB',
        ];


        // ตรวจสอบข้อมูลจากฟอร์มด้วย Validator
        $validator = Validator::make($request->all(), [
            'promotion_detail' => 'required',
            'promotion_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);

        // ถ้า validation ไม่ผ่าน ให้กลับไปหน้าฟอร์มพร้อมแสดง error และข้อมูลเดิม
        if ($validator->fails()) {
            return redirect('promotion/' . $promotion_id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // ดึงข้อมูลสินค้าตามไอดี ถ้าไม่เจอจะ throw Exception
            $promotions = PromotionModel::findOrFail($promotion_id);

            // ตรวจสอบว่ามีไฟล์รูปใหม่ถูกอัปโหลดมาหรือไม่
            if ($request->hasFile('promotion_pic')) {
                // ถ้ามีรูปเดิมให้ลบไฟล์รูปเก่าออกจาก storage
                if ($promotions->promotion_pic) {
                    Storage::disk('public')->delete($promotions->promotion_pic);
                }
                // บันทึกไฟล์รูปใหม่ลงโฟลเดอร์ 'uploads/product' ใน disk 'public'
                $imagePath = $request->file('promotion_pic')->store('uploads/promotion', 'public');
                // อัปเดต path รูปภาพใหม่ใน model
                $promotions->promotion_pic = $imagePath;
            }

            $promotions->promotion_detail = strip_tags($request->promotion_detail);

            // บันทึกการเปลี่ยนแปลงในฐานข้อมูล
            $promotions->save();

            // แสดง SweetAlert แจ้งว่าบันทึกสำเร็จ
            Alert::success('Update Successfully');

            // เปลี่ยนเส้นทางกลับไปหน้ารายการสินค้า
            return redirect('/promotion');
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');

            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            //return view('errors.404');
        }
    } //update  



    public function remove($promotion_id)
    {
        try {
            $promotions = PromotionModel::find($promotion_id); //คิวรี่เช็คว่ามีไอดีนี้อยู่ในตารางหรือไม่

            if (!$promotions) {   //ถ้าไม่มี
                Alert::error('Promotion not found.');
                return redirect('promotion');
            }

            //ถ้ามีภาพ ลบภาพในโฟลเดอร์ 
            if ($promotions->promotion_pic && Storage::disk('public')->exists($promotions->promotion_pic)) {
                Storage::disk('public')->delete($promotions->promotion_pic);
            }

            // ลบข้อมูลจาก DB
            $promotions->delete();

            Alert::success('Delete Successfully');
            return redirect('promotion');
        } catch (\Exception $e) {
            Alert::error('เกิดข้อผิดพลาด: ' . $e->getMessage());
            return redirect('promotion');
        }
    } //remove 


    public function home_index()
    {
        Paginator::useBootstrap(); // ใช้ Bootstrap pagination
        $promotions = PromotionModel::orderBy('promotion_id', 'desc')->paginate(12); //order by & pagination
        //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        return view('pages.promotion_index', compact('promotions'));
    }

    
    public function detail($promotion_id)
    {
        try {
            $promotions = PromotionModel::findOrFail($promotion_id); // ใช้ findOrFail เพื่อให้เจอหรือ 404

            //ประกาศตัวแปรเพื่อส่งไปที่ view
            if (isset($promotions)) {
                $promotion_id = $promotions->promotion_id;
                $promotion_detail = $promotions->promotion_detail;
                $promotion_pic = $promotions->promotion_pic;
                return view('pages.promotion_detail', compact('promotion_id', 'promotion_detail', 'promotion_pic'));
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            // return view('errors.404');
        }
    } //func edit
    

} //class