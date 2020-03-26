<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
// use Carbon\Carbon;
use App\Models\Vehicle;
use App\Models\VehicleIssue;
use App\Models\User;
use App\Models\VehicleIssuePart;
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
                $usersArray[$i]['view-deatil'] = '<a class="btn btn-info btn-xs" href="' . route('admin.vehicle.edit', ['id' => $user->id]) . '"><i class="fa fa-pencil"></i>Edit</a><a class="btn btn-info btn-xs" href="' . route('admin.vehicle.issue', ['id' => $user->id]) . '"><i class="fa fa-pencil"></i>Issue</a>';
                $i++;
            }
            $data['data'] = $usersArray;
            return $data;
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function issueViewVehicle(Request $request, $id) {
        try {
            $vehicle = VehicleIssue::find($id);
            if ($request->isMethod("post")) {

                $vehicle->issue_name = $request->issue_name;
                $vehicle->mechnic_name = $request->mechanic;
                $vehicle->labour_charge = $request->labour_charge;

                $vehicle->total_charge = $request->total_charge;
                 if ($request->hasFile("bill_image")) {
                        $bill_image = $request->file("bill_image");
                        $bill = Storage::disk('public')->put('bill_image', $bill_image);
                        $bill_file_name = basename($bill);
                        $vehicle->bill_image = $bill_file_name;
                    }

                $vehicle->damage_part_name_1 = $request->damage_part_name_1;
                $vehicle->cost_part_1 = $request->cost_part_1;

                $vehicle->damage_part_name_2 = $request->damage_part_name_2;
                $vehicle->cost_part_2 = $request->cost_part_2;

                $vehicle->damage_part_name_3 = $request->damage_part_name_3;
                $vehicle->cost_part_3 = $request->cost_part_3;

                $vehicle->damage_part_name_4 = $request->damage_part_name_4;
                $vehicle->cost_part_4 = $request->cost_part_4;

                $vehicle->damage_part_name_5 = $request->damage_part_name_5;
                $vehicle->cost_part_5 = $request->cost_part_5;

                $vehicle->damage_part_name_6 = $request->damage_part_name_6;
                $vehicle->cost_part_6 = $request->cost_part_6;

                $vehicle->damage_part_name_7 = $request->damage_part_name_7;
                $vehicle->cost_part_7 = $request->cost_part_7;

                $vehicle->damage_part_name_8 = $request->damage_part_name_8;
                $vehicle->cost_part_8 = $request->cost_part_8;

                if ($vehicle->save()) {
                    return redirect()->route('admin.vehicle.index')->with('status', 'Vehicle Issue has been updated successfully.');
                } else {
                    return redirect()->route('admin.vehicle.index', $id)->with('error', 'Something went be wrong.');
                }
            }
            $user = User::where('id',$vehicle->user_id)->first();
            // $parts = VehicleIssuePart::where('vehicle_issue_id',$id)->get();
            $veh = Vehicle::where('id',$vehicle->vehicle_id)->first();
            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            return view('admin.vehicle.issueView', ["vehicle" => $vehicle
            ,'css' => $css,
            'js' => $js, 'user' => $user, 'veh' => $veh,
]);
        } catch (Exception $ex) {
            dd($e);
        }
    }

    // public function issueEditVehicle(Request $request, Vehicle $vehicle) {
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

    public function issueVehicle(Request $request, $id) {
        try {

            $query = VehicleIssue::query();
            $query->where('vehicle_id',$id)->with(['vehicle','user']);
            // // $query->where("user_type_id", "=", 2);
            // if ($searchKeyword) {
            //     $query->where(function($query) use($searchKeyword) {
            //         $query->where("vehicle_owner_name", "LIKE", "%$searchKeyword%")->orWhere("rc_no", "LIKE", "%$searchKeyword%")->orWhere("vehicle_no", "LIKE", "%$searchKeyword%");
            //     });
            // }

            // $data['recordsTotal'] = $query->count();
            // $data['recordsFiltered'] = $query->count();
            $vehicles = $query->latest()->get();

            $i = 0;
            $usersArray = [];
            foreach ($vehicles as $user) {
                $usersArray[$i]['id'] = $user->id;
                $usersArray[$i]['user_name'] = $user->user->first_name;
                $usersArray[$i]['vehicle_no'] = $user->vehicle->vehicle_no;
                $usersArray[$i]['issue_date'] = $user->issue_date;
                $usersArray[$i]['mechanic_name'] = $user->mechnic_name;
                $usersArray[$i]['charge'] = $user->total_charge;
                $usersArray[$i]['view-deatil'] = '<a class="btn btn-danger btn-xs" href="' . route('admin.vehicle.issueView', ['id' => $user->id]) . '"><i class="fa fa-pencil"></i>View</a>';
                $i++;
            }
            $data['data'] = $usersArray;

            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            $vehic = Vehicle::where('id',$id)->first();
            return view('admin.vehicle.issue', [
                'css' => $css,
                'js' => $js,
                'usersArray' => $usersArray,
                'vehicle'=> $vehic,
                    ]
            );
        } catch (Exception $ex) {
            dd($e);
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
