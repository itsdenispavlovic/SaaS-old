<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\SitemapController;
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

Route::get('/', [MainController::class, 'index']);

Route::get('sitemap-google.xml', [SitemapController::class, 'googleSitemap']);

Route::get('plans', [BillingController::class, 'index'])->name('billing');

Route::group(['middleware' => 'auth'], function() {
    Route::get('checkout/{plan_id}', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

    Route::get('payment-methods/default/{paymentMethod}', [PaymentMethodController::class, 'markDefault'])->name('payment-methods.markDefault');
    Route::resource('payment-methods', PaymentMethodController::class);
    Route::get('invoices/download/{paymentId}', [BillingController::class, 'downloadInvoice'])->name('invoices.download');
});

/**
 * Admin
 */
Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('dashboard');

    /**
     * Plans
     */
    Route::resource('plans', 'PlanController');

    /**
     * Nodes
     */
    Route::post('nodes/reorder', 'NodeController@reorderRows');
    Route::get('nodes/generate-slug', 'NodeController@generateSlug');
    Route::resource('nodes', 'NodeController');

    /**
     * Users
     */
    Route::resource('users', 'UserController');

    /**
     * Newsletter
     */
    Route::resource('newsletters', 'NewsletterController');

    /**
     * Contacts & Contact Types
     */
    Route::get('contacts/toggle', 'ContactController@toggleField');
    Route::resource('contacts', 'ContactController');
    Route::resource('contactTypes', 'ContactTypeController');
});

Route::stripeWebhooks('stripe-webhook');


Route::get('{nodePath}', [MainController::class, 'showNode'])->where('nodePath', '([A-z0-9\d\-\/_. ]+)?')->name("websitePage");
