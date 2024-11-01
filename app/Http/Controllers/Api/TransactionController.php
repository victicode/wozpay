<?php

namespace App\Http\Controllers\Api;

use DateTime;
use App\Models\Pay;
use App\Models\Loan;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Database\Eloquent\Builder;

class TransactionController extends Controller
{
    //
    public function getTrasactionByUser($userId, Request $request) {
        $user =  User::with(['successPays' => function (Builder $query) use ($request) { 
            $query->whereMonth('created_at',$request->month+1);
        }, 'wallet'])->find($userId);

        $wallet =  Wallet::with(['transferSend' => function (Builder $query) use ($request) { 
            $query->with('user_to.user')->whereMonth('created_at',$request->month+1);
        }])->find($user->wallet->id);

        $wallet2 =  Wallet::with(['transferRecept' => function (Builder $query) use ($request) { 
            $query->with('user_from.user')->whereMonth('created_at',$request->month+1);
        }] )->find($user->wallet->id);

        $loans = Loan::where('status', '!=','1')
        ->where('status', '!=','0')
        ->whereMonth('created_at',$request->month+1)
        ->where('user_id', $userId)->get();
        
        $all = [
            ...$user->successPays ?? [], 
            ...$this->tagTransfer($wallet2->transferRecept ?? [],4), 
            ...$this->tagTransfer($wallet->transferSend ?? [],5) ,
            ...$this->tagTransfer($loans ?? [],6) ,
        ];
        
        usort($all, $this->object_sorter('created_at', 'DESC'));

        $allFormated = array_chunk($all, 6);
        
        return $this->returnSuccess(200,[ 
          'transactions' =>  $allFormated[$request->page - 1] ?? [],
          'countAllPages' =>  ceil(count($all)/6),
        ]);
    }
    public function getTrasactionByType($type, $id){
        return $this->returnSuccess(200,$this->trasactionByType($type, $id)) ;
    }
    public function printTransaction($type, $id)
    {
        $transaction = $this->trasactionByType($type, $id);
        $pdf = Pdf::loadView('recipeTemplate', [
            'transaction' =>  $this->formatRecipePrint($type, $transaction),
            'title' => $this->getTitleByType($type) ]);

         return $pdf->stream('Comprobante');

        
        return view('recipeTemplate', [
            'transaction' =>  $this->formatRecipePrint($type, $transaction),
            'title' => $this->getTitleByType($type) ]);

        // if(){

        //     $order = OutOrder::with('products', 'order.client')->where('id',$id)->first();
    
        //     if(!$order) return $this->returnFail(400, 'algo ha salido mal');
    
            
        // }
       
        // return $transaction;
        // return $order;
    }
    private function trasactionByType($type, $id){
        if($type == 1 ){
            return  Pay::with('user.card')->find($id);

        }
        if($type == 2 || $type == 3){
            return  Pay::with('loan', 'user.card')->find($id);
        }

        if($type == 4 || $type == 5 ){
            return  Transfer::with('user_from.user', 'user_to.user')->find($id);
        }
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
            if($tag==6){
                $key->amount = 215000;
            }
        }
        return $transfer;
    }
    private function getTitleByType($type){
        $types = [
            '',
            'Comprobante de carga de saldo',
            'Comprobante de pago con Tpago',
            'Comprobante de pago con transferencia bancaria',
            'Comprobante de transferencia interna recibida',
            'Comprobante de transferencia interna realizada',
            'Comprobante de descuento automático',
        ];

        return $types[$type];
    }
    private function formatRecipePrint($type, $transaction){
        $lines = [];

        $lines[0] = [

            'title' =>'Monto',
            'text' =>'Cantidad de dinero en Guaranies',
            'value' =>'Gs. '.number_format($transaction->amount, 0, ',', '.')
        ];

        
        if($type == 1) {

            $lines[1] = [
            'title' =>  'Carga de saldo',
            'text'  =>  'Titular Woz Pay',
            'value'   => $transaction->user->name,
            ];
            $lines[2] = [
            'title' =>  'Caja de ahorro N°',
            'text'  =>  'Documento de identificación',
            'value'   => '916-'.$transaction->user->dni,
            ];
            $lines[3] = [
            'title' =>  'Referencia',
            'text'  =>  'Referencia de transacción',
            'value'   => $transaction->operation_id,
            ];
        }

        if($type == 2 || $type == 3) {
            $lines[1] = [
            'title' =>  'Pago de prestamo',
            'text'  =>  $transaction->concept,
            ];
            $lines[2] = [
            'title' =>  'Tipo de pago',
            'text'  =>  $type == 3 ? 'Transeferencia' : 'Tarjeta mediante Tpago',
            ];
            $lines[3] = [
            'title' =>  'Referencia',
            'text'  =>  'Referencia de prestamo',
            'value'   => '619-'.$transaction->loan->loan_number,
            ];
        }

        if($type == 4 || $type == 5)  {
            $lines[1] = [
            'title' =>  $type == 4 ? 'Recibido de' : 'Enviado a',
            'text'  =>  'Titular Woz Pay',
            'value'   => $type == 4 ? $transaction->user_from->user->name : $transaction->user_to->user->name,

            ];
            $lines[2] = [
            'title' =>  'Documentación',
            'text'  =>  'Documento de identificación',
            'value'   => $type == 4 ? number_format($transaction->user_from->user->dni, 0, ',', '.') : number_format($transaction->user_to->user->dni, 0, ',', '.'),

            ];
            $lines[3] = [
            'title' =>  'Concepto',
            'text'  =>  'Motivo del envío',
            'value'   => $transaction->concept,
            ];
        }

        if($type == 6)  {
            $lines[1] = [
            'title' => 'Debito automatico',
            'text'  =>'Woz Payments',
            ];
            $lines[2] = [
            'title' => 'Tipo de debito',
            'text'  => $transaction->user->card->type ==  1 ? 'Debito tarjeta de crédito' : 'Debito tarjeta de débito',
            ];
            $lines[3] = [
            'title' => 'Referencia',
            'text'  =>'619 5556668745',
            ];
        }

        array_push($lines,[
            'date'  => date("d/m/Y", strtotime($transaction->created_at)),
            'hour'  => date(" H:i", strtotime($transaction->created_at)) .' hs',
        ]);

        return  $lines;
    
    }

}
