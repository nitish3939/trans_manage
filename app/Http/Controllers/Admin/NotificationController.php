<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AdminNotification;
use Carbon\Carbon;

class NotificationController extends Controller {

    public function index() {
        $css = [
            'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
            "vendors/iCheck/skins/flat/green.css",
        ];
        $js = [
            'vendors/datatables.net/js/jquery.dataTables.min.js',
            'vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
            'vendors/iCheck/icheck.min.js',
        ];

        $users = User::where("is_active", 1)->where('user_type_id', '=', 3)->get();
        return view('admin.notification.index', [
            'users' => $users,
            'css' => $css,
            'js' => $js,
        ]);
    }

    public function sendNotification(Request $request) {
        $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'message' => 'required',
                    'notify_user' => 'required_if:user_type,2',
                    'user_type' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendErrorResponse($validator->errors()->all()[0], (object) [], 200);
        }

        $tokens = User::where('user_type_id', '=', 3)
                        ->where("device_token", '!=', null)
                        ->when($request->user_type == 2, function($query) use($request) {
                            return $query->whereIn('id', $request->notify_user);
                        })
                        ->when($request->user_type == 3, function($query) use($request) {
                            return $query->where('is_active', 1);
                        })
                        ->pluck("device_token")->toArray();
        if (count($tokens)) {
            $this->androidPushNotification(3, $request->title, $request->message, $tokens, 123, 0);
        }

        $userIds = User::where('user_type_id', '=', 3)
                        ->where("device_token", '!=', null)
                        ->when($request->user_type == 2, function($query) use($request) {
                            return $query->whereIn('id', $request->notify_user);
                        })
                        ->when($request->user_type == 3, function($query) use($request) {
                            return $query->where('is_active', 1);
                        })
                        ->pluck("id")->toArray();
        foreach ($userIds as $userId) {
            $this->generateNotification($userId, "$request->title", $request->message, 5);
        }
        $adminNotification = new AdminNotification();
        $adminNotification->title = $request->title;
        $adminNotification->message = $request->message;
        $adminNotification->save();
        return $this->sendSuccessResponse("Notification send successfully", (object) [], 200);
    }

    public function listNotification(Request $request) {
        try {
            $offset = $request->get('start') ? $request->get('start') : 0;
            $limit = $request->get('length');
            $searchKeyword = $request->get('search')['value'];

            $query = AdminNotification::query();
            if ($searchKeyword) {
                $query->where("title", "LIKE", "%$searchKeyword%")
                        ->orWhere("message", "LIKE", "%$searchKeyword%");
            }
            $data['recordsTotal'] = $query->count();
            $data['recordsFiltered'] = $query->count();
            $notifications = $query->take($limit)->offset($offset)->latest()->get();

            $notificationsArray = [];
            foreach ($notifications as $k => $notification) {
                $created_at = Carbon::parse($notification->created_at);
                $notificationsArray[$k]['title'] = $notification->title;
                $notificationsArray[$k]['message'] = $notification->message;
                $notificationsArray[$k]['created_at'] = $created_at->format('d-m-Y H:i a');
            }

            $data['data'] = $notificationsArray;
            return $data;
        } catch (\Exception $e) {
            dd($e);
        }
    }

}
