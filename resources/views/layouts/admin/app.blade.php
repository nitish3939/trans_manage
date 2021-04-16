<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="/img/fav.ico">
        <title>{{ config('app.name') }}</title>

        <!-- Bootstrap -->
        <link href="{{ asset("vendors/bootstrap/dist/css/bootstrap.min.css") }}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset("vendors/font-awesome/css/font-awesome.min.css") }}" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{ asset("vendors/nprogress/nprogress.css") }}" rel="stylesheet">

        <link href="{{ asset("css/admin/custom.css") }}" rel="stylesheet">

        @isset($css)
        @foreach($css as $cs)
        <link href="{{ asset($cs) }}" rel="stylesheet">
        @endforeach
        @endisset


        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>
            var site_url = "{{ url('/admin') }}";
        </script>
        <script type="text/javascript">
            var _baseUrl = "{{ URL::to('/') }}";
        </script>
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
.tile-stats {
    border: none;
    overflow: hidden;
    padding-bottom: 5px;
    border-radius: 3px;
    background: #384773;
    color: #fff;
    padding: 18px 20px 40px 9px;
}

.left_col {
    background: #384773;
}

.nav_title {
    background: #384773;
}

.sidebar-footer {
    background: #384773;
}

.tile-stats:hover .icon i {
    color: rgb(255 255 255 / 41%);
}

.tile-stats h3 {
    color: #ffffff;
    font-weight: 400;
}
img.center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
}
        </style>
    </head>

    <body class="nav-md">
        <div class="overlay">
            <div id="loading-img"></div>
        </div>
        <div class="container body">
            <div class="main_container">
                @include('layouts.admin.header')

                <!-- page content -->
                <div class="right_col" role="main">
                    @yield('header-style')

                    @yield('content')
                </div>
                <!-- /page content -->

                @include('layouts.admin.footer')

            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset("vendors/jquery/dist/jquery.min.js") }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset("vendors/bootstrap/dist/js/bootstrap.min.js") }}"></script>
        <!-- FastClick -->
        <script src="{{ asset("vendors/fastclick/lib/fastclick.js") }}"></script>
        <!-- NProgress -->
        <script src="{{ asset("vendors/nprogress/nprogress.js") }}"></script>
        <!-- Chart.js -->
        <script src="{{ asset("vendors/Chart.js/dist/Chart.min.js") }}"></script>
        <!-- jQuery Sparklines -->
        <script src="{{ asset("vendors/jquery-sparkline/dist/jquery.sparkline.min.js") }}"></script>
        <script src="{{ asset("js/jquery.validate.js") }}"></script>  
        <script src="{{ asset("js/additional.validate.js") }}"></script>  
        <script src="{{ asset("js/admin/bootbox.min.js") }}"></script>  

        <!--         Flot 
                <script src="{{ asset("vendors/Flot/jquery.flot.js") }}"></script>
                <script src="{{ asset("vendors/Flot/jquery.flot.pie.js") }}"></script>
                <script src="{{ asset("vendors/Flot/jquery.flot.time.js") }}"></script>
                <script src="{{ asset("vendors/Flot/jquery.flot.stack.js") }}"></script>
                <script src="{{ asset("vendors/Flot/jquery.flot.resize.js") }}"></script>
                 Flot plugins 
                <script src="{{ asset("vendors/flot.orderbars/js/jquery.flot.orderBars.js") }}"></script>
                <script src="{{ asset("vendors/flot-spline/js/jquery.flot.spline.min.js") }}"></script>
                <script src="{{ asset("vendors/flot.curvedlines/curvedLines.js") }}"></script>
                 DateJS 
                <script src="{{ asset("vendors/DateJS/build/date.js") }}"></script>
                 bootstrap-daterangepicker 
                <script src="{{ asset("vendors/moment/min/moment.min.js") }}"></script>
                <script src="{{ asset("vendors/bootstrap-daterangepicker/daterangepicker.js") }}"></script>-->

        @yield('footer-script')

        <!-- Custom Theme Scripts -->
        <script src="{{ asset("js/admin/custom.js") }}"></script>
        <!-- <script src="{{ asset("js/custom.min.js") }}"></script> -->
        @isset($js)
        @foreach($js as $js)
        <script src="{{ asset($js) }}"></script>
        @endforeach
        @endisset

        @yield('script')

        <script>

            //setup CSRF token for ajax forms
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('change', "#state", function () {
                var state_id = $("#state :selected").val();
                state_id = state_id ? state_id : 0;
                $.ajax({
                    url: _baseUrl + '/admin/city-list/' + state_id,
                    type: 'get',
                    dataType: 'html',
                    beforeSend: function () {
                        $(".overlay").show();
                    },
                    success: function (res) {
                        $(".overlay").hide();
                        $("#city").html(res);
                    }
                });
            })

            function showErrorMessage(msg) {
                $(".msg").addClass("alert-danger");
                $(".msg").html(msg);
                $(".msg").fadeIn();
                setTimeout(function () {
                    $(".msg").fadeOut();
                }, 3000);
            }
            function showSuccessMessage(msg) {
                $(".msg").addClass("alert-success");
                $(".msg").html(msg);
                $(".msg").fadeIn();
                setTimeout(function () {
                    $(".msg").fadeOut();
                }, 3000);
            }

            setTimeout(function () {
                $(".alert").fadeOut();
            }, 3000);
        </script>
    </body>
</html>