

{{-- to join the two pages together --}}
@extends('users.user-master')
{{-- to add the @yield('admin') from the admin masters page --}}
@section('user_title')
    <title>
        User | Orders
    </title>    
@endsection

@section('users') 
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
                                    Recent Orders
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
                        <div class="card-body">
                            <div class="row mb-3">
                            </div>

                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Oreder <br> ID</th>
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
                                                <td>{{ number_format($item->total_amount , 2) }} </td>
                                                <td class="text-capitalize">{{ $item->payment_method }} </td>
                                                <td>
                                                    @if($item->status == 0)
                                                        Pending
                                                    @elseif($item->status == 1)
                                                       In Progress
                                                    @elseif($item->status == 2)
                                                       Delivered
                                                    @elseif($item->status == 3)
                                                       Completed
                                                    @else 
                                                       Cancelled
                                                    @endif
                                                </td>
                                                <td>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
                                                <td>
                                                    <a href="{{ route('user_order_details', $item->id) }}"
                                                        class="btn btn-dark sm" title="Order Details" > 
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



@endsection
