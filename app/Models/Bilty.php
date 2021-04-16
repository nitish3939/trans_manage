<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bilty extends Model
{
    public function vehicle() {
        return $this->belongsTo('App\Models\Vehicle', 'vehicle_id')->withTrashed();
    }
    public function trip() {
        return $this->belongsTo('App\Models\Trip', 'trip_id');
    }
    public function bilty_items() {
        return $this->hasMany('App\Models\BiltyItem', 'bilty_id');
    }
}
