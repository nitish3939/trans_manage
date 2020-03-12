<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Carbon\Carbon;
use App\Models\User;
use App\Models\MenuStructure;
use App\Models\AuthorityMenuMapping;
use Illuminate\Support\Facades\Hash;

class SubadminController extends Controller {

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
        return view('admin.sub-admin.index', [
            'js' => $js,
            'css' => $css
        ]);
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
            $query->where("user_type_id", "=", 5);
            if ($searchKeyword) {
                $query->where(function($query) use($searchKeyword) {
                    $query->where("first_name", "LIKE", "%$searchKeyword%")->orWhere("email_id", "LIKE", "%$searchKeyword%");
                });
            }

            $data['recordsTotal'] = $query->count();
            $data['recordsFiltered'] = $query->count();
            $users = $query->take($limit)->offset($offset)->latest()->get();

            $usersArray = [];
            foreach ($users as $key => $user) {
                // $staffResort = UserBookingDetail::where("user_id", $user->id)->first();

                $usersArray[$key]['name'] = $user->first_name . ' '.$user->last_name;
                $usersArray[$key]['email'] = $user->email_id;
                // $usersArray[$key]['resort_name'] = isset($staffResort->resort->name) ? $staffResort->resort->name : 'N/A';
                $checked_status = $user->is_active ? "checked" : '';
                $usersArray[$key]['status'] = "<label class='switch'><input  type='checkbox' class='user_status' id=" . $user->id . " data-status=" . $user->is_active . " " . $checked_status . "><span class='slider round'></span></label>";
                $usersArray[$key]['view-deatil'] = '<a class="btn btn-info btn-xs" href="' . route('admin.subadmin.edit', ['id' => $user->id]) . '"><i class="fa fa-pencil"></i>Edit</a>'
                        . '<a class="btn btn-primary btn-xs" href="' . route('admin.subadmin.change-password', ['id' => $user->id]) . '"><i class="fa fa-pencil"></i>Change Password</a>';
            }

            $data['data'] = $usersArray;
            return $data;
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function addUser(Request $request) {
        try {
            if ($request->isMethod("post")) {
                $existingUser = User::where(["email_id" => $request->email, "user_type_id" => 5])->first();
                if ($existingUser) {
                    return redirect()->route('admin.subadmin.add')->with('error', 'User already exist with this email Id.');
                }
                $user = new User();
                // $name = explode(" ", $request->name);
                $user->password = bcrypt($request->password);
                $user->user_type_id = 5;
                // $user->user_name = $request->name;
                $user->first_name = $request->f_name;
                $user->last_name = $request->l_name;
                $user->email_id = $request->email;
                $user->created_by = 1;
                $user->updated_by = 1;

                if ($user->save()) {
                    // $userBooking = new UserBookingDetail();
                    // $userBooking->source_name = ' ';
                    // $userBooking->source_id = ' ';
                    // $userBooking->user_id = $user->id;
                    // $userBooking->resort_id = $request->resort_id;
                    // $userBooking->package_id = 0;
                    // $userBooking->save();

                    if ($request->menu_ids) {
                        foreach ($request->menu_ids as $menu_id) {
                            $menuMapping = new AuthorityMenuMapping();
                            $menuMapping->user_id = $user->id;
                            $menuMapping->menu_id = $menu_id;
                            $menuMapping->created_by = 1;
                            $menuMapping->save();
                        }
                    }

                    return redirect()->route('admin.subadmin.index')->with('status', 'Subadmin has been created successfully.');
                } else {
                    return redirect()->route('admin.subadmin.add')->with('error', 'Something went be wrong.');
                }
            }

            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];

            $menus = MenuStructure::all();

            return view('admin.sub-admin.add-user', [
                'css' => $css,
                'js' => $js,
                'menus' => $menus,

            ]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.subadmin.index')->with('error', $ex->getMessage());
        }
    }

    public function editUser(Request $request, $id) {
        try {
            $user = User::find($id);
            // $userBooking = UserBookingDetail::where("user_id", $user->id)->first();
            $userAuthorityMapping = AuthorityMenuMapping::where("user_id", $user->id)->pluck("menu_id");
            if ($request->isMethod("post")) {

                $name = explode(" ", $request->name);
//                $user->password = bcrypt($request->password);
                $user->user_type_id = 5;
                // $user->user_name = $request->name;
                $user->first_name = $request->f_name;
                $user->last_name = $request->l_name;
                $user->email_id = $request->email;
                $user->created_by = 1;
                $user->updated_by = 1;

                if ($user->save()) {

                    // $userBooking->source_name = ' ';
                    // $userBooking->source_id = ' ';
                    // $userBooking->user_id = $user->id;
                    // $userBooking->resort_id = $request->resort_id;
                    // $userBooking->package_id = 0;
                    // $userBooking->save();

                    if ($request->menu_ids) {
                        AuthorityMenuMapping::where("user_id", $user->id)->delete();
                        foreach ($request->menu_ids as $menu_id) {
                            $menuMapping = new AuthorityMenuMapping();
                            $menuMapping->user_id = $user->id;
                            $menuMapping->menu_id = $menu_id;
                            $menuMapping->created_by = 1;
                            $menuMapping->save();
                        }
                    }

                    return redirect()->route('admin.subadmin.edit', $user->id)->with('status', 'Subadmin has been updated successfully.');
                } else {
                    return redirect()->route('admin.subadmin.edit', $user->id)->with('error', 'Something went be wrong.');
                }
            }

            $css = [
                "vendors/iCheck/skins/flat/green.css",
            ];
            $js = [
                'vendors/iCheck/icheck.min.js',
            ];
            $menus = MenuStructure::all();
            // $resorts = Resort::where("is_active", 1)->get();
            return view('admin.sub-admin.edit-user', [
                'css' => $css,
                'js' => $js,
                'user' => $user,
                // 'userBooking' => $userBooking,
                'menus' => $menus,
                // 'resorts' => $resorts,
                'userAuthorityMapping' => $userAuthorityMapping->toArray(),
            ]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.subadmin.index')->with('error', $ex->getMessage());
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
                $user = User::findOrFail($request->record_id);
                $user->is_active = $request->status;
                if ($user->save()) {
                    return ['status' => true, 'data' => ["status" => $request->status, "message" => "Status updated successfully"]];
                } else {
                    return ['status' => false, 'message' => "Something went be wrong."];
                }
            } else {
                return ['status' => false, 'message' => "Method not allowed."];
            }
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function changePassword(Request $request, $id) {
        $user = User::find($id);
        if ($request->isMethod("post")) {
            $validator = Validator::make($request->all(), [
                        'new_password' => 'bail|required|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{6,20}$/',
                            ], [
                        'new_password.regex' => "New password must be minimum six character, One numeric digit, One special character, One uppercase and One lowercase letter."
            ]);
            if ($validator->fails()) {
                return redirect()->route('admin.subadmin.change-password')->withErrors($validator);
            }

            if (Hash::check($request->get("old_password"), $user->password)) {
                $user->password = bcrypt($request->get("new_password"));
                $user->save();
                return redirect()->route('admin.subadmin.change-password', $user->id)->with('status', 'Password has been updated successfully.');
            } else {
                return redirect()->route('admin.subadmin.change-password', $user->id)->with('error', 'Old password incorrect.');
            }
        }
        return view('admin.sub-admin.change-password', [
            "user" => $user,
        ]);
    }

}
