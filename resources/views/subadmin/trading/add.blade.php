@extends('layouts.subadmin.app')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('errors.errors-and-messages')
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Trading </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form class="form-horizontal form-label-left" action="{{ route('subadmin.trading.add') }}" method="post" id="addStaffForm" enctype="multipart/form-data">
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Purchase*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" placeholder="Purchase" step="any" name="purchase" id="purchase" required>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Expenses*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" placeholder="Expenses" step="any" name="expenses" id="expenses" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gross Profit*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" placeholder="Gross Profit" step="any" name="gross_profit" id="gross_profit" required>
                        </div>
                    </div>
    </div>
 <div class="col-sm-6">               
                   <div class="form-group">
                        <label class="control-label col-md-6 col-sm-6 col-xs-12"><u>Credit</u> (Rs.)</label>
                    </div>
 

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sales*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" placeholder="sales" step="any" name="sales" id="sales" required>
                        </div>
                    </div>
                         </div>
        </div>    
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-4">
                            <a  class="btn btn-default" href="{{ route('subadmin.trading.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

