@extends('layouts.subadmin.app')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('errors.errors-and-messages')
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Fuel </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>

                <form class="form-horizontal form-label-left" action="{{ route('subadmin.trip.fuel', $fuel->id) }}" method="post" id="addStaffForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Driver Namer*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            @if(isset($driver))
                            <select class="form-control" id="user_id" name="user_id" required>
                                <option value="">Choose Driver</option>

                            @foreach ($driver as $dri)
                            <option value="{{$dri->id}}" @if($dri->id == $fuel->user_id){{'selected'}}@endif>{{$dri->first_name}}</option>
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
                            <option value="{{$vehl->id}}" @if($vehl->id == $fuel->vehicle_id){{'selected'}}@endif>{{$vehl->vehicle_no}}</option>
                            @endforeach
                            </select>
                            @endif
                        </div>
                    </div>
              
                <div class="ln_solid"></div>
                <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fuel Bill Image preview</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <img class="img-rounded" style="width: 100px; height: 100px;" src="{{ $fuel->fuel_bill_image }}" >
                        </div>
                    </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Payment*</label>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="number" class="form-control" value="{{ $fuel->payment }}" placeholder="Payment" name="payment" id="payment" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Location*</label>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="text" class="form-control" value="{{ $fuel->location }}" placeholder="Location" name="location" id="location" required>
                    </div>
                </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a  class="btn btn-default" href="{{ route('subadmin.trip.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-success">Update</button>
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
