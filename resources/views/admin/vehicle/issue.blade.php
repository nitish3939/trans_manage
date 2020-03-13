@extends('layouts.admin.app')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('errors.errors-and-messages')
        <div class="x_panel">
            <div class="x_title">
                <h2>Vehicle</h2>
                <div class="pull-right">
                    {{-- <a class="btn btn-success" href="{{ route('admin.vehicle.issueadd',$vehicle->id) }}">Add Issue</a> --}}
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="list" class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>User Name</th>
                            <th>Vehicle No.</th>
                            <th>Issue Date</th>
                            <th>Mechanic Name</th>
                            <th>Total Charge</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($usersArray)
                        @foreach($usersArray as $k => $usersArra)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $usersArra['user_name'] }}</td>
                            <td>{{ $usersArra['vehicle_no'] }}</td>
                            <td>{{ $usersArra['issue_date'] }}</td>
                            <td>{{ $usersArra['mechanic_name'] }}</td>
                            <td>{{ $usersArra['charge'] }}</td>
                            <td>{!! $usersArra['view-deatil'] !!}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
