<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
// use Carbon\Carbon;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller {

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
        return view('admin.vehicle.index', ['js' => $js, 'css' => $css]);
    }

    /**
     * Vehicles Listing
     *
     * @param Request $request [handle request]
     * @return pages
     */
    public function vehicleList(Request $request) {
        try {
            $offset = $request->get('start') ? $request->get('start') : 0;
            $limit = $request->get('length');
            $searchKeyword = $request->get('search')['value'];
            $query = Vehicle::query();
            // $query->where("user_type_id", "=", 2);
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
            foreach ($vehicles as $user) {
                $usersArray[$i]['vehicle_owner_name'] = $user->vehicle_owner_name;
                $usersArray[$i]['rc_no'] = $user->rc_no;
                $usersArray[$i]['vehicle_no'] = $user->vehicle_no;
                $usersArray[$i]['view-deatil'] = '<a class="btn btn-info btn-xs" href="' . route('admin.vehicle.edit', ['id' => $user->id]) . '"><i class="fa fa-pencil"></i>Edit</a>';
                $i++;
            }
            $data['data'] = $usersArray;
            return $data;
        } catch (\Exception $e) {
            dd($e);
        }
    }

    // public function viewUser(Request $request, $id) {
    //     try {
    //         $user = $this->user->find($id);
    //         return view('admin.users.user-detail', ["user" => $user]);
    //     } catch (Exception $ex) {
    //         dd($e);
    //     }
    // }

    public function addVehicle(Request $request) {
        try {
            if ($request->isMethod("post")) {

                    $vehicle = new Vehicle();
                    $vehicle->vehicle_no = $request->vehicle_no;
                    $vehicle->rc_no = $request->rc_no;
                    $vehicle->vehicle_owner_name = $request->vehicle_owner_name;

                    $vehicle->insurance_no = $request->insurance_no;
                    $vehicle->insu_start_date = $request->insu_start_date;
                    $vehicle->insu_end_date = $request->insu_end_date;

                    $vehicle->pollution_no = $request->pollution_no;
                    $vehicle->pllu_start_date = $request->pllu_start_date;
                    $vehicle->pollu_end_date = $request->pollu_end_date;

                    $vehicle->medical_cert_no = $request->medical_cert_no;
                    $vehicle->medi_start_date = $request->medi_start_date;
                    $vehicle->medi_end_date = $request->medi_end_date;

                    $vehicle->fitness_no = $request->fitness_no;
                    $vehicle->fit_start_date = $request->fit_start_date;
                    $vehicle->fit_end_date = $request->fit_end_date;

                    $vehicle->permite_no = $request->permite_no;
                    $vehicle->perm_start_date = $request->perm_start_date;
                    $vehicle->perm_end_date = $request->perm_end_date;

                    $vehicle->tax_permit_no = $request->tax_permit_no;
                    $vehicle->tax_start_date = $request->tax_start_date;
                    $vehicle->tax_end_date = $request->tax_end_date;

                    $vehicle->np_permit_no = $request->np_permit_no;
                    $vehicle->np_start_date = $request->np_start_date;
                    $vehicle->np_end_date = $request->np_end_date;

                    $vehicle->five_year_no = $request->five_year_no;
                    $vehicle->five_start_date = $request->five_start_date;
                    $vehicle->five_end_date = $request->five_end_date;

                    if ($vehicle->save()) {
                        return redirect()->route('admin.vehicle.index')->with('status', 'Vehicle has been added successfully');
                    } else {
                        return redirect()->route('admin.vehicle.add')->with('error', 'Something went be wrong.');
                    }
                }


            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            return view('admin.vehicle.add', [
                'css' => $css,
                'js' => $js,

            ]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.vehicle.index')->with('error', $ex->getMessage());
        }
    }

    public function editVehicle(Request $request, $id) {
        try {
            $vehicle = Vehicle::find($id);
            if ($request->isMethod("post")) {
                $vehicle->vehicle_no = $request->vehicle_no;
                $vehicle->rc_no = $request->rc_no;
                $vehicle->vehicle_owner_name = $request->vehicle_owner_name;

                $vehicle->insurance_no = $request->insurance_no;
                $vehicle->insu_start_date = $request->insu_start_date;
                $vehicle->insu_end_date = $request->insu_end_date;

                $vehicle->pollution_no = $request->pollution_no;
                $vehicle->pllu_start_date = $request->pllu_start_date;
                $vehicle->pollu_end_date = $request->pollu_end_date;

                $vehicle->medical_cert_no = $request->medical_cert_no;
                $vehicle->medi_start_date = $request->medi_start_date;
                $vehicle->medi_end_date = $request->medi_end_date;

                $vehicle->fitness_no = $request->fitness_no;
                $vehicle->fit_start_date = $request->fit_start_date;
                $vehicle->fit_end_date = $request->fit_end_date;

                $vehicle->permite_no = $request->permite_no;
                $vehicle->perm_start_date = $request->perm_start_date;
                $vehicle->perm_end_date = $request->perm_end_date;

                $vehicle->tax_permit_no = $request->tax_permit_no;
                $vehicle->tax_start_date = $request->tax_start_date;
                $vehicle->tax_end_date = $request->tax_end_date;

                $vehicle->np_permit_no = $request->np_permit_no;
                $vehicle->np_start_date = $request->np_start_date;
                $vehicle->np_end_date = $request->np_end_date;

                $vehicle->five_year_no = $request->five_year_no;
                $vehicle->five_start_date = $request->five_start_date;
                $vehicle->five_end_date = $request->five_end_date;


                if ($vehicle->save()) {


                    return redirect()->route('admin.vehicle.index')->with('status', 'Vehicle has been updated successfully.');
                } else {
                    return redirect()->route('admin.vehicle.index', $id)->with('error', 'Something went be wrong.');
                }
            }
            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            return view('admin.vehicle.edit', [
                'css' => $css,
                'js' => $js,
                'vehicle' => $vehicle,
                    ]
            );
        } catch (\Exception $ex) {
            return redirect()->route('admin.vehicle.index')->with('error', $ex->getMessage());
        }
    }

}
