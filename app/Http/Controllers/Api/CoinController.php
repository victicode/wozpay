<?php

namespace App\Http\Controllers\Api;

use App\Models\Coin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoinController extends Controller
{
    //
    public function index(){
        $coins = Coin::where('status', 1)->get();
        return $this->returnSuccess(200, $coins);
    }
    public function getCoinById($id){
        $coin = Coin::find($id);
        return $this->returnSuccess(200, $coin);
    }
    public function updateCoin(Request $request, $id){
        
    }
}
