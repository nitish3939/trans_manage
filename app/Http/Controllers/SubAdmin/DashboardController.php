<?php

namespace App\Http\Controllers\SubAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;

class DashboardController extends Controller {

    public function index() {
        $vehicle = Vehicle::count();
        $driver = User::where(["is_active" => 1, "user_type_id" => 2])->count();
        $staff = User::where(["is_active" => 1, "user_type_id" => 5])->count();
        $inactiveStaff = User::where(["is_active" => 0, "user_type_id" => 2])->count();

        $css = [
            'vendors/bootstrap-daterangepicker/daterangepicker.css',
        ];
        $js = [
            'vendors/moment/min/moment.min.js',
            'vendors/bootstrap-daterangepicker/daterangepicker.js',
        ];

        return view('subadmin.dashboard.dashboard', [
            "activeUser" => $vehicle,
            "activeStaff" => $driver,
            "inactiveUser" => $staff,
            "inactiveStaff" => $inactiveStaff,
            "js" => $js,
            "css" => $css
        ]);
    }

}
