<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AccountBank;
use App\Models\Bank;
use Exception;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getBanks()
    {
        try {
            //code...
            $banks = Bank::where('status', 1)->get();
        } catch (Exception $th) {
            return $this->returnFail(400, $th);
        }

       return $this->returnSuccess(200, $banks);
    }
    public function getAccountsBanksByUser($userId)
    {
        try {
            //code...
            $accountsBank = AccountBank::where('user_id', $userId)->get();
        } catch (Exception $th) {
            return $this->returnFail(400, $th);
        }

       return $this->returnSuccess(200, $accountsBank);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
