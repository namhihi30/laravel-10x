<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Profile\AvatarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::group(['prefix' => 'quan-li-nhan-vien', 'as' => 'staff.'], function () {

    Route::get('/', [StaffController::class, 'index'])->name('index');
    Route::get('/add', [StaffController::class, 'create'])->name('create');
    Route::post('/add', [StaffController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [StaffController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [StaffController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [StaffController::class, 'delete'])->name('delete');

});

Route::get('/test', function (){

});
Route::get('/testSend', [ProfileController::class, 'testSend']);

Route::get('/login', [LoginController::class, 'formLogin']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
//
//Route::group(['prefix' => 'laravel-filemanager'], function () {
//    \UniSharp\LaravelFilemanager\Lfm::routes();
//});
//
//Route::get('/home', [HomeController::class, 'index']);
//
//Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'as' => 'admin.'], function () {
//    Route::get('/', [DashboardController::class, 'index'])->name('index');
//
//
//    Route::group(['prefix' => 'posts', 'as' => 'posts.', 'middleware' => 'can:posts'], function () {
//        Route::get('/', [PostController::class, 'index'])->name('index');
//        Route::get('/add', [PostController::class, 'add'])->name('add');
//
//    });
//
//    Route::group(['prefix' => 'groups', 'as' => 'groups.'], function () {
//        Route::get('/', [GroupController::class, 'index'])->name('index')->can('viewAny', Group::class);
//        Route::get('/add', [GroupController::class, 'add'])->name('add')->can('create', Group::class);
//        Route::post('/add', [GroupController::class, 'postAdd'])->name('post_add');
//        Route::get('/edit/{id}', [GroupController::class, 'edit'])->name('edit')->can('groups.edit', Group::class);
//        Route::post('/edit', [GroupController::class, 'postEdit'])->name('post_edit');
//        Route::get('/delete/{id}', [GroupController::class, 'delete'])->name('delete');
//        Route::get('/phanquyen/{id}', [GroupController::class, 'phanquyen'])->name('phanquyen');
//        Route::post('/phanquyen/{id}', [GroupController::class, 'postPhanquyen'])->name('post_phanquyen');
//
//    });
//
//    Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => 'can:users'], function () {
//        Route::get('/', [UserController::class, 'index'])->name('index')->can('viewAny', User::class);
//        Route::get('/add', [UserController::class, 'add'])->name('add')->can('create', User::class);
//        Route::post('/add', [UserController::class, 'postAdd'])->name('post_add');
//        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit')->can('users.edit');
//        Route::post('/edit', [UserController::class, 'postEdit'])->name('post_edit');
//        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete')->can('users.delete');
//    });
//
//});
//
//
//Route::get('/ok', function () {
//
//
////    $productDetails = null;
////    foreach (config('shopping_cart.product_details') as $details) {
////        if ($details['id'] == 1) {
////            $productDetails = $details;
////            break;
////        }
////    }
////
////    $userID = Auth::user()->id;
////
////    // Add the product to the cart
////    \Cart::session($userID)->add([
////        'id' => 3,
////        'name' => 'Lenovo Smartchoice Ideapad 3',
////        'price' => 700.00,
////        'iamge' => '700.00',
////        'quantity' => 1,
////        'attributes' => array(),
////    ]);
////    return response()->json(['success' => true]);
//
//})->name('dashboard');
//
//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::patch('/profile/avatar', [AvatarController::class, 'update'])->name('profile.avatar');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});
//
//require __DIR__ . '/auth.php';
