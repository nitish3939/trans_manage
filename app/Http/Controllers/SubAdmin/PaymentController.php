<?php

namespace App\Http\Controllers\SubAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use Carbon\Carbon;

class PaymentController extends Controller {

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
        return view('subadmin.payment.index', ['js' => $js, 'css' => $css]);
    }

    /**
     * Payments Listing
     *
     * @param Request $request [handle request]
     * @return pages
     */
    public function paymentList(Request $request) {
        try {
            $offset = $request->get('start') ? $request->get('start') : 0;
            $limit = $request->get('length');
            $searchKeyword = $request->get('search')['value'];
            $query = Payment::query();
            // $query->where("user_type_id", "=", 2);
            if ($searchKeyword) {
                // $query->where(function($query) use($searchKeyword) {
                //     $query->where("name", "LIKE", "%$searchKeyword%")->orWhere("company_name", "LIKE", "%$searchKeyword%");
                // });
            }

            $data['recordsTotal'] = $query->count();
            $data['recordsFiltered'] = $query->count();
            $payments = $query->take($limit)->offset($offset)->latest()->get();

            $i = 0;
            $usersArray = [];
            foreach ($payments as $user) {

                $usersArray[$i]['month'] = $user->month;
                $usersArray[$i]['cashin'] = $user->opening_cashin + $user->sundry_debtors_cashin+ $user->sundry_creditors_cashin;
                $usersArray[$i]['cashout'] = $user->sundry_debtors_cashout + $user->sundry_creditors_cashout+ $user->expenses+ $user->closing_balances;
                $usersArray[$i]['view-deatil'] = '<a class="btn btn-info btn-xs" href="' . route('subadmin.payment.edit', ['id' => $user->id]) . '"><i class="fa fa-pencil"></i>Edit</a>';
                $i++;
            }
            $data['data'] = $usersArray;
            return $data;
        } catch (\Exception $e) {
            dd($e);
        }
    }


    public function addPayment(Request $request) {
        try {
            if ($request->isMethod("post")) {
                    $payment = new Payment();
                    $payment->month = $request->month;
                    $payment->year = $request->year;
                    $payment->opening_cashin = $request->opening_cashin;
                    $payment->sundry_debtors_cashin = $request->sundry_debtors_cashin;
                    $payment->sundry_creditors_cashin = $request->sundry_creditors_cashin;
                    $payment->sundry_debtors_cashout = $request->sundry_debtors_cashout;
                    $payment->sundry_creditors_cashout = $request->sundry_creditors_cashout;
                    $payment->expenses = $request->expenses;
                    $payment->closing_balances = $request->closing_balances;

                    if ($payment->save()) {
                        return redirect()->route('subadmin.payment.index')->with('status', 'Payment has been added successfully');
                    } else {
                        return redirect()->route('subadmin.payment.add')->with('error', 'Something went be wrong.');
                    }
                }


            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            return view('subadmin.payment.add', [
                'css' => $css,
                'js' => $js,

            ]);
        } catch (\Exception $ex) {
            return redirect()->route('subadmin.payment.index')->with('error', $ex->getMessage());
        }
    }


    public function editPayment(Request $request, $id) {
        try {
            $payment = Payment::find($id);
            if ($request->isMethod("post")) {
                $payment->month = $request->month;
                $payment->year = $request->year;
                $payment->opening_cashin = $request->opening_cashin;
                $payment->sundry_debtors_cashin = $request->sundry_debtors_cashin;
                $payment->sundry_creditors_cashin = $request->sundry_creditors_cashin;
                $payment->sundry_debtors_cashout = $request->sundry_debtors_cashout;
                $payment->sundry_creditors_cashout = $request->sundry_creditors_cashout;
                $payment->expenses = $request->expenses;
                $payment->closing_balances = $request->closing_balances;

                if ($payment->save()) {


                    return redirect()->route('subadmin.payment.index')->with('status', 'Payment has been updated successfully.');
                } else {
                    return redirect()->route('subadmin.payment.index', $id)->with('error', 'Something went be wrong.');
                }
            }
            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            return view('subadmin.payment.edit', [
                'css' => $css,
                'js' => $js,
                'payment' => $payment,
                    ]
            );
        } catch (\Exception $ex) {
            return redirect()->route('subadmin.payment.index')->with('error', $ex->getMessage());
        }
    }

}
