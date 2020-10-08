<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;
use Carbon\Carbon;
use App\Models\Trip;

class VehicleController extends Controller {

    /**
     * @api {post} /api/vehicle-issue  Vehicle Issue
     * @apiHeader {String} Accept application/json.
     * @apiName PostVehicleIssue
     * @apiGroup Vehicle
     *
     * @apiParam {String} user_id User Id*.
     * @apiParam {String} vehicle_id Vehicle Id*.
     * @apiParam {String} issue_pic Issue Image*.
     *
     * @apiSuccess {String} success true 
     * @apiSuccess {String} status_code (200 => success, 404 => Not found or failed). 
     * @apiSuccess {String} message Image Uploded Sucessfully.
     * @apiSuccess {JSON} data response.
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     *  {
     *      "status": true,
     *      "status_code": 200,
     *      "message": "Image Uploded Sucessfully",
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
     * @apiError VehicleIdMissing The vehicle id is missing.
     * @apiErrorExample Error-Response:
     * HTTP/1.1 404 Not Found
     *  {
     *     "status": false,
     *     "status_code": 404,
     *     "message": "Vehicle id missing.",
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
     public function vehicleIssue(Request $request) {
        try {
         
            if (!$request->user_id) {
                return $this->sendErrorResponse("User Id missing.", (object) []);
            }
            if (!$request->vehicle_id) {
                return $this->sendErrorResponse("Vehicle Id missing.", (object) []);
            }

            $vehicl = Vehicle::find($request->vehicle_id);
            if (!$vehicl) {
                return $this->sendErrorResponse("Vehicle Not Found", (object) []);
            }
            $user = User::find($request->user_id);
            if (!$user) {
                return $this->sendErrorResponse("User Not Found", (object) []);
            }
           
            if ($request->issue_pic) {
                if (!$request->hasFile("issue_pic")) {
                    return $this->errorResponse("Issue pic not valid file type.");
                }
                $issue_pic = $request->file("issue_pic");
                $issue = Storage::disk('public')->put('issue_pic', $issue);
                $issue_file_name = basename($issue);

                $vehicle = new VehicleIssue();
                $vehicle->user_id = $request->user_id;
                $vehicle->vehicle_id = $request->vehicle_id;
                $vehicle->bill_image = $issue_file_name;
                $vehicle->save();
            }

        
            return $this->sendSuccessResponse("Image Uploded Sucessfully",  (object) []);
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
