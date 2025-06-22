<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DropshippingPay extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "dropshipping_pays"; 
    protected $fillable = [
        "amount", 
        "coin_id", 
        "rate_amount", 
        "status", 
        "dropshipping_link_id", 
        "method" ,
        "operation_id", 
        "bank", 
        "pay_date",
        "vaucher",
        "card",
        "card_name",
        "card_cvc",
        "card_due_date",
        "email"
    ];
    protected $appends  =   ['status_label'];

    public function getstatusLabelAttribute()
    {   
        $status = [
            'Rechazada',
            'Pendiente de aprobación',
            'Aprobada',
        ];
        return $status[$this->status];
    }
    public function links(){
        return $this->belongsTo(DropshippingLink::class,'link_id', 'id');
    }
    public function coin(){
        return $this->belongsTo(Coin::class,'coin_id', 'id');

    }
}
