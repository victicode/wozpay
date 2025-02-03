<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
class PackageController extends Controller
{
    //
    public function getPackage(Request $request){
        return $this->returnSuccess(200, $this->getPackagePayForUser($request->user()->id));
    }
    private function getPackagePayForUser($user){
        $pack = Package::get();
        $packByUser = Package::whereHas('pays', function (Builder $query) use($user) {
            $query->where('user_id', $user);
        })->get();

        foreach ($packByUser as $key) {
            # code...
            foreach ($pack as $item) {
               if($item->id == $key->id) $item->isBuy = '0ssadasdasd';
            }
        }

        return  $pack;
    }
}
