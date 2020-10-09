<?php

namespace App\Http\Controllers\SubAdmin;

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
        return view('subadmin.bilty.index', ['js' => $js, 'css' => $css]);
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
                $usersArray[$i]['view-deatil'] = '<a class="btn btn-info btn-xs" href="' . route('subadmin.bilty.edit', ['id' => $user->id]) . '"><i class="fa fa-pencil"></i>Edit</a><a class="btn btn-info btn-xs" href="' . route('subadmin.bilty.invoice', ['id' => $user->id]) . '"><i class="fa fa-pencil"></i>Invoice</a>';
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
                    $bilty->payment = $request->is_software;
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
                        return redirect()->route('subadmin.bilty.index')->with('status', 'Bilty has been added successfully');
                    } else {
                        return redirect()->route('subadmin.bilty.add')->with('error', 'Something went be wrong.');
                    }
                }


            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            $trips = Trip::all();
            return view('subadmin.bilty.add', [
                'css' => $css,
                'js' => $js,
                'trips' => $trips,

            ]);
        } catch (\Exception $ex) {
            return redirect()->route('subadmin.bilty.index')->with('error', $ex->getMessage());
        }
    }

    public function editBilty(Request $request, $id) {
        $data = Bilty::find($id);
        if ($request->isMethod("post")) {
            $validator = Validator::make($request->all(), [
                        'consignor_name' => 'bail|required',
                        'consignor_address' => 'bail|required',
                        'consignee_gst' => 'bail|required',
                        'consignor_gst' => 'bail|required',
            ]);
            if ($validator->fails()) {
                return redirect()->route('subadmin.bilty.edit', $data->id)->withErrors($validator)->withInput();
            }
            $data->trip_id = $request->trip_id;
            $data->consignor_name = $request->consignor_name;
            $data->consignor_address = $request->consignor_address;
            $data->consignor_gst = $request->consignor_gst;
            $data->consignee_name = $request->consignee_name;
            $data->consignee_address = $request->consignee_address;
            $data->consignee_gst = $request->consignee_gst;
            $data->invoice_no = $request->invoice_no;
            $data->eway_bill_no = $request->eway_bill_no;
            $data->value = $request->value;
            $data->charged = $request->charged;
            $data->delivery_at = $request->delivery_at;
            $data->payment = $request->is_software;
            $data->gr_no = $request->gr_no;
            $data->freight = $request->freight;
            $data->waiting = $request->waiting;
            $data->labour = $request->labour;
            $data->toll = $request->toll;
            $data->cgst = $request->cgst;
            $data->sgst = $request->sgst;
            $data->igst = $request->igst;
            $data->g_total = $request->g_total;  

            if ($data->save()) {
                if (!empty($request->packages) && !empty($request->description) && !empty($request->weight)) {
                    foreach ($request->packages as $key => $packages) {
                        if (!empty($packages) && !empty($request->packages[$key])) {
                            if ($request->record_id[$key]) {
                                $items = BiltyItem::find($request->record_id[$key]);
                            } else {
                                $items = new BiltyItem();
                            }
                            $items->bilty_id = $data->id;
                            $items->no_package = $request->packages[$key] ? $request->packages[$key] : ' ';
                            $items->description = $request->description[$key] ? $request->description[$key] : ' ';
                            $items->weight =  $request->weight[$key] ? $request->weight[$key] : ' ';
                            $items->save();
                        }
                    }
                }
                return redirect()->route('subadmin.bilty.index')->with('status', "Bilty has been updated successfully.");
            } else {
                return redirect()->route('subadmin.bilty.edit', $data->id)->withErrors("Something went be wrong.")->withInput();
            }
        }

        $css = [
            'vendors/bootstrap-daterangepicker/daterangepicker.css',
        ];
        $js = [
            'vendors/moment/min/moment.min.js',
            'vendors/bootstrap-daterangepicker/daterangepicker.js',
            'vendors/datatables.net/js/jquery.dataTables.min.js',
        ];
        $trips = Trip::all();
        $bilty_items = BiltyItem::Where('bilty_id',$data->id)->get();
        return view('subadmin.bilty.edit', [
            'js' => $js,
            'css' => $css,
            'trips' => $trips,
            'bilty_items' => $bilty_items,
            'bilty' => $data,
        ]);
    }

    public function generateBiltyInvoice(Request $request, $id) {
        $bookingDetail = Bilty::find($id);
//        dd($bookingDetail->toArray());
        if ($bookingDetail) {
            $data = Bilty::where('id',$id)->with(['trip','bilty_items'])->first();


            $html = view('subadmin.bilty.invoice-pdf', [
                'data' => $data,
              
            ]);
//            return $html;
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($html);
            return $pdf->stream();
        } else {
            
        }
    }

}
