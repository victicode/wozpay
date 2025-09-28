<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Vendor;

class ProductController extends Controller
{
    //
    public function getAllProductsByCategory($category) {
        $product = Product::with(['vendor'])->where('categorie_id', $category)->paginate(2);

        if(!$product){
            return $this->returnFail(400, 'Product not found');
        }
        return $this->returnSuccess(200, $product);
    }
    public function getAllProductsBySearch(Request $request) {
        $product = Product::with(['vendor'])->where('title', 'like', '%'.$request->search.'%')->paginate(2);

        if(!$product){
            return $this->returnFail(400, 'Product not found');
        }
        return $this->returnSuccess(200, $product);
    }
    public function getAllProductsInInventory(Request $request) {
        $product = Product::with(['vendor'])->where('title', 'like', '%'.$request->search.'%')->paginate(15);

        if(!$product){
            return $this->returnFail(400, 'Product not found');
        }
        return $this->returnSuccess(200, $product);
    }
    public function getAllMyProducts(Request $request) {
        
        // $product = Product::with(['vendor'])->where('title', 'like', '%'.$request->search.'%')->paginate(15);

        $product = Product::whereHas('links', function($query) use ($request){
            $query->where('user_id', $request->user()->id);
        })->paginate(10);

        if(!$product){
            return $this->returnFail(400, 'Product not found');
        }
        return $this->returnSuccess(200, $product);
    }
    public function statsProfile (Request $request){
        $stats1 = Product::all();
        $stats2 = Product::whereHas('links', function($query) use ($request){
            $query->where('user_id', $request->user()->id);
        })->count();

        return $this->returnSuccess(200, [
            'stats1' => count($stats1),
            'stats2' => $stats2
        ]);
    }
    public function getAllProducts(Request $request) {
        $products = Product::with('categorie')->where('title', 'like', '%'.$request->search.'%');

        if(!$products){
            return $this->returnFail(400, 'Products not found');
        }
        return $this->returnSuccess(200, $products->paginate(100));
    }
    public function getProductById($id) {
        $product = Product::with(['vendor'])->find($id);

        if(!$product){
            return $this->returnFail(400, 'Product not found');
        }
        return $this->returnSuccess(200, $product);
    }
    public function getSimilarProduct(Request $request){
        $category = Product::with(['vendor'])->where('categorie_id', $request->category)->take(5)->get();
        $search = Product::with(['vendor'])->where('title','like', '%'.$request->title.'%')->take(5)->get();
        $metadata = $this->getMetaDataByName($request->title);

        return $this->returnSuccess(200, [
            'category' => $category,
            'search'   => $search,
            'metadata' => $metadata,
        ]);

    }
    public function storeProduct(Request $request){
        $vendor = Vendor::where('name', $request->vendor)->firstOr(function () use($request) {            
            return Vendor::create([
                'name' => $request->vendor,
                'status' => 1
            ]);
        });
        $product = Product::create([
            'title' => $request->title,
            'status' => 1,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'price' => $request->price,
            'suggest_price' => $request->price,
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
            'vendor_id' => 1,
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
    public function storeMassiveProducts(Request $request, $categoryId){
        $all = [];
        $dataForm = json_decode($request->data, true);

        foreach ($dataForm as $key) {
            
            // $categoria = Categorie::where('title', $key['categoria'])->firstOr(function () use($key) {            
            //     return Categorie::create([
            //         'title' => $key['categoria'],
            //         'status' => 1,
            //         'rating' => rand(1, 5),
            //         'reviews' => rand(50, 100)
            //     ]);
            // });

            $vendor = Vendor::where('name', $key['proveedor'])->firstOr(function () use($key) {            
                return Vendor::create([
                    'name' => $key['proveedor'],
                    'status' => 1
                ]);
            });
            
            $product = Product::create([
            'title' => $key['nombre_producto'],
            'status' => 1,
            'quantity' => $key['stock'],
            'unit' => $key['unidad'],
            'price' => $key['precio_proveedor'],
            'suggest_price' => $key['precio_sugerido'],
            'description' => $key['descripcion_larga'],
            'actual_sell_volumen' => $key['ventas'],
            'sell_volumen_last_month' => $key['historico_volumen_de_ventas'],
            'logistic' => $key['logistica'],
            'time_ship' => $key['tiempo_entrega'],
            'pay_method' => $key['metodo_pago'],
            'comision' => $key['comision'] ?? 15,
            'views' => $key['vistas'],
            'reviews' => $key['reviews'],
            'rating' => $key['estrellas'],
            'profit' => 0,
            'vendor_id' => $vendor ? $vendor['id'] : 1,
            'categorie_id' => $categoryId,
        ]);
            array_push($all, $product);
        }
        
        return $this->returnSuccess(200,$all);
    }
    public function deleteAll(){
        Product::where('status', 1)->delete();
        return $this->returnSuccess(200, 'ok');
    }
    private function getMetaDataByName($title){
        $splitName = explode(" ", $title);
        return $splitName;
    }
}
