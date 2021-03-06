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
        Route::post('/delete', 'VehicleController@deleteVehicle')->name('admin.vehicle.delete');
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
     * Balance Sheet
     */
    Route::prefix('balance')->group(function() {
        Route::get('/', 'BalanceController@index')->name('admin.balance.index');
        Route::get('/balance-list', 'BalanceController@balanceList')->name('admin.balance.list');
        Route::match(['get', 'post'], '/add-balance', 'BalanceController@addBalance')->name('admin.balance.add');
        Route::match(['get', 'post'], '/edit/{id}', 'BalanceController@editBalance')->name('admin.balance.edit');
    });

    /**
     * Trading Sheet
     */
    Route::prefix('trading')->group(function() {
        Route::get('/', 'TradingController@index')->name('admin.trading.index');
        Route::get('/trading-list', 'TradingController@tradingList')->name('admin.trading.list');
        Route::match(['get', 'post'], '/add-trading', 'TradingController@addTrading')->name('admin.trading.add');
        Route::match(['get', 'post'], '/edit/{id}', 'TradingController@editTrading')->name('admin.trading.edit');
    });

    /**
     * Profit Sheet
     */
    Route::prefix('profit')->group(function() {
        Route::get('/', 'ProfitController@index')->name('admin.profit.index');
        Route::get('/profit-list', 'ProfitController@profitList')->name('admin.profit.list');
        Route::match(['get', 'post'], '/add-profit', 'ProfitController@addProfit')->name('admin.profit.add');
        Route::match(['get', 'post'], '/edit/{id}', 'ProfitController@editProfit')->name('admin.profit.edit');
    });

    /**
     * Payment Sheet
     */
    Route::prefix('payment')->group(function() {
        Route::get('/', 'PaymentController@index')->name('admin.payment.index');
        Route::get('/payment-list', 'PaymentController@paymentList')->name('admin.payment.list');
        Route::match(['get', 'post'], '/add-payment', 'PaymentController@addPayment')->name('admin.payment.add');
        Route::match(['get', 'post'], '/edit/{id}', 'PaymentController@editPayment')->name('admin.payment.edit');
    });

    /**
     * Income Sheet
     */
    Route::prefix('income')->group(function() {
        Route::get('/', 'IncomeController@index')->name('admin.income.index');
        Route::get('/income-list', 'IncomeController@incomeList')->name('admin.income.list');
        Route::match(['get', 'post'], '/add-income', 'IncomeController@addIncome')->name('admin.income.add');
        Route::match(['get', 'post'], '/edit/{id}', 'IncomeController@editIncome')->name('admin.income.edit');
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
        // Route::match(['get', 'post'], '/fuel/{id}', 'TripController@fuelTrip')->name('admin.trip.fuel');
        Route::match(['get', 'post'], '/edit/{id}', 'TripController@editTrip')->name('admin.trip.edit');
        Route::match(['get', 'post'], '/view/{id}', 'TripController@viewTrip')->name('admin.trip.view');
        Route::match(['get', 'post'], '/fuel/{id}', 'TripController@fuelTrip')->name('admin.trip.fuel');
        Route::match(['get', 'post'], '/fuelView/{id}', 'TripController@fuelViewTrip')->name('admin.trip.fuelView');
    });

   /**
     * Bilty Management
     */
    Route::prefix('bilty')->group(function() {
        Route::get('/', 'BiltyController@index')->name('admin.bilty.index');
        Route::get('/bilty-list', 'BiltyController@biltyList')->name('admin.bilty.list');
        Route::match(['get', 'post'], '/add-bilty', 'BiltyController@addBilty')->name('admin.bilty.add');
        Route::match(['get', 'post'], '/billty/{id}', 'BiltyController@generateBiltyInvoice')->name('admin.bilty.invoice');
        Route::match(['get', 'post'], '/edit/{id}', 'BiltyController@editBilty')->name('admin.bilty.edit');
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
        Route::post('/staff-duty-status', 'StaffController@updateUserDutyStatus')->name('admin.staff.duty-status');
        Route::match(['get', 'post'], '/change-password/{id}', 'StaffController@changePassword')->name('admin.staff.change-password');
        Route::post('/delete', 'StaffController@deleteUser')->name('admin.staff.delete');
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
        Route::get('/notifications-list', 'NotificationController@listNotification')->name('admin.notification.list');
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
     * Balance Sheet
     */
    Route::prefix('balance')->group(function() {
        Route::get('/', 'BalanceController@index')->name('subadmin.balance.index');
        Route::get('/balance-list', 'BalanceController@balanceList')->name('subadmin.balance.list');
        Route::match(['get', 'post'], '/add-balance', 'BalanceController@addBalance')->name('subadmin.balance.add');
        Route::match(['get', 'post'], '/edit/{id}', 'BalanceController@editBalance')->name('subadmin.balance.edit');
    });
  /**
     * Trading Sheet
     */
    Route::prefix('trading')->group(function() {
        Route::get('/', 'TradingController@index')->name('subadmin.trading.index');
        Route::get('/trading-list', 'TradingController@tradingList')->name('subadmin.trading.list');
        Route::match(['get', 'post'], '/add-trading', 'TradingController@addTrading')->name('subadmin.trading.add');
        Route::match(['get', 'post'], '/edit/{id}', 'TradingController@editTrading')->name('subadmin.trading.edit');
    });

    /**
     * Profit Sheet
     */
    Route::prefix('profit')->group(function() {
        Route::get('/', 'ProfitController@index')->name('subadmin.profit.index');
        Route::get('/profit-list', 'ProfitController@profitList')->name('subadmin.profit.list');
        Route::match(['get', 'post'], '/add-profit', 'ProfitController@addProfit')->name('subadmin.profit.add');
        Route::match(['get', 'post'], '/edit/{id}', 'ProfitController@editProfit')->name('subadmin.profit.edit');
    });

    /**
     * Payment Sheet
     */
    Route::prefix('payment')->group(function() {
        Route::get('/', 'PaymentController@index')->name('subadmin.payment.index');
        Route::get('/payment-list', 'PaymentController@paymentList')->name('subadmin.payment.list');
        Route::match(['get', 'post'], '/add-payment', 'PaymentController@addPayment')->name('subadmin.payment.add');
        Route::match(['get', 'post'], '/edit/{id}', 'PaymentController@editPayment')->name('subadmin.payment.edit');
    });

    /**
     * Income Sheet
     */
    Route::prefix('income')->group(function() {
        Route::get('/', 'IncomeController@index')->name('subadmin.income.index');
        Route::get('/income-list', 'IncomeController@incomeList')->name('subadmin.income.list');
        Route::match(['get', 'post'], '/add-income', 'IncomeController@addIncome')->name('subadmin.income.add');
        Route::match(['get', 'post'], '/edit/{id}', 'IncomeController@editIncome')->name('subadmin.income.edit');
    });

    /**
     * Users Management
     */
    Route::get('/users', 'UsersController@index')->name('subadmin.users.index');
    Route::get('/users-list', 'UsersController@usersList')->name('subadmin.users.list');
    Route::post('/user-status', 'UsersController@updateUserStatus')->name('subadmin.users.status');
    Route::match(['get', 'post'], '/user/add-user', 'UsersController@addUser')->name('subadmin.users.add');
    Route::get('/user/detail/{id}', 'UsersController@viewUser')->name('subadmin.users.detail');
    Route::match(['get', 'post'], '/user/edit/{id}', 'UsersController@editUser')->name('subadmin.users.edit');


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
        Route::post('/staff-duty-status', 'StaffController@updateUserDutyStatus')->name('subadmin.staff.duty-status');
        Route::match(['get', 'post'], '/change-password/{id}', 'StaffController@changePassword')->name('subadmin.staff.change-password');
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
     * Trip Management
     */
    Route::prefix('trip')->group(function() {
        Route::get('/', 'TripController@index')->name('subadmin.trip.index');
        Route::get('/trip-list', 'TripController@tripList')->name('subadmin.trip.list');
        Route::match(['get', 'post'], '/add-trip', 'TripController@addTrip')->name('subadmin.trip.add');
        // Route::match(['get', 'post'], '/fuel/{id}', 'TripController@fuelTrip')->name('subadmin.trip.fuel');
        Route::match(['get', 'post'], '/edit/{id}', 'TripController@editTrip')->name('subadmin.trip.edit');
        Route::match(['get', 'post'], '/view/{id}', 'TripController@viewTrip')->name('subadmin.trip.view');
        Route::match(['get', 'post'], '/fuel/{id}', 'TripController@fuelTrip')->name('subadmin.trip.fuel');
        Route::match(['get', 'post'], '/fuelView/{id}', 'TripController@fuelViewTrip')->name('subadmin.trip.fuelView');
    });

      /**
     * Bilty Management
     */
    Route::prefix('bilty')->group(function() {
        Route::get('/', 'BiltyController@index')->name('subadmin.bilty.index');
        Route::get('/bilty-list', 'BiltyController@biltyList')->name('subadmin.bilty.list');
        Route::match(['get', 'post'], '/add-bilty', 'BiltyController@addBilty')->name('subadmin.bilty.add');
        Route::match(['get', 'post'], '/billty/{id}', 'BiltyController@generateBiltyInvoice')->name('subadmin.bilty.invoice');
        Route::match(['get', 'post'], '/edit/{id}', 'BiltyController@editBilty')->name('subadmin.bilty.edit');
    });

    /**
     * Challan Management
     */
    Route::prefix('challan')->group(function() {
        Route::get('/', 'ChallanController@index')->name('subadmin.challan.index');
        Route::get('/challan-list', 'ChallanController@challanList')->name('subadmin.challan.list');
        // Route::match(['get', 'post'], '/add-challan', 'ChallanController@addVehicle')->name('subadmin.challan.add');
        Route::match(['get', 'post'], '/edit/{id}', 'ChallanController@editChallan')->name('subadmin.challan.edit');
    });

    /**
     * Notification Management
     */
    Route::prefix('notification')->group(function() {
        Route::get('/', 'NotificationController@index')->name('subadmin.notification.index');
        Route::get('/notifications-list', 'NotificationController@listNotification')->name('subadmin.notification.list');
    });
});