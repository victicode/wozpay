<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\Models\AccountBank;
use Exception;
use Illuminate\Support\Facades\Validator;

class WithdrawalController extends Controller
{
    public function getAllByUser(Request $request)
    {
        try {
            $withdrawals = Withdrawal::with(['accountBank.bank'])
                ->where('user_id', $request->user()->id)
                ->orderBy('created_at', 'DESC')
                ->get();
        } catch (Exception $th) {
            return $this->returnFail(400, $th->getMessage());
        }
        return $this->returnSuccess(200, $withdrawals);
    }

    public function getById($id, Request $request)
    {
        try {
            $withdrawal = Withdrawal::with(['accountBank.bank'])
                ->where('id', $id)
                ->where('user_id', $request->user()->id)
                ->first();
            
            if (!$withdrawal) {
                return $this->returnFail(404, 'Retiro no encontrado');
            }
        } catch (Exception $th) {
            return $this->returnFail(400, $th->getMessage());
        }
        return $this->returnSuccess(200, $withdrawal);
    }

    public function store(Request $request)
    {
        $validated = $this->validateFieldsFromInput($request->all());
        if (count($validated) > 0) {
            return $this->returnFail(400, $validated[0]);
        }

        try {
            $withdrawal = Withdrawal::create([
                'amount'           => $request->amount,
                'type'             => $request->type,
                'status'           => 1,
                'method'           => 1,
                'comision_by_type' => $request->comision_by_type,
                'comision_fixed'   => $request->comision_fixed,
                'user_id'          => $request->user()->id,
                'account_bank_id'  => $request->account,

            ]);
        } catch (Exception $th) {
            return  $this->returnFail(500, $th->getMessage());
        }
        return $this->returnSuccess(200, 'Operation Successfully');
    }
    private function validateFieldsFromInput($inputs)
    {
        $rules = [
            'account'               => ['required', 'numeric'],
            'amount'                => ['required', 'numeric', 'regex:/^[0-9 .]+$/i'],
            'amount_to_transfer'    => ['required', 'numeric', 'regex:/^[0-9 .]+$/i'],
            'comision_by_type'      => ['required', 'numeric', 'regex:/^[0-9 .]+$/i'],
            'comision_fixed'        => ['required', 'numeric', 'regex:/^[0-9 .]+$/i'],
            'type'                  => ['required', 'integer'],

        ];
        $messages = [
            'account.required'            => 'Cuenta para retiro es requerida.',
            'account.numeric'             => 'Cuenta no valida.',
            'amount.required'             => 'El monto es requerido.',
            'amount.numeric'              => 'Monto no valido.',
            'amount.regex'                => 'Monto no valido.',
            'amount_to_transfer.required' => 'El monto es requerido.',
            'amount_to_transfer.numeric'  => 'Monto no valido.',
            'amount_to_transfer.regex'    => 'Monto no valido.',
            'comision_by_type.required'   => 'El comision es requerido.',
            'comision_by_type.numeric'    => 'Comision no valido.',
            'comision_by_type.regex'      => 'Comision no valido.',
            'comision_fixed.required'     => 'El comision es requerido.',
            'comision_fixed.numeric'      => 'Comision no valido.',
            'comision_fixed.regex'        => 'Comision no valido.',
            'type.required'               => 'Tipo de descuento es requerido',
            'type.integer'                => 'Tipo de descuento no valido'

        ];


         $validator = Validator::make($inputs, $rules, $messages)->errors();

        return $validator->all() ;
    }
}
