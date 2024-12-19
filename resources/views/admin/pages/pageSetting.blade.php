@extends('admin.admin-master')

@section('title')
Admin | System Settings
@endsection
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">System Settings</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">Edit System Settings</h1>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('update_system_settings') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3 mt-1">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">WEBSITE NAME</label>
                                    <div class="col-sm-10">
                                        <input name="name" class="form-control" type="text" id="example-text-input"
                                            placeholder="Afro Foods " value="{{ $settinga->name }}">
                                    </div>
                                </div>
                                <!-- end row -->



                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">LOGO</label>
                                    <div class="col-sm-10">
                                            <input name="logo" class="form-control" type="file"  id="logo" accept="image/jpg image/png image/jpeg image/bmp">

                                            <div class="col-12">
                                                <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($settinga->logo)) ? url($settinga->logo) :url('upload/no_image.jpg') }}" alt="Card image cap">
                                            </div>
                                    </div>
                                </div>
                                <!-- end row -->


                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">FAVICON</label>
                                    <div class="col-sm-10">
                                            <input name="favicon" class="form-control" type="file"  id="imagefav" accept="image/jpg image/png image/jpeg image/bmp">

                                            <div class="col-12 mt-2">
                                                <img id="showimagefav" class="rounded avatar-lg" src="{{ (!empty($settinga->favicon)) ? url($settinga->favicon) :url('upload/no_image.jpg') }}" alt="Card image cap">
                                            </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">FOOTER DESCRIPTION</label>
                                    <div class="col-sm-10">
                                        <textarea name="footer_description" class="form-control" cols="10" rows="2">
                                            {{ $settinga->footer_description }}
                                        </textarea>
                                    </div>
                                </div>
                                <!-- end row -->

                                <hr>

                                
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">ADDRESS</label>
                                    <div class="col-sm-10">
                                        <input name="address" class="form-control" type="text" id="example-text-input"
                                            placeholder="address " value=" {{ $settinga->address }}">
                                    </div>
                                </div>
                                <!-- end row -->
                                
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">PHONE 1</label>
                                    <div class="col-sm-10">
                                        <input name="phone1" class="form-control" type="text" id="example-text-input"
                                            placeholder="1234567890"  value="{{ $settinga->phone1 }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">PHONE 2</label>
                                    <div class="col-sm-10">
                                        <input name="phone2" class="form-control" type="text" id="example-text-input"
                                            placeholder="1234567890" value="{{ $settinga->phone2 }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">SUBMIT CONTACT EMAIL</label>
                                    <div class="col-sm-10">
                                        <input name="contact_email" class="form-control" type="email" id="example-text-input"
                                            placeholder="demo@example.com " value="{{ $settinga->contact_email }}"> 
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">EMAIL 1</label>
                                    <div class="col-sm-10">
                                        <input name="email1" class="form-control" type="email" id="example-text-input"
                                            placeholder="demo@example.com "  value="{{ $settinga->email1 }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">EMAIL 2</label>
                                    <div class="col-sm-10">
                                        <input name="email2" class="form-control" type="email" id="example-text-input"
                                            placeholder="demo@example.com" value="{{ $settinga->email2 }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">WORKING HOURS</label>
                                    <div class="col-sm-10">
                                        <input name="working_hours" class="form-control" type="text" id="example-text-input"
                                            placeholder="Mon - Sun / 9:00 AM - 8:00 PM "  value="{{ $settinga->working_hours }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <hr>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">FACEBOOK URL</label>
                                    <div class="col-sm-10">
                                        <input name="facebook" class="form-control" type="url" id="example-text-input"
                                            placeholder="https:// " value="{{ $settinga->facebook }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">TWITTER URL</label>
                                    <div class="col-sm-10">
                                        <input name="twitter" class="form-control" type="url" id="example-text-input"
                                            placeholder="https:// " value="{{ $settinga->twitter }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">INSTAGRAM URL</label>
                                    <div class="col-sm-10">
                                        <input name="instagram" class="form-control" type="url" id="example-text-input"
                                            placeholder="https:// " value="{{ $settinga->instagram }}">
                                    </div>
                                </div>
                                <!-- end row -->


                                <!-- end row -->
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Settings">
                            </form>



                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('backend/assets/js/jQuery_UI.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#imagefav').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showimagefav').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });


            $('#logo').change(function(e) {
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
