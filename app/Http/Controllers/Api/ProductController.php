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
    public function storeProduct(Request $request){
        $product = Product::create([
            'title' => $request->title,
            'status' => 1,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'prie' => $request->price,
            'description' => $request->description,
            'actual_sell_volumen' => $request->sellActual,
            'sell_volumen_last_month' => $request->sellLastMonths,
            'logistic' => $request->logistic,
            'time_ship' => $request->timeShip,
            'pay_method' => $request->payMethod,
            'comision' => $request->comision,
            'views' => $request->view,
            'rating' => $request->rating,
            'reviews' => $request->reviews,
            'profit' => 0,
            'categorie_id' => $request->categorie
        ]);

        $photo = "";
        if ($request->file('photo')) {
            $photo = '/public/images/product/'.rand(1000000, 9999999).'_'. trim(str_replace(' ', '_', $product->id )) .'.'. $request->File('photo')->extension();
            $request->file('photo')->move(public_path() . '/images/product/', $photo);
        }  
        $product->image = $photo;
        $product->save();


        return $this->returnSuccess(200, $product);
    }
    private function getMetaDataByName($title){
        $splitName = explode(" ", $title);
        return $splitName;
    }
}
