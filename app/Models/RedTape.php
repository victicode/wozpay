<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RedTape extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'red_tapes';
    protected $fillable = [
        'ips',
        'boss_name',
        'boss_phone',
        'references_name',
        'references_phone',
        'references_relationshp',
        'informconf',
        'work_certificate',
        'last_ips',
        'loan_id',
        'user_id',
    ];
}
