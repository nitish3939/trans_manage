<?php

namespace App\Http\Controllers;

use App\Http\Helper\Common;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Notification;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Facades\FCM;
use App\Models\OauthAccessToken;
use App\Models\User;
use Carbon\Carbon;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests,
        Common;

    public function sendSuccessResponse($message, $data) {
        return response()->json([
                    'status' => true,
                    'status_code' => 200,
                    'message' => $message,
                    'data' => $data
        ]);
    }

    public function sendInactiveAccountResponse() {
        return response()->json([
                    'status' => false,
                    'status_code' => 400,
                    'message' => "Your account has been In-active.Please contact to admin.",
                    'data' => (object) []
        ]);
    }

    public function sendErrorResponse($message, $data, $statusCode = 404) {
        return response()->json([
                    'status' => false,
                    'status_code' => $statusCode,
                    'message' => $message,
                    'data' => $data
        ]);
    }

    public function administratorResponse() {
        return response()->json([
                    'status' => false,
                    'status_code' => 404,
                    'message' => "Something went be wrong. Please contact administrator.",
                    'data' => (object) []
        ]);
    }

    public function androidPushNotification( $title, $message, $token) {
        $clkAction = '';

            //For Staff
            config(['fcm.http.server_key' => 'AAAANGYuCzM:APA91bFKJ5AL4Y1GV5whk9xbwijNT1ut2YbNnSD-IM7QKRux7B0q62PRnwobt6n6PdPlc-SYxoWZIgtU5gjyRxdEsxZB1orH1_J7VCFfWZv5wsbCELZzZv8ZU9sW5y8W_LKNTlmoYavG']);
            config(['fcm.http.sender_id' => '225052592947']);
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20)
                ->setPriority('high');

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($message)
                ->setSound('default');
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData([
            'title' => $title,
            'message' => $message
        ]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        //  $tokens = "erzc_FmUdSQ:APA91bHAcG8FQehCYfcFxt-KQxrVJzpMzStgjXGoPEUGmQk2FB_muNhpd5hs7hI6Oy8WuFyKHEeMUoCMQOGbaQr85JyXSRp6GMzvZH90zvpcowrfQ3vxtNrgunEuoPQZmkGPu6iqCEk7";

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        return $downstreamResponse;
    }

}
