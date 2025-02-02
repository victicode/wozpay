<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    //
    public function getPackage(){
        return $this->returnSuccess(200, Package::all());
    }
}
