@extends('admin.admin-master')

@section('title')
    Admin | Order List
@endsection
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Order List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">
                                    View All Orders 
                                </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h5 class="card-header">View Order </h5>
                        <div class="card-body">
                            <div class="row mb-3"></div>
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Oreder <br> ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Total <br> Amount (€)</th>
                                            <th>Payment <br> Method</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php($i = 1)
                                        @foreach ($orders as $item)
                                            <tr>
                                                <td>{{ $i++ }} </td>
                                                <td>{{ $item->orderNo }} </td>
                                                <td>{{ $item->lastName ." ".$item->firstName }}</td>
                                                <td>{{ $item->email }} </td>
                                                <td>{{ number_format($item->total_amount , 2) }} </td>
                                                <td class="text-capitalize">{{ $item->payment_method }} </td>
                                                <td>
                                                    <select name="" id="{{ $item->id }}" class="form-select changeStatus">
                                                        <option {{ ($item->status == 0) ? 'selected' : '' }} value="0">Pending </option>
                                                        <option {{ ($item->status == 1) ? 'selected' : '' }} value="1">In progress </option>
                                                        <option {{ ($item->status == 2) ? 'selected' : '' }} value="2">Delievered</option>
                                                        <option {{ ($item->status == 3) ? 'selected' : '' }} value="3">Completed</option>
                                                        <option {{ ($item->status == 4) ? 'selected' : '' }} value="4">Cancelled</option>
                                                    </select>
                                                </td>
                                                <td>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
                                                <td>
                                                    <a href="{{ route('details_orders', $item->id) }}"
                                                        class="btn btn-primary sm" title="Order Details" > 
                                                        Details
                                                    </a>
                                                </td>

                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
    </div>


    <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('body').delegate('.changeStatus', 'change', function() {
                let status = $(this).val();
                let order_id = $(this).attr('id');

                $.ajax({
                    url: "{{ url('admin/order_status') }}",
                    type: 'POST',
                    data: {
                        status: status,
                        order_id: order_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {            
                        if(data.success === true){
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        // toastr.error('An error occurred: ' + error);
                    }
                });
            });

        });
    </script>
@endsection
