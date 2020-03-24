<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Trip;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TripController extends Controller {

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
        return view('admin.trip.index', ['js' => $js, 'css' => $css]);
    }

    /**
     * Challan Listing
     *
     * @param Request $request [handle request]
     * @return pages
     */
    public function tripList(Request $request) {
        try {
            $offset = $request->get('start') ? $request->get('start') : 0;
            $limit = $request->get('length');
            $searchKeyword = $request->get('search')['value'];
            $query = Trip::query();
            $query->with(['vehicle','user']);
            if ($searchKeyword) {
                $query->where(function($query) use($searchKeyword) {
                    $query->where("challan_no", "LIKE", "%$searchKeyword%");
                });
            }

            $data['recordsTotal'] = $query->count();
            $data['recordsFiltered'] = $query->count();
            $vehicles = $query->take($limit)->offset($offset)->latest()->get();

            $i = 0;
            $usersArray = [];
            foreach ($vehicles as $user) {
                $usersArray[$i]['vehicle_no'] = $user->vehicle->vehicle_no;
                $usersArray[$i]['user_name'] = $user->user->first_name;
                $usersArray[$i]['start_trip'] = $user->start_trip;
                $usersArray[$i]['end_trip'] = $user->end_trip;
                $usersArray[$i]['trip_date'] = $user->trip_date;
                $usersArray[$i]['expense_amount'] = $user->expense_amount;
                $usersArray[$i]['view-deatil'] = '<a class="btn btn-info btn-xs" href="' . route('admin.trip.edit', ['id' => $user->id]) . '"><i class="fa fa-pencil"></i>Edit</a>';
                $i++;
            }
            $data['data'] = $usersArray;
            return $data;
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function addTrip(Request $request) {
        try {
            if ($request->isMethod("post")) {
                    $trip = new Trip();
                    $trip->user_id = $request->user_id;
                    $trip->vehicle_id = $request->vehicle_id;
                    $trip->trip_date = $request->trip_date;
                    $trip->start_trip = $request->start_trip;
                    $trip->fuel_entry = $request->fuel_entry;
                    $trip->end_trip = $request->end_trip;
                    $trip->start_km = $request->start_km;
                    $trip->end_km = $request->end_km;
                    $trip->expense_amount = $request->expense_amount;
                    $trip->amount_spend = $request->amount_spend;
                    $trip->end_fuel_entry = $request->end_fuel_entry;
                    if ($trip->save()) {
                        return redirect()->route('admin.trip.index')->with('status', 'Trip has been added successfully');
                    } else {
                        return redirect()->route('admin.trip.add')->with('error', 'Something went be wrong.');
                    }
                }
            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                "vendors/iCheck/icheck.min.js",
            ];
            $vehicle = Vehicle::all();
            $driver = User::where('user_type_id', 2)->get();
            return view('admin.trip.add', [
                'css' => $css,
                'js' => $js,
                'vehicle' => $vehicle,
                'driver' => $driver,
            ]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.trip.index')->with('error', $ex->getMessage());
        }
    }


    public function editTrip(Request $request, $id) {
        try {
            $trip = Trip::where('id',$id)->with(['vehicle','user'])->first();
            if ($request->isMethod("post")) {
                $trip->user_id = $request->user_id;
                    $trip->vehicle_id = $request->vehicle_id;
                    $trip->trip_date = $request->trip_date;
                    $trip->start_trip = $request->start_trip;
                    $trip->fuel_entry = $request->fuel_entry;
                    $trip->end_trip = $request->end_trip;
                    $trip->start_km = $request->start_km;
                    $trip->end_km = $request->end_km;
                    $trip->expense_amount = $request->expense_amount;
                    $trip->amount_spend = $request->amount_spend;
                    $trip->end_fuel_entry = $request->end_fuel_entry;
                if ($trip->save()) {
                    return redirect()->route('admin.trip.index')->with('status', 'Trip has been updated successfully.');
                } else {
                    return redirect()->route('admin.trip.index', $id)->with('error', 'Something went be wrong.');
                }
            }
            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            $vehicle = Vehicle::all();
            $driver = User::where('user_type_id', 2)->get();
            return view('admin.trip.edit', [
                'css' => $css,
                'js' => $js,
                'trip' => $trip,
                'vehicle' => $vehicle,
                'driver' => $driver,
                    ]
            );
        } catch (\Exception $ex) {
            return redirect()->route('admin.trip.index')->with('error', $ex->getMessage());
        }
    }

}