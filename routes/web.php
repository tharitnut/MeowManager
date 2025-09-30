<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Public / Landing
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index']);
Route::get('/cat_page', [CatController::class, 'home_index']);
Route::get('/cat_page/detail/{cat_name}', [CatController::class, 'detail']);
Route::get('/menu_page', [MenuItemController::class, 'home_index']);
Route::get('/promotion_page', [PromotionController::class, 'home_index']);
Route::get('/promotion_page/detail/{promotion_id}', [PromotionController::class, 'detail']);

/*
|--------------------------------------------------------------------------
| Auth (Login / Logout)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboards (post-login destinations)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard',  [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/staff/dashboard',  [DashboardController::class, 'index'])->name('staff.dashboard');

    // keep the name for compatibility, but redirect to /profile for members
    Route::get('/member/dashboard', function () {
        return redirect()->route('user.profile');
    })->name('member.dashboard');

    // NEW: profile route for all roles
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/member/profile', [MemberController::class, 'detail'])->name('member.detail');
});


/*
|--------------------------------------------------------------------------
| Admin-only CRUD
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','allow:admin'])->group(function () {
    Route::get('/user', [UserController::class, 'index']);
    Route::delete('/user/remove/{user_id}', [UserController::class, 'remove']);

    Route::get('/employee', [EmployeeController::class, 'index']);
    Route::get('/employee/adding', [EmployeeController::class, 'adding']);
    Route::post('/employee', [EmployeeController::class, 'create']);
    Route::get('/employee/{employee_id}', [EmployeeController::class, 'edit']);
    Route::put('/employee/{employee_id}', [EmployeeController::class, 'update']);
    Route::delete('/employee/remove/{employee_id}', [EmployeeController::class, 'remove']);

    Route::get('/member', [MemberController::class, 'index']);
    Route::get('/member/adding', [MemberController::class, 'adding']);
    Route::post('/member', [MemberController::class, 'create']);
    Route::get('/member/{member_id}', [MemberController::class, 'edit']);
    Route::put('/member/{member_id}', [MemberController::class, 'update']);
    Route::delete('/member/remove/{member_id}', [MemberController::class, 'remove']);

    Route::get('/menuitem', [MenuItemController::class, 'index']);
    Route::get('/menuitem/adding',  [MenuItemController::class, 'adding']);
    Route::post('/menuitem',  [MenuItemController::class, 'create']);
    Route::get('/menuitem/{item_id}',  [MenuItemController::class, 'edit']);
    Route::put('/menuitem/{item_id}',  [MenuItemController::class, 'update']);
    Route::delete('/menuitem/remove/{item_id}',  [MenuItemController::class, 'remove']);

    Route::get('/promotion/adding', [PromotionController::class, 'adding']);
    Route::post('/promotion', [PromotionController::class, 'create']);
    Route::get('/promotion/{promotion_id}', [PromotionController::class, 'edit']);
    Route::put('/promotion/{promotion_id}', [PromotionController::class, 'update']);
    Route::delete('/promotion/remove/{promotion_id}', [PromotionController::class, 'remove']);
});

/*
|--------------------------------------------------------------------------
| Cat (admin + staff)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','allow:admin,staff'])->group(function () {
    Route::get('/cat', [CatController::class, 'index']);
    Route::get('/cat/adding',  [CatController::class, 'adding']);
    Route::post('/cat',  [CatController::class, 'create']);
    Route::get('/cat/{cat_id}',  [CatController::class, 'edit']);
    Route::put('/cat/{cat_id}',  [CatController::class, 'update']);
    Route::delete('/cat/remove/{cat_id}',  [CatController::class, 'remove']);
});

/*
|--------------------------------------------------------------------------
| Orders (admin + staff)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','allow:admin,staff'])->group(function () {
    Route::get('/orders', [OrdersController::class, 'index']);
    Route::get('/orders/adding', [OrdersController::class, 'adding']);
    Route::post('/orders', [OrdersController::class, 'create']);
    Route::get('/orders/{order_id}', [OrdersController::class, 'show'])->name('orders.show');
});

/*
|--------------------------------------------------------------------------
| Promotion list (admin + member)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','allow:admin,member'])->group(function () {
    Route::get('/promotion', [PromotionController::class, 'index']);
});