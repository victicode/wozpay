<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['number', 'balance', 'type', 'status', 'user_id'];
    protected $appends = ['status_label'];

    public function getstatusLabelAttribute()
    {   
        $status = [
            'Rechazada',
            'Pendiente',
            'Aprobada',
        ];
        return $status[intval($this->status)];
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }
    public function transferSend(){
        return $this->hasMany(Transfer::class, 'from_id', 'id')->where('status', '2')->orderBy('created_at', 'desc');
    }
    public function transferRecept(){
        return $this->hasMany(Transfer::class, 'to_id', 'id')->where('status', '2')->orderBy('created_at', 'desc');
    }
}
