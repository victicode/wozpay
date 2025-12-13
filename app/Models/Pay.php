<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pay extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable =   ['user_id', 'loan_id', 'package_id', 'amount', 'amount_to_client', 'operation_id','quota_id', 'method', 'bank', 'pay_date', 'vaucher', 'type', 'status', 'concept'];
    public $appends  =   ['status_label', 'transaction'];
    
    public function getstatusLabelAttribute()
    {   
        $status = [
            'Rechazada',
            'Pendiente',
            'Aprobada',
            'Pagada',
            'No pagada',
        ];
        return $status[$this->status];
    }
    public function getTransactionAttribute()
    {
        if($this->type == 5) return 8;
        else if($this->type==6)return 9;
        else{

            return intval($this->type);
        }
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
    public function loan()
    {
        return $this->belongsTo(Loan::class,'loan_id', 'id');
    }
    public function package()
    {
        return $this->belongsTo(Package::class,'package_id', 'id');
    }
    
}
