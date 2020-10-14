<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Challan;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ChallanController extends Controller {

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
        return view('admin.challan.index', ['js' => $js, 'css' => $css]);
    }

    /**
     * Challan Listing
     *
     * @param Request $request [handle request]
     * @return pages
     */
    public function challanList(Request $request) {
        try {
            $offset = $request->get('start') ? $request->get('start') : 0;
            $limit = $request->get('length');
            $searchKeyword = $request->get('search')['value'];
            $query = Challan::query();
            $query->with(['vehicle','user']);
            if ($searchKeyword) {
                $query->whereHas("user", function($query) use($searchKeyword) {
                    $query->where("first_name", "LIKE", "%$searchKeyword%")
                            ->orWhere("mobile_number", "LIKE", "%$searchKeyword%");
                });
            }

            $data['recordsTotal'] = $query->count();
            $data['recordsFiltered'] = $query->count();
            $vehicles = $query->take($limit)->offset($offset)->latest()->get();

            $i = 0;
            $usersArray = [];
            foreach ($vehicles as $user) {
                $usersArray[$i]['challan_no'] = $user->challan_no;
                $usersArray[$i]['user_name'] = $user->user->first_name;
                $usersArray[$i]['vehicle_no'] = $user->vehicle_id?$user->vehicle->vehicle_no:"";
                $usersArray[$i]['challan_place'] = $user->challan_place;
                $usersArray[$i]['challan_amount'] = $user->challan_amount;
                $usersArray[$i]['challan_pic'] = '<img class="img-bordered" height="60" width="100" src=' . $user->challan_pic . '>';
                $usersArray[$i]['issue_date'] = $user->created_at->format('d-M-Y');
                $usersArray[$i]['description'] = $user->description;
                $usersArray[$i]['view-deatil'] = '<a class="btn btn-info btn-xs" href="' . route('admin.challan.edit', ['id' => $user->id]) . '"><i class="fa fa-pencil"></i>Edit</a>';
                $i++;
            }
            $data['data'] = $usersArray;
            return $data;
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function editChallan(Request $request, $id) {
        try {
            $challan = Challan::where('id',$id)->with(['vehicle','user'])->first();
            if ($request->isMethod("post")) {
                $challan->challan_no = $request->challan_no;
                $challan->challan_place = $request->challan_place;
                $challan->challan_amount = $request->challan_amount;
                $challan->description = $request->description;
                $challan->vehicle_id = $request->vehicle_id;
                if ($challan->save()) {
                    return redirect()->route('admin.challan.index')->with('status', 'Challan has been updated successfully.');
                } else {
                    return redirect()->route('admin.challan.index', $id)->with('error', 'Something went be wrong.');
                }
            }
            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            $vehicle = Vehicle::all();
            return view('admin.challan.edit', [
                'css' => $css,
                'js' => $js,
                'challan' => $challan,
                'vehicle' => $vehicle,
                    ]
            );
        } catch (\Exception $ex) {
            return redirect()->route('admin.challan.index')->with('error', $ex->getMessage());
        }
    }

}
