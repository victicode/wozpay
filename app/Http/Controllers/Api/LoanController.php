<?php

namespace App\Http\Controllers\Api;

use App\Models\Loan;
use App\Models\RedTape;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoanController extends Controller
{
    //
    public function storeLoan(Request $request) {

        $loan = Loan::create([
            'due_date' => '20/8/2024',
            'type' => 1,
            'amount' => $request->amount,
            'amount_to_pay' => $request->amountToPay,
            'quotas' => 2,
            'status' => 1,
            'user_id' => $request->user()->id,
        ]);

        $this->storeRedTapes($request, $loan->id);

    }
    private function storeRedTapes(Request $request, $loanId) {
        $informconf = '-';
        $workCertificate = '-';
        $lastIps = '-';

        $redTape = RedTape::create([
            'business' => $request->business,
            'business_address' => $request->business_address,
            'business_phone' => $request->business_phone,
            'ips' => $request->ips,
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

}
