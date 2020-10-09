<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

Route::namespace("Api")->group(function () {
    if (\Request::segment(1) == "api") {
        $myfile = fopen(__DIR__ . "/../storage/input_data.txt", "a") or die("Unable to open file!");
        fwrite($myfile, "----------------------------------------------------");
        fwrite($myfile, "\n" . json_encode(date("d-m-Y H:i:s")));
        fwrite($myfile, "\n" . json_encode(\Request::segment(2)));
        fwrite($myfile, "\n" . json_encode($_REQUEST));
        fwrite($myfile, "\n");
        fwrite($myfile, "----------------------------------------------------");
        fwrite($myfile, "\n");
        fwrite($myfile, "----------------------------------------------------");
        fclose($myfile);
    }

    //Send OTP
    Route::post('send-otp', 'AuthController@sendOTP');

    //Verify OTP
    Route::post('verify-otp', 'AuthController@login');

    //Accept Trip
    Route::post('trip-list', 'TripController@tripList');

    //Accept Trip
    Route::post('status-trip', 'TripController@statusTrip');

    //Vehicle Issue
    Route::post('vehicle-issue', 'VehicleController@vehicleIssue');

   //Fuel Fill
   Route::post('fuel-fill', 'VehicleController@fuelFill');

});
