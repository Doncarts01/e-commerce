@extends('admin.admin-master')

@section('title')
Admin | Add Discount Code
@endsection
@section('admin')
<link href="{{ asset('backend/assets/libs/spectrum-colorpicker2/spectrum.min.css') }}" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Coupon Code Page</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="active">
                                    <a href="{{ route('view_discount') }}" class="btn btn-primary">View All Coupon Codes </a>
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
                        <div class="card-header">
                            <h1 class="card-title pb-0">Add New Coupon Code</h1>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('store_discount') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3 mt-1">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Coupon Name</label>
                                    <div class="col-sm-10">
                                        <input name="name" class="form-control" type="text" id="example-text-input"
                                            placeholder="Coupon ">
                                    </div>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- end row -->


                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-10">
                                        <select name="type" id="" class="form-select">
                                            <option value="Amount">Amount</option>
                                            <option value="Percent">Percent</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- end row -->


                                <div class="row mb-3 mt-1">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Percent / Amount</label>
                                    <div class="col-sm-10">
                                        <input name="percent_amount" class="form-control" type="text" id="example-text-input"
                                            placeholder="Percent / Amount">
                                    </div>
                                    @error('percent_amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- end row -->

                                <div class="row mb-3 mt-1">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Expiry Date</label>
                                    <div class="col-sm-10">
                                        <input name="expire_date" class="form-control" type="date" id="example-text-input"
                                            >
                                    </div>
                                    @error('expire_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- end row -->


                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select name="status" id="" class="form-select">
                                            <option value="0">Active</option>
                                            <option value="1">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- end row -->

                                <!-- end row -->
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Coupon">
                            </form>



                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

        </div>
    </div>

@endsection
