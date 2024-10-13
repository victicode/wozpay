<?php

namespace App\Http\Controllers\Api;

use App\Models\Loan;
use App\Models\User;
use App\Models\Wallet;
use App\Models\RedTape;
use App\Models\Interest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Quota;
use Exception;

class LoanController extends Controller
{
    //
    public function getActiveLoan($id) {
        $loan = Loan::query()->withCount('pays')->where('user_id', $id)->with('redTapes.user', 'pays', 'quotas_desc.successPays')
        ->orderBy('created_at', 'desc')->first();

        return $this->returnSuccess(200, $loan);
    }
    public function storeLoan(Request $request) {
        $loan = Loan::create([
            'days' => $request->due_date,
            'type' => 1,
            'amount' => $request->amount,
            'days' => $request->due_date,
            'amount_to_pay' => $request->amountToPay,
            'quotas' => $this->getQuaotasByDay($request->due_date) ,
            'amount_quota' => $request->amountToPay/$this->getQuaotasByDay($request->due_date),
            'status' => 1,
            'loan_number' => '619'+ rand(100000, 999999),
            'interest' => $this->getInterestPerDay($request->due_date, 1),
            'interest_for_delay' => $this->getInterestPerDay($request->due_date, 2),
            'user_id' => $request->user()->id,
        ]);

        $redTape =  $this->storeRedTapes($request, $loan->id);
        
        $this->emitNotification('Tu solicititud de prestamo fue creada con exito', $loan->user_id, 'Prestamo solicitado');
        
        return $this->returnSuccess(200, ['redTapes' => $redTape, 'loan' => $loan]);
    }
    public function getLoanById($id) {
        $loan = Loan::query()->withCount('pays')->with('redTapes', 'user.card', 'pays','quotas_desc.successPays.user.card', )->find($id);

        return $this->returnSuccess(200, $loan);
    }
    public function changeStatus($loanId, Request $request) {
        $loan = Loan::with('redTapes', 'user.card')->find($loanId);
        if(!$loan) return $this->returnFail(400, 'Prestamo no encontrado');

        $loan->status = $request->status;
        $loan->due_date = $request->status == 2 ? $this->dueDateQuotas($loan)[0]: $loan->due_date;
        $loan->save();
        $this->actionByStatusLoan($loan);
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
    public function getInterestPerDay($days, $type) {

        $interest = Interest::where('days', $days)->where('type', $type)->first();

        return $interest->interest;
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
    private function getQuaotasByDay($days) {
        $quoatas = [
            15 => 1,
            30 => 1,
            60 => 2,
            90 => 3,
        ];
        return $quoatas[$days];
    }
    private function firstLoanDone($userId) {
        $user = User::find($userId);
        $user->is_first_loan = 0;
        $user->save();
        return $user;
    }
    private function actionByStatusLoan($loan) {
        if($loan->status == 2) $this->approveLoan($loan);
        if($loan->status == 0) $this->rejectLoan($loan);
    }
    private function approveLoan($loan){
        $this->firstLoanDone($loan->user_id);
        $this->plusWallet($loan->user_id, $loan->amount);
        $this->createQuatas($loan);
        $this->emitNotification('Tu solicititud del prestamo #'.$loan->loan_number.' fue aprobada', $loan->user_id, 'Prestamo aprobado');

    } 
    private function rejectLoan($loan){

        $this->emitNotification('Tu solicititud del prestamo #'.$loan->loan_number.' fue rechazado', $loan->user_id, 'Prestamo rechazado');

    } 
    private function emitNotification($message, $user, $subject){
        $notification = new NotificationController;
        $requestNotification = new Request([
            'text'      => $message,
            'user'   => $user,
            'subject' => $subject,
            'sender' => 'Woz Pay informa',
        ]);
        try {
            $notification->storeNotification($requestNotification);
        } catch (Exception $th) {
            //throw $th;
        }
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
    private function plusWallet($user, $amount){
        $wallet = Wallet::where('user_id', $user)->first();
        
        if(!$wallet) return $this->returnFail(404, 'Wallet no encontrada');

        $wallet->balance +=  $amount;
        $wallet->save();
    }
    
    private function createQuatas($loan){
        for ($i=0; $i < $loan->quotas; $i++) { 
            # code...
            Quota::create([
                'loan_id'   => $loan->id,
                'amount'    => ($loan->amount_to_pay/$loan->quotas),
                'due_date'  => $this->dueDateQuotas($loan)[$i],
            ]);
        }
        
    }
    private function dueDateQuotas($loan){
        $daysOfPayQouta = [];
        $days = $loan->days/$loan->quotas;
        $day = $days;

        for ($i=0; $i < $loan->quotas; $i++) { 
          array_push($daysOfPayQouta, date(('Y-m-d'), strtotime(date('Y-m-d')) + ($day  * 86400))) ; 
          $day += $days;
        }
        return $daysOfPayQouta; 
    }

}
