<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'id',
        'url', 
        'short', 
        'code', 
        'title',
        'note', 
        'amount', 
        'status', 
        'pay_status', 
        'isWatch', 
        'categorie',
        'type', 
        'user_id',
        'due_time',
    ];
    protected $appends  =   ['status_label', 'pay_status_label', 'type_label'];

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
    public function getTypeLabelAttribute()
    {   
        $status = [
            '',
            '',
            'Membresía',
            'Freelancer',
            'Ventas',
        ];
        return $status[$this->type];
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }
    public function pay(){
        return $this->hasOne(PayLink::class,'link_id', 'id')->where('status', '!=', '0');
    }
}
