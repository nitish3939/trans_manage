<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Vehicle;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller {

    /**
     * Index Page
     *
     * @param Request $request [handle request]
     * @return pages
     */
    public function index() {

        $css = [
            'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
        ];
        $js = [
            'vendors/datatables.net/js/jquery.dataTables.min.js',
            'vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
        ];
        return view('admin.notification.index', ['js' => $js, 'css' => $css]);
    }

    /**
     * Vehicles Listing
     *
     * @param Request $request [handle request]
     * @return pages
     */
    public function listNotification(Request $request) {
        try {
            $offset = $request->get('start') ? $request->get('start') : 0;
            $limit = $request->get('length');
            $searchKeyword = $request->get('search')['value'];
            $today = Carbon::now();
            $query = Vehicle::query();

            if ($searchKeyword) {
                $query->where(function($query) use($searchKeyword) {
                    $query->where("vehicle_owner_name", "LIKE", "%$searchKeyword%")->orWhere("rc_no", "LIKE", "%$searchKeyword%")->orWhere("vehicle_no", "LIKE", "%$searchKeyword%");
                });
            }

            $data['recordsTotal'] = $query->count();
            $data['recordsFiltered'] = $query->count();
            $vehicles = $query->take($limit)->offset($offset)->latest()->get();

            $i = 0;
            $usersArray = [];
            $now = Carbon::now();
            foreach ($vehicles as $user) {
            $date = Carbon::parse($user->insu_end_date);
            $diff = $date->diffInDays($now);
            if($diff <= 30){
                $usersArray[$i]['vehicle_no'] = $user->vehicle_no;
                $usersArray[$i]['days_Left'] = $diff . " Days";
                $usersArray[$i]['vehicle_owner'] = $user->vehicle_owner_name;
                $usersArray[$i]['type'] = "Insurance";
                $i++;
            }
            $date1 = Carbon::parse($user->pollu_end_date);
            $diff1 = $date1->diffInDays($now);
            if($diff1 <= 7){
                $usersArray[$i]['vehicle_no'] = $user->vehicle_no;
                $usersArray[$i]['days_Left'] = $diff1 . " Days";
                $usersArray[$i]['vehicle_owner'] = $user->vehicle_owner_name;
                $usersArray[$i]['type'] = "Pollution";
                $i++;
            }
            $date2 = Carbon::parse($user->medi_end_date);
            $diff2 = $date2->diffInDays($now);
            if($diff2 <= 30){
                $usersArray[$i]['vehicle_no'] = $user->vehicle_no;
                $usersArray[$i]['days_Left'] = $diff2 . " Days";
                $usersArray[$i]['vehicle_owner'] = $user->vehicle_owner_name;
                $usersArray[$i]['type'] = "Medical";
                $i++;
            }
            $date3 = Carbon::parse($user->fit_end_date);
            $diff3 = $date3->diffInDays($now);
            if($diff3 <= 30){
                $usersArray[$i]['vehicle_no'] = $user->vehicle_no;
                $usersArray[$i]['days_Left'] = $diff3 . " Days";
                $usersArray[$i]['vehicle_owner'] = $user->vehicle_owner_name;
                $usersArray[$i]['type'] = "Fitness";
                $i++;
            }
            $date4 = Carbon::parse($user->perm_end_date);
            $diff4 = $date4->diffInDays($now);
            if($diff4 <= 30){
                $usersArray[$i]['vehicle_no'] = $user->vehicle_no;
                $usersArray[$i]['days_Left'] = $diff4 . " Days";
                $usersArray[$i]['vehicle_owner'] = $user->vehicle_owner_name;
                $usersArray[$i]['type'] = "Permit";
                $i++;
            }
            $date5 = Carbon::parse($user->tax_end_date);
            $diff5 = $date5->diffInDays($now);
            if($diff5 <= 30){
                $usersArray[$i]['vehicle_no'] = $user->vehicle_no;
                $usersArray[$i]['days_Left'] = $diff5 . " Days";
                $usersArray[$i]['vehicle_owner'] = $user->vehicle_owner_name;
                $usersArray[$i]['type'] = "Tax";
                $i++;
            }
            $date6 = Carbon::parse($user->np_end_date);
            $diff6 = $date6->diffInDays($now);
            if($diff6 <= 30){
                $usersArray[$i]['vehicle_no'] = $user->vehicle_no;
                $usersArray[$i]['days_Left'] = $diff6. " Days";
                $usersArray[$i]['vehicle_owner'] = $user->vehicle_owner_name;
                $usersArray[$i]['type'] = "NP permit";
                $i++;
            }
            $date7 = Carbon::parse($user->five_end_date);
            $diff7 = $date7->diffInDays($now);
            if($diff7 <= 30){
                $usersArray[$i]['vehicle_no'] = $user->vehicle_no;
                $usersArray[$i]['days_Left'] = $diff7 . " Days";
                $usersArray[$i]['vehicle_owner'] = $user->vehicle_owner_name;
                $usersArray[$i]['type'] = "5 Year Permit";
                $i++;
            }

        }
            $data['data'] = $usersArray;
            return $data;
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
