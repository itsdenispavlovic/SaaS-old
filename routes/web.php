<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\CheckoutController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('billing', [BillingController::class, 'index'])->name('billing');
    Route::get('checkout/{plan_id}', [CheckoutController::class, 'checkout'])->name('checkout');
});

/**
 * Admin
 */
Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('dashboard');

    /**
     * Users
     */
    Route::resource('users', 'UserController');
});
