<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quota extends Model
{
    use HasFactory;
    protected $fillable = [
        'loan_id', 
        'amount', 
        'due_date', 
        'status'
    ];
    protected $appends = ['days_due'];
    
    public function getDaysDueAttribute()
    {   $daysDue = 0;
        try {

            $daysDue = (strtotime(date('Y-m-d')) - strtotime($this->due_date))/86400;
            
        } catch ( Exception $r) {
            $daysDue = $r->getMessage();
        }
        return $daysDue;
    }
    public function loan(){
        return $this->belongsTo(Loan::class,'loan_id', 'id');
    }
    public function allPays(){
        return $this->hasMany(Pay::class,'quota_id', 'id');
    }
    public function successPays(){
        return $this->hasOne(Pay::class,'quota_id', 'id')->where('status', '!=', '0');
    }
}
