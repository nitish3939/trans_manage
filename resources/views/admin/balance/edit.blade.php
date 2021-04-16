@extends('layouts.admin.app')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('errors.errors-and-messages')
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Balance </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>

                <form class="form-horizontal form-label-left" action="{{ route('admin.balance.edit', $balance->id) }}" method="post" id="addStaffForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Month*</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                @if(isset($balance))
                                <select class="form-control" id="month" name="month" required>
                                    <option value="">Choose month</option>
                                    <option value='January' @if($balance->month == "January"){{'selected'}}@endif>January</option>
                                    <option value='February' @if($balance->month == "February"){{'selected'}}@endif>February</option>
                                    <option value='March' @if($balance->month == "March"){{'selected'}}@endif>March</option>
                                    <option value='April' @if($balance->month == "April"){{'selected'}}@endif>April</option>
                                    <option value='May' @if($balance->month == "May"){{'selected'}}@endif>May</option>
                                    <option value='June' @if($balance->month == "June"){{'selected'}}@endif>June</option>
                                    <option value='July' @if($balance->month == "July"){{'selected'}}@endif>July</option>
                                    <option value='August' @if($balance->month == "August"){{'selected'}}@endif>August</option>
                                    <option value='September' @if($balance->month == "September"){{'selected'}}@endif>September</option>
                                    <option value='October' @if($balance->month == "October"){{'selected'}}@endif>October</option>
                                    <option value='November' @if($balance->month == "November"){{'selected'}}@endif>November</option>
                                    <option value='December' @if($balance->month == "December"){{'selected'}}@endif>December</option>
                                </select>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Year*</label>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                           
                                                   <input type="text" class="form-control" placeholder="YYYY"  value="{{ $balance->year }}" name="year" pattern="[1-9][0-9]{3}" id="year" required>
                            </div>
                        </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Profit Adjusted*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" value="{{ $balance->profit_adjusted }}" placeholder="Profit Adjusted" step="any" name="profit_adjusted" id="profit_adjusted" required>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Duties & Taxes*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" value="{{ $balance->duties_taxes }}" placeholder="Duties Taxes" step="any" name="duties_taxes" id="duties_taxes" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sundry Creditors*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" value="{{ $balance->sundry_creditors }}" placeholder="Sundry Creditors" step="any" name="sundry_creditors" id="sundry_creditors" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Suspense*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" value="{{ $balance->suspense }}" placeholder="Suspense" step="any" name="suspense" id="suspense" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Bank Account*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" value="{{ $balance->bank }}" placeholder="Bank" step="any" name="bank" id="bank" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cash In Hand*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" value="{{ $balance->cash }}" placeholder="Cash" step="any" name="cash" id="cash" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sundry Debtors*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" value="{{ $balance->sundry_debtors }}" placeholder="Sundry Debtors" step="any" name="sundry_debtors" id="sundry_debtors" required>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a  class="btn btn-default" href="{{ route('admin.balance.index') }}">Cancel</a>
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
