<?php

namespace App\Http\Controllers\Api;

use Exception;
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
        $newNotification = Notification::create([
            'text'      => $request->text,
            'user_id'   => $request->user,
            'sender_id' => $request->sender,
            'read'      => 0,
            'type'      => 1,
        ]);
        event(new NotificationsEvent($newNotification->user_id));
        return $this->returnSuccess(200, $newNotification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
