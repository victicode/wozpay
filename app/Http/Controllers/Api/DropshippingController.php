<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\DropshippingLink;
use App\Models\DropshippingPay;
use App\Models\PayAdd;
use App\Models\Pay;
use App\Models\Product;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
class DropshippingController extends Controller
{
    //
    public function getStadisticAndProfitByUser(Request $request, $user){


        return $this->returnSuccess(200, [...$this->getStadistics($user)]);
    }
    public function payActivate(Request $request){

        $vaucher = ''; 
        if ($request->vaucher) {
            $vaucher = '/public/images/vaucher/dropshipping_activate_'.rand(1000000, 9999999).'_'. trim(str_replace(' ', '_', $request->loan_id )) .'.'. $request->File('vaucher')->extension();
            $request->file('vaucher')->move(public_path() . '/images/vaucher/', $vaucher);
        }  
       
        try {
            $pay = Pay::create([
                'user_id'       =>  $request->user()->id,
                'loan_id'       =>  null,
                'package_id'    =>  null,
                'amount'        =>  $request->amount,
                'operation_id'  =>  $request->operation_id ?? rand(1000000, 9999999),
                'quota_id'      =>  null,
                'bank'          =>  null,
                'method'        =>  $request->method,
                'pay_date'      =>  null,
                'vaucher'       =>  $vaucher,
                'type'          =>  $request->type,
                'status'        =>  $request->status,
                'concept'       =>  'Pago de activación Woz Dropshipping',
            ]);
        } catch (Exception $th) {
            return $this->returnFail(400, $th->getMessage());
        }
        
        $this->sendNotification(
        'Tu pago para la activación de tu cuenta de dropshipping fue realizado con exito, nuestro equipo se encuentra validando que cumpla con las medidas de seguridad', $pay->user_id, 
        'Pago pendiente de verificación dropshipping', 1);
    

        $this->sendMail(
            $pay->load('user'),
            'emails.newPayDropshippingActivateAdmin',
            'Pago de activación de cuenta dropshipping #'.$pay->operation_id
        );
        return $this->returnSuccess(200, $pay);
    }
    private function getStadistics($user){
         $links = DropshippingLink::where("user_id", $user)->where('pay_status', 3)->with('pay')->get();
         $totalSell = 0;
         $amountClient = 0;
         $totalPay = count($links);


         foreach ($links as $key) {
            $totalSell      += $key->amount;
            $amountClient   += $key->amount_to_client;
         }
        

         return [
            'links' => $links,
            'totalPay' => $totalPay,
            'totalSell' => $totalSell,
            'totalEarnings' => $amountClient,
            'totalProductsSell'=> $this->getTotalProductsSell($user),
            'volumenForMonth' => $this->getVolumenForMonth($user),
            'payAddsAmount' => $this->getPayAddsAmount($user),
            'withdrawal' => $this->getAllWithdrawal($user),
         ];
    }
    private function getVolumenForMonth($user){
        $result = ''; 
        $amount = 0;
        
        $categories = DropshippingLink::get()->where("user_id", $user)->where('pay_status', 3)->groupBy(function($item,$key) {
            return Carbon::parse($item->created_at)->format('Y-m');
        })
        ->sortBy(function($item, $key){    
            return "01".$key;
        });


        $count = 1;
        foreach ($categories as $key) {
            foreach ($key as $value){
                $amount +=$value->amount;
                
            }

            $result .=$amount.(count($categories) == $count ?"":",");
            $amount = 0;
            $count++;
        }

        return $result;
    }
    private function getPayAddsAmount($user){
        $payAdds = PayAdd::where("user_id", $user)->where('status', 3)->get();
        $total = 0;

        if(!$payAdds) return 0;

        foreach ($payAdds as $key) {
            $total += $key->amount;
        }
        return $total;
    }
    private function getTotalProductsSell($user){
        return Product::whereHas('links', function (Builder $query) use ($user) {
            $query->where('user_id', $user);
        })->count();
    }
    private function getAllWithdrawal($user){
        $withdrawal = Withdrawal::where('user_id', $user)->where('status',2)->get();
        $totalWithdrawal = 0;

        foreach ($withdrawal as $key) {
            $totalWithdrawal += $key->amount;
        }

        return $totalWithdrawal;

    }
    private function sendNotification($message, $user, $subject, $type){
        $notification = new NotificationController;
        $requestNotification = new Request([
            'text'      => $message,
            'subject'   => $subject,
            'user'   => $user,
            'sender' => 'Woz Pay informa',
            'type' => $type,
        ]);
        try {
            $notification->storeNotification($requestNotification);
        } catch (Exception $th) {
            //throw $th;
        }
    }
    public function sendMail($pay, $template, $subject){
        $reciver = $template == 'emails.newPayDropshippingActivateAdmin' ? 'frovic.ve@gmail.com' : $pay->user->email;
        try{
            Mail::send($template, ["pay"=>$pay], function ($message) use ($reciver, $subject)  {  
                $message->from("noreply@wozpayment.com", "Woz Payments");
                $message->to($reciver)->subject($subject);
 
            });
        }
        catch(Exception $e){
            return  $e->getMessage();
        }
        return "bien";
    }
    public function getDropPayByUser(Request $request, $id){
        $pays = DropshippingPay::with('link.productsInLink', 'link.user')->whereHas('link', function (Builder $query) use ($id) {
            $query->where('user_id', $id);
        })->get()
        ->where('status', $request->status);


        return $this->returnSuccess(200, $pays);
    }
}
