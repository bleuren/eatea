<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OpayPaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Cart\Index as CartIndex;
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

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('referral');

Route::group(['prefix' => 'login/{provider}'], function () {
    Route::get('/', [LoginController::class, 'redirectToProvider'])->name('social.login');
    Route::get('/callback', [LoginController::class, 'handleProviderCallback'])->name('social.callback');
});
Route::post('/receive', [OpayPaymentController::class, 'receive']);
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
    Route::resource('order', OrderController::class, ['only' => ['index', 'show', 'store']]);
    Route::get('/refer', [UserController::class, 'refs'])->name('user.refs');
    Route::get('/wallet', [UserController::class, 'wallet'])->name('user.wallet');
    Route::post('/pay', [OpayPaymentController::class, 'pay']);
    Route::patch('/order/update/payment/{order}', [OrderController::class, 'patchPayment'])->name('order.update.payment');

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/deposit/{id}/{type}/{amount}', [UserController::class, 'deposit'])->name('user.deposit');
        Route::get('/withdraw/{id}/{type}/{amount}', [UserController::class, 'withdraw'])->name('user.withdraw');
        Route::resource('order', OrderController::class, ['only' => ['update', 'edit']]);
        Route::get('/order/tasks/{received_at}', [OrderController::class, 'tasks'])->name('order.tasks');
        Route::get('/order/notifyTasks/{received_at}', [OrderController::class, 'notifyTasks'])->name('order.tasks.notify');
    });
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('cart', CartIndex::class)->name('cart.index');
Route::resource('cart', CartController::class, ['only' => ['store']]);
Route::resource('page', PageController::class, ['only' => ['show']]);
Route::resource('product', ProductController::class, ['only' => ['index', 'show']]);

Route::get('map', [HomeController::class, 'map'])->name('map');
