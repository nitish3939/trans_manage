<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    public function vehicle() {
        return $this->belongsTo('App\Models\Vehicle', 'vehicle_id')->withTrashed();
    }
    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id')->withTrashed();
    }
    public function getFuelBillImageAttribute($name) {
        return $name ? asset('storage/fuel_pic/' . $name) : asset("/img/no-image.jpg");
    }
     public function getFuelBillImage1Attribute($name) {
        return $name ? asset('storage/fuel_pic/' . $name) : false;
    }
}
