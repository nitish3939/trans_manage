@extends('layouts.admin.app')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('errors.errors-and-messages')
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Staff </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>

                <form class="form-horizontal form-label-left" action="{{ route('admin.staff.edit', $user->id) }}" method="post" id="addStaffForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">First Name*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" value="{{ $user->first_name }}" class="form-control" placeholder="First Name" name="f_name" id="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" value="{{ $user->last_name }}" class="form-control" placeholder="Last Name" name="l_name" id="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Mobile No.*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input readonly="true" value="{{ $user->mobile_number }}" type="text" class="form-control" placeholder="Mobile No." name="staff_mobile_no" id="staff_mobile_no">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input value="{{ $user->email_id }}" type="text" class="form-control" placeholder="Email" name="staff_email" id="staff_email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Dob*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="date" value="{{ $user->date_of_birth }}" class="form-control" name="staff_dob" id="staff_dob">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Profile Pic</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control" type="file" name="profile_pic" id="profile_pic" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Profile preview</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <img class="img-rounded" style="width: 100px; height: 100px;" src="{{ $user->profile_pic_path }}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Address*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input value="{{ $user->address }}" type="text" class="form-control" placeholder="Address" name="staff_address" id="staff_address">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Account Holder Name*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input value="{{ $user->account_holder_name }}" type="text" class="form-control" placeholder="Account_holder_name" name="account_holder_name" id="account_holder_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Bank Account No.*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input value="{{ $user->bank_account_no }}" type="number" class="form-control" placeholder="Account No" name="acc_no" id="acc_no">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Bank Name*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input value="{{ $user->bank_name }}" type="text" class="form-control" placeholder="Bank Name" name="bank_name" id="bank_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">IFSC Code*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input value="{{ $user->ifsc }}" type="text" class="form-control" placeholder="IFSC" name="ifsc" id="ifsc">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kyc Front Image</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control" type="file" name="aadhar_id_front" id="aadhar_id_front" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kyc preview</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <img class="img-rounded" style="width: 100px; height: 100px;" src="@if($user->aadhar_id_front) http://transport.dbaquincy.com/storage/aadhar/{{$user->aadhar_id_front}}elseif {{'http://transport.dbaquincy.com/img/no-image.jpg'}}@endif" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kyc Back Image</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control" type="file" name="aadhar_id_back" id="aadhar_id_back" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kyc preview</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <img class="img-rounded" style="width: 100px; height: 100px;" src="http://transport.dbaquincy.com/storage/aadhar/{{ $user->aadhar_id_back }}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">DL Image</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control" type="file" name="voter_id" id="voter_id" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">DL preview</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <img class="img-rounded" style="width: 100px; height: 100px;" src="http://transport.dbaquincy.com/storage/dl/{{ $user->voter_id }}" >
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a  class="btn btn-default" href="{{ route('subadmin.staff.index') }}">Cancel</a>
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
