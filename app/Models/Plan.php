<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    use HasUuids;
    public function priceAnnualy(){
        return $this->hasOne(PlanPrice::class,'plan_id', 'id')->where('type', 1);

    }
    public function priceMonthly(){
        return $this->hasOne(PlanPrice::class,'plan_id', 'id')->where('type', 2);

    }
}




