<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VehicleIssue extends Model
{
        public function vehicle()
        {
            return $this->belongsTo('App\Models\Vehicle', 'vehicle_id');
        }

        public function user()
        {
            return $this->belongsTo('App\Models\User', 'user_id');
        }
        public function getBillImageAttribute($name) {
            return $name ? asset('storage/issue_pic/' . $name) : asset("/img/no-image.jpg");
        }

}
