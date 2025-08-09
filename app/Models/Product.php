<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'status', 
        'quantity', 
        'unit', 
        'price', 
        'suggest_price',
        'description',
        'actual_sell_volumen',
        'sell_volumen_last_month',
        'logistic',
        'time_ship',
        'pay_method',
        'comision',
        'image',
        'views',
        'rating',
        'reviews',
        'profit',
        'categorie_id',
        'vendor_id'
    ];

    public function categorie(){
        return $this->belongsTo(Categorie::class, 'categorie_id', 'id');
    }
    public function links(){
        return $this->belongsToMany(DropshippingLink::class, 'products_x_drop_links', 'product_id')->withPivot('quantity','dropper_price')->where('status', 2);
    }
}
