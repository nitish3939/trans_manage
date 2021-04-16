<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset("img/fav.ico") }}" type="image/x-icon"/>
        <title>{{ config('app.name') }}</title>

        <!-- Bootstrap -->
        <link href="{{ asset("vendors/bootstrap/dist/css/bootstrap.min.css") }}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset("vendors/font-awesome/css/font-awesome.min.css") }}" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{ asset("vendors/nprogress/nprogress.css") }}" rel="stylesheet">
        <!-- Animate.css -->
        <link href="{{ asset("vendors/animate.css/animate.min.css") }}" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="{{ asset("css/admin/custom.css") }}" rel="stylesheet">

        <script src="{{ asset("vendors/jquery/dist/jquery.min.js") }}"></script>
        <script src="{{ asset("vendors/bootstrap/dist/js/bootstrap.min.js") }}"></script>
        <script src="{{ asset("vendors/fastclick/lib/fastclick.js") }}"></script>
        <script src="{{ asset("vendors/nprogress/nprogress.js") }}"></script>
        <script src="{{ asset("vendors/bootstrap-progressbar/bootstrap-progressbar.min.js") }}"></script>
        <script src="{{ asset("vendors/iCheck/icheck.min.js") }}"></script>   
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>   
           <style>
            body {
                color: #353535;
                font-size: 14px;
            }

            .left_col {
                background: #22295a;
            }
            .form-control {
                height: 50px;
                padding: 8px 10px;
            }
            
            .registration_form, .login_form {
                top: 120px;
            }
            .nav_title {
                background: #22295a;
            }

            .sidebar-footer {
                background: #22295a;
            }
            .sidebar-footer a {
                background: #ffffff;
                border-radius: 0px 29px 29px 0px;
            }
            .nav.side-menu>li>a, .nav.child_menu>li>a {
                color: #ffffff;
                font-weight: 400;
            }
            <style>
            .nav.side-menu>li>a {
                margin-bottom: 9px;
            }

            .nav.side-menu>li.current-page, .nav.side-menu>li.active {
                border-right: 5px solid #6ed5eb;
            }

            .nav.side-menu>li.active>a {
                text-shadow: rgb(0 0 0 / 25%) 0 -1px 0;
                background: linear-gradient(#334556, #6ed5eb), #2A3F54;
            }

            .nav-sm .nav.child_menu li.active, .nav-sm .nav.side-menu li.active-sm {
                border-right: 5px solid #6ed5eb;
            }

            .profile_info {
                padding: 17px 14px 15px;
                width: 65%;
                float: left;
            }

            .img-circle.profile_img {
                width: 84%;
                margin-top: 29px;
            }

            .profile_pic {
                width: 20%;
                float: left;
            }

            .btn-success {
                background: #6D9E77;
                border: 1px solid #6D9E77;
            }

            .btn-info {
                color: #fff;
                background-color: #31b0d5;
                border-color: #31b0d5;
            }

            .btn-danger.active.focus, .btn-danger.active:focus, .btn-danger.active:hover, .btn-danger:active.focus, .btn-danger:active:focus, .btn-danger:active:hover, .open>.dropdown-toggle.btn-danger.focus, .open>.dropdown-toggle.btn-danger:focus, .open>.dropdown-toggle.btn-danger:hover {
                color: #fff;
                background-color: #D66A3F;
                border-color: #D66A3F;
            }

            div.dataTables_wrapper div.dataTables_paginate ul.pagination {
                margin: 12px 0;
                white-space: nowrap;
            }

            .login {
                background: #293273;
            }
            .form-control {
    height: 50px;
    padding: 8px 10px;
}

.registration_form, .login_form {
    top: 120px;
}

.login_wrapper {
    max-width: 470px;
}

.animate.form.login_form {
    background: #f9f9f9;
    padding: 16px 32px;
    border-radius: 4px;
}

.form-group {
    margin-bottom: 15px;
}

.login_content form input[type="submit"], #content form .submit {
    float: left;
    padding: 9px 47px;
}
        </style>
    </head>

    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                @yield('content')
            </div>
        </div>
    </body>
</html>
