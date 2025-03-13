<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Link;
use App\Models\Wallet;
use App\Models\PayLink;
use Illuminate\Http\Request;
use App\Events\UserUpdateEvent;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource by Id.
     */
    public function getByUserLast5($id)
    {
        //
        $links = Link::where('user_id', $id)->orderBy('id', 'desc')->take(5)->get();
        return $this->returnSuccess(200, $links);
    }
    public function getByUser($id)
    {
        //
        $links = Link::where('user_id', $id)->orderBy('id', 'desc')->get();
        return $this->returnSuccess(200, $links);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function getById($id)
    {
        //
        $link = Link::with('user', 'pay')->find($id);
        return $this->returnSuccess(200, $link);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        date_default_timezone_set('America/Asuncion');

        $code = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8);

        $link = Link::create([
            'url'           => config('app.url').'v1/pay/link/'.$code ,
            'code'          => $code,
            'title'         => $request->title,
            'note'          => $request->note,
            'amount'        => $request->amount,
            'status'        => 1,
            'pay_status'    => 1,
            'isWatch'       => 0,
            'categorie'     => intval($request->categorie),
            'type'          => $request->type,
            'user_id'       => $request->user()->id,
            'due_time'      => date('Y-m-d H:i:s', time() + 7200)
        ]);
        return $this->returnSuccess(200, $link);
    }

    public function getByCode($code){
        $link = Link::with('user', 'pay')->where('code', $code)->first();
        return $this->returnSuccess(200, $link);
    }
    public function setPayStatus(Request $request)
    {
        //.3
        $pay = PayLink::find($request->payId);
        $link = Link::with('user', 'pay')->find($pay->link_id);


        if($request->status == 3){
            $pay->status = 2;
            $link->pay_status = $request->status;
            $link->status = 2;
            $this->updateWallet($link);
            $this->sendNotification(
                'El pago del link #'.$link->code.' fue aprobado de forma exitosa', $link->user_id, 
                'Pago de link aprobado', 1);
        }
        
        if($request->status == 0){
            $pay->status = $request->status;
            $link->pay_status = 4;
            $link->status = 1;
            $this->sendNotification(
                'El pago realizado por el link #'.$link->code.' fue rechazado por que no cumple con nuestras normativas de seguridad ', $link->user_id, 'Pago de link rechazado', 3);
            
        }
        $pay->save();
        $link->save();
        event(new UserUpdateEvent($link->user_id));

        return $this->returnSuccess(200, $link);
    }
    private function updateWallet($link)
    {
        $wallet = Wallet::where('user_id', $link->user_id)->where('type', '2')->first();

        $wallet->balance += $link->amount_recive;

        $wallet->save();
    }
    // private function deductAmount($link)
    // {
    //     if($link->categorie != 0){
    //         $deduct1 = $link->amount *0.12;
    //         $deduct2 = 7800;
    //         return $link->amount - $deduct1 - $deduct2;
    //     }
    //     $deduct1 = $link->amount *0.02;
    //     return $link->amount - $deduct1;

    // }
    private function sendNotification($message, $user, $subject, $type)
    {
        $notification = new NotificationController;
        $requestNotification = new Request([
            'text'      => $message,
            'subject'   => $subject,
            'user'   => $user,
            'sender' => 'Woz Pay informa',
            'type' => $type,
        ]);
        try {
            $notification->storeNotification($requestNotification);
        } catch (Exception $th) {
            //throw $th;
        }
    }
}
