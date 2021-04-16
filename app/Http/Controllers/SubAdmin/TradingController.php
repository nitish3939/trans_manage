<?php

namespace App\Http\Controllers\SubAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Trading;
use Carbon\Carbon;

class TradingController extends Controller {

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
        return view('subadmin.trading.index', ['js' => $js, 'css' => $css]);
    }

    /**
     * Tradings Listing
     *
     * @param Request $request [handle request]
     * @return pages
     */
    public function tradingList(Request $request) {
        try {
            $offset = $request->get('start') ? $request->get('start') : 0;
            $limit = $request->get('length');
            $searchKeyword = $request->get('search')['value'];
            $query = Trading::query();
            // $query->where("user_type_id", "=", 2);
            if ($searchKeyword) {
                // $query->where(function($query) use($searchKeyword) {
                //     $query->where("name", "LIKE", "%$searchKeyword%")->orWhere("company_name", "LIKE", "%$searchKeyword%");
                // });
            }

            $data['recordsTotal'] = $query->count();
            $data['recordsFiltered'] = $query->count();
            $tradings = $query->take($limit)->offset($offset)->latest()->get();

            $i = 0;
            $usersArray = [];
            foreach ($tradings as $user) {

                $usersArray[$i]['month'] = $user->month;
                $usersArray[$i]['debit'] = $user->purchase + $user->expenses+ $user->gross_profit;
                $usersArray[$i]['credit'] = $user->sales;
                $usersArray[$i]['view-deatil'] = '<a class="btn btn-info btn-xs" href="' . route('subadmin.trading.edit', ['id' => $user->id]) . '"><i class="fa fa-pencil"></i>Edit</a>';
                $i++;
            }
            $data['data'] = $usersArray;
            return $data;
        } catch (\Exception $e) {
            dd($e);
        }
    }


    public function addTrading(Request $request) {
        try {
            if ($request->isMethod("post")) {
                    $trading = new Trading();
                    $trading->month = $request->month;
                    $trading->year = $request->year;
                    $trading->purchase = $request->purchase;
                    $trading->expenses = $request->expenses;
                    $trading->gross_profit = $request->gross_profit;
                    $trading->sales = $request->sales;

                    if ($trading->save()) {
                        return redirect()->route('subadmin.trading.index')->with('status', 'Trading has been added successfully');
                    } else {
                        return redirect()->route('subadmin.trading.add')->with('error', 'Something went be wrong.');
                    }
                }


            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            return view('subadmin.trading.add', [
                'css' => $css,
                'js' => $js,

            ]);
        } catch (\Exception $ex) {
            return redirect()->route('subadmin.trading.index')->with('error', $ex->getMessage());
        }
    }


    public function editTrading(Request $request, $id) {
        try {
            $trading = Trading::find($id);
            if ($request->isMethod("post")) {
                $trading->month = $request->month;
                $trading->year = $request->year;
                $trading->purchase = $request->purchase;
                $trading->expenses = $request->expenses;
                $trading->gross_profit = $request->gross_profit;
                $trading->sales = $request->sales;

                if ($trading->save()) {


                    return redirect()->route('subadmin.trading.index')->with('status', 'Trading has been updated successfully.');
                } else {
                    return redirect()->route('subadmin.trading.index', $id)->with('error', 'Something went be wrong.');
                }
            }
            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            return view('subadmin.trading.edit', [
                'css' => $css,
                'js' => $js,
                'trading' => $trading,
                    ]
            );
        } catch (\Exception $ex) {
            return redirect()->route('subadmin.trading.index')->with('error', $ex->getMessage());
        }
    }

}
