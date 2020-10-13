@extends('layouts.subadmin.app')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('errors.errors-and-messages')
        <div class="x_panel">
            <div class="x_title">
                <h2>View Trip </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>

                <form class="form-horizontal form-label-left" action="{{ route('subadmin.trip.edit', $trip->id) }}" method="post" id="addStaffForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Driver Namer*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            @if(isset($driver))
                            <select class="form-control" id="user_id" name="user_id" disabled>
                                <option value="">Choose Driver</option>

                            @foreach ($driver as $dri)
                            <option value="{{$dri->id}}" @if($dri->id == $trip->user_id){{'selected'}}@endif>{{$dri->first_name}}</option>
                            @endforeach
                            </select>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Vehicle Number*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            @if(isset($vehicle))
                            <select class="form-control" id="vehicle_id" name="vehicle_id" disabled>
                                <option value="">Choose Vehicle</option>
                            @foreach ($vehicle as $vehl)
                            <option value="{{$vehl->id}}" @if($vehl->id == $trip->vehicle_id){{'selected'}}@endif>{{$vehl->vehicle_no}}</option>
                            @endforeach
                            </select>
                            @endif
                        </div>
                    </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Trip Date*</label>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="date" class="form-control" value="{{ $trip->trip_date }}" placeholder="Trip Date" name="trip_date" id="trip_date" disabled>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Start trip*</label>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                    <textarea class="form-control" rows="4" cols="50" name="start_trip" id="start_trip" disabled>{{ $trip->start_trip }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">End Trip*</label>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                    <textarea class="form-control" rows="4" cols="50" name="end_trip" id="end_trip" disabled>{{ $trip->end_trip }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Fuel Entry(L)*</label>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="number" class="form-control" value="{{ $trip->fuel_entry }}" placeholder="Fuel Entry" name="fuel_entry" id="fuel_entry" disabled>
                    </div>
                </div>
              
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Start Distance(KM)*</label>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="number" class="form-control" value="{{ $trip->start_km }}" placeholder="Start KM" name="start_km" id="start_km" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">End Distance(KM)</label>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="number" class="form-control" value="{{ $trip->end_km }}" placeholder="End KM" name="end_km" id="end_km" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Expense Amount</label>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="number" class="form-control" value="{{ $trip->expense_amount }}" placeholder="Expense Amount" name="expense_amount" id="expense_amount" disabled >
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Amount Spend</label>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="number" class="form-control" value="{{ $trip->amount_spend }}" placeholder="Amount Spend" name="amount_spend" id="amount_spend" disabled >
                    </div>
                </div>
                <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Expense Description</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                        <textarea class="form-control" rows="4" cols="50"  disabled>{{ $trip->expense_description }}</textarea>
                        </div>
                    </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">End Fuel Entry(L)</label>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="number" class="form-control" value="{{ $trip->end_fuel_entry }}" placeholder="End Fuel Entry" name="end_fuel_entry" id="end_fuel_entry" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">End Trip Location</label>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="text" class="form-control" value="{{ $trip->end_trip_location }}" placeholder="End Trip Location" name="end_trip_location" id="end_trip_location" disabled>
                    </div>
                </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a  class="btn btn-default" href="{{ route('subadmin.trip.index') }}">Back</a>
                          
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
<script>
    $(document).ready(function () {

        $("#addStaffForm").validate({
            rules: {
                staff_name: {
                    required: true
                },
                staff_mobile_no: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10,
                },
                staff_email: {
                    required: true,
                    email: true
                },
                staff_address: {
                    required: true
                },
            }
        });

    });
</script>

@endsection
