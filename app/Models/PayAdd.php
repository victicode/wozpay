<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayAdd extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "pay_adds"; 
    protected $fillable = [
        'amount', 
        'type', 
        'status', 
        'concept', 
        'method', 
        'operation_id', 
        'bank', 
        'pay_date',
        'vaucher',
        'card',
        'card_name',
        'card_cvc',
        'card_due_date',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
