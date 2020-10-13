<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Validator;
use Carbon\Carbon;
use App\Models\Trip;

class AuthController extends Controller {

    /**
     * @api {post} /api/verify-otp  Verify OTP
     * @apiHeader {String} Accept application/json.
     * @apiName PostVerifyOtp
     * @apiGroup Auth
     *
     * @apiParam {String} mobile_number Users mobile number*.
     * @apiParam {String} password password*.
     * @apiParam {String} user_type User type*. (Staff member => 2 ).
     * @apiParam {String} longitude cordinate location.
     * @apiParam {String} latitude cordinate location.
     *  @apiParam {String} fcm_token Token*.
     *
     * @apiSuccess {String} success true 
     * @apiSuccess {String} status_code (200 => success, 404 => Not found or failed). 
     * @apiSuccess {String}   message OTP verified successfully.
     * @apiSuccess {JSON}   data User detail with unique token.
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     *  {
     *      "status": true,
     *      "status_code": 200,
     *      "message": "OTP verified successfully.",
     *      "data": {
     *          "id": 149,
     *          "first_name": "Om",
     *          "last_name": "hg",
     *          "otp": "7015",
     *          "user_type_id": 2,
     *          "email_id": "om@mail.com",
     *          "date_of_birth": "2015-10-23",
     *          "profile_pic_path": "http://127.0.0.1:8000/storage/profile_pic/M9eFQWAvpBHyk1e4PDK9WsoYy4Hh5eY2G32tvNi7.jpeg",
     *          "account_holder_name": "Nitish",
     *          "bank_account_no": 1234567890000,
     *          "mobile_number": "8088080000",
     *          "bank_name": "Sbi",
     *          "ifsc": "Utib00095",
     *          "address": "Noida",
     *          "password": null,
     *          "aadhar_id_front": "http://127.0.0.1:8000/storage/aadhar/M8UrX3a3MH2T6qVLIRpsiclbsozQYADgt9OerG15.jpeg",
     *           "aadhar_id_back": "http://127.0.0.1:8000/storage/aadhar/seZQhl91k6KvaeBPJmruzjmnBOrW9jaclXl6eQss.jpeg",
     *           "voter_id": "http://127.0.0.1:8000/storage/dl/E51tdtrQyGZvYneWMlytm5vff6svyAyngmtoOMvU.jpeg",
     *          "device_token": null,
     *          "device_id": null,
     *          "latitude": null,
     *          "longitude": null,
     *          "is_active": 1,
     *          "remember_token": null,
     *          "created_by": "1",
     *          "updated_by": "1",  
     *          "created_at": "2020-03-31 12:29:45",
     *          "updated_at": "2020-04-01 14:24:53"
     *      }
     *  }
     *  
     * @apiError MobileNumberMissing The mobile number is missing.
     * @apiErrorExample Error-Response:
     * HTTP/1.1 404 Not Found
     *  {
     *     "status": false,
     *     "status_code": 404,
     *     "message": "Mobile number missing.",
     *     "data": {}
     *  }
     *
     * @apiError MobileNumber10Digit The Mobile number should be 10 digit.
     * @apiErrorExample Error-Response:
     * HTTP/1.1 404 Not Found
     *  {
     *     "status": false,
     *     "status_code": 404,
     *     "message": "Mobile number should be 10 digit.",
     *     "data": {}
     *  }
     *  
     * @apiError OTPMissing The OTP is missing.
     * @apiErrorExample Error-Response:
     * HTTP/1.1 404 Not Found
     *  {
     *     "status": false,
     *     "status_code": 404,
     *     "message": "OTP missing.",
     *     "data": {}
     *  }
     * 
     * @apiError UserTypeMissing The User Type is missing.
     * @apiErrorExample Error-Response:
     * HTTP/1.1 404 Not Found
     *  {
     *     "status": false,
     *     "status_code": 404,
     *     "message": "User type missing.",
     *     "data": {}
     *  }
     * 
     * @apiError InvalidUserType The user type invalid 
     * @apiErrorExample Error-Response:
     * HTTP/1.1 404 Not Found
     *  {
     *     "status": false,
     *     "status_code": 404,
     *     "message": "User type invalid.",
     *     "data": {}
     *  }
     * 
     * @apiError IncorrectOTP The OTP or mobile number incorrect.
     * @apiErrorExample Error-Response:
     * HTTP/1.1 404 Not Found
     *  {
     *     "status": false,
     *     "status_code": 404,
     *     "message": "OTP or mobile number incorrect.",
     *     "data": {}
     *  }
     * 
     */   
    public function login(Request $request) {
        try {
            if (!$request->mobile_number) {
                return $this->sendErrorResponse("Mobile number missing.", (object) []);
            }
            if (strlen($request->mobile_number) != 10) {
                return $this->sendErrorResponse("Mobile number should be 10 digit.", (object) []);
            }
            if (!$request->password) {
                return $this->sendErrorResponse("password missing.", (object) []);
            }
            if (!$request->user_type) {
                return $this->sendErrorResponse("User type missing.", (object) []);
            }
            if (!$request->fcm_token) {
                return $this->sendErrorResponse("Token Fcm missing.", (object) []);
            }
            if (!(in_array($request->user_type, [2]))) {
                return $this->sendErrorResponse("User type invalid.", (object) []);
            }

            $credentials = [
                'user_type_id' => $request->user_type,
                'mobile_number' => $request->mobile_number,
                'password' => $request->password
            ];
            if (Auth::attempt($credentials)) {
                $us = User::find($request->user()->id);
                $us->device_token = $request->fcm_token;
                $us->save();
               
            }else{
                return $this->sendErrorResponse("Password or mobile number incorrect.", (object) []);
            }

            if ($request->user()->is_active == 0) {
                return $this->sendInactiveAccountResponse();
            }

            return $this->sendSuccessResponse("Password verified successfully.", $request->user());
        } catch (\Exception $e) {
            return $this->sendErrorResponse($e->getMessage(), (object) []);
        }
    }

    /**
     * @api {get} /api/logout  Logout
     * @apiHeader {String} Accept application/json.
     * @apiName GetLogout
     * @apiGroup Auth
     *
     * @apiSuccess {String} success true 
     * @apiSuccess {String} status_code (200 => success, 404 => Not found or failed). 
     * @apiSuccess {String}   message logout successfully.
     * @apiSuccess {JSON}   data {}.
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     *   {
     *       "status": true,
     *       "status_code": 200,
     *       "message": "logout successfully",
     *       "data": {}
     *   }
     *  
     * 
     */
    public function logout(Request $request) {
        $user = User::find($request->user()->id);
        if ($user) {
            if ($user->user_type_id == 2) {
                $user->device_token = NULL;
                $user->save();
            }
        }
        return $this->sendSuccessResponse("logout successfully", (object) []);
    }

}
