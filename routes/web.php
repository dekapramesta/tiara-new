<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UserDashboardController::class, 'index'])->name('user');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/cart', [ShopController::class, 'cart'])->name('cart');
Route::post('/deletecart', [ShopController::class, 'DeleteCart'])->name('cart.delete');
Route::post('/updatecart', [ShopController::class, 'UpdateCart'])->name('cart.update');
Route::post('/addcart', [ShopController::class, 'AddCart'])->name('cart.add');
Route::get('/get-payment', [MidtransController::class, 'index'])->name('payment');
Route::get('/bayar', [ShopController::class, 'bayar'])->name('bayar');
Route::post('/bayar-midtrans', [ShopController::class, 'payment_post'])->name('bayar.midtrans');
Route::post('/bayar', [ShopController::class, 'cariKode'])->name('bayar.kode');
Route::post('/searchcode', [ShopController::class, 'SearchCode'])->name('cari.kode');
Route::post('/checkout', [ShopController::class, 'Buying'])->name('buying');
Route::get('/generate-pdf', [PdfController::class, 'generatePDF']);
Route::get('Login', [LoginController::class, 'index'])->name('Login');
Route::post('LoginExc', [LoginController::class, 'LoginAction'])->name('Login.action');
Route::prefix('Admin')->group(function () {
    Route::get('/home', [AdminController::class, 'index'])->name('adminhome');
    Route::post('/menu', [MenuController::class, 'TambahMenu'])->name('menu.tambah');
    Route::post('/menu/edit', [MenuController::class, 'UpdateMenu'])->name('menu.edit');
    Route::delete('/menu/{id}', [MenuController::class, 'DeleteMenu'])->name('menu.delete');
    Route::get('/about', [AboutController::class, 'index'])->name('aboutadmin');
    Route::post('/about', [AboutController::class, 'TambahAbout'])->name('about.tambah');
    Route::post('/about/edit', [AboutController::class, 'EditAbout'])->name('about.edit');
    Route::delete('/about/{id}/delete', [AboutController::class, 'DeleteAbout'])->name('about.delete');
});
