@extends('layouts.admin.app')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('errors.errors-and-messages')
        <div class="x_panel">
            <div class="x_title">
                <h2>Challan</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="list" class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>Challan No.</th>
                            <th>Driver Name</th>
                            <th>Vehicle No.</th>
                            <th>Place</th>
                            <th>Amount Type</th>
                            <th>Image</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        var t = $('#list').DataTable({
            lengthMenu: [[10, 25, 50], [10, 25, 50]],
            searching: true,
            processing: true,
            serverSide: true,
            stateSave: true,
            language: {
                'loadingRecords': '&nbsp;',
                'processing': '<i class="fa fa-refresh fa-spin"></i>'
            },
            ajax: "{{route('admin.challan.list')}}",
            "columns": [
                {"data": null,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {"data": "challan_no", sortable: false},
                {"data": "user_name", sortable: false},
                {"data": "vehicle_no", sortable: false},
                {"data": "challan_place", sortable: false},
                {"data": "challan_amount", sortable: false},
                {"data": "challan_pic", sortable: false},
                {"data": "issue_date", sortable: false},
                {"data": "description", sortable: false},
                {"data": "view-deatil", sortable: false},
            ]
        });


    });
</script>
@endsection
