<?php

namespace App\Http\Controllers\Api;

use App\Models\Pay;
use App\Models\Loan;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Events\UserUpdateEvent;
use App\Http\Controllers\Controller;
use App\Models\Quota;
use Exception;

class WalletController extends Controller
{
    public function getWalletByNumber($wallet, Request $request){
        $wallet = Wallet::with('user')->where('number', $wallet)->first();
        
        if(!$wallet) return $this->returnFail(400, 'Cuenta no existe.');
        if($wallet->user->id == $request->user()->id) return $this->returnFail(400, 'No puedes realizar trasferencia a tu misma cuenta.');

        return $this->returnSuccess(200, $wallet);
    }
    public function allBalances($id) {
        $wallet = Wallet::where('user_id', $id)->first();
        if(!$wallet) return $this->returnFail(400, 'Cuenta no existe.');
        $loansBalances = $this->allLoansAmount();
        $paysAndProfit = $this->allPays();
        $paysPending =  $this->paysPeding();

        return $this->returnSuccess(200, $id == 1 
        ? [
            'wallet'        => round($wallet->balance),
            'loans'         => round($loansBalances['amount']),
            'toRecieve'     => round($loansBalances['amountToRecive']),
            'toPay'         => round($this->allQuotasToRecive()),
            'paysRecieve'   => round($paysAndProfit['pays']),
            'subscriptions' => round($paysAndProfit['subscriptions']),
            'paysPeding'    => round($paysPending) 
        ]
        : [
            'wallet'        => $wallet->balance,
            'loans'         => $loansBalances['amount'],
            'toRecieve'     => $loansBalances['amountToRecive'],
            'paysRecieve'   => $paysAndProfit['pays'],

        ]);
    }
    public function incrementsWallet($id, Request $request) {
        $wallet = Wallet::where('user_id', $id)->first();
        
        if(!$wallet) return $this->returnFail(404, 'Wallet no encontrada');

        $wallet->balance +=  $request->amount;
        $wallet->balance -=  $request->amountLess;

        $wallet->save();
        try {
            event(new UserUpdateEvent($id));
        } catch (Exception $th) {
            //throw $th;
        }

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
        $loans = Loan::where('status','!=' ,'1' )->where('status','!=' ,'0' )->get();
        
        
        foreach ($loans as $loan) {
            $amount += $loan->amount;
            $amounToRecive += $loan->amount_to_pay;
        }

        return [
            'amount' => $amount,
            'amountToRecive' => $amounToRecive,
        ];

    }
    private function allQuotasToRecive() {
        $amount = 0;
        $amounDelay = 0 ;
        $quotas = Quota::where('status', '1' )->get();
        $quotasDelay = Quota::with('loan')->where('status', '3' )->get();
        
        
        foreach ($quotas as $quota) {
            $amount += $quota->amount;
        }
        foreach ($quotasDelay as $quota) {
            $amount += ( $quota->amount + ($quota->amount * $quota->loan->interest_for_delay)/100) ;
        }
        return $amount;

    }
    private function allPays() {
        $forSubscriptions = 0;
        $paysRecieve = 0 ;
        $pays = Pay::where('status', '2' )->get();
        $subscriptions = (Loan::where('status', '2' )->where('isRekutu', 0)->count() * 150000) + (Loan::where('status', '3' )->where('isRekutu', 0)->count() *150000) + (Loan::where('status', '4' )->count() *150000);

        if($pays) 
            foreach ($pays as $pay) {
                $paysRecieve += $pay->amount;
            }   

        return [
            'pays' => $paysRecieve,
            'subscriptions' => $subscriptions,
        ];

    }
    private function paysPeding() {
        return  Pay::where('status', '1' )->count();
    }
}
