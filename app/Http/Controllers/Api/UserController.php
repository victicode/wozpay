<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Loan;
use App\Models\User;
use App\Models\Wallet;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Events\UserUpdateEvent;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request){
        try {
            $user = User::find($request->user()->id ?? 1);
        } catch (Exception $th) {
            $this->returnSuccess(400, $th->getMessage() );
        }
		return  $this->returnSuccess(200,  [ 'user' => $user ] );

    }
    public function allUsers(Request $request){
        $users = User::query()->where('rol_id', 3)->orderBy('created_at', 'DESC');
        if($request->type == 1){
            $users->where('verify_status', 2)->where('facial_verify', 2);
        }
        if($request->type == 2){
            $users->where('verify_status', 1)->orWhere('facial_verify', 1);
        }
        if($request->type == 3){
            $users->withTrashed()->where('deleted_at', '!=',null);
        }
        if($request->type == 4){
            $users->where('verify_status', 0)->orWhere('facial_verify', 0);
        }
        if($request->type == 5){
            $users->whereHas('card', function($q){
                $q->orderBy('created_at', 'desc');
            });
        }

        if(!empty($request->search)){
            $users->where('dni', 'like', '%'.$request->search.'%');
        }
		return  $this->returnSuccess(200,   $users->paginate(10));
    }
    public function usersWithActiveLoan(Request $request){
        $loanComplete = Loan::where('status','<>', '0')->count();
        $users = User::query()
            ->with(['loans'])
            ->withTrashed()
            ->where('rol_id', 3)
            ->whereHas('loans', function($q){
                $q->where('status', '1');
            });

        if(!empty($request->search)){
            $users->where('dni', 'like', '%'.$request->search.'%');
        }


		return  $this->returnSuccess(200,   ['users' => $users->paginate(10), 'loansComplete' => $loanComplete]);
    }
    public function cleanUser(Request $request){
        $users = User::query()
            ->with(['loansComplete'])
            ->withTrashed()
            ->where('rol_id', 3)
            ->whereHas('loansComplete')
            ->orderBy('created_at', 'DESC');

        if(!empty($request->search)){
            $users->where('dni', 'like', '%'.$request->search.'%');
        }
		return  $this->returnSuccess(200,   ['users' => $users->paginate(10)]);
    }
    public function slowPayerUser(Request $request){
        $users = User::query()
            ->with(['loans'])
            ->withTrashed()
            ->where('rol_id', 3)
            ->whereHas('loans', function($q){
                $q->where('status', '4');
            });

        if(!empty($request->search)){
            $users->where('dni', 'like', '%'.$request->search.'%');
        }
		return  $this->returnSuccess(200,   ['users' => $users->paginate(10)]);
    }
    public function paysPendingByUser(Request $request){
        $users = User::query()
            ->with(['paysPending'])
            ->withTrashed()
            ->where('rol_id', 3)
            ->whereHas('paysPending');
            

        if(!empty($request->search)){
            $users->where('dni', 'like', '%'.$request->search.'%');
        }
		return  $this->returnSuccess(200,   ['users' => $users->paginate(10)]);
    }
    public function getUsersBySearch(Request $request){
        $users = User::query()
            ->withTrashed()
            ->where('rol_id', 3);

        if(!empty($request->search)){
            $users->where('name', 'like', '%'.$request->search.'%');
        }
		return  $this->returnSuccess(200, $users->take(10)->get());
    }
    public function getUserById($userId){
        $user = User::with('card', 'redTape.loan', 'wallet', 'pays','accountbank.bank')->withTrashed()->find($userId);
 
         return $this->returnSuccess(200, $user);
    }
    public function getAlluserByRol(Request $request){
       $usersByRol = User::with('rol')->where('rol',$request->rol)->get();

        return $this->returnSuccess(200, $usersByRol);
    }
    public function store(Request $request){
        $validated = $this->validateFieldsFromInput($request->all());

        if (count($validated) > 0) return $this->returnFail(400, $validated[0]);
        
        try {
            $newUser = User::create([
                'name'          => $request->fullName,
                'email'         => $request->email,
                'dni'           => $request->dni,
                'password'      => bcrypt($request->password),
                'rol_id'        => 3,
                'is_first_loan' => 1,
                'facial_verify' => 0,
                'verify_status' => 0,

            ]);
        } catch (Exception $th) {
            return $this->returnSuccess(400, $th->getMessage());
        }

        $requestWallet = new Request([
            'user_id'   => $newUser->id,
            'user_dni'       => $newUser->dni,
            'type'      => 1,
        ]);
        $this->storeWallet($requestWallet);

        return $this->returnSuccess(200, $newUser);
    }
    public function updateUser(Request $request, $id){
        // $validated = $this->validateFieldsFromInput($request->all()) ;

        // if (count($validated) > 0) return $this->returnFail(400, $validated[0]);
       
        $user = User::find($id);
        if (!$user) return $this->returnFail(400, 'Usuario no encontrado');
        
        try {
            $user->phone    = $request->phone ?? $user->phone;
            $user->email    = $request->email ?? $user->email;
            $user->city     = $request->city ?? $user->city;
            $user->locality = $request->locality ?? $user->locality;
            $user->address  = $request->address ?? $user->address;
            $user->work     = $request->work ?? $user->work;
            $user->office   = $request->office ?? $user->office;
            $user->salary   = $request->salary ?? $user->salary;

            $user->save();
            
        } catch (Exception $th) {
            return $this->returnSuccess(400, $th->getMessage() );
        }

        return $this->returnSuccess(200, $user);
        

    }
    public function deleteUser($userId)
    {
        if (!$userId) {
            return $this->returnFail(400, "El ID del producto es requerido.");
        }

        $user = User::find($userId);

        if (!$user) {
            return $this->returnFail(404, "Producto no encontrada.");
        }

        $user->delete();


        return $this->returnSuccess(200, $user->load('card', 'redTape.loan', 'wallet', 'pays','accountbank.bank'));
    }
    public function restoreUser($userId)
    {
        if (!$userId) {
            return $this->returnFail(400, "El ID del producto es requerido.");
        }

        $user = User::withTrashed()->find($userId);
        // $dismantlingsOfProducts= Dismantling::where('piece_product_id', $userId)->delete();


        if (!$user) {
            return $this->returnFail(404, "Producto no encontrada.");
        }

        $user->restore();


        return $this->returnSuccess(200, $user->load('card', 'redTape.loan', 'wallet', 'pays','accountbank.bank'));
    }
    public function setStatus($userId, Request $request)
    {
        if (!$userId) {
            return $this->returnFail(400, "Usuario no encontrado.");
        }

        $user = User::find($userId);

        if (!$user) {
            return $this->returnFail(404, "Usuario no encontrado.");
        }

        $user->general_status = $request->status ??  $user->general_status;
        $user->isBlock = $request->block ??  $user->isBlock;
        $user->save();

        return $this->returnSuccess(200, $user->load('card', 'redTape.loan', 'wallet', 'pays','accountbank.bank'));
    }
    public function sendMobileVerifyCode(Request $request){

        try {
            
            $sid = config('twilio.sid');
            $token = config('twilio.token');
            $services = config('twilio.services');
            $twilio = new Client($sid, $token);
            $verification_check = $twilio->verify->v2
            ->services($services)
            ->verifications->create(
                '+58'.$request->phone,
                'sms'
            );
        } catch (Exception $th) {
            return $this->returnFail(400, $th->getMessage());
        }
        
        return $this->returnSuccess(200, $verification_check->status);
    }
    public function verifyPhoneNumber(Request $request){
        try {

            $sid = config('twilio.sid');
            $token = config('twilio.token');
            $services = config('twilio.services');
            $twilio = new Client($sid, $token);

            $verification_check = $twilio->verify->v2
            ->services($services)
            ->verificationChecks->create([
                'to' => '+58'.$request->phone,
                'code' => $request->code,
            ]);
        } catch (Exception $th) {
            return $this->returnFail(400, $th->getMessage());
        }
        
        return $this->returnSuccess(200, $verification_check->status);
    }
    public function setKyc(Request $request) {
        $user = User::find($request->user()->id);
        if (!$user) return $this->returnFail(400, 'Usuario no encontrado');

        $facial = null;
        $document_front = null;
        $document_back = null;

        
        if ($request->facial) {
            $facial = '/public/images/kyc/'.$request->user()->id.'/'.rand(1000000, 9999999).'_facial_.'. $request->File('facial')->extension();
            $request->file('facial')->move(public_path() . '/images/kyc/'.$request->user()->id.'/', $facial);
        }
        if ($request->document_front) {
            $document_front = '/public/images/kyc/'.$request->user()->id.'/'.rand(1000000, 9999999).'_document_front_.'. $request->File('document_front')->extension();
            $request->file('document_front')->move(public_path() . '/images/kyc/'.$request->user()->id.'/', $document_front);
        }
        if ($request->document_back) {
            $document_back = '/public/images/kyc/'.$request->user()->id.'/'.rand(1000000, 9999999).'_document_back_.'. $request->File('document_back')->extension();
            $request->file('document_back')->move(public_path() . '/images/kyc/'.$request->user()->id.'/', $document_back);
        }
        
        try {
            $user->facial_verify = $request->facial ? 1 : $user->facial_verify;
            $user->facial_photo = $facial ? $facial : $user->facial_photo ;
            $user->verify_status = $request->document_front && $request->document_back ?  1 : $user->verify_status;
            $user->document_photo_front = $document_front ? $document_front : $user->document_photo_front;
            $user->document_photo_back = $document_back ? $document_back : $user->document_photo_back;
            $user->save();
            
        } catch (Exception $th) {
            return $this->returnSuccess(400, $th->getMessage());
        }

        return $this->returnSuccess(200, $user->load('wallet'));
    }
    public function setNewVerifyStatus(Request $request) {
        $user = User::find($request->id);
        if (!$user) return $this->returnFail(400, 'Usuario no encontrado');

        try {
            $user->verify_status = $request->verify_status ?? $user->verify_status;
            $user->facial_verify = $request->facial_verify ?? $user->facial_verify;
            $user->save();
        } catch (Exception $th) {
            return $this->returnSuccess(400, $th->getMessage() );
        }

        if($request->verify_status  == 0 || $request->facial_verify == 0) $this->resendVerify($user);
        
       isset($request->verify_status) ? $this->documentAction($user) : $this->facialAction($user);
        try{
            event(new UserUpdateEvent($user->id));
        } catch (Exception $th) {
            //throw $th;
        }
        return $this->returnSuccess(200, $user);
    }
    private function validateFieldsFromInput($inputs){
        $rules=[
            'fullName'      => ['required', 'regex:/^[a-zA-Z-À-ÿ .]+$/i'],
            'dni'           => ['required', 'unique:users', 'regex:/^[0-9 .]+$/i'],
            // 'email'         => ['required', 'email',],
            'password'      => ['min:8'],
        ];
        $messages = [
            'fullName.required'     => 'El nombre es requerido.',
            'fullName.regex'        => 'Nombre no valido',
            'dni.required'          => 'El DNI es requerido.',
            'dni.regex'             => 'DNI no valido',
            'dni.unique'            => 'DNI ya se encuentra registrado',
            // 'email.required'        => 'El email es requerido.',
            // 'email.email'           => 'El Email no es valido',
            'password.required'     => 'La contraseña es requerida',
            'password.min'          => 'La contraseña debe tener un minimo de 8 caracteres'
        ];


         $validator = Validator::make($inputs, $rules, $messages)->errors();

        return $validator->all() ;

    }
    private function resendVerify($user){
        $user->facial_photo = $user->facial_verify == 0 ? null : $user->facial_photo ;
        $user->document_photo_front = $user->verify_status == 0 ? null : $user->document_photo_front;
        $user->document_photo_back = $user->verify_status == 0 ? null : $user->document_photo_back;
        $user->save();
    }
    private function storeWallet(Request $request){
        $wallet = Wallet::create([
            'number'    => '916' . $request->user_dni,
            'balance'   => 0,
            'type'      => $request->type,
            'status'    => 1,
            'user_id'   => $request->user_id,
        ]);

        return $wallet;
    }
    private function facialAction($user){
        if($user->facial_verify  == 0){
            $this->sendNotification(
                'Tu verificación facial fue rechazada, verifica que tu foto sea lo mas nititda posible y se pueda apreciar tu rostro', 
                $user->id, 
                'Datos faciales Rechazados', 
                3
            ); 
        }
        if($user->facial_verify  == 2){
            $this->sendNotification('Tu verificación facial ser realizó de forma exitosa!', $user->id, 'Datos faciales verificados <i class="q-icon eva eva-checkmark-circle-2-outline chekicon" aria-hidden="true" role="img"> </i>', 1);
        }

    }
    private function documentAction($user){
        if($user->verify_status  == 0){
            $this->sendNotification(
                'Tus documentos fueron rechazados, verifica que la foto que hayas subido sea legible tu documento y que el mismo no este vencido', 
                $user->id, 
                'Documentos Rechazados', 
                3
            ); 
        }
        if($user->verify_status  == 2){
            $this->sendNotification('Tu documentos han sido verificados de forma exitosa!', $user->id, 'Documentos verificados <i class="q-icon eva eva-checkmark-circle-2-outline chekicon" aria-hidden="true" role="img"> </i>', 1);
        }
    }
    private function sendNotification($message, $user, $subject, $type){
        $notification = new NotificationController;
        $requestNotification = new Request([
            'text'      => $message,
            'subject'   => $subject,
            'user'   => $user,
            'sender' => 'Woz Pay informa',
            'type' => $type,
        ]);
        try {
            //code...
            $notification->storeNotification($requestNotification);
        } catch (Exception $th) {
            //throw $th;
        }
    }

}
