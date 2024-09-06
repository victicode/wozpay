<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Interest;
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
    public function updateInterestRate() {
        $interestRate  = Interest::where('type', 1)->get();
        $interestDelay = Interest::where('type', 2)->get();

        return $this->returnSuccess(200, [ 'interestRate' => $interestRate, 'interestDelay' => $interestDelay ]);
    }
}
