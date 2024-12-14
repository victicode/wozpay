<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BankAccountController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\InterestController;
use App\Http\Controllers\Api\LoanController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PayController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\TransferController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WalletController;

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

Route::middleware('basic.authentication')->prefix('v1/tpago')->name('tpago')->group( function () {
    Route::post('/', [PayController::class, 'tpagoCallback']);
});
Route::get('/get-users', [UserController::class, 'index']);

Route::post('/create_wallet', [UserController::class, 'storeWallet']);

// Route::post('/add/phoneNumber', [UserController::class, 'addNumber']);


Route::middleware('jwt.verify')->prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/get/{id}', [UserController::class, 'getUserById']);
    Route::get('/getBySearch', [UserController::class, 'getUsersBySearch']);
    Route::get('/all', [UserController::class, 'allUsers']);
    Route::get('/loan', [UserController::class, 'usersWithActiveLoan']);
    Route::get('/cleanUser', [UserController::class, 'cleanUser']);
    Route::get('/slowPayer', [UserController::class, 'slowPayerUser']);
    Route::get('/payPendigs', [UserController::class, 'paysPendingByUser']);
    
    Route::post('/u/{id}', [UserController::class, 'updateUser']);
    Route::post('/sendPhoneCode', [UserController::class, 'sendMobileVerifyCode']);
    Route::post('/verifyPhoneCode', [UserController::class, 'verifyPhoneNumber']);
    Route::post('/set-status/{id}', [UserController::class, 'setStatus']);
    Route::post('/set-block/{id}', [UserController::class, 'setBlock']);
    Route::post('/delete/{id}', [UserController::class, 'deleteUser']);
    Route::post('/restore/{id}', [UserController::class, 'restoreUser']);
    Route::post('/kyc', [UserController::class, 'setKyc']);
    Route::post('/setNewVerifyStatus', [UserController::class, 'setNewVerifyStatus']);
    Route::post('/email_prueba/{id}', [LoanController::class, 'sendeEmail']);

});


Route::middleware('jwt.verify')->prefix('notifications')->name('notification.')->group(function () {
    Route::post('/', [NotificationController::class, 'storeNotification']);
    Route::get('/{id}', [NotificationController::class, 'getAllByUser']);
    Route::get('/seeAll/{id}', [NotificationController::class, 'seeAllByUser']);
});

Route::middleware('jwt.verify')->prefix('banks')->name('bank.')->group(function () {
    Route::get('/', [BankAccountController::class, 'getBanks']);
});

Route::middleware('jwt.verify')->prefix('accounts_bank')->name('accountsBank.')->group(function () {
    Route::post('/', [BankAccountController::class, 'storeAccountBank']);
    Route::get('/{id}', [BankAccountController::class, 'getAccountsBanksByUser']);
    Route::post('/{id}', [BankAccountController::class, 'updateAccountBank']);
    Route::get('/delete/{id}', [BankAccountController::class, 'destroyAccountBank']);
});

Route::middleware('jwt.verify')->prefix('loan')->name('loan.')->group(function () {
    Route::post('/', [LoanController::class, 'storeLoan']);
    Route::get('/{id}', [LoanController::class, 'getActiveLoan']);
    Route::get('/get/{id}', [LoanController::class, 'getLoanById']);
    Route::get('/approve/get', [LoanController::class, 'getApproveLoan']);
    Route::post('/changeStatus/{id}', [LoanController::class, 'changeStatus']);
    Route::get('/getloan/pending', [LoanController::class, 'getPendingCount']);
});

Route::middleware('jwt.verify')->prefix('wallet')->name('wallet.')->group(function () {
    Route::post('/{id}', [WalletController::class, 'getWalletByNumber']);
});

Route::middleware('jwt.verify')->prefix('card')->name('card.')->group(function () {
    Route::post('/', [CardController::class, 'linkCard']);
    Route::get('/{id}', [CardController::class, 'getLinkCard']);
    Route::post('/delete/{id}', [CardController::class, 'deleteCard']);
    Route::post('/changeStatus/{id}', [CardController::class, 'changeStatus']);
});

Route::middleware('jwt.verify')->prefix('transfer')->name('transfer.')->group(function () {
    Route::get('/{id}', [TransferController::class, 'getTransferById']);
    Route::post('/', [TransferController::class, 'createTransfer']);

});
Route::middleware('jwt.verify')->prefix('transaction')->name('transacction.')->group(function () {
    Route::get('/all/{id}', [TransactionController::class, 'getTrasactionByUser']);
    Route::get('/byType/{type}/{id}', [TransactionController::class, 'getTrasactionByType']);
    Route::get('/print/{type}/{id}', [TransactionController::class, 'printTransaction']);
    Route::post('/', [TransactionController::class, 'createTransfer']);

});
Route::middleware('jwt.verify')->prefix('interest')->name('interest.')->group(function () {
    Route::get('/', [InterestController::class, 'getInterestRate']);
    Route::post('/', [InterestController::class, 'storeInterestRate']);
    Route::post('/{type}', [InterestController::class, 'updateInterestRate']);

});

Route::middleware('jwt.verify')->prefix('pay')->name('pay.')->group( function () {
    Route::post('/', [PayController::class, 'storePay']);
    Route::post('/get_url', [PayController::class, 'payRequest']);
    Route::post('/change-status/{id}', [PayController::class, 'changeStatus']);
});


Route::middleware('jwt.verify')->prefix('balance')->name('balance.')->group( function () {
    Route::get('/{id}', [WalletController::class, 'allBalances']);
    Route::post('/increments/{id}', [WalletController::class, 'incrementsWallet']);
    Route::post('/admin', [WalletController::class, 'setNewAdminCapital']);

});
