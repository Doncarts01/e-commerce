@extends('admin.admin-master')

@section('title')
Admin | Add Sub Category
@endsection
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Sub Category</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="active">
                                    <a href="{{ route('view_subcategories') }}" class="btn btn-primary">View Sub Categories </a>
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
                            <h1 class="card-title pb-0">Add Sub Category</h1>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('store_Subcategory') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3 mt-1">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Sub Category Name</label>
                                    <div class="col-sm-10">
                                        <input name="name" class="form-control" type="text" id="example-text-input"
                                            placeholder="Accessories ">
                                    </div>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- end row -->

                                <div class="row mb-3 mt-1">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Select Category</label>
                                    <div class="col-sm-10">
                                        <select name="category_id" id="" class="form-select">
                                            @foreach ($category as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id')
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

                                {{-- <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Phone Number </label>
                                    <div class="col-sm-10">
                                        <input name="phone" class="form-control" type="tel" id="phone"
                                            maxlength="15" minlength="11">
                                    </div>
                                </div> --}}
                                <!-- end row -->

                                {{-- <div class="row mb-1">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Total Amount </label>
                                    <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">₦</span>
                                            <input name="totalAmount" class="form-control" type="number" id="totalAmount">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div> --}}

                                {{-- <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Amount Paid </label>
                                    <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">₦</span>
                                            <input name="amountPaid" class="form-control" type="number" id="amountPaid">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div> --}}
                                <!-- end row -->

                                <!-- end row -->
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Sub Category">
                            </form>



                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    <script>
        document.getElementById('phone').addEventListener('input', function(event) {
            var input = event.target;
            var value = input.value;

            // Remove any character that is not a digit or '+'
            value = value.replace(/[^0-9+]/g, '');

            // Ensure only one '+' symbol is present and it's at the beginning
            if (value.indexOf('+') > 0) {
                value = value.replace(/\+/g, '');
            } else if (value.indexOf('+') === 0) {
                value = '+' + value.slice(1).replace(/\+/g, '');
            }

            // Update the input value
            input.value = value;

        });
    </script>
@endsection
