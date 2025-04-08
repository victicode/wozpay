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
        $coin = Coin::find($id);
        $coin->name = $request->name;
        $coin->code = $request->code;
        $coin->rate = $request->rate;
        $coin->save();
        return $this->returnSuccess(200, $coin);
    }
    public function deleteCoin($id){
        $coin = Coin::find($id);
        if(!$coin) return $this->returnFail(403, 'No existe esta moneda');  
        $coin->delete();
        return $this->returnSuccess(200, $coin);
    }
}
