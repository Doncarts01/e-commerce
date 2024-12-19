@extends('admin.admin-master')

@section('title')
Admin | Add Color
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
                        <h4 class="mb-sm-0">Color Page</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="active">
                                    <a href="{{ route('view_categories') }}" class="btn btn-primary">View All Colors </a>
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
                            <h1 class="card-title pb-0">Add New Color</h1>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('store_color') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3 mt-1">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input name="name" class="form-control" type="text" id="example-text-input"
                                            placeholder="Green ">
                                    </div>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- end row -->

                                <div class="row mb-3 mt-1">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Color</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="colorpicker-showinput-intial" name="code" value="#f46a6a">
                                    </div>
                                    @error('code')
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
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Color">
                            </form>



                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

        </div>
    </div>


    <script src="{{ asset('backend/assets/libs/spectrum-colorpicker2/spectrum.min.js') }}"></script>

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
