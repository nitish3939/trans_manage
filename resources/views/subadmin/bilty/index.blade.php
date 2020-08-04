@extends('layouts.subadmin.app')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('errors.errors-and-messages')
        <div class="x_panel">
            <div class="x_title">
                <h2>Billty</h2>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('subadmin.bilty.add') }}">Add Billty</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="list" class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>Invoice No.</th>
                            <th>Billty Date</th>
                            <th>Consignee Name</th>
                            <th>Vehicle No.</th>
                            <th>Eway Bill No.</th>
                            <th>Amount</th>
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
            ajax: "{{route('subadmin.bilty.list')}}",
            "columns": [
                {"data": null,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {"data": "invoice_no", sortable: false},
                {"data": "bilty_date", sortable: false},
                {"data": "consignee_name", sortable: false},
                {"data": "vehicle_no", sortable: false},
                {"data": "eway_bill_no", sortable: false},
                {"data": "amount", sortable: false},
                {"data": "view-deatil", sortable: false},
            ]
        });


    });
</script>
@endsection
