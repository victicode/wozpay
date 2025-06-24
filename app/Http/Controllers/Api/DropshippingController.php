<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DropshippingLink;
use App\Models\PayAdd;
use App\Models\Product;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
class DropshippingController extends Controller
{
    //
    public function getStadisticAndProfitByUser(Request $request, $user){


        return $this->returnSuccess(200, [...$this->getStadistics($user)]);
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
}
