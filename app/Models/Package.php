<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'note', 'amount', 'type', 'quantity', 'comision'];

    public function pays(){
        return $this->hasMany(Pay::class)->where('status', '2')->orderBy('created_at', 'desc');
    }
}
