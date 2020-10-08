<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;
use Carbon\Carbon;
use App\Models\Trip;

class TripController extends Controller {

    /**
     * @api {post} /api/trip-list  Trip List
     * @apiHeader {String} Accept application/json.
     * @apiName PostTripList
     * @apiGroup Trip
     *
     * @apiParam {String} user_id User Id*.
     *
     * @apiSuccess {String} success true 
     * @apiSuccess {String} status_code (200 => success, 404 => Not found or failed). 
     * @apiSuccess {String}  message Trip List.
     * @apiSuccess {JSON} data response.
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     *  {
     *      "status": true,
     *      "status_code": 200,
     *      "message": "Trip List",
     *      "data": {
     *      "id": 149,
     *      "user_id": 6,
     *      "vehicle_id": 1,
     *      "trip_date": "2020-10-08",
     *      "start_trip": "noida1",
     *      "fuel_entry": "4325",
     *      "end_trip": "patna",
     *      "start_km": "5345",
     *      "end_km": "32532",
     *      "expense_amount": 5325,
     *      "expense_description": "42353",
     *      "amount_spend": 5345,
     *      "end_fuel_entry": "534",
     *      "is_read": 0,
     *      "created_at": "2020-10-08 12:58:24",
     *      "updated_at": "2020-10-08 12:58:24"
     *      }
     *  }
     *  
     * @apiError UserIdMissing The user id is missing.
     * @apiErrorExample Error-Response:
     * HTTP/1.1 404 Not Found
     *  {
     *     "status": false,
     *     "status_code": 404,
     *     "message": "User id missing.",
     *     "data": {}
     *  }
     *  
     * @apiError UserNotFound The User Not Found.
     * @apiErrorExample Error-Response:
     * HTTP/1.1 404 Not Found
     *  {
     *     "status": false,
     *     "status_code": 404,
     *     "message": "User Not Found",
     *     "data": {}
     *  }
     * 
     */   
     public function tripList(Request $request) {
        try {
         
            if (!$request->user_id) {
                return $this->sendErrorResponse("User Id missing.", (object) []);
            }

            $user = User::find($request->user_id);
            if (!$user) {
                return $this->sendErrorResponse("User Not Found", (object) []);
            }

            if ($user->is_active == 0) {
                return $this->sendInactiveAccountResponse();
            }

            $trip = Trip::where('user_id',$user->id)->where('is_read',0)->whereDate('trip_date','=',date('Y-m-d'))->first();
          

            return $this->sendSuccessResponse("Trip List", $trip);
        } catch (\Exception $e) {
            return $this->sendErrorResponse($e->getMessage(), (object) []);
        }
    }

        /**
     * @api {post} /api/status-trip  Status Trip
     * @apiHeader {String} Accept application/json.
     * @apiName PostStatusTrip
     * @apiGroup Trip
     *
     * @apiParam {String} user_id User Id*.
     * @apiParam {String} status Status*(1=>accept , 2=>reject).
     * @apiParam {String} trip_id Trip Id*.
     *
     * @apiSuccess {String} success true 
     * @apiSuccess {String} status_code (200 => success, 404 => Not found or failed). 
     * @apiSuccess {String}  message Trip List.
     * @apiSuccess {JSON} data response.
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     *  {
     *      "status": true,
     *      "status_code": 200,
     *      "message": "Trip List",
     *      "data": {}
     *  }
     *  
     * @apiError UserIdMissing The user id is missing.
     * @apiErrorExample Error-Response:
     * HTTP/1.1 404 Not Found
     *  {
     *     "status": false,
     *     "status_code": 404,
     *     "message": "User id missing.",
     *     "data": {}
     *  }
     *  
     * @apiError UserNotFound The User Not Found.
     * @apiErrorExample Error-Response:
     * HTTP/1.1 404 Not Found
     *  {
     *     "status": false,
     *     "status_code": 404,
     *     "message": "User Not Found",
     *     "data": {}
     *  }
     * 
     */   

    public function statusTrip(Request $request) {
        try {
            if (!$request->status) {
                return $this->sendErrorResponse("Status missing.", (object) []);
            }
            if (!$request->user_id) {
                return $this->sendErrorResponse("User Id missing.", (object) []);
            }
            if (!$request->trip_id) {
                return $this->sendErrorResponse("Trip Id missing.", (object) []);
            }

            $trip = Trip::Where([
                'user_id' => $request->user_id,
                'id' => $request->trip_id,
                'is_read' => 0
            ])->first();
            if (!$trip) {
                return $this->sendErrorResponse("Trip Not Found", (object) []);
            }else{
                $trip->$request->status;
                $trip->save();
              
                return $this->sendSuccessResponse("Status Changed successfully.", (object) []);
            }
           
        } catch (\Exception $e) {
            return $this->sendErrorResponse($e->getMessage(), (object) []);
        }
    }

}
