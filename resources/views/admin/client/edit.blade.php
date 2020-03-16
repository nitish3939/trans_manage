@extends('layouts.admin.app')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('errors.errors-and-messages')
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Client </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>

                <form class="form-horizontal form-label-left" action="{{ route('admin.client.edit', $client->id) }}" method="post" id="addStaffForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Client Name*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" value="{{ $client->name }}" placeholder="Client Name" name="client_name" id="client_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Name*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" value="{{ $client->company_name }}" placeholder="Company Name" name="company_name" id="company_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Designation*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" value="{{ $client->designation }}" placeholder="Designation" name="designation" id="designation" required>
                        </div>
                    </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Bribe*</label>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="number" class="form-control" value="{{ $client->bribe }}" placeholder="Bribe" name="bribe" id="bribe" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Commission Type*</label>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        @if(isset($client))
                        <select class="form-control" id="commision_type" name="commision_type" required>
                            <option value="">Choose option</option>
                            <option value="daily" @if($client->commision_type == "daily"){{'selected'}}@endif>Daily</option>
                            <option value="monthly" @if($client->commision_type == "monthly"){{'selected'}}@endif>Monthly</option>
                        </select>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Commison Charge*</label>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="number" class="form-control"value="{{ $client->commision_charge }}"  placeholder="Commison Charge" name="commision_charge" id="commision_charge" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Work Amount*</label>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="number" class="form-control" value="{{ $client->work_amount }}" placeholder="Work Amount" name="work_amount" id="work_amount" required>
                    </div>
                </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a  class="btn btn-default" href="{{ route('admin.client.index') }}">Cancel</a>
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
