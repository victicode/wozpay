<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DropshippingAccount extends Model
{
    use HasFactory;
    protected $appends  =   ['status_label','type_label'];
    protected $table = "dropshipping_accounts"; 
    protected $fillable = [
        "facturation_cicle", 
        "status", 
        "due_date",
        "user_id"
    ];

    public function getStatusLabelAttribute()
    {   
        $status = [
            'Vencida',
            'Pendiente',
            'Activado',
        ];
        return $status[$this->facturation_cicle];
    }
    public function getTypeLabelAttribute()
    {   
        $status = [
            '',
            'Mensual',
            'Anual',
        ];
        return $status[$this->facturation_cicle];
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
