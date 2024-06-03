<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartInController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ManagementEditController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminLoginController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.product-list');

Route::get('/products/{product}/details', [ProductController::class, 'showProductDetail'])->name('products.product-detail');
Route::post('/products/{product}/details', [CartInController::class, 'cartIn']);

Route::middleware('auth:web')->group(function () {
    // マイページ
    Route::get('/mypage', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/mypage', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/mypage/delete', [ProfileController::class, 'showDeleteConfirm'])->name('profile.delete');
    Route::delete('/mypage/delete', [ProfileController::class, 'delete'])->name('profile.delete');

    // ショッピングカート
    Route::get('/cart-items', [CartItemController::class, 'showCartItem'])->name('cartitems.cart');

    Route::group(['middleware' => 'can:view,cart_item'], function() {
        Route::put('/cart-items/{cart_item}', [CartItemController::class, 'changeQuantity'])->name('cartitems.change');
        Route::delete('/cart-items/{cart_item}', [CartItemController::class, 'destroyProduct'])->name('cartitems.destroy');
    });

    // お届け先
    Route::get('/cart-items/delivery', [PurchaseController::class, 'showDeliveryAdress'])->name('cartitems.delivery');

    // 購入内容確認
    Route::post('/cart-items/confirm', [PurchaseController::class, 'confirm'])->name('cartitems.confirm');

    // 注文完了
    Route::post('/cart-items/done', [PurchaseController::class, 'done'])->name('cartitems.done');

});

Route::prefix('admin')->middleware('auth.admin:admin')->group(function () {
    // 注文管理画面
    Route::get('orders', [ManagementController::class, 'showOrder'])->name('management.order');

    // 注文詳細画面
    Route::get('orders/{order}/edit', [ManagementEditController::class, 'showOrderEdit'])->name('management.order-edit');
    Route::post('orders/{order}/edit', [ManagementEditController::class, 'editOrder']);
    Route::put('orders/{order}/edit/{order_detail}', [ManagementEditController::class, 'changePurchaseQuantity'])->name('management.change');

    // ログアウト
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';