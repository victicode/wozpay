<?php

namespace App\Http\Controllers\Api;

use App\Models\Loan;
use App\Models\User;
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
            'due_date' => date(('Y-m-d'), strtotime(date('Y-m-d')) + ($request->due_date  * 86400)),
            'type' => 1,
            'amount' => $request->amount,
            'amount_to_pay' => $request->amountToPay,
            'quotas' => $request->user()->is_first_loan == 1 ? 1 : 4 ,
            'status' => 1,
            'loan_number' => '619'+ rand(100000, 999999),
            'interest' => 70,
            'interest_for_delay' => 10,
            'user_id' => $request->user()->id,
        ]);

        $redTape =  $this->storeRedTapes($request, $loan->id);
        // $this->firstLoanDone($loan->user_id);

        return $this->returnSuccess(200, ['redTapes' => $redTape, 'loan' => $loan]);
    }
    public function getLoanById($id) {
        $loan = Loan::query()->withCount('pays')->with('redTapes', 'user.card')->find($id);

        return $this->returnSuccess(200, $loan);
    }
    public function changeStatus($loanId, Request $request) {
        $loan = Loan::with('redTapes', 'user.card')->find($loanId);

        if(!$loan) return $this->returnFail(400, 'Prestamo no encontrado');

        $loan->status = $request->status;
        $loan->save();

        return $this->returnSuccess(200, $loan);
    }
    public function getApproveLoan(Request $request) {
        $users = User::query()
            ->with(['loans'])
            ->withTrashed()
            ->where('rol_id', 3)
            ->whereHas('loans', function($q){
                $q->where('status', '2');
            });

        if(!empty($request->search)){
            $users->where('dni', 'like', '%'.$request->search.'%');
        }
        return  $this->returnSuccess(200, $users->paginate(30));
        
    }
    private function storeRedTapes($request, $loanId) {
        $informconf = '-';
        $workCertificate = '-';
        $lastIps =  $this->lastIpsFormat($request, $loanId);
        
        if ($request->informconf) {
            $informconf = 'public/images/informconf/'.rand(1000000, 9999999).'_'.$loanId.'_'. $request->user()->id .'.'. $request->File('informconf')->extension();
            $request->file('informconf')->move(public_path() . '/images/informconf/', $informconf);
        }
        if ($request->work) {
            $workCertificate = 'public/images/work_certificate/'.rand(1000000, 9999999).'_'.$loanId.'_'. $request->user()->id .'.'. $request->File('work')->extension();
            $request->file('work')->move(public_path() . '/images/work_certificate/', $workCertificate);
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

        return [json_decode($request->last_ips, true), json_decode($request->work, true)];
    }
    private function firstLoanDone($userId) {
        $user = User::find($userId);
        $user->is_first_loan = 0;
        $user->save();
        return $user;
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
    private function lastIpsFormat ($request, $loan){
        $lastIps = [];
        for ($i=0; $i < $request->last_ips ; $i++) { 
            $ips = 'public/images/last_ips/'.rand(1000000, 9999999).'_'.$loan.'_'. $request->user()->id .'.'. $request->File('last_ips'.$i)->extension();
            $request->file('last_ips'.$i)->move(public_path() . '/images/last_ips/', $ips);
            array_push($lastIps , $ips);
        }
        return json_encode($lastIps);
    }

}
