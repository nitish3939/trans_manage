@extends('layouts.subadmin.app')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('errors.errors-and-messages')
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Vehicle </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form class="form-horizontal form-label-left" action="{{ route('subadmin.vehicle.add') }}" method="post" id="addStaffForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Vehicle Owner Name*</label>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <input type="text" class="form-control" placeholder="Vehicle Owner Name" name="vehicle_owner_name" id="vehicle_owner_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Vehicle Number*</label>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <input type="text" class="form-control" placeholder="Vehicle Number" name="vehicle_no" id="vehicle_no">
                            </div>
                        </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">RC No.*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="RC No." name="rc_no" id="rc_no">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Insurance No.</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="Insurance No." name="insurance_no" id="insurance_no">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Insurance Start Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="date" class="form-control" name="insu_start_date" id="insu_start_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Insurance End Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="date" class="form-control" name="insu_end_date" id="insu_end_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pollution No.*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="Pollution No." name="pollution_no" id="pollution_no">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pollution Start Date*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="date" class="form-control" name="pllu_start_date" id="pllu_start_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pollution End Date*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="date" class="form-control" name="pollu_end_date" id="pollu_end_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Medical certificate No.</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="Medical certificate No." name="medical_cert_no" id="medical_cert_no">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Medical Start Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="date" class="form-control" name="medi_start_date" id="medi_start_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Medical End Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="date" class="form-control" name="medi_end_date" id="medi_end_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fitness No.</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="Fitness No." name="fitness_no" id="fitness_no">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fitness Start Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="date" class="form-control" name="fit_start_date" id="fit_start_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fitness End Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="date" class="form-control" name="fit_end_date" id="fit_end_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Permite No.</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="Permite No." name="permite_no" id="permite_no">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Permite Start Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="date" class="form-control" name="perm_start_date" id="perm_start_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Permite End Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="date" class="form-control" name="perm_end_date" id="perm_end_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tax Permit No.</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="Tax Permit No." name="tax_permit_no" id="tax_permit_no">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tax Permit Start Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="date" class="form-control" name="tax_start_date" id="tax_start_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tax Permit End Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="date" class="form-control" name="tax_end_date" id="tax_end_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">NP Permit No.</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="NP Permit No." name="np_permit_no" id="np_permit_no">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">NP Permit Start Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="date" class="form-control" name="np_start_date" id="np_start_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">NP Permit End Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="date" class="form-control" name="np_end_date" id="np_end_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">5 Year No.</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="5 Year No." name="five_year_no" id="five_year_no">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">5 Year Start Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="date" class="form-control" name="five_start_date" id="five_start_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">5 Year End Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="date" class="form-control" name="five_end_date" id="five_end_date">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-4">
                            <a  class="btn btn-default" href="{{ route('subadmin.vehicle.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-success">Submit</button>
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

        $(document).on('keydown', "#vehicle_owner_name", function (e) {
        var charCode = (e.which) ? e.which : e.keyCode;
        if (((charCode == 8) || (charCode == 32) || (charCode == 46) || (charCode == 9) || (charCode >= 35 && charCode <= 40) || (charCode >= 65 && charCode <= 90))) {
            return true;
        } else {
            return false;
        }
    });

    });
</script>

@endsection
