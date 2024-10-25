<?php

namespace App\Http\Controllers\Api;

use DateTime;
use App\Models\Pay;
use App\Models\User;
use App\Models\Transfer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    //
    public function getTrasactionByUser($UserId, Request $request) {

        $wallet = User::with('wallet')->find($UserId)->wallet->id;
        $pays =  Pay::where('user_id', $UserId)->orderBy('created_at', 'desc')->whereMonth('created_at', $request->month+1)->paginate(1);
        $transferSend = $this->tagTransfer(Transfer::with('user_to.user')->orderBy('created_at', 'desc')->whereMonth('created_at', $request->month+1)->where('from_id', $wallet)->paginate(1), 4);
        $transferRecept = $this->tagTransfer(Transfer::with('user_from.user')->orderBy('created_at', 'desc')->whereMonth('created_at', $request->month+1)->where('to_id', $wallet)->paginate(1),5);

        $all = [
            ...$pays, 
            ...$transferSend,
            ...$transferRecept,
        ];
        usort($all, $this->object_sorter('created_at', 'DESC'));

        return $this->returnSuccess(200, $all);
    }
     private function object_sorter($clave,$orden=null) {
        return function ($a, $b) use ($clave,$orden) {
              $result=  ($orden=="DESC") ? strnatcmp($b->$clave, $a->$clave) :  strnatcmp($a->$clave, $b->$clave);
              return $result;
        };
    }
    private function tagTransfer($transfer, $tag){
        foreach ($transfer as $key) {
            $key->transaction = $tag;
        }
        return $transfer;
    }
}
