<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Admin\JoinerController;
use App\Http\Controllers\User\ChangePasswordController;
use App\Http\Controllers\User\ForgotPasswordController;

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

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::get('/migrate', function () {
    $exitCode = Artisan::call('migrate');
    return 'DONE'; //Return anything
});
Route::get('/make-model', function () {
    $exitCode = Artisan::call('migrate:rollback');
    return Artisan::output(); //Return anything
});

Route::get('/routeList', function () {
    $exitCode = Artisan::call('route:list');
    return Artisan::output(); //Return anything
});

Route::get('/seed', function () {
    $exitCode = Artisan::call('db:seed');
    return 'DONE'; //Return anything
});

//create symbolic link for storage
Route::get('/symlink', function () {
    return view('symlink');
});

Route::get('/', function () {
    return view('index');
});
Route::get('about', function () {
    return view('about');
});

Route::get('contact', function () {
    return view('contact');
});
Route::get('register', function () {
    return view('register');
});

Route::get('product', function () {
    return view('product');
});

Route::get('plan', function () {
    return view('plan');
});
Route::get('network', function () {
    return view('network');
});

Route::get('/search', [UserController::class, 'search'])->name('search');
Route::post('/register-save', [UserController::class, 'store'])->name('register.save');
Route::get('/pay/{id}', [UserController::class, 'getPayment'])->name('user.payment');
Route::post('/payment/{id}', [UserController::class, 'payment'])->name('pay');
Route::post('/success', [UserController::class, 'success']);
Auth::routes();

Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot.password');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('user');

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    Route::resource('/joiners', JoinerController::class);
    Route::get('/pay/{id}', [JoinerController::class, 'getPayment'])->name('payment');
    Route::post('/payment/{id}', [JoinerController::class, 'payment'])->name('pay');
    Route::post('/success', [JoinerController::class, 'success']);
    Route::get('/payment-success/{id}', [JoinerController::class, 'paymentSuccess'])->name('payment-success');
    Route::get('/company-tree', [JoinerController::class, 'treeview'])->name('treeview');
    Route::get('/payment-settlement', [JoinerController::class, 'paymentSettlement'])->name('payment-settlement');
    Route::post('/payment-settlement', [JoinerController::class, 'generatePaymentSettlement'])->name('generate-payment-settlement');
    Route::get('/get-payment-settlement/{id}', [JoinerController::class, 'viewPaymentSettlement'])->name('payment-settlement.view');
    Route::get('/paid-payment-settlement/{id}', [JoinerController::class, 'paidPaymentSettlement'])->name('payment-settlement.paid');
    Route::post('/payment-settlement/status', [JoinerController::class, 'paymentSettlementStatus'])->name('payment-settlement.status');
});

Route::post('/payment-success', [App\Http\Controllers\User\UserController::class, 'success']);
Route::prefix('user')->name('user.')->middleware('user')->group(function() {
    Route::post('/save-plan', [App\Http\Controllers\User\UserController::class, 'savePlan'])->name('save-plan');
    Route::get('/plan-payment/{id}', [App\Http\Controllers\User\UserController::class, 'planPayment'])->name('plan-payment');
    Route::post('/pay/{id}', [App\Http\Controllers\User\UserController::class, 'payment'])->name('pay');
    Route::get('/payment-success/{id}', [App\Http\Controllers\User\UserController::class, 'paymentSuccess'])->name('payment-success');
    Route::get('/tree-view', [App\Http\Controllers\User\UserController::class, 'treeview'])->name('treeview');
    Route::get('/joiners', [App\Http\Controllers\User\UserController::class, 'index'])->name('joiners.index');
    Route::get('/joiners/create', [App\Http\Controllers\User\UserController::class, 'create'])->name('joiners.create');
    Route::post('/joiners', [App\Http\Controllers\User\UserController::class, 'store'])->name('joiners.store');
    Route::get('/search', [App\Http\Controllers\User\UserController::class, 'search'])->name('search');
    Route::get('/registration-payment/{id}', [App\Http\Controllers\User\UserController::class, 'registrationPayment'])->name('registration-payment');
    Route::post('/registration-pay/{id}', [App\Http\Controllers\User\UserController::class, 'registrationPay'])->name('registration-pay');
    Route::post('/payment-success', [App\Http\Controllers\User\UserController::class, 'registrationSuccess']);
    Route::get('/plan-details', [App\Http\Controllers\User\UserController::class, 'planDetails'])->name('plan-details');
    Route::get('/kyc-upload', [App\Http\Controllers\User\UserController::class, 'kycUpload'])->name('kyc-upload');
    Route::post('/kyc-document/upload', [App\Http\Controllers\User\UserController::class, 'uploadDocument'])->name('kyc-document.upload');
    Route::get('/my-profile', [App\Http\Controllers\User\UserController::class, 'myProfile'])->name('profile');
    Route::get('/edit-profile', [App\Http\Controllers\User\UserController::class, 'editProfile'])->name('edit-profile');
    Route::put('/update-profile/{id}', [App\Http\Controllers\User\UserController::class, 'updateProfile'])->name('profile-update');
    Route::get('/change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password');
    Route::post('/update-password', [ChangePasswordController::class, 'updatePassword'])->name('update-password');
    Route::get('/my-wallet', [App\Http\Controllers\User\UserController::class, 'wallet'])->name('wallet');
});