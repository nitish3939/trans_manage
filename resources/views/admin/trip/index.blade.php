@extends('layouts.admin.app')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('errors.errors-and-messages')
        <div class="x_panel">
            <div class="x_title">
                <h2>Trip</h2>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('admin.trip.add') }}">Add Trip</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="list" class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>Vehicle No.</th>
                            <th>Driver Name</th>
                            <th>Start Trip</th>
                            <th>End Trip</th>
                            <th>Trip Date</th>
                            <th>Expense Amount</th>
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
            ajax: "{{route('admin.trip.list')}}",
            "columns": [
                {"data": null,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {"data": "vehicle_no", sortable: false},
                {"data": "user_name", sortable: false},
                {"data": "start_trip", sortable: false},
                {"data": "end_trip", sortable: false},
                {"data": "trip_date", sortable: false},
                {"data": "expense_amount", sortable: false},
                {"data": "view-deatil", sortable: false},
            ]
        });


    });
</script>
@endsection
