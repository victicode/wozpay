<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'loan_number', 
        'user_id', 
        'due_date',
        'days', 
        'type', 
        'amount', 
        'amount_to_pay', 
        'quotas', 
        'amount_quota',
        'interest', 
        'interest_for_delay'
    ];
    protected $appends = ['days_due'];
    
    public function getDaysDueAttribute()
    {   $daysDue = 0;
        try {
            if($this->status == 4 ){
                $daysDue = (strtotime(date('Y-m-d')) - strtotime($this->due_date))/86400;
            }
        } catch ( Exception $r) {
            $daysDue = $r->getMessage();
        }
        return $daysDue;
    }
    public function redTapes(){
        return $this->belongsTo(RedTape::class,'red_tapes_id', 'id');
    }
    public function pays(){
        return $this->hasMany(Pay::class,'loan_id', 'id');
    }
    public function paysSuccess(){
        return $this->hasMany(Pay::class,'loan_id', 'id')->where('status','2');
    }
    public function countPays(){
        return $this->hasMany(Pay::class,'loan_id', 'id')->where('status', '!=','0');
    }
    public function quotas_desc(){
        return $this->hasMany(Quota::class,'loan_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
