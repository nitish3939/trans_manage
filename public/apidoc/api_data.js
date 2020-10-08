define({ "api": [
  {
    "type": "get",
    "url": "/api/logout",
    "title": "Logout",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Users unique access-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>application/json.</p>"
          }
        ]
      }
    },
    "name": "GetLogout",
    "group": "Auth",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status_code",
            "description": "<p>(200 =&gt; success, 404 =&gt; Not found or failed).</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>logout successfully.</p>"
          },
          {
            "group": "Success 200",
            "type": "JSON",
            "optional": false,
            "field": "data",
            "description": "<p>{}.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n  {\n      \"status\": true,\n      \"status_code\": 200,\n      \"message\": \"logout successfully\",\n      \"data\": {}\n  }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/AuthController.php",
    "groupTitle": "Auth"
  },
  {
    "type": "post",
    "url": "/api/verify-otp",
    "title": "Verify OTP",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>application/json.</p>"
          }
        ]
      }
    },
    "name": "PostVerifyOtp",
    "group": "Auth",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "mobile_number",
            "description": "<p>Users mobile number*.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "otp",
            "description": "<p>OTP*.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user_type",
            "description": "<p>User type*. (Staff member =&gt; 2 ).</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "device_id",
            "description": "<p>User device Id (IMEI number)*.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status_code",
            "description": "<p>(200 =&gt; success, 404 =&gt; Not found or failed).</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>OTP verified successfully.</p>"
          },
          {
            "group": "Success 200",
            "type": "JSON",
            "optional": false,
            "field": "data",
            "description": "<p>User detail with unique token.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n     \"status\": true,\n     \"status_code\": 200,\n     \"message\": \"OTP verified successfully.\",\n     \"data\": {\n         \"id\": 149,\n         \"first_name\": \"Om\",\n         \"last_name\": \"hg\",\n         \"otp\": \"7015\",\n         \"user_type_id\": 2,\n         \"email_id\": \"om@mail.com\",\n         \"date_of_birth\": \"2015-10-23\",\n         \"profile_pic_path\": \"http://127.0.0.1:8000/storage/profile_pic/M9eFQWAvpBHyk1e4PDK9WsoYy4Hh5eY2G32tvNi7.jpeg\",\n         \"account_holder_name\": \"Nitish\",\n         \"bank_account_no\": 1234567890000,\n         \"mobile_number\": \"8088080000\",\n         \"bank_name\": \"Sbi\",\n         \"ifsc\": \"Utib00095\",\n         \"address\": \"Noida\",\n         \"password\": null,\n         \"aadhar_id_front\": \"http://127.0.0.1:8000/storage/aadhar/M8UrX3a3MH2T6qVLIRpsiclbsozQYADgt9OerG15.jpeg\",\n          \"aadhar_id_back\": \"http://127.0.0.1:8000/storage/aadhar/seZQhl91k6KvaeBPJmruzjmnBOrW9jaclXl6eQss.jpeg\",\n          \"voter_id\": \"http://127.0.0.1:8000/storage/dl/E51tdtrQyGZvYneWMlytm5vff6svyAyngmtoOMvU.jpeg\",\n         \"device_token\": null,\n         \"device_id\": null,\n         \"latitude\": null,\n         \"longitude\": null,\n         \"is_active\": 1,\n         \"remember_token\": null,\n         \"created_by\": \"1\",\n         \"updated_by\": \"1\",  \n         \"created_at\": \"2020-03-31 12:29:45\",\n         \"updated_at\": \"2020-04-01 14:24:53\"\n     }\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "MobileNumberMissing",
            "description": "<p>The mobile number is missing.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "MobileNumber10Digit",
            "description": "<p>The Mobile number should be 10 digit.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "OTPMissing",
            "description": "<p>The OTP is missing.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserTypeMissing",
            "description": "<p>The User Type is missing.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "InvalidUserType",
            "description": "<p>The user type invalid</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "IncorrectOTP",
            "description": "<p>The OTP or mobile number incorrect.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n {\n    \"status\": false,\n    \"status_code\": 404,\n    \"message\": \"Mobile number missing.\",\n    \"data\": {}\n }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n {\n    \"status\": false,\n    \"status_code\": 404,\n    \"message\": \"Mobile number should be 10 digit.\",\n    \"data\": {}\n }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n {\n    \"status\": false,\n    \"status_code\": 404,\n    \"message\": \"OTP missing.\",\n    \"data\": {}\n }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n {\n    \"status\": false,\n    \"status_code\": 404,\n    \"message\": \"User type missing.\",\n    \"data\": {}\n }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n {\n    \"status\": false,\n    \"status_code\": 404,\n    \"message\": \"User type invalid.\",\n    \"data\": {}\n }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n {\n    \"status\": false,\n    \"status_code\": 404,\n    \"message\": \"OTP or mobile number incorrect.\",\n    \"data\": {}\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/AuthController.php",
    "groupTitle": "Auth"
  },
  {
    "type": "post",
    "url": "/api/status-trip",
    "title": "Status Trip",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>application/json.</p>"
          }
        ]
      }
    },
    "name": "PostStatusTrip",
    "group": "Trip",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>User Id*.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>Status*(1=&gt;accept , 2=&gt;reject).</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "trip_id",
            "description": "<p>Trip Id*.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status_code",
            "description": "<p>(200 =&gt; success, 404 =&gt; Not found or failed).</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Trip List.</p>"
          },
          {
            "group": "Success 200",
            "type": "JSON",
            "optional": false,
            "field": "data",
            "description": "<p>response.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n     \"status\": true,\n     \"status_code\": 200,\n     \"message\": \"Trip List\",\n     \"data\": {}\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserIdMissing",
            "description": "<p>The user id is missing.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The User Not Found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n {\n    \"status\": false,\n    \"status_code\": 404,\n    \"message\": \"User id missing.\",\n    \"data\": {}\n }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n {\n    \"status\": false,\n    \"status_code\": 404,\n    \"message\": \"User Not Found\",\n    \"data\": {}\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/TripController.php",
    "groupTitle": "Trip"
  },
  {
    "type": "post",
    "url": "/api/trip-list",
    "title": "Trip List",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>application/json.</p>"
          }
        ]
      }
    },
    "name": "PostTripList",
    "group": "Trip",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>User Id*.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status_code",
            "description": "<p>(200 =&gt; success, 404 =&gt; Not found or failed).</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Trip List.</p>"
          },
          {
            "group": "Success 200",
            "type": "JSON",
            "optional": false,
            "field": "data",
            "description": "<p>response.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n     \"status\": true,\n     \"status_code\": 200,\n     \"message\": \"Trip List\",\n     \"data\": {\n     \"id\": 149,\n     \"user_id\": 6,\n     \"vehicle_id\": 1,\n     \"trip_date\": \"2020-10-08\",\n     \"start_trip\": \"noida1\",\n     \"fuel_entry\": \"4325\",\n     \"end_trip\": \"patna\",\n     \"start_km\": \"5345\",\n     \"end_km\": \"32532\",\n     \"expense_amount\": 5325,\n     \"expense_description\": \"42353\",\n     \"amount_spend\": 5345,\n     \"end_fuel_entry\": \"534\",\n     \"is_read\": 0,\n     \"created_at\": \"2020-10-08 12:58:24\",\n     \"updated_at\": \"2020-10-08 12:58:24\"\n     }\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserIdMissing",
            "description": "<p>The user id is missing.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserNotFound",
            "description": "<p>The User Not Found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n {\n    \"status\": false,\n    \"status_code\": 404,\n    \"message\": \"User id missing.\",\n    \"data\": {}\n }",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n {\n    \"status\": false,\n    \"status_code\": 404,\n    \"message\": \"User Not Found\",\n    \"data\": {}\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/TripController.php",
    "groupTitle": "Trip"
  },
  {
    "type": "get",
    "url": "/api/get-checkin-detail",
    "title": "Get Check-In detail",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>application/json.</p>"
          }
        ]
      }
    },
    "name": "GetCheckInDetail",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>User id*.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status_code",
            "description": "<p>(200 =&gt; success, 404 =&gt; Not found or failed).</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>User check In detail.</p>"
          },
          {
            "group": "Success 200",
            "type": "JSON",
            "optional": false,
            "field": "data",
            "description": "<p>{}.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n      {\n      \"status\": true,\n      \"status_code\": 200,\n      \"message\": \"User.\",\n      \"data\": {\n      \"checkin_detail\": {\n      \"id\": 149,\n      \"cart_count\": 0,\n      \"user_name\": \"Om\",\n      \"first_name\": \"Om\",\n      \"mid_name\": \"\",\n      \"last_name\": \"\",\n      \"email_id\": \"om@mail.com\",\n      \"user_type_id\": 3,\n      \"is_checked_in\": false,\n      \"address\": \"\",\n      \"state\": \"\",\n      \"city\": \"\",\n      \"pincode\": \"\",\n      \"screen_name\": \"\",\n      \"profile_pic_path\": \"http://127.0.0.1:1234/img/no-image.jpg\",\n      \"mobile_number\": \"8077575835\",\n      \"source_name\": \"GOIBO\",\n      \"source_id\": \"GOIBO123456\",\n      \"resort_room_no\": \"T-2\",\n      \"room_type\": \"Tent\",\n      \"check_in_pin\": 7015,\n      \"check_out_pin\": 3336,\n      \"check_in_date\": \"04-Mar-2019\",\n      \"check_in_time\": \"12:00 AM\",\n      \"check_out_date\": \"30-Mar-2019\",\n      \"check_out_time\": \"10:00 AM\",\n      \"booking_id\": \"GOIBO123456\",\n      \"no_of_guest\": \"1 Adult and 1 Child\",\n      \"guest_detail\": [\n      {\n      \"id\": 23,\n      \"person_name\": \"Ankit\",\n      \"person_age\": \"10\",\n      \"person_type\": \"Child\"\n      },\n      {\n      \"id\": 24,\n      \"person_name\": \"Anshu\",\n      \"person_age\": \"25\",\n      \"person_type\": \"Adult\"\n      }\n      ],\n      \"membership\": {\n      \"membership_id\": \"ABCDE\",\n      \"valid_from\": \"04-Mar-2019 12:00 AM\",\n      \"valid_till\": \"07-Mar-2019 12:00 AM\"\n      },\n      \"resort\": {\n      \"id\": 2,\n      \"name\": \"Dintex\",\n      \"description\": \"<p>Rindex Media Pvt. limited, brings to you Sanjeevani, a naturopathy Centre cradled in the valley of nature, in the beautiful city of Dehradun. Sanjeevani is a centre that not only encompasses the treatment of diabetes but also strives to achieve and helps you maintain optimal levels of health with the help of highly professional staff. The various programs and services such as yoga, meditation, naturopathy, treating diabetes are designed to suit individual needs.</p>\\r\\n\\r\\n<p>At the Centre, you&rsquo;ll get the chance to detox your body&rsquo;s equilibrium and feel the eternal bliss of wellness.As such, our holistic approach sets new standards and we are prepared to meet the challenging health issues of today&rsquo;s Indian society/lifestyle.</p>\",\n      \"amenities\": \"1#2#3#4#5#6#7#8#10\",\n      \"other_amenities\": \"Other Amenity\",\n      \"contact_number\": \"8588936238\",\n      \"other_contact_number\": null,\n      \"address_1\": \"U-701\",\n      \"address_2\": null,\n      \"address_3\": null,\n      \"pincode\": 201301,\n      \"city_id\": 181,\n      \"latitude\": 28.5355,\n      \"longitude\": 77.391,\n      \"is_active\": 1,\n      \"domain_id\": 0,\n      \"created_by\": \"1\",\n      \"updated_by\": \"1\",\n      \"created_at\": \"2018-12-20 21:19:14\",\n      \"updated_at\": \"2019-02-21 08:12:15\",\n      \"deleted_at\": null\n      }\n      }\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserController.php",
    "groupTitle": "User"
  },
  {
    "type": "get",
    "url": "/api/user-counts",
    "title": "User counts",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>application/json.</p>"
          }
        ]
      }
    },
    "name": "GetUserCounts",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>User id*.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status_code",
            "description": "<p>(200 =&gt; success, 404 =&gt; Not found or failed).</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Conts.</p>"
          },
          {
            "group": "Success 200",
            "type": "JSON",
            "optional": false,
            "field": "data",
            "description": "<p>Array.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n  {\n      \"status\": true,\n      \"status_code\": 200,\n      \"message\": \"counts\",\n      \"data\": {\n          \"notification_count\": 0\n      }\n  }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/api/change-password",
    "title": "Change User Password",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Users unique access-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>application/json.</p>"
          }
        ]
      }
    },
    "name": "PostChangePassword",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>User id*.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "new_password",
            "description": "<p>New Password*.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "confirm_password",
            "description": "<p>Confirm Password.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status_code",
            "description": "<p>(200 =&gt; success, 404 =&gt; Not found or failed).</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Password Changed successfully.</p>"
          },
          {
            "group": "Success 200",
            "type": "JSON",
            "optional": false,
            "field": "data",
            "description": "<p>blank object.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n\"status\": true,\n\"message\": \"Password Changed successfully.\",\n\"data\": {}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserIdMissing",
            "description": "<p>The user id was missing.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "InvalidUser",
            "description": "<p>The user is invalid.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "NewPasswordMissing",
            "description": "<p>The new password was missing.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "ConfirmPasswordMissing",
            "description": "<p>The confirm password was missing.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n \"status\": false,\n \"message\": \"User id missing.\",\n \"data\": {}\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n \"status\": false,\n \"message\": \"Invalid user.\",\n \"data\": {}\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n \"status\": false,\n \"message\": \"New Password missing.\",\n \"data\": {}\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n \"status\": false,\n \"message\": \"Confirm Password missing.\",\n \"data\": {}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/api/check-in",
    "title": "Check In user",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Users unique access-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>application/json.</p>"
          }
        ]
      }
    },
    "name": "PostCheckIn",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>User id*.</p>"
          },
          {
            "group": "Parameter",
            "type": "File",
            "optional": false,
            "field": "aadhar_id",
            "description": "<p>User aadhar id document*.</p>"
          },
          {
            "group": "Parameter",
            "type": "File",
            "optional": false,
            "field": "other_aadhar_id",
            "description": "<p>User Other side aadhar id document*.</p>"
          },
          {
            "group": "Parameter",
            "type": "File",
            "optional": false,
            "field": "other_id",
            "description": "<p>User other document.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status_code",
            "description": "<p>(200 =&gt; success, 404 =&gt; Not found or failed).</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>User check-in successfully.</p>"
          },
          {
            "group": "Success 200",
            "type": "JSON",
            "optional": false,
            "field": "data",
            "description": "<p>blank array.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n      {\n      \"status\": true,\n      \"status_code\": 200,\n      \"message\": \"User check-in successfully.\",\n      \"data\": {\n      \"id\": 149,\n      \"discount\": 10,\n      \"salutation_id\": 0,\n      \"user_name\": \"Om\",\n      \"first_name\": \"Om\",\n      \"mid_name\": \"\",\n      \"last_name\": \"\",\n      \"gender\": null,\n      \"user_type_id\": 3,\n      \"designation_id\": 0,\n      \"department_id\": 0,\n      \"city_id\": 0,\n      \"language_id\": 0,\n      \"email_id\": \"om@mail.com\",\n      \"alternate_email_id\": null,\n      \"screen_name\": \"\",\n      \"date_of_joining\": null,\n      \"authority_id\": \"0\",\n      \"user_id_RA\": null,\n      \"date_of_birth\": null,\n      \"profile_pic_path\": \"http://127.0.0.1:1234/img/no-image.jpg\",\n      \"id_card\": null,\n      \"is_user_loked\": 0,\n      \"mobile_number\": \"8077575835\",\n      \"other_contact_number\": null,\n      \"address1\": \"\",\n      \"address2\": null,\n      \"address3\": null,\n      \"pincode\": \"\",\n      \"secuity_question\": null,\n      \"secuity_questio_answer\": null,\n      \"ref_time_zone_id\": null,\n      \"login_expiry_date\": null,\n      \"other_info\": null,\n      \"password\": \"$2y$10$EeEc0jxjDXyE/rH0Ri20lObAg2JjpMBHeOFsYQLo.zmgzG4oF1K/.\",\n      \"remember_token\": null,\n      \"aadhar_id\": \"http://127.0.0.1:1234/storage/aadhar_id/lH9ghKYDYDDrBYstCe7IlJyJbCwVttZuWa0DC7jc.png\",\n      \"other_aadhar_id\": \"http://127.0.0.1:1234/storage/other_aadhar_id/oHBhMKEU8XBLpliH5ja4nRW465iolmRcRRnJg1W6.png\",\n      \"voter_id\": \"http://127.0.0.1:1234/img/no-image.jpg\",\n      \"authorise_amenities_id\": null,\n      \"is_service_authorise\": 0,\n      \"is_meal_authorise\": 0,\n      \"device_token\": \"153dsf45dsf4d5s31f32ds1f32ds1f32ds1f32s\",\n      \"device_type\": \"Android\",\n      \"device_id\": null,\n      \"is_active\": 1,\n      \"domain_id\": 0,\n      \"otp\": \"2062\",\n      \"oath_token\": null,\n      \"created_by\": \"1\",\n      \"updated_by\": \"1\",\n      \"created_at\": \"2019-03-04 10:18:06\",\n      \"updated_at\": \"2019-03-04 12:03:48\",\n      \"is_checked_in\": true\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserIdMissing",
            "description": "<p>The user id missing.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "AadharIdMissing",
            "description": "<p>The aadhar document missing.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "AadharIdNotValidFile",
            "description": "<p>The aadhar document not valid file type.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "OtherIdNotValidFile",
            "description": "<p>The other document not valid file type.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "InvalidUser",
            "description": "<p>This user was invalid.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n \"status\": false,\n \"message\": \"User Id missing.\",\n \"data\": []\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n \"status\": false,\n \"message\": \"Aadhar id missing.\",\n \"data\": []\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n \"status\": false,\n \"message\": \"aadhar id not valid file type.\",\n \"data\": []\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n \"status\": false,\n \"message\": \"other id not valid file type.\",\n \"data\": []\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n \"status\": false,\n \"message\": \"Invalid user.\",\n \"data\": []\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/api/state-city-list",
    "title": "State City list",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>application/json.</p>"
          }
        ]
      }
    },
    "name": "PostStateCity",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "country_id",
            "description": "<p>Country id*.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status_code",
            "description": "<p>(200 =&gt; success, 404 =&gt; Not found or failed).</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>state and city listing.</p>"
          },
          {
            "group": "Success 200",
            "type": "JSON",
            "optional": false,
            "field": "data",
            "description": "<p>state city array.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n  {\n      \"status\": true,\n      \"status_code\": 200,\n      \"message\": \"state and city listing\",\n      \"data\": [\n          {\n              \"id\": 1,\n              \"state_name\": \"Andaman & Nicobar Islands\",\n              \"cities\": [\n                  {\n                      \"id\": 93,\n                      \"city_name\": \"Carnicobar\",\n                      \"state\": null\n                  },\n                  {\n                      \"id\": 149,\n                      \"city_name\": \"Diglipur\",\n                      \"state\": null\n*                   },\n                  {\n                      \"id\": 174,\n                      \"city_name\": \"Ferrargunj\",\n                      \"state\": null\n                  },\n                  {\n                      \"id\": 220,\n                      \"city_name\": \"Hut Bay\",\n                      \"state\": null\n                  },\n                  {\n                      \"id\": 331,\n                      \"city_name\": \"Mayabander\",\n                      \"state\": null\n                  },\n.........",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/api/update-device-token",
    "title": "Update Device Token",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>application/json.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Users unique access-token.</p>"
          }
        ]
      }
    },
    "name": "PostUpdateDeviceToken",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>User id*.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "device_token",
            "description": "<p>Device Token*.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "device_type",
            "description": "<p>Device Type* (Android or Iphone).</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "device_id",
            "description": "<p>Unique Device ID*.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status_code",
            "description": "<p>(200 =&gt; success, 404 =&gt; Not found or failed).</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Device token updated successfully.</p>"
          },
          {
            "group": "Success 200",
            "type": "JSON",
            "optional": false,
            "field": "data",
            "description": "<p>blank object.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n   \"status\": true,\n   \"status_code\": 200,\n   \"message\": \"Device token updated successfully.\",\n   \"data\": {}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/api/update-profile",
    "title": "Update user profile",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Users unique access-token.</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>application/json.</p>"
          }
        ]
      }
    },
    "name": "PostUpdateUserProfile",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>User id*.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "full_name",
            "description": "<p>Full name.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email_id",
            "description": "<p>Email Id.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>Address.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "pincode",
            "description": "<p>Pincode.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "city_id",
            "description": "<p>City id.</p>"
          },
          {
            "group": "Parameter",
            "type": "File",
            "optional": false,
            "field": "profile_pic",
            "description": "<p>Profile Pic.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>true</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status_code",
            "description": "<p>(200 =&gt; success, 404 =&gt; Not found or failed).</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Profile update succesfully.</p>"
          },
          {
            "group": "Success 200",
            "type": "JSON",
            "optional": false,
            "field": "data",
            "description": "<p>blank object.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n      {\n      \"status\": true,\n      \"status_code\": 200,\n      \"message\": \"Profile update succesfully.\",\n      \"data\": {\n      \"id\": 149,\n      \"user_name\": \"Om\",\n      \"first_name\": \"Om\",\n      \"last_name\": \"\",\n      \"email_id\": \"om@mail.com\",\n      \"profile_pic_path\": \"http://127.0.0.1:1234/img/no-image.jpg\",\n      \"address1\": \"\",\n      \"pincode\": \"\",\n      \"city_id\": 0,\n      \"state\": \"\",\n      \"city\": \"\",\n      \"membership_id\": \"ABCDE\",\n      \"valid_from\": \"04-Mar-2019 12:00 AM\",\n      \"valid_till\": \"07-Mar-2019 12:00 AM\"\n      }\n      }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserIdMissing",
            "description": "<p>The user id was missing.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "NotValidFileType",
            "description": "<p>The profile pic not valid file type.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n \"status\": false,\n \"message\": \"User id missing.\",\n \"data\": {}\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n \"status\": false,\n \"message\": \"Profile pic not valid file type.\",\n \"data\": {}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserController.php",
    "groupTitle": "User"
  }
] });
