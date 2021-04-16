@extends('layouts.subadmin.app')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('errors.errors-and-messages')
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Income </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form class="form-horizontal form-label-left" action="{{ route('subadmin.income.add') }}" method="post" id="addStaffForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Month*</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" id="month" name="month" required>
                                    <option value="">Choose month</option>
                                    <option value='January'>January</option>
                                    <option value='February'>February</option>
                                    <option value='March'>March</option>
                                    <option value='April'>April</option>
                                    <option value='May'>May</option>
                                    <option value='June'>June</option>
                                    <option value='July'>July</option>
                                    <option value='August'>August</option>
                                    <option value='September'>September</option>
                                    <option value='October'>October</option>
                                    <option value='November'>November</option>
                                    <option value='December'>December</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Year*</label>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                      
                                <input type="text" class="form-control" placeholder="YYYY" name="year" pattern="[1-9][0-9]{3}" id="year" required>
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
                            <input type="number" class="form-control" placeholder="Conveyance Expenses" step="any" name="conveyance_expenses" id="conveyance_expenses" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Petrol Expenses*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" placeholder="Petrol Expenses" step="any" name="petrol_expenses" id="petrol_expenses" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">To Excess of Income Over Expenses*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" placeholder="Income Over Expenses" step="any" name="income_over_expenses" id="income_over_expenses" required>
                        </div>
                    </div>

                     </div>
 <div class="col-sm-6">               
                   <div class="form-group">
                        <label class="control-label col-md-6 col-sm-6 col-xs-12"><u>Credit</u> (Rs.)</label>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Income By C/O*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" placeholder="Income By C/O" step="any" name="income_co" id="income_co" required>
                        </div>
                    </div>
                     </div>
        </div>    
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-4">
                            <a  class="btn btn-default" href="{{ route('subadmin.income.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

