<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code', 'rate', 'status'];
    public function links(){
        return $this->hasMany(Link::class)->orderBy('created_at', 'desc');
    }
    public function payLinks(){
        return $this->hasMany(PayLink::class)->orderBy('created_at', 'desc');
    }
}
