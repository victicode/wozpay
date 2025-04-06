<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PayLink extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pay_links';
    protected $fillable = [
        'link_id', 
        'amount', 
        'coin_id',
        'method', 
        'type', 
        'status', 
        'concept', 
        'operation_id', 
        'bank', 
        'pay_date',
        'vaucher',
        'card',
        'card_name',
        'cvc',
        'due_date',
        'email'
    ];
    protected $appends  =   ['status_label','transaction'];

    public function getstatusLabelAttribute()
    {   
        $status = [
            'Rechazada',
            'Pendiente de aprobación',
            'Aprobada',
        ];
        return $status[$this->status];
    }
    public function getTransactionAttribute(){
        
        return 10;
        
    }
    public function links(){
        return $this->belongsTo(Link::class,'link_id', 'id');
    }
}