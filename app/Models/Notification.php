<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table ='notifications';
    protected $fillable = [
        'text',
        'subject',
        'read',
        'type',
        'user_id',
        'sender_id'
    ];
}
