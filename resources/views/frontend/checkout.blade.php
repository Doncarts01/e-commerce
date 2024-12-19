@extends('frontend.frontend_masters')
@php
$getSystemSettingsApp = App\Models\settings::getSingle();
@endphp

@section('title')
{{ $getSystemSettingsApp->name }} | Checkouts
@endsection

@section('main')
    <main class="main main-test">
        <div class="container checkout-container">
            <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                <li class="active">
                    <a href="checkout.html">Checkout</a>
                </li>user@test.com
            </ul>

            <form action="" method="POST" id="submitForm">
                @csrf
                <div class="row">
                    <div class="col-lg-7">
                        <ul class="checkout-steps">
                            <li>
                                <h2 class="step-title">Billing details</h2>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First name
                                                    <abbr class="required" title="required">*</abbr>
                                                </label>
                                                <input type="text" name="firstName" class="form-control" required value="{{ !empty(Auth::user()->firstname) ? Auth::user()->firstname : ''  }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last name
                                                    <abbr class="required" title="required">*</abbr></label>
                                                <input type="text" name="lastName" class="form-control" required value="{{ !empty(Auth::user()->lastname) ? Auth::user()->lastname : ''  }}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Country <abbr class="required" title="required">*</abbr> </label>
                                        <input type="text" name="country" class="form-control" required value="{{ !empty(Auth::user()->country) ? Auth::user()->country : ''  }}" />
                                    </div>

                                    <div class="form-group mb-1 pb-2">
                                        <label>Street address
                                            <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" name="address1" class="form-control" placeholder="House number and street name"
                                            required value="{{ !empty(Auth::user()->address1) ? Auth::user()->address1 : ''  }}" />
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control"
                                            placeholder="Apartment, suite, unite, etc. (optional)" name="address2" value="{{ !empty(Auth::user()->address2) ? Auth::user()->address2 : ''  }}" />
                                    </div>

                                    <div class="form-group">
                                        <label>Town / City
                                            <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" name="city" class="form-control" required  value="{{ !empty(Auth::user()->city) ? Auth::user()->city : ''  }}"/>
                                    </div>

                                    <div class="form-group">
                                        <label>State
                                            <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" name="state" class="form-control" required value="{{ !empty(Auth::user()->state) ? Auth::user()->state : ''  }}" />
                                    </div>

                                    <div class="form-group">
                                        <label>Postcode / Zip
                                            <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" name="postcode" class="form-control" required value="{{ !empty(Auth::user()->postcode) ? Auth::user()->postcode : ''  }}" />
                                    </div>

                                    <div class="form-group">
                                        <label>Phone <abbr class="required" title="required">*</abbr></label>
                                        <input type="tel" name="phone" class="form-control" required value="{{ !empty(Auth::user()->phone) ? Auth::user()->phone : ''  }}" />
                                    </div>

                                    <div class="form-group">
                                        <label>Email address
                                            <abbr class="required" title="required">*</abbr></label>
                                        <input type="email" name="email" class="form-control" value="{{ !empty(Auth::user()->email) ? Auth::user()->email : ''  }}" {{ !empty(Auth::user()->email) ? 'readonly'  : ''  }} required />
                                        <div class="error text-danger" id="emailError"></div>
                                    </div>

                                    @if (empty(Auth::check()))                                        
                                    <div class="form-group mb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="create-account" name="isCreate"/>
                                            <label class="custom-control-label" data-toggle="collapse"
                                                data-target="#collapseThree" aria-controls="collapseThree"
                                                for="create-account">Create an
                                                account?</label>
                                        </div>
                                    </div>

                                    <div id="collapseThree" class="collapse">
                                        <div class="form-group">
                                            <label>Create account password
                                                <abbr class="required" title="required">*</abbr></label>
                                            <input type="password" name="password" placeholder="Password" class="form-control" required />
                                        </div>
                                        <div class="error text-danger" id="passwordError"></div>
                                    </div>
                                    @endif


                                    <div class="form-group">
                                        <label class="order-comments">Order notes (optional)</label>
                                        <textarea class="form-control" name="notes" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>
                            </li>
                        </ul>
                    </div>
                    <!-- End .col-lg-8 -->

                    <div class="col-lg-5">
                        <div class="order-summary">
                            <h3>YOUR ORDER</h3>

                            <table class="table table-mini-cart">
                                <thead>
                                    <tr>
                                        <th colspan="2">Product</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cart = app('cart');
                                    @endphp
                                    @foreach ($cart->getContent() as $key => $carts)
                                        @php
                                            $getCartProduct = App\Models\products::getSingle($carts->id);
                                        @endphp
                                        <tr>
                                            <td class="product-col">
                                                <h3 class="product-title">
                                                    {{ $getCartProduct->title }} ×
                                                    <span class="product-qty">{{ $carts->quantity }}</span>
                                                </h3>
                                            </td>

                                            <td class="price-col">
                                                <span>€{{ number_format($carts->price * $carts->quantity, 2) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <td>
                                            <h4>Subtotal</h4>
                                        </td>

                                        <td class="price-col">
                                            <span>€{{ number_format($cart->getSubTotal(), 2) }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="cart-discount mb-0">
                                                <div class="input-group">
                                                    <input type="text" id="getCouponCode"
                                                        class="form-control form-control-sm" placeholder="Coupon Code" name="couponCode">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-sm btn-outline-primary" type="button"
                                                            id="applyCoupon">Apply
                                                            Coupon</button>
                                                    </div>
                                                </div><!-- End .input-group -->
                                                <h6 class="text-danger d-none" id="error">Invalid Coupon code</h6>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4>Discount</h4>
                                        </td>

                                        <td class="price-col">
                                            <span id="coupon_amount">€0.00</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" class="text-left">
                                            <h4>Shipping</h4>
                                            
                                            @foreach ($getShipping as $shipping)
                                            <div class="form-group form-group-custom-control mb-0">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input getShippingCharge" name="shipping" value="{{ $shipping->id }} " id="shipping{{ $shipping->id }}" data-price="{{ !empty($shipping->price) ? $shipping->price : 0}}" required>
                                                    <label class="custom-control-label" for="shipping{{ $shipping->id }}">{{ $shipping->name }}   
                                                        @if (!empty($shipping->price))
                                                            <b>(€{{ number_format($shipping->price, 2) }})</b>
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach

                                        </td>
                                    </tr>



                                    <tr class="order-total">
                                        <td>
                                            <h4>Total</h4>
                                        </td>
                                        <td>
                                            <input type="hidden" id="getShippingChargeTotal" value="0">
                                            <input type="hidden" id="payableTotal" value="{{ $cart->getSubTotal() }}">
                                            <b class="total-price">€<span
                                                    id="payable_total">{{ number_format($cart->getSubTotal(), 2) }}</span></b>
                                        </td>
                                    </tr>

                                    </tr>
                                    <tr class="order-shipping">
                                        <td class="text-left" colspan="2">
                                            <h4 class="m-b-sm mt-1">Payment methods</h4>
                                            @if (!empty($paymentSettings->is_cash))
                                            <div class="form-group form-group-custom-control">
                                                <div class="custom-control custom-radio d-flex">
                                                    <input type="radio" class="custom-control-input" name="payment_method" value="cash" />
                                                    <label class="custom-control-label">Cash on devlivery</label>
                                                </div>
                                                <!-- End .custom-checkbox -->
                                            </div>    
                                            @endif


                                            @if (!empty($paymentSettings->is_paypal))
                                            <div class="form-group form-group-custom-control">
                                                <div class="custom-control custom-radio d-flex">
                                                    <input type="radio" class="custom-control-input" name="payment_method" value="paypal" />
                                                    <label class="custom-control-label">Paypal</label>
                                                </div>
                                                <!-- End .custom-checkbox -->
                                            </div>

                                            @endif

                                            
                                            @if (!empty($paymentSettings->is_stripe))
                                            <div class="form-group form-group-custom-control">
                                                <div class="custom-control custom-radio d-flex">
                                                    <input type="radio" class="custom-control-input" name="payment_method" value="stripe"/>
                                                    <label class="custom-control-label">Credit card (Stripe)</label>
                                                </div>
                                                <!-- End .custom-checkbox -->
                                            </div>
                                            @endif

                                            
                                            @if (!empty($paymentSettings->is_paystack))
                                            <div class="form-group form-group-custom-control">
                                                <div class="custom-control custom-radio d-flex">
                                                    <input type="radio" class="custom-control-input" name="payment_method" value="paystack"/>
                                                    <label class="custom-control-label">Paystack</label>
                                                </div>
                                                <!-- End .custom-checkbox -->
                                            </div>
                                            @endif

                                            
                                            <div class="row mb-4">
                                                <img src="{{ asset('frontend/assets/images/payments/04.png') }}"
                                                    class="img-fluid mx-auto d-block" alt="">
                                            </div>
                                            <!-- End .form-group -->
                                        </td>

                                    </tr>
                                </tfoot>
                            </table>

                            {{-- <div class="payment-methods">
                            <h4 class="">Payment methods</h4>
                            <div class="info-box with-icon p-0">

                                <p>
                                    Sorry, it seems that there are no available payment methods for your state.
                                    Please contact us if you require assistance or wish to make alternate
                                    arrangements.
                                </p>
                            </div>
                        </div> --}}

                            <button type="submit" class="btn btn-dark btn-place-order">
                                Place order
                            </button>
                        </div>
                        <!-- End .cart-summary -->
                    </div>
                    <!-- End .col-lg-4 -->
                </div>
            </form>

            <!-- End .row -->
        </div>
        <!-- End .container -->
    </main>
@endsection

<script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {

        // 
        $('body').delegate('.getShippingCharge', 'change', function() {
            var price = $(this).attr('data-price');
            var total = $('#payableTotal').val();
            $('#getShippingChargeTotal').val(price);

            var finalTotal = parseFloat(price) + parseFloat(total);
            $('#payable_total').html(finalTotal.toFixed(2));
            
        });


        $('body').delegate('#submitForm', 'submit', function(e) {
            e.preventDefault();
            var formData = $('#submitForm').serialize();
            $.ajax({
                url: "{{ url('checkout/place-order') }}",
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(data) {
                    if(data.status == true){
                        window.location.href = data.redirect;
                    }else {
                        displayErrors(data.errors);
                    }
                },
                error: function(data) {

                }
            });

        });

        $('body').delegate('#applyCoupon', 'click', function() {
            var couponCode = $('#getCouponCode').val();
            $('#applyCoupon').text('checking...')

            $.ajax({
                url: "{{ url('checkout/apply-coupon') }}",
                type: 'POST',
                data: {
                    couponCode: couponCode,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {
                    $('#applyCoupon').text('Valid');
                        $('#error').addClass('d-none');
                        $('#error').removeClass('d-block');
                        setTimeout(() => {
                            $('#applyCoupon').text('Apply coupon')
                            $('#coupon_amount').html(response.coupon_amount);
                            var shipping = $('#getShippingChargeTotal').val();
                            var finalTotal = parseFloat(shipping) + parseFloat(response.payable_total)
                            $('#payable_total').html(finalTotal.toFixed(2));
                            $('#payableTotal').val(response.payable_total);
                            
                        }, 1000); 
                    if (response.status == false) {
                        $('#applyCoupon').text('Apply coupon')
                        $('#error').removeClass('d-none');
                        $('#error').addClass('d-block');
                        $('#error').text(response.message);
                    } 

                }
            });
        });




        function displayErrors(errors) {
            // Clear previous errors
            $('.error').text('');

            // Display new errors
            if (errors.email) {
                $('#emailError').text(errors.email);
            }
            if (errors.password) {
                $('#passwordError').text(errors.password);
            }
            // Add other fields as needed
        }







    });
</script>
