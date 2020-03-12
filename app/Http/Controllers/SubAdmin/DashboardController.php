<?php

namespace App\Http\Controllers\SubAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;


class DashboardController extends Controller {

    public function index(Request $request) {

        $activeUser = User::where(["is_active" => 1, "user_type_id" => 3])->count();
        $activeStaff = User::where(["is_active" => 1, "user_type_id" => 2])->count();
        $inactiveUser = User::where(["is_active" => 0, "user_type_id" => 3])->count();
        $inactiveStaff = User::where(["is_active" => 0, "user_type_id" => 2])->count();

        $css = [
            'vendors/bootstrap-daterangepicker/daterangepicker.css',
        ];
        $js = [
            'vendors/moment/min/moment.min.js',
            'vendors/bootstrap-daterangepicker/daterangepicker.js',
        ];
        return view('subadmin.dashboard.dashboard', [
            "activeUser" => $activeUser,
            "activeStaff" => $activeStaff,
            "inactiveUser" => $inactiveUser,
            "inactiveStaff" => $inactiveStaff,
            "js" => $js,
            "css" => $css
        ]);
    }


}
