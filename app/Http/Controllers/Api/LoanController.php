<?php

namespace App\Http\Controllers\Api;

use App\Models\Loan;
use App\Models\Wallet;
use App\Models\RedTape;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoanController extends Controller
{
    //
    public function getActiveLoan($id) {
        $loan = Loan::query()->withCount('pays')->where('user_id', $id)->with('redTapes.user', 'pays')->first();

        return $this->returnSuccess(200, $loan);

    }
    public function storeLoan(Request $request) {

        $loan = Loan::create([
            'due_date' => '2024-08-20',
            'type' => 1,
            'amount' => $request->amount,
            'amount_to_pay' => $request->amountToPay,
            'quotas' => 2,
            'status' => 1,
            'loan_number' => '619'+ rand(100000, 999999),
            'interest' => 70,
            'interest_for_delay' => 10,
            'user_id' => $request->user()->id,
        ]);

       $redTape =  $this->storeRedTapes($request, $loan->id);

    //    $requestWallet = new Request([
    //         'user_id'   => $request->user()->id,
    //         'type'      => 2,
    //         'dni'       => $request->user()->dni,
    //         'balance'   => $request->amount,
    //     ]);
    //     $this->storeWallet($requestWallet);

        return $this->returnSuccess(200, ['redTapes' => $redTape, 'loan' => $loan]);
    }
    private function storeRedTapes($request, $loanId) {
        $informconf = '-';
        $workCertificate = '-';
        $lastIps = '-';
        $vaucher = ''; 
        
        if ($request->informconf) {
            $informconf = 'public/images/informconf/'.rand(1000000, 9999999).'_'.$loanId.'_'. $request->user()->id .'.'. $request->File('informconf')->extension();
            $request->file('informconf')->move(public_path() . '/images/informconf/', $informconf);
        }
        if ($request->work) {
            $workCertificate = 'public/images/work_certificate/'.rand(1000000, 9999999).'_'.$loanId.'_'. $request->user()->id .'.'. $request->File('work')->extension();
            $request->file('work')->move(public_path() . '/images/workCertificate/', $workCertificate);
        }
        if ($request->last_ips) {
            $lastIps = 'public/images/last_ips/'.rand(1000000, 9999999).'_'.$loanId.'_'. $request->user()->id .'.'. $request->File('last_ips')->extension();
            $request->file('last_ips')->move(public_path() . '/images/last_ips/', $lastIps);
        }
        
        $redTape = RedTape::create([
            'business' => $request->business,
            'business_address' => $request->business_address,
            'business_phone' => $request->business_phone,
            'ips' => $request->ips ? 1 : 0 ,
            'boss_name' => $request->boss_name,
            'boss_phone' => $request->boss_phone,
            'reference_name' => $request->reference_name,
            'reference_phone' => $request->reference_phone,
            'reference_relationship' => $request->reference_relationship,
            'informconf' => $informconf,
            'work_certificate' => $workCertificate,
            'last_ips' => $lastIps,
            'loan_id' => $loanId,
            'user_id' => $request->user()->id,
        ]);

        return $redTape;
    }
    private function storeWallet(Request $request,){

        $wallet = Wallet::create([
            'number'    => '916' + $request->dni,
            'balance'   => floatval($request->balance),
            'type'      => $request->type,
            'status'    => 1,
            'user_id'   => $request->user_id,
        ]);

        return $wallet;
    }

}
