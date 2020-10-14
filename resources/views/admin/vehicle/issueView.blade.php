@extends('layouts.admin.app')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Vehicle Issue Detail</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form class="form-horizontal form-label-left" action="{{ route('admin.vehicle.issueView',$vehicle->id) }}" method="post" id="addStaffForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Staff Name</label>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <input type="text" class="form-control" value="{{$user->first_name}}" disabled >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Vehicle Number</label>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <input type="text" class="form-control" value="{{$veh->vehicle_no}}" disabled >
                            </div>
                        </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Issue Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" value="{{$vehicle->issue_date}}" disabled >
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Issue Name</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="Issue Name" name="issue_name" id="issue_name" value="{{$vehicle->issue_name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Mechanic Name</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="Mechanic Name" value="{{$vehicle->mechnic_name}}" name="mechanic" id="mechanic">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Labour Charge</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" name="labour_charge" id="labour_charge" value="{{$vehicle->labour_charge}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Charge</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" name="total_charge" id="total_charge" value="{{$vehicle->total_charge}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Bill Image</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control" type="file" name="bill_image" id="bill_image" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Bill preview</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <a href="{{$vehicle->bill_image }}" target="_blank"><img style="width: 100px; height: 100px;" src="{{ $vehicle->bill_image }}" ></a>
                        </div>
                    </div>
                    <table id="list" class="table table-striped table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Sr.No.</th>
                                <th>Damage Part Name</th>
                                <th>Cost Per Part</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>{{ 1 }}</td>
                                <td><input type="text" class="form-control" name="damage_part_name_1" id="damage_part_name_1" value="{{ $vehicle->damage_part_name_1 }}"></td>
                                <td><input type="number" class="form-control" name="cost_part_1" id="cost_part_1" value="{{ $vehicle->cost_part_1 }}"></td>
                            </tr>

                            <tr>
                                <td>{{ 2 }}</td>
                                <td><input type="text" class="form-control" name="damage_part_name_2" id="damage_part_name_2" value="{{ $vehicle->damage_part_name_2 }}"></td>
                                <td><input type="number" class="form-control" name="cost_part_2" id="cost_part_2" value="{{ $vehicle->cost_part_2 }}"></td>
                            </tr>

                            <tr>
                                <td>{{ 3 }}</td>
                                <td><input type="text" class="form-control" name="damage_part_name_3" id="damage_part_name_3" value="{{ $vehicle->damage_part_name_3 }}"></td>
                                <td><input type="number" class="form-control" name="cost_part_3" id="cost_part_3" value="{{ $vehicle->cost_part_3 }}"></td>
                            </tr>

                            <tr>
                                <td>{{ 4 }}</td>
                                <td><input type="text" class="form-control" name="damage_part_name_4" id="damage_part_name_4" value="{{ $vehicle->damage_part_name_4 }}"></td>
                                <td><input type="number" class="form-control" name="cost_part_4" id="cost_part_4" value="{{ $vehicle->cost_part_4 }}"></td>
                            </tr>

                            <tr>
                                <td>{{ 5 }}</td>
                                <td><input type="text" class="form-control" name="damage_part_name_5" id="damage_part_name_5" value="{{ $vehicle->damage_part_name_5 }}"></td>
                                <td><input type="number" class="form-control" name="cost_part_5" id="cost_part_5" value="{{ $vehicle->cost_part_5 }}"></td>
                            </tr>

                            <tr>
                                <td>{{ 6 }}</td>
                                <td><input type="text" class="form-control" name="damage_part_name_6" id="damage_part_name_6" value="{{ $vehicle->damage_part_name_6 }}"></td>
                                <td><input type="number" class="form-control" name="cost_part_6" id="cost_part_6" value="{{ $vehicle->cost_part_6 }}"></td>
                            </tr>

                            <tr>
                                <td>{{ 7 }}</td>
                                <td><input type="text" class="form-control" name="damage_part_name_7" id="damage_part_name_7" value="{{ $vehicle->damage_part_name_7 }}"></td>
                                <td><input type="number" class="form-control" name="cost_part_7" id="cost_part_7" value="{{ $vehicle->cost_part_7 }}"></td>
                            </tr>

                            <tr>
                                <td>{{ 8 }}</td>
                                <td><input type="text" class="form-control" name="damage_part_name_8" id="damage_part_name_8" value="{{ $vehicle->damage_part_name_8 }}"></td>
                                <td><input type="number" class="form-control" name="cost_part_8" id="cost_part_8" value="{{ $vehicle->cost_part_8 }}"></td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a  class="btn btn-default" href="{{ route('admin.vehicle.issue',$vehicle->vehicle_id) }}">Cancel</a>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
