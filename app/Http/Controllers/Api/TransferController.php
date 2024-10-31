<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Wallet;
use App\Models\Transfer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Events\UserUpdateEvent;

class TransferController extends Controller
{
    //
    public function getTransferById($id) {
        $transfer = Transfer::with('user_to.user')->find($id);

        return $this->returnSuccess(200, $transfer);
    }
    public function createTransfer(Request $request) {
        $validated = $this->validateFieldsFromInput($request->all());

        if (count($validated) > 0) return $this->returnFail(400, $validated[0]);
        
        try {
            $transfer = Transfer::create([
                'from_id'       => $request->from,
                'to_id'         => $request->to,
                'amount'        => $request->amount,
                'type'          => $request->type,
                'pay_method'    => $request->pay_method,
                'concept'       => $request->concept,
                'reference'     => '00'.$request->pay_method.rand(10000, 99999),
                'status'        => $request->pay_method == 2 ? 2 : 1,

            ]);
            if($transfer->status == 2) $this->isApproveTransfer($transfer);
            else $this->waitTransfer($transfer);
        } catch (Exception $th) {
            return $this->returnSuccess(400, $th->getMessage());
        }
        
        return $this->returnSuccess(200, $transfer);
    }
    private function validateFieldsFromInput($inputs){
        $rules=[
            'from'          => ['required', 'integer'],
            'to'            => ['required', 'integer'],
            'amount'        => ['required', 'integer'],
            'type'          => ['required', 'regex:/^[0-9 .]+$/i'],
            'pay_method'    => ['required', 'regex:/^[0-9 .]+$/i'],
            'concept'       => ['required', 'regex:/^[a-zA-Z-À-ÿ0-9 ()#.]+$/i'],
        ];
        $messages = [
            'from.required'         => 'El emisor es requerido.',
            'from.integer'          => 'Id de emisor no valido',
            'to.required'           => 'El destinatario es requerido.',
            'to.integer'            => 'Id de destinatario no valido',
            'amount.required'       => 'El monto es requerido.',
            'amount.integer'        => 'Monto no valido',
            'type.required'         => 'El tipo de transacción es requerido.',
            'type.integer'          => 'Transsación no valida',
            'pay_method.required'   => 'El metódo de pago es requerido.',
            'pay_method.integer'    => 'Metódo de pago no valido',
            'concept.required'      => 'El concepto es requerido.',
            'concept.integer'       => 'Concepto no valido',
        ];


         $validator = Validator::make($inputs, $rules, $messages)->errors();

        return $validator->all() ;

    }
    private function isApproveTransfer(Transfer $transfer){
        $walletPlus = Wallet::with('user')->find($transfer->to_id);
        $walletPlus->balance += $transfer->amount;
        $walletPlus->save();
        if($transfer->pay_method == 2){
            $walletMinus = Wallet::with('user')->find($transfer->from_id);
            $walletMinus->balance -= $transfer->amount;
            $walletMinus->save();
            try{
                event(new UserUpdateEvent($walletMinus->user->id));
            } catch (Exception $th) {
                //throw $th;
            }
        }
        $this->sendNotification(
            $this->messagesByStatus($transfer)[0], 
            $walletMinus->user->id, 
            $this->titleByStatus($transfer)[0],
            2
        );
        $this->sendNotification(
            $this->messagesByStatus($transfer)[1], 
            $walletPlus->user->id, 
            $this->titleByStatus($transfer)[1],
            2
        );
        try{
            event(new UserUpdateEvent($walletPlus->user->id));
        } catch (Exception $th) {
            //throw $th;
        }
    }
    private function rejectTransfer(Transfer $transfer) {
        $wallet = Wallet::with('user')->find($transfer->from_id);
        $wallet->balance += $transfer->amount;
        $wallet->save();
        $this->sendNotification(
            $this->messagesByStatus($transfer), 
            $wallet->user->id, 
            $this->titleByStatus($transfer),
            3
        );
    }

    private function waitTransfer(Transfer $transfer) {
        $wallet = Wallet::with('user')->find($transfer->from_id);
        $wallet->balance -= $transfer->amount;
        $wallet->save();
        $this->sendNotification(
            $this->messagesByStatus($transfer), 
            $wallet->user->id, 
            $this->titleByStatus($transfer),
            1
        );
    }

    private function sendNotification($message, $user, $subject, $type) {
        $notification = new NotificationController;
        $requestNotification = new Request([
            'text'      => $message,
            'subject'   => $subject,
            'user'   => $user,
            'sender' => 'Woz Pay informa',
            'type' => $type,
        ]);
        try {
            //code...
            $notification->storeNotification($requestNotification);
        } catch (Exception $th) {
            //throw $th;
        }
    }
    private function messagesByStatus(Transfer $transfer){
        if($transfer->status == 3){
            return 'Tu transferencia ha sido rechazada por falta de fondos/incumplimiento';
        }
        if($transfer->status == 1){
            return 'Tu transferencia ha sido creada y esta pendiente de aprobación';

        }
        if($transfer->status == 2){
            return[
                'Realizaste una transferencia de Gs.'.number_format($transfer->amount, 0, ',', '.').' con la referencia #'.$transfer->reference,
                'Recibiste una transferencia por Gs.'.number_format($transfer->amount, 0, ',', '.').' con la referencia #'.$transfer->reference,
            ];
        }
    }
    private function titleByStatus(Transfer $transfer){
        if($transfer->status == 3){
            return 'Transferencia rechazada';
        }
        if($transfer->status == 1){
            return 'Transferencia pendiente.';
        }
        if($transfer->status == 2){
            return[
                'Transferencia realizada con exito <i class="q-icon eva eva-checkmark-circle-2-outline chekicon" aria-hidden="true" role="img"> </i>',
                'Acabas de recibir una transferencia <i class="q-icon eva eva-checkmark-circle-2-outline chekicon" aria-hidden="true" role="img"> </i>',
            ];
        }
    }
}
