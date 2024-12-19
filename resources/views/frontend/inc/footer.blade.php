<footer class="footer bg-dark">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">Contact Info</h4>
                        <ul class="contact-info">
                            <li>
                                <span class="contact-info-label">Address:</span>
                                {{ $getSystemSettingsApp->address }}
                            </li>
                            <li>
                                <span class="contact-info-label">Phone:</span><a href="tel: {{ $getSystemSettingsApp->phone1 }}"> {{ $getSystemSettingsApp->phone1 }}</a>
                            </li>
                            @if(!empty($getSystemSettingsApp->phone2))
                            <li>
                                <span class="contact-info-label">Phone 2:</span><a href="tel: {{ $getSystemSettingsApp->phone2 }}"> {{ $getSystemSettingsApp->phone2 }}</a>
                            </li>
                            @endif
                            <li>
                                <span class="contact-info-label">Email:</span> <a href="mailto:{{ $getSystemSettingsApp->email1 }}"><span class="" >{{ $getSystemSettingsApp->email1 }}</span></a>
                            </li>
                            @if(!empty($getSystemSettingsApp->email2))
                            <li>
                                <span class="contact-info-label">Email 2:</span> <a href="mailto:{{ $getSystemSettingsApp->email2 }}"><span class="" >{{ $getSystemSettingsApp->email2 }}</span></a>
                            </li>
                            @endif
                            @if(!empty($getSystemSettingsApp->working_hours))
                            <li>
                                <span class="contact-info-label">Working Days/Hours:</span> {{ $getSystemSettingsApp->working_hours }}
                            </li>
                            @endif
      
                        </ul>
                        <div class="social-icons">
                            @if (!empty($getSystemSettingsApp->facebook))
                            <a href="{{ $getSystemSettingsApp->facebook }}" class="social-icon social-facebook icon-facebook" target="_blank" title="Facebook"></a>
                            @endif
                            @if (!empty($getSystemSettingsApp->twitter))
                            <a href="{{ $getSystemSettingsApp->twitter }}" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
                            @endif
                            @if (!empty($getSystemSettingsApp->instagram))
                            <a href="{{ $getSystemSettingsApp->instagram }}" class="social-icon social-instagram icon-instagram" target="_blank" title="Instagram"></a>
                            @endif
                        </div>
                        <!-- End .social-icons -->
                    </div>
                    <!-- End .widget -->
                </div>
                <!-- End .col-lg-3 -->

                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">Customer Service</h4>

                        <ul class="links">
                            <li><a href="{{ url('payment-method') }}">Payment Methods</a></li>
                            <li><a href="{{ url('money-back-guarantee') }}">Money back guarantee</a></li>
                            <li><a href="{{ url('shipping') }}">Shipping & Delivery</a></li>
                            <li><a href="{{ url('returns') }}">Returns</a></li>
                            <li><a href="{{ url('terms-conditions') }}">Terms & Conditions</a></li>
                            <li><a href="{{ url('privacy-policy') }}">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <!-- End .widget -->
                </div>
                <!-- End .col-lg-3 -->

                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">Useful Links</h4>

                        <ul class="links">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('about') }}">About Us</a></li>
                            <li><a href="{{ url('faq') }}">Help & FAQ</a></li>
                            <li><a href="{{ url('contact') }}">Contact Us</a></li>
                            @if (Auth::guard('admin')->check()) 
                                <li><a href="{{ url('admin/dashboard') }}" class="">{{ Auth::guard('admin')->user()->name }}</a></li>
                            @elseif (Auth::check())
                                <li><a href="{{ url('dashboard') }}" class="">{{ Auth::user()->name }}</a></li>
                            @else
                                <li><a href="{{ url('login') }}" class="">Log in</a></li>
                            @endif
                        </ul>
                    </div>
                    <!-- End .widget -->
                </div>
                <!-- End .col-lg-3 -->

                <div class="col-lg-3 col-sm-6">
                    <div class="widget widget-newsletter">
                        <h4 class="widget-title">Subscribe newsletter</h4>
                        <p>Get all the latest information on events, sales and offers. Sign up for newsletter:
                        </p>
                        <form action="{{ url('/subscribe') }}" class="mb-0" method="POST">
                            @csrf
                            <input type="email" name="email" class="form-control m-b-3" placeholder="Email address" required>
                            <input type="submit" class="btn btn-primary shadow-none" value="Subscribe">

                            <div>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </form>
                    </div>
                    <!-- End .widget -->
                </div>
                <!-- End .col-lg-3 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .footer-middle -->

    <div class="container">
        <div class="footer-bottom">
            <div class="container d-sm-flex align-items-center">
                <div class="footer-left">
                    <span class="footer-copyright">© {{ $getSystemSettingsApp->name }}. <script>document.write(new Date().getFullYear())</script> . All Rights Reserved</span>
                </div>

                <div class="footer-right ml-auto mt-1 mt-sm-0">
                    <div class="payment-icons">
                        <span class="payment-icon visa" style="background-image: url({{ asset('frontend/assets/images/payments/payment-visa.svg') }})"></span>
                        <span class="payment-icon paypal" style="background-image: url({{ asset('frontend/assets/images/payments/payment-paypal.svg') }})"></span>
                        <span class="payment-icon stripe" style="background-image: url({{ asset('frontend/assets/images/payments/payment-stripe.png') }})"></span>
                        <span class="payment-icon verisign" style="background-image:  url({{ asset('frontend/assets/images/payments/payment-verisign.svg') }})"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- End .footer-bottom -->
    </div>
    <!-- End .container -->
</footer>