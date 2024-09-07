<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Interest;
use Exception;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    //
    public function storeInterestRate () {
        $interestRate = Interest::create([

        ]);
        
        return $this->returnSuccess(200, $interestRate);
    }
    public function getInterestRate() {
        $interestRate  = Interest::where('type', 1)->get();
        $interestDelay = Interest::where('type', 2)->get();

        return $this->returnSuccess(200, [ 'interestRate' => $interestRate, 'interestDelay' => $interestDelay ]);
    }
    public function updateInterestRate($type, Request $request) {
        try{
           Interest::where('type', $type)->delete();
        }catch(Exception $e){
        }
        $interestRates = json_decode($request->interest, true);
         
        foreach ($interestRates as $rate) {
            Interest::insert([
                'days'      => $rate['days'],
                'interest'  => $rate['interest'],
                'type'      => $type,
            ]);
        }
        $interestRates = Interest::where('type', $type)->get();
        return $this->returnSuccess(200, $interestRates);
    }
}
