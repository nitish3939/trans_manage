<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Profit;
use Carbon\Carbon;

class ProfitController extends Controller {

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
        return view('admin.profit.index', ['js' => $js, 'css' => $css]);
    }

    /**
     * Profits Listing
     *
     * @param Request $request [handle request]
     * @return pages
     */
    public function profitList(Request $request) {
        try {
            $offset = $request->get('start') ? $request->get('start') : 0;
            $limit = $request->get('length');
            $searchKeyword = $request->get('search')['value'];
            $query = Profit::query();
            // $query->where("user_type_id", "=", 2);
            if ($searchKeyword) {
                // $query->where(function($query) use($searchKeyword) {
                //     $query->where("name", "LIKE", "%$searchKeyword%")->orWhere("company_name", "LIKE", "%$searchKeyword%");
                // });
            }

            $data['recordsTotal'] = $query->count();
            $data['recordsFiltered'] = $query->count();
            $profits = $query->take($limit)->offset($offset)->latest()->get();

            $i = 0;
            $usersArray = [];
            foreach ($profits as $user) {

                $usersArray[$i]['month'] = $user->month;
                $usersArray[$i]['debit'] = $user->petrol_expenses + $user->convey_expenses+ $user->nett_profit;
                $usersArray[$i]['credit'] = $user->gross_profit;
                $usersArray[$i]['view-deatil'] = '<a class="btn btn-info btn-xs" href="' . route('admin.profit.edit', ['id' => $user->id]) . '"><i class="fa fa-pencil"></i>Edit</a>';
                $i++;
            }
            $data['data'] = $usersArray;
            return $data;
        } catch (\Exception $e) {
            dd($e);
        }
    }


    public function addProfit(Request $request) {
        try {
            if ($request->isMethod("post")) {
                    $profit = new Profit();
                    $profit->month = $request->month;
                    $profit->year = $request->year;
                    $profit->petrol_expenses = $request->petrol_expenses;
                    $profit->convey_expenses = $request->convey_expenses;
                    $profit->nett_profit = $request->nett_profit;
                    $profit->gross_profit = $request->gross_profit;

                    if ($profit->save()) {
                        return redirect()->route('admin.profit.index')->with('status', 'Profit has been added successfully');
                    } else {
                        return redirect()->route('admin.profit.add')->with('error', 'Something went be wrong.');
                    }
                }


            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            return view('admin.profit.add', [
                'css' => $css,
                'js' => $js,

            ]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.profit.index')->with('error', $ex->getMessage());
        }
    }


    public function editProfit(Request $request, $id) {
        try {
            $profit = Profit::find($id);
            if ($request->isMethod("post")) {
                $profit->month = $request->month;
                $profit->year = $request->year;
                $profit->petrol_expenses = $request->petrol_expenses;
                $profit->convey_expenses = $request->convey_expenses;
                $profit->nett_profit = $request->nett_profit;
                $profit->gross_profit = $request->gross_profit;

                if ($profit->save()) {


                    return redirect()->route('admin.profit.index')->with('status', 'Profit has been updated successfully.');
                } else {
                    return redirect()->route('admin.profit.index', $id)->with('error', 'Something went be wrong.');
                }
            }
            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            return view('admin.profit.edit', [
                'css' => $css,
                'js' => $js,
                'profit' => $profit,
                    ]
            );
        } catch (\Exception $ex) {
            return redirect()->route('admin.profit.index')->with('error', $ex->getMessage());
        }
    }

}
