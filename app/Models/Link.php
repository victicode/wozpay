<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use HasFactory, SoftDeletes;
    protected $appends  =   ['status_label'];

    public function getstatusLabelAttribute()
    {   
        $status = [
            'Rechazada',
            'Pendiente',
            'Aprobada',
        ];
        return $status[$this->status];
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
