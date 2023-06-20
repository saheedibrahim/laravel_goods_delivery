<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DispatcherController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDispatcherController;
use App\Http\Controllers\DispatcherNotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'notification', 'as' => 'notification.'], function()
{
    Route::get('/accept/{orderId}', [DispatcherNotificationController::class, 'dispatcherAccepted'])->name('accept');
    Route::get('/delivered/{orderId}/{dispatcherId}', [DispatcherNotificationController::class, 'goodsDelivered'])->name('delivered');
    Route::get('/decline/{orderId}/{dispatcherId}/{userId}', [DispatcherNotificationController::class, 'getAnotherDispatcher'])->name('decline');
});

Route::group(['prefix' => 'user', 'as' => 'user.'], function()
{
    Route::get('/signup', [UserController::class, 'signuppage'])->name('signup');
    Route::post('/signup', [UserController::class, 'create'])->name('signup');

    Route::get('/login', [UserController::class, 'loginpage'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::get('/home', [UserController::class, 'home'])->name('home')->middleware('user');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('user');
    
    Route::get('/order', [OrderController::class, 'orderpage'])->name('order')->middleware('user');
    Route::post('/order', [OrderController::class, 'order'])->name('order');
});

Route::group(['prefix' => 'dispatcher', 'as' => 'dispatcher.'], function()
{
    Route::get('/signup', [DispatcherController::class, 'signuppage'])->name('signup');
    Route::post('/signup', [DispatcherController::class, 'store'])->name('signup');

    Route::get('/login', [DispatcherController::class, 'loginpage'])->name('login');
    Route::post('/login', [DispatcherController::class, 'login'])->name('login');
    Route::get('/home', [DispatcherController::class, 'index'])->name('home')->middleware('dispatcher');
    Route::get('/logout', [DispatcherController::class, 'logout'])->name('logout')->middleware('dispatcher');
});

Route::prefix('admin')->group(function()
{
    Route::get('/signup', [AdminController::class, 'signuppage']);
    Route::post('/signup', [AdminController::class, 'store']);

    Route::get('/login', [AdminController::class, 'loginpage']);
    Route::post('/login', [AdminController::class, 'login']);
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware('admin');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
