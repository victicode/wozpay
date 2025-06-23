<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DropshippingLink;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
            'volumenForMonth' => $this->getVolumenForMonth($user)
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
    private function getTotalProductsSell($user){
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
}
