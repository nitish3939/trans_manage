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
use App\Models\Vehicle;
use App\Models\VehicleIssue;
use App\Models\Challan;
use App\Models\Fuel;

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
                $issue = Storage::disk('public')->put('issue_pic', $issue_pic);
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
     * @api {post} /api/fuel-fill  Fuel Fill
     * @apiHeader {String} Accept application/json.
     * @apiName PostFuelFill
     * @apiGroup Vehicle
     *
     * @apiParam {String} user_id User Id*.
     * @apiParam {String} vehicle_id Vehicle Id*.
     * @apiParam {String} trip_id Trip Id*.
     * @apiParam {String} amount Amount*.
     * @apiParam {String} location Location*.
     * @apiParam {String} meter_fuel Meter Fuel*.
     * @apiParam {String} fuel_pic Bill Image*.
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
    public function fuelFill(Request $request) {
        try {
         
            if (!$request->user_id) {
                return $this->sendErrorResponse("User Id missing.", (object) []);
            }
            if (!$request->vehicle_id) {
                return $this->sendErrorResponse("Vehicle Id missing.", (object) []);
            }
            if (!$request->location) {
                return $this->sendErrorResponse("Location missing.", (object) []);
            }
            if (!$request->trip_id) {
                return $this->sendErrorResponse("Trip Id missing.", (object) []);
            }
            if (!$request->meter_fuel) {
                return $this->sendErrorResponse("Meter Fuel missing.", (object) []);
            }
            if (!$request->amount) {
                return $this->sendErrorResponse("Fuel Amount missing.", (object) []);
            }
            $trip = Trip::find($request->trip_id);
            if (!$trip) {
                return $this->sendErrorResponse("Trip Not Found", (object) []);
            }
            $vehicl = Vehicle::find($request->vehicle_id);
            if (!$vehicl) {
                return $this->sendErrorResponse("Vehicle Not Found", (object) []);
            }
            $user = User::find($request->user_id);
            if (!$user) {
                return $this->sendErrorResponse("User Not Found", (object) []);
            }
           
            if ($request->fuel_pic) {
                if (!$request->hasFile("fuel_pic")) {
                    return $this->errorResponse("fuel pic not valid file type.");
                }
                $fuel_pic = $request->file("fuel_pic");
                $fuel = Storage::disk('public')->put('fuel_pic', $fuel_pic);
                $fuel_file_name = basename($fuel);

                $vehicle = new Fuel();
                $vehicle->trip_id = $request->trip_id;
                $vehicle->user_id = $request->user_id;
                $vehicle->vehicle_id = $request->vehicle_id;
                $vehicle->meter_fuel = $request->meter_fuel;
                $vehicle->payment = $request->amount;
                $vehicle->location = $request->location;
                $vehicle->fuel_bill_image = $fuel_file_name;
                $vehicle->save();
            }

        
            return $this->sendSuccessResponse("Image Uploded Sucessfully",  (object) []);
        } catch (\Exception $e) {
            return $this->sendErrorResponse($e->getMessage(), (object) []);
        }
    }

    /**
     * @api {post} /api/trip-challan  Trip Challan
     * @apiHeader {String} Accept application/json.
     * @apiName PostTripChallan
     * @apiGroup Vehicle
     *
     * @apiParam {String} user_id User Id*.
     * @apiParam {String} vehicle_id Vehicle Id*.
     * @apiParam {String} longitude challan place longitude*.
     * @apiParam {String} latitude challan place latitude*.
     * @apiParam {String} challan_place challan place*.
     * @apiParam {String} amount Challan Amount*.
     * @apiParam {String} challan_pic Challan Image*.
     *
     * @apiSuccess {String} success true 
     * @apiSuccess {String} status_code (200 => success, 404 => Not found or failed). 
     * @apiSuccess {String} message Challan Uploded Sucessfully.
     * @apiSuccess {JSON} data response.
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     *  {
     *      "status": true,
     *      "status_code": 200,
     *      "message": "Challan Uploded Sucessfully",
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
    public function tripChallan(Request $request) {
        try {
         
            if (!$request->user_id) {
                return $this->sendErrorResponse("User Id missing.", (object) []);
            }
            if (!$request->vehicle_id) {
                return $this->sendErrorResponse("Vehicle Id missing.", (object) []);
            }
            if (!$request->longitude) {
                return $this->sendErrorResponse("Location missing.", (object) []);
            }
            if (!$request->latitude) {
                return $this->sendErrorResponse("Meter Fuel missing.", (object) []);
            }
            if (!$request->challan_place) {
                return $this->sendErrorResponse("challan Place missing.", (object) []);
            }
            if (!$request->amount) {
                return $this->sendErrorResponse("Fuel Amount missing.", (object) []);
            }
            $vehicl = Vehicle::find($request->vehicle_id);
            if (!$vehicl) {
                return $this->sendErrorResponse("Vehicle Not Found", (object) []);
            }
            $user = User::find($request->user_id);
            if (!$user) {
                return $this->sendErrorResponse("User Not Found", (object) []);
            }
           
            if ($request->challan_pic) {
                if (!$request->hasFile("challan_pic")) {
                    return $this->errorResponse("challan pic not valid file type.");
                }
                $challan_pic = $request->file("challan_pic");
                $challan = Storage::disk('public')->put('challan_pic', $challan_pic);
                $challan_file_name = basename($challan);

                $vehicle = new Challan();
                $vehicle->user_id = $request->user_id;
                $vehicle->vehicle_id = $request->vehicle_id;
                $vehicle->challan_place = $request->challan_place;
                $vehicle->challan_amount = $request->amount;
                $vehicle->longitude = $request->longitude;
                $vehicle->latitude = $request->latitude;
                $vehicle->challan_pic = $challan_file_name;
                $vehicle->save();
            }

        
            return $this->sendSuccessResponse("Challan Uploded Sucessfully",  (object) []);
        } catch (\Exception $e) {
            return $this->sendErrorResponse($e->getMessage(), (object) []);
        }
    }

    /**
     * @api {post} /api/spend-money  Spend Money
     * @apiHeader {String} Accept application/json.
     * @apiName PostSpendMoney
     * @apiGroup Vehicle
     *
     * @apiParam {String} user_id User Id*.
     * @apiParam {String} trip_id Trip Id*.
     * @apiParam {String} expense_description Expense Description*.
     * @apiParam {String} expense_amount Expense Amount*.
     *
     * @apiSuccess {String} success true 
     * @apiSuccess {String} status_code (200 => success, 404 => Not found or failed). 
     * @apiSuccess {String} message Expense Uploded Sucessfully.
     * @apiSuccess {JSON} data response.
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     *  {
     *      "status": true,
     *      "status_code": 200,
     *      "message": "Expense Uploded Sucessfully",
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
     * @apiError TripIdMissing The Trip id is missing.
     * @apiErrorExample Error-Response:
     * HTTP/1.1 404 Not Found
     *  {
     *     "status": false,
     *     "status_code": 404,
     *     "message": "Trip id missing.",
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
    public function spendMoney(Request $request) {
        try {
         
            if (!$request->user_id) {
                return $this->sendErrorResponse("User Id missing.", (object) []);
            }
            if (!$request->trip_id) {
                return $this->sendErrorResponse("Vehicle Id missing.", (object) []);
            }
            if (!$request->expense_description) {
                return $this->sendErrorResponse("expense description missing.", (object) []);
            }
            if (!$request->expense_amount) {
                return $this->sendErrorResponse("expense Amount missing.", (object) []);
            }
        
            $user = User::find($request->user_id);
            if (!$user) {
                return $this->sendErrorResponse("User Not Found", (object) []);
            }
            $trip = Trip::find($request->trip_id);
            if (!$trip) {
                return $this->sendErrorResponse("Trip Not Found", (object) []);
            }else{
         
                $trip->amount_spend = $trip->amount_spend + $request->expense_amount;
                $trip->expense_description = $trip->expense_description .'+'. $request->expense_description;

                $trip->save();
           
            return $this->sendSuccessResponse("Expense Uploded Sucessfully",  (object) []);
            }          
   
        } catch (\Exception $e) {
            return $this->sendErrorResponse($e->getMessage(), (object) []);
        }
    }

}
