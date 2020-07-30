@extends('layouts.subadmin.app')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('errors.errors-and-messages')
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Trip </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form class="form-horizontal form-label-left" action="{{ route('subadmin.trip.add') }}" method="post" id="addStaffForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Driver Namer*</label>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                @if(isset($driver))
                                <select class="form-control" id="user_id" name="user_id" required>
                                    <option value="">Choose Driver</option>

                                @foreach ($driver as $dri)
                                <option value="{{$dri->id}}">{{$dri->first_name}}</option>
                                @endforeach
                                </select>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Vehicle Number*</label>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                @if(isset($vehicle))
                                <select class="form-control" id="vehicle_id" name="vehicle_id" required>
                                    <option value="">Choose Vehicle</option>
                                @foreach ($vehicle as $vehl)
                                <option value="{{$vehl->id}}">{{$vehl->vehicle_no}}</option>
                                @endforeach
                                </select>
                                @endif
                            </div>
                        </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Trip Date*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="date" class="form-control" placeholder="Trip Date" name="trip_date" id="trip_date" required>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Start trip*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="Start Trip" name="start_trip" id="start_trip" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fuel Entry(L)*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" placeholder="Fuel Entry" name="fuel_entry" id="fuel_entry" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">End Trip*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="End Trip" name="end_trip" id="end_trip" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Start Distance(KM)*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" placeholder="Start KM" name="start_km" id="start_km" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">End Distance(KM)</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" placeholder="End KM" name="end_km" id="end_km" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Expense Amount</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" placeholder="Expense Amount" name="expense_amount" id="expense_amount" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Amount Spend</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" placeholder="Amount Spend" name="amount_spend" id="amount_spend" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Expense Description</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="Expense Description" name="expense_description" id="expense_description" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">End Fuel Entry(L)</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" placeholder="End Fuel Entry" name="end_fuel_entry" id="end_fuel_entry" >
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-4">
                            <a  class="btn btn-default" href="{{ route('subadmin.trip.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

