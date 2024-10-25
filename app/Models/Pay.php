<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pay extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable =   ['user_id', 'loan_id', 'amount', 'operation_id','quota_id', 'bank', 'pay_date', 'vaucher', 'type', 'status', 'concept'];
    protected $appends  =   ['status_label', 'transaction'];
    
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
    public function getTransactionAttribute(){
        return intval($this->type);
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }
    public function loan(){
        return $this->belongsTo(Loan::class,'loan_id', 'id');
    }
}
