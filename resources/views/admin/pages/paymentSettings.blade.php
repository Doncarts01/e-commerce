@extends('admin.admin-master')

@section('title')
Admin | Payment Settings
@endsection
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Payment Settings</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">Edit Payment Settings</h1>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('update_payment_settings') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3 mt-1">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">CASH ON DELIVERY</label>
                                    <div class="col-sm-10">

                                        <div class="d-flex flex-wrap gap-2 mt-2">
                                            <input type="checkbox" id="switch1" switch="bool" {{ !empty($settinga->is_cash) ? 'checked' : '' }} name="is_cash" />
                                            <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                        </div>

                                    </div>
                                </div>
                                <!-- end row -->

                                <hr>

                                <div class="row mb-3 mt-1">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">PAYPAL</label>
                                    <div class="col-sm-10">

                                        <div class="d-flex flex-wrap gap-2 mt-2">
                                            <input type="checkbox" id="switch2" switch="bool" {{ !empty($settinga->is_paypal) ? 'checked' : '' }} name="is_paypal" />
                                            <label for="switch2" data-on-label="On" data-off-label="Off"></label>
                                        </div>

                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3 mt-1">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">PAYPAL ID</label>
                                    <div class="col-sm-10">
                                        <input name="paypal_id" class="form-control" type="text" id="example-text-input"
                                            placeholder="PayPal ID" value="{{ $settinga->paypal_id }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3 mt-1">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">PAYPAL SECRET KEY</label>
                                    <div class="col-sm-10">
                                        <input name="paypal_sk" class="form-control" type="text" id="example-text-input"
                                            placeholder="PayPal Secret Key" value="{{ $settinga->paypal_sk }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3 mt-1">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">PAYPAL STATUS</label>
                                    <div class="col-sm-10">
                                        <select name="paypal_status" id="paypal_status" class="form-select">
                                            <option {{ ($settinga->paypal_status == 'sandbox') ? 'selected' : '' }} value="sandbox">Sandbox</option>
                                            <option {{ ($settinga->paypal_status == 'live') ? 'selected' : '' }} value="live">Live</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- end row -->

                                <hr>

                                
                                <div class="row mb-3 mt-1">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">STRIPE</label>
                                    <div class="col-sm-10">

                                        <div class="d-flex flex-wrap gap-2 mt-2">
                                            <input type="checkbox" id="switch3" switch="bool" {{ !empty($settinga->is_stripe) ? 'checked' : '' }} name="is_stripe" />
                                            <label for="switch3" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                                
                                <div class="row mb-3 mt-1">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">STRIPE PUBLIC KEY</label>
                                    <div class="col-sm-10">
                                        <input name="stripe_pk" class="form-control" type="text" id="example-text-input"
                                            placeholder="Stripe Public Key" value="{{ $settinga->stripe_pk }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3 mt-1">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">STRIPE SECRET KEY</label>
                                    <div class="col-sm-10">
                                        <input name="stripe_sk" class="form-control" type="text" id="example-text-input"
                                            placeholder="Stripe Secret Key" value="{{ $settinga->stripe_sk }}">
                                    </div>
                                </div>
                                <!-- end row -->


                                <hr>

                                
                                <div class="row mb-3 mt-1">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">PAYSTACK</label>
                                    <div class="col-sm-10">
                                        <div class="d-flex flex-wrap gap-2 mt-2">
                                            <input type="checkbox" id="switch4" switch="bool" {{ !empty($settinga->is_paystack) ? 'checked' : '' }} name="is_paystack" />
                                            <label for="switch4" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                                
                                <div class="row mb-3 mt-1">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">PAYSTACK PUBLIC KEY</label>
                                    <div class="col-sm-10">
                                        <input name="paystack_pk" class="form-control" type="text" id="example-text-input"
                                            placeholder="Paystack Public Key" value="{{ $settinga->paystack_pk }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3 mt-1">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">PAYSTACK SECRET KEY</label>
                                    <div class="col-sm-10">
                                        <input name="paystack_sk" class="form-control" type="text" id="example-text-input"
                                            placeholder="Paystack Secret Key" value="{{ $settinga->paystack_sk }}">
                                    </div>
                                </div>
                                <!-- end row -->


                                <div class="row mb-3 mt-1">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">MERCHANT EMAIL</label>
                                    <div class="col-sm-10">
                                        <input name="merchant_email" class="form-control" type="email" id="example-text-input"
                                            placeholder="Paystack Merchant Email" value="{{ $settinga->merchant_email }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Payment Settings">
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
