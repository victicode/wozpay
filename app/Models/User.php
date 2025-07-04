<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'dni',
        'password',
        'rol_id',
        'verify_status',
        'facial_verify',
        'is_first_loan',
        'viewBank',
        'viewTransfer',
        'viewRekutu',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function redTape(){
        return $this->hasMany(RedTape::class)->orderBy('created_at', 'desc');
    }
    public function loans(){
        return $this->hasMany(Loan::class)->orderBy('created_at', 'desc');
    }
    public function loansComplete(){
        return $this->hasMany(Loan::class)->orderBy('created_at', 'desc')->where('status', '!=','1')->where('status', '!=','0');
    }
    public function currentLoan(){
        return $this->hasOne(Loan::class)->orderBy('created_at', 'desc');
    }
    public function loansDelay(){
        return $this->hasMany(Loan::class)->orderBy('created_at', 'desc')->where('status', '4');
    }
    public function pays(){
        return $this->hasMany(Pay::class)->orderBy('created_at', 'desc');
    }
    public function payAdds(){
        return $this->hasMany(PayAdd::class)->orderBy('created_at', 'desc');
    }
    public function successPays(){
        return $this->hasMany(Pay::class)->where('status', '2')->where('type', '!=' , 5)->where('type', '!=' , 6)->where('type', '!=' , 7)->orderBy('created_at', 'desc');
    }
    public function paysPending(){
        return $this->hasMany(Pay::class)->where('status', '1')->where('type', '3' )->orderBy('created_at', 'desc');
    }
    public function card(){
        return $this->hasOne(Card::class)->orderBy('created_at', 'desc')->where('status','!=', '0');
    }
    public function depositPending() {
        return $this->hasMany(Pay::class,'user_id', 'id')->where('type', '1' )->where('status', '1');
    }
    public function wallet(){
        return $this->hasOne(Wallet::class)->where('type', 1);
    }
    public function walletLink(){
        return $this->hasOne(Wallet::class)->where('type', 2);
    }
    // public function walletFound(){
    //     return $this->hasOne(Wallet::class)->where('type', 2);
    // }
    public function accountbank(){
        return $this->hasOne(AccountBank::class);
    }
    public function accountbanks(){
        return $this->hasMany(AccountBank::class);
    }
    public function links(){
        return $this->hasMany(Link::class)->orderBy('created_at', 'desc');
    }
    public function links_pay(){
        return $this->hasMany(Link::class)->where('pay_status',2)->orderBy('created_at', 'desc');
    }
    public function dropshippingAccount(){
        return $this->hasOne(DropshippingAccount::class, 'user_id');
    }

}   
