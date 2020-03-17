<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    return view('welcome');
});
//Route::get('/test', 'Admin\LoginController@test');

Route::namespace("Admin")->prefix('admin')->group(function() {
    Route::get('/', 'LoginController@showLoginForm')->name('admin.login');
    Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'LoginController@login')->name('admin.login');
    Route::get('/logout', 'LoginController@logout')->name('admin.logout');
    Route::post('password/email', 'ForgetController@sendResetLinkEmail')->name('admin.password.email');
    Route::post('password/reset', 'ResetPasswordController@resetPassword')->name('password.reset');
});


Route::namespace("Admin")->prefix('admin')->middleware(['adminGuest'])->group(function() {
    Route::match(['get', 'post'], '/test', 'LoginController@test')->name('admin.test');
    // Route::match(['get', 'post'], '/default-resort', 'DashboardController@defaultResort')->name('admin.resort-list');
    Route::match(['get', 'post'], '/profile', 'LoginController@profile')->name('admin.profile');
    Route::match(['get', 'post'], '/change-password', 'LoginController@changePassword')->name('admin.change-password');
    // Route::get('/city-list/{id}', 'CommonController@getCityList')->name('admin.city.list');
    /**
     * Dashboard & Profile routes
     */
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
    // Route::post('/inventory-detail', 'DashboardController@inventoryDetail')->name('admin.dashboard.inventory');


    /**
     * Users Management
     */
    Route::get('/users', 'UsersController@index')->name('admin.users.index');
    Route::get('/users-list', 'UsersController@usersList')->name('admin.users.list');
    Route::post('/user-status', 'UsersController@updateUserStatus')->name('admin.users.status');
    Route::match(['get', 'post'], '/user/add-user', 'UsersController@addUser')->name('admin.users.add');
    Route::get('/user/detail/{id}', 'UsersController@viewUser')->name('admin.users.detail');
    Route::match(['get', 'post'], '/user/edit/{id}', 'UsersController@editUser')->name('admin.users.edit');
    Route::match(['get', 'post'], '/user/user-order/{id}', 'UsersController@userOrder')->name('admin.users.user-order');
    // Route::post('/user/user-meal-item', 'UsersController@userMealItem')->name('admin.users.user-meal-item');
    // Route::post('/user/user-meal-package', 'UsersController@userMealPackage')->name('admin.users.user-meal-package');
    // Route::post('/user/user-order-create', 'UsersController@userOrderCreate')->name('admin.users.user-order-create');
    // Route::get('payments/{user}', 'UsersController@viewPayments')->name('admin.users.payments');
    // Route::get('payments-invoice/{user}', 'UsersController@generateInvoice')->name('admin.users.invoice');
    // Route::get('booking-invoice/{booking_id}', 'UsersController@generateBookingInvoice')->name('admin.users.booking-invoice');
    // Route::match(['get', 'post'], 'payments/{user}', 'UsersController@viewPayments')->name('admin.users.payments');
    // Route::post('pay-outstanding', 'UsersController@payOutstading')->name('admin.users.pay_outstanding');
    // Route::get('user-booking/{id}', 'UsersController@booking')->name('admin.users.booking');
    // Route::get('user-booking-list/{id}', 'UsersController@bookingList')->name('admin.users.booking-list');
    // Route::match(['get', 'post'], 'user-booking-create/{id}', 'UsersController@bookingCreate')->name('admin.users.booking-create');
    // Route::match(['get', 'post'], 'user-booking-edit/{id}', 'UsersController@bookingEdit')->name('admin.users.booking-edit');
    // Route::match(['get', 'post'], 'user-booking-verify/{id}', 'UsersController@verifyBooking')->name('admin.users.booking-verify');
    // Route::match(['get', 'post'], 'user-early-checkout/{id}', 'UsersController@earlyCheckout')->name('admin.users.early-checkout');

    /**
     * Vehicle Management
     */
    Route::prefix('vehicle')->group(function() {
        Route::get('/', 'VehicleController@index')->name('admin.vehicle.index');
        Route::get('/vehicle-list', 'VehicleController@vehicleList')->name('admin.vehicle.list');
        Route::match(['get', 'post'], '/add-vehicle', 'VehicleController@addVehicle')->name('admin.vehicle.add');
        Route::match(['get', 'post'], '/edit/{id}', 'VehicleController@editVehicle')->name('admin.vehicle.edit');
        Route::match(['get', 'post'], '/issue/{id}', 'VehicleController@issueVehicle')->name('admin.vehicle.issue');
        Route::match(['get', 'post'], '/issueView/{id}', 'VehicleController@issueViewVehicle')->name('admin.vehicle.issueView');
    });

    /**
     * Challan Management
     */
    Route::prefix('challan')->group(function() {
        Route::get('/', 'ChallanController@index')->name('admin.challan.index');
        Route::get('/challan-list', 'ChallanController@challanList')->name('admin.challan.list');
        // Route::match(['get', 'post'], '/add-challan', 'ChallanController@addVehicle')->name('admin.challan.add');
        Route::match(['get', 'post'], '/edit/{id}', 'ChallanController@editChallan')->name('admin.challan.edit');
    });

    /**
     * Client Management
     */
    Route::prefix('client')->group(function() {
        Route::get('/', 'ClientController@index')->name('admin.client.index');
        Route::get('/client-list', 'ClientController@clientList')->name('admin.client.list');
        Route::match(['get', 'post'], '/add-client', 'ClientController@addClient')->name('admin.client.add');
        Route::match(['get', 'post'], '/edit/{id}', 'ClientController@editClient')->name('admin.client.edit');
    });

   /**
     * Trip Management
     */
    Route::prefix('trip')->group(function() {
        Route::get('/', 'TripController@index')->name('admin.trip.index');
        Route::get('/trip-list', 'TripController@tripList')->name('admin.trip.list');
        Route::match(['get', 'post'], '/add-trip', 'TripController@addTrip')->name('admin.trip.add');
        Route::match(['get', 'post'], '/edit/{id}', 'TripController@editTrip')->name('admin.trip.edit');
    });


    /**
     * Staff Management
     */
    Route::prefix('staff')->group(function() {
        Route::get('/', 'StaffController@index')->name('admin.staff.index');
        Route::get('/staff-list', 'StaffController@usersList')->name('admin.staff.list');
        Route::post('/staff-status', 'StaffController@updateUserStatus')->name('admin.staff.status');
        Route::match(['get', 'post'], '/add-staff', 'StaffController@addUser')->name('admin.staff.add');
        Route::get('/staff-detail/{id}', 'StaffController@viewUser')->name('admin.staff.detail');
        Route::match(['get', 'post'], '/edit/{id}', 'StaffController@editUser')->name('admin.staff.edit');
        // Route::post('/amenity-list', 'StaffController@getAmenities')->name('admin.staff.amenity-list');
        Route::post('/staff-duty-status', 'StaffController@updateUserDutyStatus')->name('admin.staff.duty-status');
    });
    /**
     * Sub-Admin Management
     */
    Route::prefix('subadmin-user')->group(function() {
        Route::get('/', 'SubadminController@index')->name('admin.subadmin.index');
        Route::get('/subadmin-list', 'SubadminController@usersList')->name('admin.subadmin.list');
        Route::post('/subadmin-status', 'SubadminController@updateUserStatus')->name('admin.subadmin.status');
        Route::match(['get', 'post'], '/add-subadmin', 'SubadminController@addUser')->name('admin.subadmin.add');
        Route::get('/staff-detail/{id}', 'SubadminController@viewUser')->name('admin.subadmin.detail');
        Route::match(['get', 'post'], '/edit/{id}', 'SubadminController@editUser')->name('admin.subadmin.edit');
        // Route::post('/amenity-list', 'SubadminController@getAmenities')->name('admin.subadmin.amenity-list');
        Route::match(['get', 'post'], '/change-password/{id}', 'SubadminController@changePassword')->name('admin.subadmin.change-password');
    });
    /**
     * Notification Management
     */
    Route::prefix('notification')->group(function() {
        Route::get('/', 'NotificationController@index')->name('admin.notification.index');
        Route::post('/send-notification', 'NotificationController@sendNotification')->name('admin.notification.send');
        Route::get('/notifications-list', 'NotificationController@listNotification')->name('subadmin.notification.list');
    });
});


Route::namespace("SubAdmin")->prefix('sub-admin')->group(function() {
    Route::get('/', 'LoginController@showLoginForm')->name('subadmin.login');
    Route::get('/login', 'LoginController@showLoginForm')->name('subadmin.login');
    Route::post('/login', 'LoginController@login')->name('subadmin.login');
    Route::get('/logout', 'LoginController@logout')->name('subadmin.logout');
    Route::post('password/email', 'ForgetController@sendResetLinkEmail')->name('subadmin.password.email');
    Route::post('password/reset', 'ResetPasswordController@resetPassword')->name('subadmin.password.reset');
});


Route::namespace("SubAdmin")->prefix('sub-admin')->middleware(['subadminGuest'])->group(function() {
    Route::match(['get', 'post'], '/profile', 'LoginController@profile')->name('subadmin.profile');
    Route::match(['get', 'post'], '/change-password', 'LoginController@changePassword')->name('subadmin.change-password');
    // Route::get('/city-list/{id}', 'CommonController@getCityList')->name('subadmin.city.list');


    /**
     * Dashboard & Profile routes
     */
    Route::get('/dashboard', 'DashboardController@index')->name('subadmin.dashboard');
    // Route::post('/inventory-detail', 'DashboardController@inventoryDetail')->name('subadmin.dashboard.inventory');


    /**
     * Users Management
     */
    Route::get('/users', 'UsersController@index')->name('subadmin.users.index');
    Route::get('/users-list', 'UsersController@usersList')->name('subadmin.users.list');
    Route::post('/user-status', 'UsersController@updateUserStatus')->name('subadmin.users.status');
    Route::match(['get', 'post'], '/user/add-user', 'UsersController@addUser')->name('subadmin.users.add');
    Route::get('/user/detail/{id}', 'UsersController@viewUser')->name('subadmin.users.detail');
    Route::match(['get', 'post'], '/user/edit/{id}', 'UsersController@editUser')->name('subadmin.users.edit');
    // Route::get('payments/{user}', 'UsersController@viewPayments')->name('subadmin.users.payments');
    // Route::post('pay-outstanding', 'UsersController@payOutstading')->name('subadmin.users.pay_outstanding');
    // Route::get('user-booking/{id}', 'UsersController@booking')->name('subadmin.users.booking');
    // Route::get('user-booking-list/{id}', 'UsersController@bookingList')->name('subadmin.users.booking-list');
    // Route::match(['get', 'post'], 'user-booking-create/{id}', 'UsersController@bookingCreate')->name('subadmin.users.booking-create');
    // Route::match(['get', 'post'], 'user-booking-edit/{id}', 'UsersController@bookingEdit')->name('subadmin.users.booking-edit');
    // Route::match(['get', 'post'], 'user-booking-verify/{id}', 'UsersController@verifyBooking')->name('subadmin.users.booking-verify');
    // Route::get('user-detail/{mobile_number}', 'UsersController@getUserDetail')->name('subadmin.users.booking-detail');
    // Route::match(['get', 'post'], 'user-early-checkout/{id}', 'UsersController@earlyCheckout')->name('subadmin.users.early-checkout');
    // Route::match(['get', 'post'], '/user/user-order/{id}', 'UsersController@userOrder')->name('subadmin.users.user-order');
    // Route::post('/user/user-meal-item', 'UsersController@userMealItem')->name('subadmin.users.user-meal-item');
    // Route::post('/user/user-meal-package', 'UsersController@userMealPackage')->name('subadmin.users.user-meal-package');
    // Route::post('/user/user-order-create', 'UsersController@userOrderCreate')->name('subadmin.users.user-order-create');
    // Route::get('payments-invoice/{user}', 'UsersController@generateInvoice')->name('subadmin.users.invoice');
    // Route::get('booking-invoice/{booking_id}', 'UsersController@generateBookingInvoice')->name('subadmin.users.booking-invoice');

    /**
     * Staff Management
     */
    Route::prefix('staff')->group(function() {
        Route::get('/', 'StaffController@index')->name('subadmin.staff.index');
        Route::get('/staff-list', 'StaffController@usersList')->name('subadmin.staff.list');
        Route::post('/staff-status', 'StaffController@updateUserStatus')->name('subadmin.staff.status');
        Route::match(['get', 'post'], '/add-staff', 'StaffController@addUser')->name('subadmin.staff.add');
        Route::get('/staff-detail/{id}', 'StaffController@viewUser')->name('subadmin.staff.detail');
        Route::match(['get', 'post'], '/edit/{id}', 'StaffController@editUser')->name('subadmin.staff.edit');
        // Route::post('/amenity-list', 'StaffController@getAmenities')->name('subadmin.staff.amenity-list');
        Route::post('/staff-duty-status', 'StaffController@updateUserDutyStatus')->name('admin.staff.duty-status');
    });

           /**
     * Vehicle Management
     */
    // Route::prefix('vehicle')->group(function() {
    //     Route::get('/', 'VehicleController@index')->name('admin.vehicle.index');
    //     Route::get('/vehicle-list', 'VehicleController@vehicleList')->name('admin.vehicle.list');
    //     Route::match(['get', 'post'], '/add-vehicle', 'VehicleController@addVehicle')->name('admin.vehicle.add');
    //     Route::match(['get', 'post'], '/edit/{id}', 'VehicleController@editVehicle')->name('admin.vehicle.edit');
    // });

        /**
     * Vehicle Management
     */
    Route::prefix('vehicle')->group(function() {
        Route::get('/', 'VehicleController@index')->name('subadmin.vehicle.index');
        Route::get('/vehicle-list', 'VehicleController@vehicleList')->name('subadmin.vehicle.list');
        Route::match(['get', 'post'], '/add-vehicle', 'VehicleController@addVehicle')->name('subadmin.vehicle.add');
        Route::match(['get', 'post'], '/edit/{id}', 'VehicleController@editVehicle')->name('subadmin.vehicle.edit');
        Route::match(['get', 'post'], '/issue/{id}', 'VehicleController@issueVehicle')->name('subadmin.vehicle.issue');
        Route::match(['get', 'post'], '/issueView/{id}', 'VehicleController@issueViewVehicle')->name('subadmin.vehicle.issueView');
    });

    /**
     * Notification Management
     */
    Route::prefix('notification')->group(function() {
        Route::get('/', 'NotificationController@index')->name('subadmin.notification.index');
        Route::post('/send-notification', 'NotificationController@sendNotification')->name('subadmin.notification.send');
    });
});


