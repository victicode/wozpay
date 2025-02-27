<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Events\NotificationsEvent;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAllByUser($id)
    {
        //
        try {
            $notifications = Notification::query()->where('user_id', $id)->orderBy('created_at', 'desc')->take(20)->get();
            $unreadCount = Notification::query()->where('user_id', $id)->where('read', 0)->count();
        } catch (Exception $th) {
            return $this->returnFail(400, $th->getMessage());
        }
        
        return $this->returnSuccess(200, [
            'notifications' => $notifications,
            'unreadCount' => $unreadCount, 
        ]);
    }
    public function seeAllByUser($id)
    {
        //
        try {
            $notifications = Notification::query()->where('user_id', $id)->update(['read' => 1]);
        } catch (Exception $th) {
            return $this->returnFail(400, $th->getMessage());
        }
        
        return $this->returnSuccess(200, $notifications);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeNotification(Request $request)
    {
       
        $newNotification = $request->user == -1
        ?   $this->sendToAllUser($request)
        :   $this->createNotification($request);

        return $this->returnSuccess(200, $newNotification);
    }

    /**
     * Display the specified resource.
     */
    private function sendToAllUser(Request $request)
    {
        $all = User::where('rol_id', '3')->where('general_status', '1')->where('isBlock', '0')->get();
        foreach($all as $item){
            $request->user = $item->id;
            $this->createNotification($request);
        }

        return $all ;
    }

    private function createNotification(Request $request){
        $newNotification = Notification::create([
            'text'      => $request->text,
            'user_id'   => $request->user,
            'sender_id' => $request->sender,
            'subject'   => $request->subject,
            'read'      => 0,
            'type'      => $request->type ?? 1,
        ]);
        event(new NotificationsEvent($newNotification->user_id));
        return $newNotification;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
