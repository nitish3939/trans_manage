@extends('layouts.admin.app')

@section('content')

<div class="">
    <div class="row top_tiles">
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-truck"></i></div>
                <div class="count">{{ $activeUser }}</div>
                <h3>Total Vehicles</h3>
                <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
            </div>
        </div>
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="count">{{ $activeStaff }}</div>
                <h3>Driver Staff</h3>
                <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
            </div>
        </div>
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="count">{{ $inactiveUser }}</div>
                <h3>Superviser Staff</h3>
                <!--<p>Lorem ipsum psdea itgum rixt.</p>-->
            </div>
        </div>

    </div>

</div>
@endsection

