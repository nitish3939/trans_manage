@extends('layouts.admin.app')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('errors.errors-and-messages')
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Subadmin </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>

                <form class="form-horizontal form-label-left" action="{{ route('admin.subadmin.edit', $user->id) }}" method="post" id="editSubadminForm">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">First Name*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" value="{{ $user->first_name }}" class="form-control" placeholder="First Name" name="f_name" id="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="text" value="{{ $user->last_name }}" class="form-control" placeholder="Last Name" name="l_name" id="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email*</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input value="{{ $user->email_id }}" type="text" class="form-control" placeholder="Email" name="email" id="email" required> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Menu's</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p style="padding: 5px;">
                                @if($menus)
                                @foreach($menus as $menu)
                            <div class="col-md-6 col-sm-6 col-xs-6" style="padding-bottom: 4px;">
                                <input class="flat" type="checkbox" name="menu_ids[]" value="{{ $menu->id }}"
                                       @if(in_array($menu->id, $userAuthorityMapping))
                                       {{ "checked" }}
                                       @endif
                                       ><label>{{ $menu->display_name }}</label>
                            </div>

                            @endforeach
                            @endif
                            <p>
                        </div>
                    </div>
                    <div id="menuIdError" class="error col-md-offset-4"></div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-4">
                            <a  class="btn btn-default" href="{{ route('admin.subadmin.index') }}">Cancel</a>
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
        $("#editSubadminForm").validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                resort_id: {
                    required: true
                },
                "menu_ids[]": {
                    required: function () {
                        return $("[name='menu_ids[]']:checked").length == 0;
                    }
                }
            },
            messages: {
                "menu_ids[]": {
                    required: 'Please add some rights from menus.'
                }
            },
            errorPlacement: function (error, el) {
                if ($(el).attr('type') == 'checkbox') {
                    console.log(error);
                    error.appendTo("#menuIdError");
                } else {
                    error.insertAfter(el);
                }
            }
        });

        $(document).on("change", "#resort_id", function () {
            var resort_id = $("#resort_id :selected").val();
            $.ajax({
                url: _baseUrl + '/admin/staff/amenity-list',
                type: 'post',
                data: {resort_id: resort_id},
                dataType: 'html',
                success: function (res) {
                    $("#amenity_list_div").html(res);
                }
            });
        });

        if ($("input.flat")[0]) {
            $(document).ready(function () {
                $('input.flat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            });
        }
        $(document).on('keydown', "#name", function (e) {
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
