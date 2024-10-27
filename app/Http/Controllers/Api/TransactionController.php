<?php

namespace App\Http\Controllers\Api;

use DateTime;
use App\Models\Pay;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Transfer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Database\Eloquent\Builder;

class TransactionController extends Controller
{
    //
    public function getTrasactionByUser($UserId, Request $request) {
        $user =  User::with(['successPays' => function (Builder $query) use ($request) { 
            $query->whereMonth('created_at',$request->month+1);
        }, 'wallet'])->find($UserId);

        $wallet =  Wallet::with(['transferSend' => function (Builder $query) use ($request) { 
            $query->with('user_to.user')->whereMonth('created_at',$request->month+1);
        }])->find($user->wallet->id);

        $wallet2 =  Wallet::with(['transferRecept' => function (Builder $query) use ($request) { 
            $query->with('user_from.user')->whereMonth('created_at',$request->month+1);
        }] )->find($user->wallet->id);


        
        $all = [
            ...$user->successPays ?? [], 
            ...$this->tagTransfer($wallet2->transferRecept ?? [],4), 
            ...$this->tagTransfer($wallet->transferSend ?? [],5) ,
        ];
        

        usort($all, $this->object_sorter('created_at', 'DESC'));

        $allFormated = array_chunk($all, 6);


        return $this->returnSuccess(200,[ 
          'transactions' =>  $allFormated[$request->page - 1] ?? [],
          'countAllPages' =>  ceil(count($all)/6),
        ]);
    }
     private function object_sorter($clave,$orden=null) {
        return function ($a, $b) use ($clave,$orden) {
              $result=  ($orden=="DESC") ? strnatcmp($b->$clave, $a->$clave) :  strnatcmp($a->$clave, $b->$clave);
              return $result;
        };
    }
    private function tagTransfer($transfer, $tag){
        if(count($transfer) == 0) return [];
        
        foreach ($transfer as $key) {
            $key->transaction = $tag;
        }
        return $transfer;
    }

}
