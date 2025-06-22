<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DropshippingLink;
use Illuminate\Http\Request;

class DropshippingController extends Controller
{
    //
    public function getStadisticAndProfitByUser(Request $request, $user){


        return $this->returnSuccess(200, [...$this->getStadistics($user)]);
    }
    private function getStadistics($user){
         $links = DropshippingLink::where("user_id", $user)->where('pay_status', 3)->with('pay')->get();
         $totalSell = 0;
         $totalPay = count($links);


         foreach ($links as $key) {
            $totalSell += $key->amount;
         }

         return [
            'links' => $links,
            'totalPay' => $totalPay,
            'totalSell' => $totalSell
         ];
    }
}
