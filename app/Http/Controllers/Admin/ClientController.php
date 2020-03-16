<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Client;

class ClientController extends Controller {

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
        return view('admin.client.index', ['js' => $js, 'css' => $css]);
    }

    /**
     * Vehicles Listing
     *
     * @param Request $request [handle request]
     * @return pages
     */
    public function clientList(Request $request) {
        try {
            $offset = $request->get('start') ? $request->get('start') : 0;
            $limit = $request->get('length');
            $searchKeyword = $request->get('search')['value'];
            $query = Client::query();
            // $query->where("user_type_id", "=", 2);
            if ($searchKeyword) {
                $query->where(function($query) use($searchKeyword) {
                    $query->where("name", "LIKE", "%$searchKeyword%")->orWhere("company_name", "LIKE", "%$searchKeyword%");
                });
            }

            $data['recordsTotal'] = $query->count();
            $data['recordsFiltered'] = $query->count();
            $vehicles = $query->take($limit)->offset($offset)->latest()->get();

            $i = 0;
            $usersArray = [];
            foreach ($vehicles as $user) {
                $usersArray[$i]['name'] = $user->name;
                $usersArray[$i]['company_name'] = $user->company_name;
                $usersArray[$i]['designation'] = $user->designation;
                $usersArray[$i]['bribe'] = $user->bribe;
                $usersArray[$i]['commision_type'] = $user->commision_type;
                $usersArray[$i]['commision_charge'] = $user->commision_charge;
                $usersArray[$i]['work_amount'] = $user->work_amount;
                $usersArray[$i]['view-deatil'] = '<a class="btn btn-info btn-xs" href="' . route('admin.client.edit', ['id' => $user->id]) . '"><i class="fa fa-pencil"></i>Edit</a>';
                $i++;
            }
            $data['data'] = $usersArray;
            return $data;
        } catch (\Exception $e) {
            dd($e);
        }
    }


    public function addClient(Request $request) {
        try {
            if ($request->isMethod("post")) {
                    $vehicle = new Client();
                    $vehicle->name = $request->client_name;
                    $vehicle->company_name = $request->company_name;
                    $vehicle->designation = $request->designation;
                    $vehicle->commision_type = $request->commision_type;
                    $vehicle->commision_charge = $request->commision_charge;
                    $vehicle->bribe = $request->bribe;
                    $vehicle->work_amount = $request->work_amount;

                    if ($vehicle->save()) {
                        return redirect()->route('admin.client.index')->with('status', 'Client has been added successfully');
                    } else {
                        return redirect()->route('admin.client.add')->with('error', 'Something went be wrong.');
                    }
                }


            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            return view('admin.client.add', [
                'css' => $css,
                'js' => $js,

            ]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.client.index')->with('error', $ex->getMessage());
        }
    }


    public function editClient(Request $request, $id) {
        try {
            $client = Client::find($id);
            if ($request->isMethod("post")) {
                $client->name = $request->client_name;
                $client->company_name = $request->company_name;
                $client->designation = $request->designation;
                $client->commision_type = $request->commision_type;
                $client->commision_charge = $request->commision_charge;
                $client->bribe = $request->bribe;
                $client->work_amount = $request->work_amount;

                if ($client->save()) {


                    return redirect()->route('admin.client.index')->with('status', 'Client has been updated successfully.');
                } else {
                    return redirect()->route('admin.client.index', $id)->with('error', 'Something went be wrong.');
                }
            }
            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            return view('admin.client.edit', [
                'css' => $css,
                'js' => $js,
                'client' => $client,
                    ]
            );
        } catch (\Exception $ex) {
            return redirect()->route('admin.client.index')->with('error', $ex->getMessage());
        }
    }

}
