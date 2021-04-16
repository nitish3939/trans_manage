<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Income;
use Carbon\Carbon;

class IncomeController extends Controller {

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
        return view('admin.income.index', ['js' => $js, 'css' => $css]);
    }

    /**
     * Incomes Listing
     *
     * @param Request $request [handle request]
     * @return pages
     */
    public function incomeList(Request $request) {
        try {
            $offset = $request->get('start') ? $request->get('start') : 0;
            $limit = $request->get('length');
            $searchKeyword = $request->get('search')['value'];
            $query = Income::query();
            // $query->where("user_type_id", "=", 2);
            if ($searchKeyword) {
                // $query->where(function($query) use($searchKeyword) {
                //     $query->where("name", "LIKE", "%$searchKeyword%")->orWhere("company_name", "LIKE", "%$searchKeyword%");
                // });
            }

            $data['recordsTotal'] = $query->count();
            $data['recordsFiltered'] = $query->count();
            $incomes = $query->take($limit)->offset($offset)->latest()->get();

            $i = 0;
            $usersArray = [];
            foreach ($incomes as $user) {

                $usersArray[$i]['month'] = $user->month;
                $usersArray[$i]['debit'] = $user->income_over_expenses + $user->petrol_expenses+ $user->conveyance_expenses;
                $usersArray[$i]['credit'] = $user->income_co;
                $usersArray[$i]['view-deatil'] = '<a class="btn btn-info btn-xs" href="' . route('admin.income.edit', ['id' => $user->id]) . '"><i class="fa fa-pencil"></i>Edit</a>';
                $i++;
            }
            $data['data'] = $usersArray;
            return $data;
        } catch (\Exception $e) {
            dd($e);
        }
    }


    public function addIncome(Request $request) {
        try {
            if ($request->isMethod("post")) {
                    $income = new Income();
                    $income->month = $request->month;
                    $income->year = $request->year;
                    $income->conveyance_expenses = $request->conveyance_expenses;
                    $income->petrol_expenses = $request->petrol_expenses;
                    $income->income_over_expenses = $request->income_over_expenses;
                    $income->income_co = $request->income_co;

                    if ($income->save()) {
                        return redirect()->route('admin.income.index')->with('status', 'Income has been added successfully');
                    } else {
                        return redirect()->route('admin.income.add')->with('error', 'Something went be wrong.');
                    }
                }


            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            return view('admin.income.add', [
                'css' => $css,
                'js' => $js,

            ]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.income.index')->with('error', $ex->getMessage());
        }
    }


    public function editIncome(Request $request, $id) {
        try {
            $income = Income::find($id);
            if ($request->isMethod("post")) {
                $income->month = $request->month;
                $income->year = $request->year;
                $income->conveyance_expenses = $request->conveyance_expenses;
                $income->petrol_expenses = $request->petrol_expenses;
                $income->income_over_expenses = $request->income_over_expenses;
                $income->income_co = $request->income_co;

                if ($income->save()) {


                    return redirect()->route('admin.income.index')->with('status', 'Income has been updated successfully.');
                } else {
                    return redirect()->route('admin.income.index', $id)->with('error', 'Something went be wrong.');
                }
            }
            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            return view('admin.income.edit', [
                'css' => $css,
                'js' => $js,
                'income' => $income,
                    ]
            );
        } catch (\Exception $ex) {
            return redirect()->route('admin.income.index')->with('error', $ex->getMessage());
        }
    }

}
