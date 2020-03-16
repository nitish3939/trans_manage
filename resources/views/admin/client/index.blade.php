@extends('layouts.admin.app')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('errors.errors-and-messages')
        <div class="x_panel">
            <div class="x_title">
                <h2>Client</h2>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('admin.client.add') }}">Add Client</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="list" class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>Client Name</th>
                            <th>Company Name</th>
                            <th>Designation</th>
                            <th>Bribe</th>
                            <th>Commision Type</th>
                            <th>Charge</th>
                            <th>Work Amount</th>
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
            ajax: "{{route('admin.client.list')}}",
            "columns": [
                {"data": null,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {"data": "name", sortable: false},
                {"data": "company_name", sortable: false},
                {"data": "designation", sortable: false},
                {"data": "bribe", sortable: false},
                {"data": "commision_type", sortable: false},
                {"data": "commision_charge", sortable: false},
                {"data": "work_amount", sortable: false},
                {"data": "view-deatil", sortable: false},
            ]
        });


    });
</script>
@endsection
