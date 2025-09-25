<?php

namespace App\Http\Controllers;

use App\Models\MenuItemModel;
use Illuminate\Http\Request; //รับค่าจากฟอร์ม
use Illuminate\Support\Facades\Validator; //form validation
use RealRashid\SweetAlert\Facades\Alert; //sweet alert
use Illuminate\Support\Facades\Storage; //สำหรับเก็บไฟล์ภาพ
use Illuminate\Pagination\Paginator; //แบ่งหน้า



class MenuItemController extends Controller
{

    public function index(Request $request)
    {
        Paginator::useBootstrap();

        $category = $request->query('category');        // 'Food' | 'Drink' | null
        $keyword  = $request->query('keyword');         // menu name

        $menu_items = MenuItemModel::query()
            ->when($category, function ($q) use ($category) {
                $q->where('category', $category);
            })
            ->when($keyword, function ($q) use ($keyword) {
                $q->where('item_name', 'like', '%' . $keyword . '%');
            })
            ->orderBy('item_id', 'desc')
            ->paginate(5)
            ->appends($request->query()); // keep filters on pagination links

        return view('menuitems.list', compact('menu_items', 'category', 'keyword'));
    }


    public function adding()
    {
        return view('menuitems.create');
    }


    public function create(Request $request)
    {
        //msg
        $messages = [
            'item_name.required' => 'กรุณากรอกชื่อสินค้า',
            'category.required' => 'กรุณาเลือกประเภทสินค้า',
            'item_price.required' => 'ห้ามว่าง',
            'item_price.numeric' => 'ใส่ตัวเลขเท่านั้น',
            'item_price.min' => 'ขั้นต่ำมากกว่า 1',
            'item_pic.mimes' => 'รองรับ jpeg, png, jpg เท่านั้น !!',
            'item_pic.max' => 'ขนาดไฟล์ไม่เกิน 5MB !!',
        ];

        //rule ตั้งขึ้นว่าจะเช็คอะไรบ้าง
        $validator = Validator::make($request->all(), [
            'item_name' => 'required',
            'category' => 'required',
            'item_price' => 'required|numeric|min:1',
            'item_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);


        //ถ้าผิดกฏให้อยู่หน้าเดิม และแสดง msg ออกมา
        if ($validator->fails()) {
            return redirect('menuitem/adding')
                ->withErrors($validator)
                ->withInput();
        }


        //ถ้ามีการอัพโหลดไฟล์เข้ามา ให้อัพโหลดไปเก็บยังโฟลเดอร์ uploads/product
        try {
            $imagePath = null;
            if ($request->hasFile('item_pic')) {
                $imagePath = $request->file('item_pic')->store('uploads/menuitem', 'public');
            }

            //insert เพิ่มข้อมูลลงตาราง
            MenuItemModel::create([
                'item_name' => strip_tags($request->item_name),
                'category' => strip_tags($request->category),
                'item_price' => $request->item_price,
                'item_pic' => $imagePath,
            ]);

            //แสดง sweet alert
            Alert::success('Insert Successfully');
            return redirect('/menuitem');
        } catch (\Exception $e) {  //error debug
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //create 

    public function edit($item_id)
    {
        try {
            $menu_items = MenuItemModel::findOrFail($item_id); // ใช้ findOrFail เพื่อให้เจอหรือ 404

            //ประกาศตัวแปรเพื่อส่งไปที่ view
            if (isset($menu_items)) {
                $item_id = $menu_items->item_id;
                $item_name = $menu_items->item_name;
                $category = $menu_items->category;
                $item_price = $menu_items->item_price;
                $item_pic = $menu_items->item_pic;
                return view('menuitems.edit', compact('item_id', 'item_name', 'category', 'item_price', 'item_pic'));
            }
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //func edit

    public function update($item_id, Request $request)
    {

        //error msg
        $messages = [
            'item_name.required' => 'กรุณากรอกชื่อสินค้า',
            'category.required' => 'กรุณาเลือกประเภทสินค้า',
            'item_price.required' => 'ห้ามว่าง',
            'item_price.numeric' => 'ใส่ตัวเลขเท่านั้น',
            'item_price.min' => 'ขั้นต่ำมากกว่า 1',
            'item_pic.mimes' => 'รองรับ jpeg, png, jpg เท่านั้น !!',
            'item_pic.max' => 'ขนาดไฟล์ไม่เกิน 5MB !!',
        ];


        // ตรวจสอบข้อมูลจากฟอร์มด้วย Validator
        $validator = Validator::make($request->all(), [
            'item_name' => 'required',
            'category' => 'required',
            'item_price' => 'required|numeric|min:1',
            'item_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);

        // ถ้า validation ไม่ผ่าน ให้กลับไปหน้าฟอร์มพร้อมแสดง error และข้อมูลเดิม
        if ($validator->fails()) {
            return redirect('menuitem/' . $item_id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // ดึงข้อมูลสินค้าตามไอดี ถ้าไม่เจอจะ throw Exception
            $menu_items = MenuItemModel::findOrFail($item_id);

            // ตรวจสอบว่ามีไฟล์รูปใหม่ถูกอัปโหลดมาหรือไม่
            if ($request->hasFile('item_pic')) {
                // ถ้ามีรูปเดิมให้ลบไฟล์รูปเก่าออกจาก storage
                if ($menu_items->item_pic) {
                    Storage::disk('public')->delete($menu_items->item_pic);
                }
                // บันทึกไฟล์รูปใหม่ลงโฟลเดอร์ 'uploads/product' ใน disk 'public'
                $imagePath = $request->file('item_pic')->store('uploads/menuitem', 'public');
                // อัปเดต path รูปภาพใหม่ใน model
                $menu_items->item_pic = $imagePath;
            }

            // อัปเดตชื่อสินค้า โดยใช้ strip_tags ป้องกันการแทรกโค้ด HTML/JS
            $menu_items->item_name = strip_tags($request->item_name);
            // อัปเดตรายละเอียดสินค้า โดยใช้ strip_tags ป้องกันการแทรกโค้ด HTML/JS
            $menu_items->category = strip_tags($request->category);
            // อัปเดตราคาสินค้า
            $menu_items->item_price = $request->item_price;

            // บันทึกการเปลี่ยนแปลงในฐานข้อมูล
            $menu_items->save();

            // แสดง SweetAlert แจ้งว่าบันทึกสำเร็จ
            Alert::success('Update Successfully');

            // เปลี่ยนเส้นทางกลับไปหน้ารายการสินค้า
            return redirect('/menuitem');
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');

            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            //return view('errors.404');
        }
    } //update  



    public function remove($item_id)
    {
        try {
            $menu_items = MenuItemModel::find($item_id); //คิวรี่เช็คว่ามีไอดีนี้อยู่ในตารางหรือไม่

            if (!$menu_items) {   //ถ้าไม่มี
                Alert::error('Menu Item not found.');
                return redirect('menuitem');
            }

            //ถ้ามีภาพ ลบภาพในโฟลเดอร์ 
            if ($menu_items->item_pic && Storage::disk('public')->exists($menu_items->item_pic)) {
                Storage::disk('public')->delete($menu_items->item_pic);
            }

            // ลบข้อมูลจาก DB
            $menu_items->delete();

            Alert::success('Delete Successfully');
            return redirect('menuitem');
        } catch (\Exception $e) {
            Alert::error('เกิดข้อผิดพลาด: ' . $e->getMessage());
            return redirect('menuitem');
        }
    } //remove 


    public function home_index()
    {
        Paginator::useBootstrap(); // ใช้ Bootstrap pagination
        $items = MenuItemModel::orderBy('item_id')->paginate(12); //order by & pagination
        //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        return view('pages.menu_index', compact('items'));
    }


} //class