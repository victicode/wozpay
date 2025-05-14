<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    //
    public function getAll(){
        $categories = Categorie::where('status', 1)->get();
        return $this->returnSuccess(200, $categories);
    }
    public function getMostProlifict(Request $request){
        $categories = Categorie::with('products')
            ->whereHas('products')->where('status', 1)->take($request->quantity)->get();
        return $this->returnSuccess(200, $categories);
    }
}
