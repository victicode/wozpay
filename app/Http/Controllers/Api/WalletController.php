<?php

namespace App\Http\Controllers\Api;

use App\Models\Pay;
use App\Models\Loan;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Events\UserUpdateEvent;
use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    public function getWalletByNumber($wallet){
        $wallet = Wallet::with('user')->where('number', $wallet)->first();
        
        if(!$wallet) return $this->returnFail(400, 'Cuenta no existe.');

        return $this->returnSuccess(200, $wallet);
    }
    public function allBalances($id) {
        $wallet = Wallet::where('user_id', $id)->first();
        $loansBalances = $this->allLoansAmount();
        $paysAndProfit = $this->allPays();
        if(!$wallet) return $this->returnFail(400, 'Cuenta no existe.');

        return $this->returnSuccess(200, [
            'wallet'        => $wallet->balance,
            'loans'         => $loansBalances['amount'],
            'toRecieve'      => $loansBalances['amountToRecive'],
            'paysRecieve'   => $paysAndProfit['pays'],
            'subscriptions' => $paysAndProfit['subscriptions'],

        ]);
    }
    public function incrementsWallet($id, Request $request) {
        $wallet = Wallet::where('user_id', $id)->first();
        
        if(!$wallet) return $this->returnFail(404, 'Wallet no encontrada');

        $wallet->balance +=  $request->amount;
        $wallet->balance -=  $request->amountLess;

        $wallet->save();
        event(new UserUpdateEvent($id));

        return $this->returnSuccess(200, $wallet);
    }
    public function setNewAdminCapital(Request $request) {
        $wallet = Wallet::where('user_id', 1)->first();

        $wallet->balance =  $request->amount;
        $wallet->save();
        event(new UserUpdateEvent(1));

        return $this->returnSuccess(200, $wallet);
    }
    private function allLoansAmount() {
        $amount = 0;
        $amounToRecive = 0 ;
        $loans = Loan::where('status', '2' )->get();
        
        foreach ($loans as $loan) {
            $amount += $loan->amount;
            $amounToRecive += $loan->amount_to_pay;
        }

        return [
            'amount' => $amount,
            'amountToRecive' => $amounToRecive,
        ];

    }
    private function allPays() {
        $forSubscriptions = 0;
        $paysRecieve = 0 ;
        $pays = Pay::where('status', '2' )->where('type', '2' )->get();
        $subscriptions = Pay::where('status', '2' )->where('type', '1' )->get();

        if($pays) 
            foreach ($pays as $pay) {
                $paysRecieve += $pay->amount;
            }
        if($subscriptions)
            foreach ($subscriptions as $subscription) {
                $forSubscriptions += $subscription->amount;
            }   

        return [
            'pays' => $paysRecieve,
            'subscriptions' => $forSubscriptions,
        ];

    }
}
