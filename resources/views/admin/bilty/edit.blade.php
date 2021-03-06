
@extends('layouts.admin.app')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('errors.errors-and-messages')
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Billty </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form class="form-horizontal form-label-left" action="{{ route('admin.bilty.edit', $bilty->id) }}" method="post" id="addStaffForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Consignor Name*</label>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <input type="text" class="form-control" placeholder="Consignor Name" name="consignor_name" required value="{{ $bilty->consignor_name }}" id="consignor_name">
                            </div>
                        </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Consignor Address*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="Consignor Address" name="consignor_address" required value="{{ $bilty->consignor_address }}" id="consignor_address">
                        </div>
                    </div>
                 
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Consignor Gst*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="Consignor Gst" name="consignor_gst" required value="{{ $bilty->consignor_gst }}" id="consignor_gst">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Consignee Name*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="Consignee Name" name="consignee_name" required value="{{ $bilty->consignee_name }}" id="consignee_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Consignee Address*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="Consignee Address" name="consignee_address" required value="{{ $bilty->consignee_address }}" id="consignee_address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Consignee Gst*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="Consignee Gst" name="consignee_gst" required value="{{ $bilty->consignee_gst }}" id="consignee_gst">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Trip*</label>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                @if(isset($trips))
                                <select class="form-control" id="trip_id" name="trip_id" required>
                                    <option value="">Choose Trip</option>
                                @foreach ($trips as $trip)
                                <option value="{{$trip->id}}" @if($trip->id == $bilty->trip_id){{'selected'}}@endif>{{$trip->start_trip}} => {{$trip->end_trip}} ({{$trip->trip_date}})</option>
                                @endforeach
                                </select>
                                @endif
                            </div>
                        </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">GR No.*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" placeholder="GR No." name="gr_no" required value="{{ $bilty->gr_no }}" id="gr_no">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Invoice No*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" placeholder="Invoice No" required name="invoice_no" value="{{ $bilty->invoice_no }}" id="invoice_no">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Eway Bill No*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="Eway Bill No"  required name="eway_bill_no" value="{{ $bilty->eway_bill_no }}" id="eway_bill_no">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Value</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" placeholder="value"  name="value" value="{{ $bilty->value }}" id="value">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Charged*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          
                            <select name="charged" class="form-control" required >
                                    <option value="" >Select Charged Option</option>
									<option value="diesel" @if($bilty->charged == "diesel"){{'selected'}}@endif>Diesel</option>
									<option value="cng" @if($bilty->charged == "cng"){{'selected'}}@endif>CNG</option>
                                    <option value="other" @if($bilty->charged == "other"){{'selected'}}@endif>Other</option>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Delivery At*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="Delivery At" required name="delivery_at" value="{{ $bilty->delivery_at }}" id="delivery_at">
                        </div>
                    </div>  

                    <div class="ln_solid"></div>
                    <div id="member_div">
                        @if($bilty_items)
                        @foreach($bilty_items as $bilty_item)
                        <input value="{{ $bilty_item->id }}" type="hidden" name="record_id[]">
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">No Of Packages</label>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <input value="{{ $bilty_item->no_package }}" type="text" class="form-control" name="packages[]">
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Description</label>
                            <div class='col-md-2 col-sm-2 col-xs-12'>
                            <input value="{{ $bilty_item->description }}" type="text" class="form-control" name="description[]">
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Weight</label>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <input value="{{ $bilty_item->weight }}" type="text" class="form-control" name="weight[]">
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-10">
                            <button type="button" class="btn btn-primary" id="add_more_member">Add Items</button>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12" for="w3-last-name">Is it Build Or Paid*</label>
														<div class="col-md-6 col-sm-6 col-xs-6">
															<select name="is_software" class="form-control" id="softwareselector" required>
                                                            <option value="" >Select Option</option>
															<option value="build" @if($bilty->payment == "build"){{'selected'}}@endif>To Be Build</option>
															<option value="paid" @if($bilty->payment == "paid"){{'selected'}}@endif>To Be Paid</option>
															</select>
														</div>
													</div>
														<div id="yes_software">
														    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Freight*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="Freight" name="freight" value="{{ $bilty->freight }}" id="freight">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Waiting*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="Waiting" name="waiting" value="{{ $bilty->waiting }}" id="waiting">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">labour*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" class="form-control" placeholder="labour" name="labour" value="{{ $bilty->labour }}" id="labour">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Toll*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" placeholder="Toll" name="toll" value="{{ $bilty->toll }}" id="toll">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">CGST*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" placeholder="CGST" name="cgst" value="{{ $bilty->cgst }}" id="cgst">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">SGST*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" placeholder="SGST" name="sgst" value="{{ $bilty->sgst }}" id="sgst">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">IGST*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" placeholder="IGST" name="igst" value="{{ $bilty->igst }}" id="igst">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">G Total*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" placeholder="G Total" name="g_total" value="{{ $bilty->g_total }}" id="g_total">
                        </div>
                    </div>
                 	</div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-4">
                            <a  class="btn btn-default" href="{{ route('admin.bilty.index') }}">Cancel</a>
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
       
        $(function () {

$("#softwareselector").change(function () {
    if ($(this).val() == "paid") {
        $("#yes_software").show();
    }   else  {
        $('#yes_software').hide();
            }
   
});
});

        $(document).on("click", "#add_more_member", function () {
            var member_html =  "<input value='0' type='hidden' name='record_id[]'>"
                    + "<div class='form-group'><label class='control-label col-md-2 col-sm-2 col-xs-12'>No Of Packages</label><div class='col-md-2 col-sm-2 col-xs-12'><input type='text' class='form-control' name='packages[]'>"
                    + "</div><label class='control-label col-md-2 col-sm-2 col-xs-12'>Description</label><div class='col-md-2 col-sm-2 col-xs-12'>"
                    + "<input type='text' class='form-control' name='description[]'></div><label class='control-label col-md-2 col-sm-2 col-xs-12'>Weight</label><div class='col-md-2 col-sm-2 col-xs-12'>"
                    + "<input type='text' class='form-control' name='weight[]'></div>"
//                    +"<label class='control-label col-md-2 col-sm-2 col-xs-12'>Person Type</label><div class='col-md-2 col-sm-2 col-xs-12'>"
//                    + "<select class='form-control' name='person_type[]'><option value='Adult'>Adult</option><option value='Child'>Children</option></select>"
                    + "</div></div>";
            $("#member_div").append(member_html);
        });


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

