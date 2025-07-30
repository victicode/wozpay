<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsDropshippingLink extends Model
{
    use HasFactory;
    protected $table = "products_x_drop_links";
    protected $fillable = ["product_id", "dropshipping_link_id", "quantity", "dropper_price"]; 
}
