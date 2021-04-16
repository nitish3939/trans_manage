@extends('layouts.subadmin.app')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('errors.errors-and-messages')
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Profit </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>

                <form class="form-horizontal form-label-left" action="{{ route('subadmin.profit.edit', $profit->id) }}" method="post" id="addStaffForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Month*</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                @if(isset($profit))
                                <select class="form-control" id="month" name="month" required>
                                    <option value="">Choose month</option>
                                    <option value='January' @if($profit->month == "January"){{'selected'}}@endif>January</option>
                                    <option value='February' @if($profit->month == "February"){{'selected'}}@endif>February</option>
                                    <option value='March' @if($profit->month == "March"){{'selected'}}@endif>March</option>
                                    <option value='April' @if($profit->month == "April"){{'selected'}}@endif>April</option>
                                    <option value='May' @if($profit->month == "May"){{'selected'}}@endif>May</option>
                                    <option value='June' @if($profit->month == "June"){{'selected'}}@endif>June</option>
                                    <option value='July' @if($profit->month == "July"){{'selected'}}@endif>July</option>
                                    <option value='August' @if($profit->month == "August"){{'selected'}}@endif>August</option>
                                    <option value='September' @if($profit->month == "September"){{'selected'}}@endif>September</option>
                                    <option value='October' @if($profit->month == "October"){{'selected'}}@endif>October</option>
                                    <option value='November' @if($profit->month == "November"){{'selected'}}@endif>November</option>
                                    <option value='December' @if($profit->month == "December"){{'selected'}}@endif>December</option>
                                </select>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Year*</label>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                          
                                <input type="text" class="form-control" placeholder="YYYY"  value="{{ $profit->year }}" name="year" pattern="[1-9][0-9]{3}" id="year" required>
                            </div>
                        </div>
                    <div class="ln_solid"></div>
                                         <div class="row">    
   <div class="col-sm-6">    
                 <div class="form-group">
                        <label class="control-label col-md-6 col-sm-6 col-xs-12"><u>Debit</u> (Rs.)</label>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Conveyance Expenses*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" value="{{ $profit->convey_expenses }}" step="any" placeholder="Convey Expenses" name="convey_expenses" id="convey_expenses" required>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Petrol Expenses*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" value="{{ $profit->petrol_expenses }}" step="any" placeholder="Petrol Expenses" name="petrol_expenses" id="petrol_expenses" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nett Profit*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" value="{{ $profit->nett_profit }}" step="any" placeholder="Nett Profit" name="nett_profit" id="nett_profit" required>
                        </div>
                    </div>
                      </div>
 <div class="col-sm-6">               
                   <div class="form-group">
                        <label class="control-label col-md-6 col-sm-6 col-xs-12"><u>Credit</u> (Rs.)</label>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">By Gross Profit*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" value="{{ $profit->gross_profit }}" step="any" placeholder="Gross Profit" name="gross_profit" id="gross_profit" required>
                        </div>
                    </div>
                               </div>
        </div>    
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a  class="btn btn-default" href="{{ route('subadmin.profit.index') }}">Cancel</a>
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
