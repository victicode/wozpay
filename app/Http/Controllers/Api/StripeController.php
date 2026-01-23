<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    /**
     * Paso 1: Crear un SetupIntent
     * Esto le dice a Stripe: "Este usuario quiere registrar una tarjeta"
     */
    public function createSetupIntent(Request $request)
    {
        return $this->returnSuccess(200,
            ['client_secret' => $request->user()->createSetupIntent()->client_secret]
        );
    }

    /**
     * Paso 2: Crear la suscripción
     */
    public function subscribe(Request $request)
    {
        $user = $request->user();
        $paymentMethod = $request->payment_method; // Viene del frontend
        $planId = $request->plan_id; // Ej: 'price_1PQ...'

        try {
            // Si el usuario no tiene ID de Stripe, Cashier lo crea automáticamente
            $user->createOrGetStripeCustomer();
            
            // Actualizamos el método de pago por defecto
            $user->updateDefaultPaymentMethod($paymentMethod);

            // Creamos la suscripción
            $user->newSubscription('default', $planId)
                ->create($paymentMethod);

            return $this->returnSuccess(200, 'Suscrito correctamente');
            
        } catch (\Exception $e) {
            return $this->returnFail(500, $e->getMessage());
        }
    }

    /**
     * Extra: Pago único (Sin suscripción)
     */
    public function singleCharge(Request $request)
    {
        $amount = 1000; // $10.00 (en centavos)
        try {
            $request->user()->charge($amount, $request->payment_method);
            return $this->returnSuccess(200, '200');
        } catch (\Exception $e) {
            return $this->returnFail(500, $e->getMessage());
        }
    }
}
