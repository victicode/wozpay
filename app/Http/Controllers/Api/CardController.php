<?php

namespace App\Http\Controllers\Api;

use App\Events\CardUpdateEvent;
use App\Http\Controllers\Controller;
use App\Models\Card;
use Exception;
use Illuminate\Http\Request;

class CardController extends Controller
{
    //
    public function getLinkCard($id) {

        $card = Card::query()->where('user_id', $id)->first();

        return $this->returnSuccess(200, $card);

    }
    public function linkCard(Request $request) {
        try {
            $card = Card::create([
                'number'     => $request->card,
                'due_date'   => $request->due_date,
                'owner_name' => $request->user()->name,
                'cvc'        => $request->cvc,
                'type'       => $request->type['value'],
                'status'     => 1,
                'user_id'    => $request->user()->id,
            ]);
        } catch (Exception $th) {
            //throw $th;
            return $this->returnFail(505, $th->getMessage());
        }
        
        return $this->returnSuccess(200, $card);
    }
    public function deleteCard($id) {
        $card = Card::find($id);

        if(!$card) return $this->returnFail(404, 'No se encontro la tarjeta');

        $card->delete();

        return $this->returnSuccess(200, $card);
    }
    public function changeStatus($id, Request $request) {
        $card = Card::find($id);
        if(!$card) return $this->returnFail(404, 'No se encontro la tarjeta');
        $card->status = $request->status;
        $card->save();

        $this->cardAction($card);
        event(new CardUpdateEvent($card->user_id));

        return $this->returnSuccess(200, $card);
    }
    private function cardAction($card){
        if($card->status == 0){
            $this->sendNotification('Tu tarjeta fue rechazada, por que no cumple con las medidas de seguridad de Woz Pay', $card->user_id, 'Tarjeta Rechazada', 3);
            return;
        }
        $this->sendNotification('Tu tarjeta fue vinculada con exito!', $card->user_id, 'Tarjeta vinculada <i class="q-icon eva eva-checkmark-circle-2-outline chekicon" aria-hidden="true" role="img"> </i>', 1);
        return;
    }
    private function sendNotification($message, $user, $subject, $type){
        $notification = new NotificationController;
        $requestNotification = new Request([
            'text'      => $message,
            'subject'   => $subject,
            'user'   => $user,
            'sender' => 'Woz Pay informa',
            'type' => $type,
        ]);
        $notification->storeNotification($requestNotification);
    }
}
