@extends('layouts.admin.app')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('errors.errors-and-messages')
        <div class="x_panel">
            <div class="x_title">
                <div style="display: none;" class="alert msg" role="alert"></div>
                <h2>Change Password ({{ $user->first_name }})</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left" action="{{ route('admin.staff.change-password', $user->id) }}" method="post" id="profileForm" >
                    @csrf
              
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">New Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input  class="form-control" type="text" name="new_password" id="new_password" placeholder="New Password">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input  class="form-control" type="text" name="confirm_password" id="confirm_password" placeholder="Confirm Password">

                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <a class="btn btn-default" href="{{ route("admin.staff.index") }}">Cancel</a>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
     
        $("#profileForm").validate({
            rules: {
                new_password: {
                    required: true,
                    alphanumeric: true
                },
                confirm_password: {
                    required: true,
                    equalTo: "#new_password"
                },
            },
            messages: {
                confirm_password: {
                    equalTo: "Confirm password does't match."
                },
            }
        });
    });
</script>
@endsection