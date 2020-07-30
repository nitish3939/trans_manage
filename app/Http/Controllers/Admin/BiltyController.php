<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Trip;
use App\Models\Bilty;
use App\Models\BiltyItem;
use App\Models\Vehicle;
use Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BiltyController extends Controller {

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
        return view('admin.bilty.index', ['js' => $js, 'css' => $css]);
    }

    /**
     * Bilty Listing
     *
     * @param Request $request [handle request]
     * @return pages
     */
    public function biltyList(Request $request) {
        try {
            $offset = $request->get('start') ? $request->get('start') : 0;
            $limit = $request->get('length');
            $searchKeyword = $request->get('search')['value'];
            $query = Bilty::query();
            $query->with(['vehicle','trip']);
            if ($searchKeyword) {
                $query->where(function($query) use($searchKeyword) {
                    $query->where("invoice_no", "LIKE", "%$searchKeyword%");
                });
            }

            $data['recordsTotal'] = $query->count();
            $data['recordsFiltered'] = $query->count();
            $vehicles = $query->take($limit)->offset($offset)->latest()->get();

            $i = 0;
            $usersArray = [];
            foreach ($vehicles as $user) {
                $usersArray[$i]['invoice_no'] = $user->invoice_no;
                $usersArray[$i]['bilty_date'] = $user->created_at->format('d-M-Y');
                $usersArray[$i]['consignee_name'] = $user->consignee_name;
                $usersArray[$i]['vehicle_no'] = $user->vehicle_id?$user->vehicle->vehicle_no:"";
                $usersArray[$i]['eway_bill_no'] = $user->eway_bill_no;
                $usersArray[$i]['amount'] = $user->value;
                $usersArray[$i]['view-deatil'] = '<a class="btn btn-info btn-xs" href="' . route('admin.bilty.edit', ['id' => $user->id]) . '"><i class="fa fa-pencil"></i>Edit</a><a class="btn btn-info btn-xs" href="' . route('admin.bilty.invoice', ['id' => $user->id]) . '"><i class="fa fa-pencil"></i>Invoice</a>';
                $i++;
            }
            $data['data'] = $usersArray;

            return $data;
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function addBilty(Request $request) {
        try {
            if ($request->isMethod("post")) {
                    $bilty = new Bilty();
                    $bilty->trip_id = $request->trip_id;
                    $bilty->consignor_name = $request->consignor_name;
                    $bilty->consignor_address = $request->consignor_address;
                    $bilty->consignor_gst = $request->consignor_gst;
                    $bilty->consignee_name = $request->consignee_name;
                    $bilty->consignee_address = $request->consignee_address;
                    $bilty->consignee_gst = $request->consignee_gst;
                    $bilty->invoice_no = $request->invoice_no;
                    $bilty->eway_bill_no = $request->eway_bill_no;
                    $bilty->value = $request->value;
                    $bilty->charged = $request->charged;
                    $bilty->delivery_at = $request->delivery_at;
                    $bilty->gr_no = $request->gr_no;
                    $bilty->freight = $request->freight;
                    $bilty->waiting = $request->waiting;
                    $bilty->labour = $request->labour;
                    $bilty->toll = $request->toll;
                    $bilty->cgst = $request->cgst;
                    $bilty->sgst = $request->sgst;
                    $bilty->igst = $request->igst;
                    $bilty->g_total = $request->g_total;               

                    if ($bilty->save()) {
                        if (!empty($request->packages) && !empty($request->description) && !empty($request->weight)) {
                            foreach ($request->packages as $key => $packages) {
                                if (!empty($packages) && !empty($request->description[$key])) {
                                 
                                        $items = new BiltyItem();
                                    
                                    $items->bilty_id = $bilty->id;
                                    $items->no_package = $request->packages[$key] ? $request->packages[$key] : ' ';
                                    $items->description = $request->description[$key] ? $request->description[$key] : ' ';
                                    $items->weight =  $request->weight[$key] ? $request->weight[$key] : ' ';
                                    $items->save();
                                }
                            }
                        }
                        return redirect()->route('admin.bilty.index')->with('status', 'Bilty has been added successfully');
                    } else {
                        return redirect()->route('admin.bilty.add')->with('error', 'Something went be wrong.');
                    }
                }


            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            $trips = Trip::all();
            return view('admin.bilty.add', [
                'css' => $css,
                'js' => $js,
                'trips' => $trips,

            ]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.bilty.index')->with('error', $ex->getMessage());
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

    public function generateBuiltyInvoice(Request $request, $booking_id) {
        $bookingDetail = UserBookingDetail::find($booking_id);
//        dd($bookingDetail->toArray());
        if ($bookingDetail) {
            $user = User::find($bookingDetail->user_id);
            $user->load(['payments', 'mealOrders' => function($query) use($user, $bookingDetail) {
                    $query->where(["user_id" => $user->id, "resort_id" => $bookingDetail->resort_id, "booking_id" => $bookingDetail->id])->accepted();
                }]);

            $total = $user->mealOrders->sum('total_amount');
            if ($bookingDetail->booking_amount_type == 2) {
                $total += $bookingDetail->booking_amount;
            }
            $paid = $user->payments->where("resort_id", $bookingDetail->resort_id)->where("booking_id", $bookingDetail->id)->sum('amount');
            $discountPrice = $total;
            if ($user->discount > 0) {
                $discountPrice = number_format(($total - ($total * ($user->discount / 100))), 0, ".", "");
            }
            $discountAmt = number_format(($total * ($user->discount / 100)), 0, ".", "");
            $outstanding = $discountPrice - $paid;

            $html = view('admin.users.booking-invoice-pdf', [
                'user' => $user,
                'bookingDetail' => $bookingDetail,
                'total' => $total,
                'paid' => $paid,
                'discountPrice' => $discountPrice,
                'outstanding' => $outstanding,
                'discountAmt' => $discountAmt,
            ]);
//            return $html;
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($html);
            return $pdf->stream();
        } else {
            
        }
    }

}
