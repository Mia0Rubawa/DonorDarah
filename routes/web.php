<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginIndividuController as LoginIndividu;
use App\Http\Controllers\Auth\LogoutController;
use App\Models\User;

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
Route::get('make-factory-user', function () {
    $user = User::factory(1)->create();
    return 'done';
});

// Auth::routes();
// Login Routes
Route::get('login-super', [LoginController::class, 'showLoginForm'])->name('login-super');
Route::post('login-super', [LoginController::class, 'login'])->name('login-super.post');


Route::get('login', [LoginIndividu::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginIndividu::class, 'login'])->name('login.post');

//Logout Routes
Route::post('logout/{auth}', [LogoutController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Email Verification Routes (if enabled)
Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('super')->prefix('super')->name('super.')->group(function () {
    include('akun/super.php');
});
Route::middleware('individu')->prefix('individu')->name('individu.')->group(function () {
    include('akun/individu.php');
});
