<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    /**
     * Paso 1: Crear un SetupIntent
     * Esto le dice a Stripe: "Este usuario quiere registrar una tarjeta"
     */
    public function createSetupIntent(Request $request)
    {
       



        try {
            $user = $request->user();
            $user->createOrGetStripeCustomer();
            $intent = $user->createSetupIntent([
                'payment_method_types' => ['card'],
            ]);
            
        } catch (\Stripe\Exception\InvalidRequestException $e) {
  
            if ($e->getStripeCode() === 'resource_missing') {
                $user->stripe_id = null;
                $user->save();
                $user = $request->user();
                $user->createOrGetStripeCustomer();
                $intent = $user->createSetupIntent([
                    'payment_method_types' => ['card'],
                ]);
                return $this->returnSuccess(200,
                    ['client_secret' => $intent->client_secret]
                );
            }
        }
        return $this->returnSuccess(200,
            ['client_secret' => $intent->client_secret]
        );
    }

    /**
     * Paso 2: Crear la suscripción
     */
    public function subscribe(Request $request)
    {
        $user = $request->user();
        $paymentMethod = $request->payment_method;
        $plan = $this->getPriceIdOfPlan($request->plan_code, $request->payment_type);
        

        try {
            $user->createOrGetStripeCustomer();
            
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->newSubscription($plan->name, $plan->price_id)
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
            $request->user()->charge($amount, $request->payment_method, [
                'currency' => 'pyg',
            ]);
            return $this->returnSuccess(200, '200');
        } catch (\Exception $e) {
            return $this->returnFail(500, $e->getMessage());
        }
    }

    private function getPriceIdOfPlan($planID, $planType)
    {
        $plan = Plan::where('code',$planID)->first(); 
        $plan->price_id = $planType == 1
         ? $plan->load('priceAnnualy')->priceAnnualy->price_id
         : $plan->load('priceMonthly')->priceMonthly->price_id;

        return $plan;
    }
}
