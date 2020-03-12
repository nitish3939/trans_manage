<?php

namespace App\Http\Controllers\SubAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller {

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(User $user) {
        $this->user = $user;
    }

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
        return view('subadmin.staff.index', ['js' => $js, 'css' => $css]);
    }

    /**
     * Users Listing
     *
     * @param Request $request [handle request]
     * @return pages
     */
    public function usersList(Request $request) {
        try {
            $offset = $request->get('start') ? $request->get('start') : 0;
            $limit = $request->get('length');
            $searchKeyword = $request->get('search')['value'];
            $query = User::query();
            $query->where("user_type_id", "=", 2);
            if ($searchKeyword) {
                $query->where(function($query) use($searchKeyword) {
                    $query->where("first_name", "LIKE", "%$searchKeyword%")->orWhere("email_id", "LIKE", "%$searchKeyword%")->orWhere("mobile_number", "LIKE", "%$searchKeyword%");
                });
            }

            $data['recordsTotal'] = $query->count();
            $data['recordsFiltered'] = $query->count();
            $users = $query->take($limit)->offset($offset)->latest()->get();

            $i = 0;
            $usersArray = [];
            foreach ($users as $user) {
                $usersArray[$i]['name'] = $user->first_name.' '.$user->last_name;
                $usersArray[$i]['email'] = $user->email_id;
                $usersArray[$i]['mobileno'] = $user->mobile_number;
                $checked_status = $user->is_active ? "checked" : '';
                $usersArray[$i]['status'] = "<label class='switch'><input  type='checkbox' class='user_status' id=" . $user->id . " data-status=" . $user->is_active . " " . $checked_status . "><span class='slider round'></span></label>";
                $usersArray[$i]['view-deatil'] = '<a class="btn btn-info btn-xs" href="' . route('subadmin.staff.edit', ['id' => $user->id]) . '"><i class="fa fa-pencil"></i>Edit</a>';
                $i++;
            }

            $data['data'] = $usersArray;
            return $data;
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * [updateUserStatus Update user status]
     * @param  Request $request    [INPUT from web]
     * @param  [INTEGER]  $status [user status either 1 or 0]
     * @return [json]          [e.g  {status:true,data:{status:1 or 0}}]
     */
    public function updateUserStatus(Request $request) {
        try {
            if ($request->isMethod('post')) {
                $user = $this->user->findOrFail($request->record_id);
                $user->is_active = $request->status;
                if ($user->save()) {
                    return ['status' => true, 'data' => ["status" => $request->status, "message" => "Status updated successfully"]];
                }
                return [];
            }
            return [];
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function viewUser(Request $request, $id) {
        try {
            $user = $this->user->find($id);
            return view('subadmin.users.user-detail', ["user" => $user]);
        } catch (Exception $ex) {
            dd($e);
        }
    }

    public function addUser(Request $request) {
        try {
            if ($request->isMethod("post")) {
                $userExist = User::where("mobile_number", $request->staff_mobile_no)
                        ->where("user_type_id", 2)
                        ->first();

                if ($userExist) {
                    return redirect()->route('subadmin.staff.add')->with('error', 'User already exists with this mobile number.');
                } else {
                    $user = $this->user;
                    $user->otp = 9999;
                    // $user->password = bcrypt(9999);
                    $user->user_type_id = 2;
                    $user->first_name = $request->f_name;
                    $user->last_name = $request->l_name;
                    $user->mobile_number = $request->staff_mobile_no;
                    $user->email_id = $request->staff_email;
                    $user->date_of_birth = $request->staff_dob;
                    $user->account_holder_name = $request->account_holder_name;
                    $user->bank_account_no = $request->acc_no;
                    $user->bank_name = $request->bank_name;
                    $user->ifsc = $request->ifsc;
                    $user->address = $request->staff_address;
                    $user->created_by = 1;
                    $user->updated_by = 1;
                    if ($request->hasFile("profile_pic")) {
                        $profile_pic = $request->file("profile_pic");
                        $profile = Storage::disk('public')->put('profile_pic', $profile_pic);
                        $profile_file_name = basename($profile);
                        $user->profile_pic_path = $profile_file_name;
                    }
                    if ($request->hasFile("aadhar_id_front")) {
                        $aadhar_id_front = $request->file("aadhar_id_front");
                        $aadharfront = Storage::disk('public')->put('aadhar', $aadhar_id_front);
                        $aadharfront_file_name = basename($aadharfront);
                        $user->aadhar_id_front = $aadharfront_file_name;
                    }
                    if ($request->hasFile("aadhar_id_back")) {
                        $aadhar_id_back = $request->file("aadhar_id_back");
                        $aadharback = Storage::disk('public')->put('aadhar', $aadhar_id_back);
                        $aadharback_file_name = basename($aadharback);
                        $user->aadhar_id_back = $aadharback_file_name;
                    }
                    if ($request->hasFile("voter_id")) {
                        $voter_id = $request->file("voter_id");
                        $voter = Storage::disk('public')->put('dl', $voter_id);
                        $voter_file_name = basename($voter);
                        $user->voter_id = $voter_file_name;
                    }
                    if ($user->save()) {
                        return redirect()->route('subadmin.staff.index')->with('status', 'Staff has been added successfully');
                    } else {
                        return redirect()->route('subadmin.staff.add')->with('error', 'Something went be wrong.');
                    }
                }
            }

            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            return view('subadmin.staff.add-user', [
                'css' => $css,
                'js' => $js,

            ]);
        } catch (\Exception $ex) {
            return redirect()->route('subadmin.staff.index')->with('error', $ex->getMessage());
        }
    }

    public function editUser(Request $request, $id) {
        try {
            $user = User::find($id);
            if ($request->isMethod("post")) {

                $user->first_name = $request->f_name;
                $user->last_name = $request->l_name;
                $user->mobile_number = $request->staff_mobile_no;
                $user->email_id = $request->staff_email;
                $user->date_of_birth = $request->staff_dob;
                $user->account_holder_name = $request->account_holder_name;
                $user->bank_account_no = $request->acc_no;
                $user->bank_name = $request->bank_name;
                $user->ifsc = $request->ifsc;
                $user->address = $request->staff_address;
                $user->created_by = 1;
                $user->updated_by = 1;
                if ($request->hasFile("profile_pic")) {
                    $profile_pic = $request->file("profile_pic");
                    $profile = Storage::disk('public')->put('profile_pic', $profile_pic);
                    $profile_file_name = basename($profile);
                    $user->profile_pic_path = $profile_file_name;
                }
                if ($request->hasFile("aadhar_id_front")) {
                    $aadhar_id_front = $request->file("aadhar_id_front");
                    $aadharfront = Storage::disk('public')->put('aadhar', $aadhar_id_front);
                    $aadharfront_file_name = basename($aadharfront);
                    $user->aadhar_id_front = $aadharfront_file_name;
                }
                if ($request->hasFile("aadhar_id_back")) {
                    $aadhar_id_back = $request->file("aadhar_id_back");
                    $aadharback = Storage::disk('public')->put('aadhar', $aadhar_id_back);
                    $aadharback_file_name = basename($aadharback);
                    $user->aadhar_id_back = $aadharback_file_name;
                }
                if ($request->hasFile("voter_id")) {
                    $voter_id = $request->file("voter_id");
                    $voter = Storage::disk('public')->put('dl', $voter_id);
                    $voter_file_name = basename($voter);
                    $user->voter_id = $voter_file_name;
                }

                if ($user->save()) {


                    return redirect()->route('subadmin.staff.index')->with('status', 'Staff has been updated successfully.');
                } else {
                    return redirect()->route('subadmin.staff.index', $id)->with('error', 'Something went be wrong.');
                }
            }
            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            return view('subadmin.staff.edit-user', [
                'css' => $css,
                'js' => $js,
                'user' => $user,
                    ]
            );
        } catch (\Exception $ex) {
            return redirect()->route('subadmin.users.index')->with('error', $ex->getMessage());
        }
    }

}
