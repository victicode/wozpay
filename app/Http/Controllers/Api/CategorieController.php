<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    //
    
    public function getAll(){
        $categories = Categorie::with('products')->get()->where('status', 1)->groupBy(function($item,$key) {
            return $item->rating;     //treats the name string as an array
        })
        ->sortByDesc(function($item, $key){    
            return $key;
        });

        return $this->returnSuccess(200,$categories);
    }
    public function getAllToSelect(){
        $categories = Categorie::with('products')->get()->where('status', 1);

        return $this->returnSuccess(200,$categories);
    }
    public function getMostProlifict(Request $request){
        $categories = Categorie::with('products')
            ->whereHas('products')->where('status', 1)->take($request->quantity)->get();
        return $this->returnSuccess(200, $categories);
    }
}
