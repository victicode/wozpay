<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DropshippingLink extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = "dropshipping_links"; 
    protected $fillable = [
        "url", 
        "code", 
        "amount", 
        "amount_to_client", 
        "coin_id", 
        "rate_amount", 
        "status", 
        "pay_status", 
        "user_id" ,
        "product_id", 
        "due_date"
    ];
    protected $appends  =   ['status_label', 'pay_status_label',];

    public function getstatusLabelAttribute()
    {   
        $status = [
            'Rechazada',
            'Pendiente',
            'Aprobada',
        ];
        return $status[$this->status];
    }
    public function getpayStatusLabelAttribute()
    {   
        $status = [
            'Rechazada',
            'Pendiente',
            'Pendiente de aprob.',
            'Aprobada',
            'Pago rechazado'
        ];
        return $status[$this->pay_status];
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }
    public function pay(){
        return $this->hasOne(DropshippingPay::class,'dropshipping_link_id', 'id')->where('status', '!=', '0');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id', 'id')->where('status', '!=', '0');
    }
}
