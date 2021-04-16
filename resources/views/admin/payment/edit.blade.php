@extends('layouts.subadmin.app')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('errors.errors-and-messages')
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Payment </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>

                <form class="form-horizontal form-label-left" action="{{ route('subadmin.payment.edit', $payment->id) }}" method="post" id="addStaffForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Month*</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                @if(isset($payment))
                                <select class="form-control" id="month" name="month" required>
                                    <option value="">Choose month</option>
                                    <option value='January' @if($payment->month == "January"){{'selected'}}@endif>January</option>
                                    <option value='February' @if($payment->month == "February"){{'selected'}}@endif>February</option>
                                    <option value='March' @if($payment->month == "March"){{'selected'}}@endif>March</option>
                                    <option value='April' @if($payment->month == "April"){{'selected'}}@endif>April</option>
                                    <option value='May' @if($payment->month == "May"){{'selected'}}@endif>May</option>
                                    <option value='June' @if($payment->month == "June"){{'selected'}}@endif>June</option>
                                    <option value='July' @if($payment->month == "July"){{'selected'}}@endif>July</option>
                                    <option value='August' @if($payment->month == "August"){{'selected'}}@endif>August</option>
                                    <option value='September' @if($payment->month == "September"){{'selected'}}@endif>September</option>
                                    <option value='October' @if($payment->month == "October"){{'selected'}}@endif>October</option>
                                    <option value='November' @if($payment->month == "November"){{'selected'}}@endif>November</option>
                                    <option value='December' @if($payment->month == "December"){{'selected'}}@endif>December</option>
                                </select>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Year*</label>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                      
                                <input type="text" class="form-control" placeholder="YYYY"  value="{{ $payment->year }}" name="year" pattern="[1-9][0-9]{3}" id="year" required>
                            </div>
                        </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Cash In</label>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Opening Cash & Bank Balances*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" value="{{ $payment->opening_cashin }}" step="any" placeholder="opening" name="opening_cashin" id="opening_cashin" required>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sundry Debtors*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" value="{{ $payment->sundry_debtors_cashin }}" step="any" placeholder="Sundry Debtors" name="sundry_debtors_cashin" id="sundry_debtors_cashin" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sundry Creditors*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" value="{{ $payment->sundry_creditors_cashin }}" step="any" placeholder="Sundry Creditors" name="sundry_creditors_cashin" id="sundry_creditors_cashin" required>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Cash out</label>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sundry Debtors*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" value="{{ $payment->sundry_debtors_cashout }}" step="any" placeholder="Sundry Debtors" name="sundry_debtors_cashout" id="sundry_debtors_cashout" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sundry Creditors*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" value="{{ $payment->sundry_creditors_cashout }}" step="any" placeholder="Sundry Creditors" name="sundry_creditors_cashout" id="sundry_creditors_cashout" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Expenses*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" value="{{ $payment->expenses }}" placeholder="expenses" step="any" name="expenses" id="expenses" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Closing Cash & Bank Balances*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" value="{{ $payment->closing_balances }}" step="any" placeholder="Closing Balances" name="closing_balances" id="closing_balances" required>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a  class="btn btn-default" href="{{ route('subadmin.payment.index') }}">Cancel</a>
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
