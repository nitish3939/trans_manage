<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    public function vehicle() {
        return $this->belongsTo('App\Models\Vehicle', 'vehicle_id');
    }
    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
