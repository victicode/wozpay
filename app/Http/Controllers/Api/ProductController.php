<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //
    public function getAllProductsByCategory($category) {
        $product = Product::where('categorie_id', $category)->paginate(2);

        if(!$product){
            return $this->returnFail(400, 'Category not found');
        }
        return $this->returnSuccess(200, $product);
    }
    public function getProductById($id) {
        $product = Product::find($id);

        if(!$product){
            return $this->returnFail(400, 'Product not found');
        }
        return $this->returnSuccess(200, $product);
    }
}
