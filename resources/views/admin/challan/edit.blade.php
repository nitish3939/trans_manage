@extends('layouts.admin.app')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('errors.errors-and-messages')
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Challan </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>

                <form class="form-horizontal form-label-left" action="{{ route('admin.challan.edit', $challan->id) }}" method="post" id="addStaffForm" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Driver Name*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" disabled value="{{ $challan->user->first_name }}" placeholder="Company Name" name="company_name" id="company_name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Challan Date*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" disabled value="{{ $challan->created_at->format('d-M-Y') }}" placeholder="Challan Date" name="issue_date" id="issue_date">
                        </div>
                    </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Challan No.*</label>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="text" class="form-control" value="{{ $challan->challan_no }}" placeholder="Challan Number" name="challan_no" id="challan_no" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Vehicle Number*</label>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        @if(isset($vehicle))
                        <select class="form-control" id="vehicle_id" name="vehicle_id" required>
                            <option value="">Choose Vehicle</option>

                        @foreach ($vehicle as $vehl)
                        <option value="{{$vehl->id}}" @if($vehl->id == $challan->vehicle_id){{'selected'}}@endif>{{$vehl->vehicle_no}}</option>
                        @endforeach
                        </select>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Challan Place*</label>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="text" class="form-control" value="{{ $challan->challan_place }}" placeholder="Challan Place" name="challan_place" id="challan_place" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Challan Amount*</label>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="number" class="form-control"value="{{ $challan->challan_amount }}"  placeholder="Challan Charge" name="challan_amount" id="challan_amount" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Challan preview</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <img  style="width: 100px; height: 100px;" src="{{ asset('storage/challan_pic/'.$challan->challan_pic) }}" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Challan Description</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" value="{{ $challan->description }}" placeholder="Description" name="description" id="description" required>
                    </div>
                </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a  class="btn btn-default" href="{{ route('admin.challan.index') }}">Cancel</a>
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
