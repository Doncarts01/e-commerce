{{-- to join the two pages together --}}
@extends('admin.admin-master')

@section('title')
    Admin | Dashboard
@endsection

{{-- to add the @yield('admin') from the admin masters page --}}
@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    @php
        $getSystemSettingsApp = App\Models\settings::getSingle();
    @endphp
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ $getSystemSettingsApp->name }}</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Orders</p>
                                    <h4 class="mb-2">{{ $totalOrders }}</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="ri-shopping-cart-2-line font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Today Orders</p>
                                    <h4 class="mb-2">{{ $todayOrders }}</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="ri-shopping-cart-2-line font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Payments</p>
                                    <h4 class="mb-2"> € {{ number_format($totalAmount, 2) }}</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class=" ri-money-euro-circle-fill font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Today Payments</p>
                                    <h4 class="mb-2"> € {{ number_format($todayTotalAmount, 2) }}</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class=" ri-money-pound-circle-fill font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Today Customers</p>
                                    <h4 class="mb-2">{{ $totalTodayCustomers }}</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="ri-shield-user-fill font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Customers</p>
                                    <h4 class="mb-2">{{ $totalCustomers }}</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="ri-user-3-fill font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-end">
                                <select class="form-select shadow-none form-select-sm changeYear">
                                    @for ($i = 2018; $i <= date('Y') ; $i++)
                                        <option {{ ($year == $i) ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <h4 class="card-title mb-4">Bar Chart</h4>

                            <div class="row text-center">
                                <div class="col-4">
                                    <h5 class="mb-0">{{ $customerAmount }}</h5>
                                    <p class="text-muted text-truncate">Customers</p>
                                </div>
                                <div class="col-4">
                                    <h5 class="mb-0">{{ $orderAmountCount }}</h5>
                                    <p class="text-muted text-truncate">Orders</p>
                                </div>
                                <div class="col-4">
                                    <h5 class="mb-0">€ {{ number_format($finalAmount, 2) }}</h5>
                                    <p class="text-muted text-truncate">Amount</p>
                                </div>
                            </div>

                            {{-- <canvas id="bar" height="300"></canvas> --}}
                            <canvas id="myBarChart" height="100"></canvas>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title mb-4">Latest Transactions</h4>

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
                                            <th>Created at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php($i = 1)
                                        @foreach ($latestOrders as $item)
                                            <tr>
                                                <td>{{ $i++ }} </td>
                                                <td>{{ $item->orderNo }} </td>
                                                <td>{{ $item->lastName . ' ' . $item->firstName }}</td>
                                                <td>{{ $item->email }} </td>
                                                <td>{{ number_format($item->total_amount, 2) }} </td>
                                                <td class="text-capitalize">{{ $item->payment_method }} </td>
                                                <td>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
                                                <td>
                                                    <a href="{{ route('details_orders', $item->id) }}"
                                                        class="btn btn-primary sm" title="Order Details">
                                                        Details
                                                    </a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>

    </div>
    <style>
        /* *{
            color: rgb(255, 0, 0);
        } */
    </style>
    <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>

    {{-- to end the sectoion --}}
    <script>

        $(".changeYear").change(function() {
            let year = $(this).val();
            window.location.href = `{{ url('admin/dashboard?year=') }} ${year}`;
        })




        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily =
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Bar Chart Example
        var ctx = document.getElementById("myBarChart");
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", 'December'],
                datasets: [
                    {
                        label: "Customer",
                        backgroundColor: "rgba(2,117,216,1)",
                        borderColor: "rgba(2,117,216,1)",
                        data: [{{ $getTotalCustomerMonth }}],
                    },
                    {
                        label: "Order",
                        backgroundColor: "rgb(0,0, 0)",
                        borderColor: "rgba(2,117,216,1)",
                        data: [{{ $getTotalOrderMonth }}],
                    },
                    {
                        label: "Amount",
                        backgroundColor: "rgb(255, 0, 0)",
                        borderColor: "rgba(255, 0, 0, 1)",
                        data: [{{ $getTotalOrderMonth }}],
                    }
                ],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 12
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 100,
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            display: true
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
    </script>
@endsection
