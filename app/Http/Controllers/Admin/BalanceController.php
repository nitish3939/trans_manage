<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Balance;
use Carbon\Carbon;

class BalanceController extends Controller {

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
        return view('admin.balance.index', ['js' => $js, 'css' => $css]);
    }

    /**
     * Balances Listing
     *
     * @param Request $request [handle request]
     * @return pages
     */
    public function balanceList(Request $request) {
        try {
            $offset = $request->get('start') ? $request->get('start') : 0;
            $limit = $request->get('length');
            $searchKeyword = $request->get('search')['value'];
            $query = Balance::query();
            // $query->where("user_type_id", "=", 2);
            if ($searchKeyword) {
                // $query->where(function($query) use($searchKeyword) {
                //     $query->where("name", "LIKE", "%$searchKeyword%")->orWhere("company_name", "LIKE", "%$searchKeyword%");
                // });
            }

            $data['recordsTotal'] = $query->count();
            $data['recordsFiltered'] = $query->count();
            $balances = $query->take($limit)->offset($offset)->latest()->get();

            $i = 0;
            $usersArray = [];
            foreach ($balances as $user) {

                $usersArray[$i]['month'] = $user->month;
                $usersArray[$i]['liabilities'] = $user->profit_adjusted + $user->duties_taxes+ $user->sundry_creditors + $user->suspense;
                $usersArray[$i]['assets'] = $user->bank + $user->cash+ $user->sundry_debtors;
                $usersArray[$i]['view-deatil'] = '<a class="btn btn-info btn-xs" href="' . route('admin.balance.edit', ['id' => $user->id]) . '"><i class="fa fa-pencil"></i>Edit</a>';
                $i++;
            }
            $data['data'] = $usersArray;
            return $data;
        } catch (\Exception $e) {
            dd($e);
        }
    }


    public function addBalance(Request $request) {
        try {
            if ($request->isMethod("post")) {
                    $balance = new Balance();
                    $balance->month = $request->month;
                    $balance->year = $request->year;
                    $balance->profit_adjusted = $request->profit_adjusted;
                    $balance->duties_taxes = $request->duties_taxes;
                    $balance->sundry_creditors = $request->sundry_creditors;
                    $balance->suspense = $request->suspense;
                    $balance->bank = $request->bank;
                    $balance->cash = $request->cash;
                    $balance->sundry_debtors = $request->sundry_debtors;

                    if ($balance->save()) {
                        return redirect()->route('admin.balance.index')->with('status', 'Balance has been added successfully');
                    } else {
                        return redirect()->route('admin.balance.add')->with('error', 'Something went be wrong.');
                    }
                }


            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            return view('admin.balance.add', [
                'css' => $css,
                'js' => $js,

            ]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.balance.index')->with('error', $ex->getMessage());
        }
    }


    public function editBalance(Request $request, $id) {
        try {
            $balance = Balance::find($id);
            if ($request->isMethod("post")) {
                $balance->month = $request->month;
                $balance->year = $request->year;
                $balance->profit_adjusted = $request->profit_adjusted;
                $balance->duties_taxes = $request->duties_taxes;
                $balance->sundry_creditors = $request->sundry_creditors;
                $balance->suspense = $request->suspense;
                $balance->bank = $request->bank;
                $balance->cash = $request->cash;
                $balance->sundry_debtors = $request->sundry_debtors;

                if ($balance->save()) {


                    return redirect()->route('admin.balance.index')->with('status', 'Balance has been updated successfully.');
                } else {
                    return redirect()->route('admin.balance.index', $id)->with('error', 'Something went be wrong.');
                }
            }
            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            return view('admin.balance.edit', [
                'css' => $css,
                'js' => $js,
                'balance' => $balance,
                    ]
            );
        } catch (\Exception $ex) {
            return redirect()->route('admin.balance.index')->with('error', $ex->getMessage());
        }
    }

}
