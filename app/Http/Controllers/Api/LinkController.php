<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Link;
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
        $link = Link::with('user')->find($id);
        return $this->returnSuccess(200, $link);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
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
