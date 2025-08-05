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
            return $this->returnFail(400, 'Product not found');
        }
        return $this->returnSuccess(200, $product);
    }
    public function getAllProducts(Request $request) {
        $products = Product::with('categorie')->paginate(10);

        if(!$products){
            return $this->returnFail(400, 'Products not found');
        }
        return $this->returnSuccess(200, $products);
    }
    public function getProductById($id) {
        $product = Product::find($id);

        if(!$product){
            return $this->returnFail(400, 'Product not found');
        }
        return $this->returnSuccess(200, $product);
    }
    public function getSimilarProduct(Request $request){
        $category = Product::where('categorie_id', $request->category)->get();
        $search = Product::where('title','like', '%'.$request->title.'%')->get();
        $metadata = $this->getMetaDataByName($request->title);
        // if(!$product){
        //     return $this->returnFail(400, 'Category not found');
        // }
        return $this->returnSuccess(200, [
            'category' => $category,
            'search'   => $search,
            'metadata' => $metadata,
        ]);

    }
    private function getMetaDataByName($title){
        $splitName = explode(" ", $title);
        return $splitName;
    }
}
