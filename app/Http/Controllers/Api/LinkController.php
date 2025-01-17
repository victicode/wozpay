<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Models\PayLink;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource by Id.
     */
    public function getByUser($id)
    {
        //
        $links = Link::where('user_id', $id)->orderBy('id', 'desc')->take(5)->get();
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

    public function setPayStatus(Request $request)
    {
        //.3
        $pay = PayLink::find($request->payId);
        $link = Link::with('user', 'pay')->find($pay->link_id);

        $pay->status = $request->status;
        $link->pay_status = $request->status;
        
        if($link->pay_status == 2){
            $link->status = 2;
        }
        $pay->save();
        $link->save();

        return $this->returnSuccess(200, $link);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $code = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8);
        $link = Link::create([
            'url'      => config('app.url').'v1/pay/link/'.$code ,
            'short'    => '',
            'code'     => $code,
            'title'    => $request->title,
            'note'     => $request->note,
            'amount'   => $request->amount,
            'status'   => 1,
            'isWatch'  => 0,
            'type'     => $request->type,
            'user_id'  => $request->user()->id,
            'due_time' => date('Y-m-d H:i:s', time() + 7200)
        ]);
        return $this->returnSuccess(200, $link);
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
