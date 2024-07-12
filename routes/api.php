<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BankAccountController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('auth')->name('user.')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [UserController::class, 'store']);
    Route::middleware('jwt.verify')->get('/logout', [AuthController::class, 'logout']);
    Route::middleware('jwt.verify')->get('/current_user', [AuthController::class, 'getUser']);

});

Route::get('/get-users', [UserController::class, 'index']);
// Route::post('/add/phoneNumber', [UserController::class, 'addNumber']);


Route::middleware('jwt.verify')->prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/u/{id}', [UserController::class, 'updateUser']);
    Route::post('/sendPhoneCode', [UserController::class, 'sendMobileVerifyCode']);
    Route::post('/verifyPhoneCode', [UserController::class, 'verifyPhoneNumber']);
});


Route::middleware('jwt.verify')->prefix('notifications')->name('notification.')->group(function () {
    Route::get('/{id}', [NotificationController::class, 'getAllByUser']);
    Route::get('/seeAll/{id}', [NotificationController::class, 'seeAllByUser']);
    // Route::post('/verifyPhoneCode', [NotificationController::class, 'verifyPhoneNumber']);
});

Route::middleware('jwt.verify')->prefix('banks')->name('bank.')->group(function () {
    Route::get('/', [BankAccountController::class, 'getBanks']);
    // Route::post('/verifyPhoneCode', [NotificationController::class, 'verifyPhoneNumber']);
});
Route::middleware('jwt.verify')->prefix('accounts_bank')->name('accountsBank.')->group(function () {
    Route::post('/', [BankAccountController::class, 'storeAccountBank']);
    Route::get('/{id}', [BankAccountController::class, 'getAccountsBanksByUser']);


    // Route::post('/verifyPhoneCode', [NotificationController::class, 'verifyPhoneNumber']);
});
