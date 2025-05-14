<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'status', 'quantity', 'unit', 'price', 'categorie_id'];

    public function categorie(){
        return $this->belongsTo(Categorie::class, 'categorie_id', 'id');
    }
}
