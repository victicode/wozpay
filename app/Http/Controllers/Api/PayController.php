<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PayController extends Controller
{
    //
    public function payRequest(Request $request) {
        $data = [
            "amount" => $request->amount,
            "description" => "cuotatest",
            "periodicity" => 1,
            "debit_day" => $request->debitDay,
            "unlimited" => true
        ];
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Basic YXBwcy91Q2dwaFFRMXNRUFk4dlFoRHZwc1V5R09BQU1MTTBiVDp5KW80UHJqLnpjV1VERmUuNHE2MDUrWVNMR3JCc2ozWk1lQXJPbnhl',
                'Content-Type' => 'application/json'
            ])->post('https://comercios.bancard.com.py:8888/external-commerce/api/0.1/commerces/321473/branches/1/links/generate-subscription-link', $data);
        } catch (Exception $th) {
            //throw $th;
            return $this->returnFail(400, $th->getMessage());
        }
        
        return $this->returnSuccess(200, $response->object()->subscription_link);
    }
}
