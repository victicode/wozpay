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
}
