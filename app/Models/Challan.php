<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challan extends Model
{
    public function vehicle() {
        return $this->belongsTo('App\Models\Vehicle', 'vehicle_id');
    }
    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getChallanPicAttribute($name) {
        return $name ? asset('storage/challan_pic/' . $name) : asset("/img/no-image.jpg");
    }
}
