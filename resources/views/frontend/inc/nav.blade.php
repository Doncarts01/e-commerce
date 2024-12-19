{{-- <div class="loading-overlay">
    <div class="bounce-loader">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div> --}}

{{-- <div class="mobile-menu-overlay"></div> --}}
<!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="fa fa-times"></i></span>
        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li><a href="{{ url('/') }}">Home</a></li>
                    @php
                        use App\Models\category;
                        use App\Models\subCategory;

                        $getCategories = category::where('status', 0)
                        ->where('isdelete', 0)
                        ->inRandomOrder()
                        ->get();
                    @endphp

                    @foreach ($getCategories as $categories)
                         @if (!empty($categories->getSubCategory->count()))

                        <li>
                                <a href="{{ route('front_categories', [$categories->id, Str::slug($categories->name)]) }}">{{ $categories->name }}</a>
                                @php
                                $getSubcategories = subCategory::where('category_id', $categories->id)->where('isdelete', 0)->where('status', 0)->limit(5)->get();
                            @endphp
                            <ul>
                                    @foreach ($getSubcategories as $subCategory)
                                    <li><a href="{{ route('front_sub_categories', [$categories->id, Str::slug($categories->name), $subCategory->id, Str::slug($subCategory->name) ]) }}">{{ $subCategory->name }}</a>
                                    </li>
                                    @endforeach
                            </ul>
                        </li>
                        @endif
                
                    @endforeach
            </ul>

            <ul class="mobile-menu">
                @if (Auth::guard('admin')->check()) 
                <li><a href="{{ url('admin/dashboard') }}">My Account</a></li>
                @elseif (Auth::check())
                <li><a href="{{ url('dashboard') }}">My Account</a></li>
                @else
                <li><a href="{{ url('dashboard') }}">My Account</a></li>
                @endif
                <li><a href="{{ url('about') }}">About Us</a></li>
                <li><a href="{{ url('contact') }}">Contact Us</a></li>
                @if (Auth::check())
                <li><a href="{{ url('my-wishlist') }}">My Wishlist</a></li>
                @endif
                <li><a href="{{ url('cart') }}">Cart</a></li>
                @if (Auth::guard('admin')->check()) 
                <li><a href="{{ url('admin/logout') }}" class="">Log out</a></li>
                @endif

                @if (Auth::check())
                <li><a href="{{ url('user/logout') }}" class="">Log out</a></li>
                @endif
            </ul>
        </nav>
        <!-- End .mobile-nav -->

        <form class="search-wrapper mb-2" action="{{ route('search_product') }}" method="GET">
            <input type="text" class="form-control mb-0" placeholder="Search..." name="q" id="q" required />
            <button class="btn icon-search text-white bg-transparent p-0" type="submit"></button>
        </form>

        <div class="social-icons">

            @if (!empty($getSystemSettingsApp->facebook))
            <a href="{{ $getSystemSettingsApp->facebook }}" class="social-icon social-facebook icon-facebook" target="_blank"></a>       
            @endif
            @if (!empty($getSystemSettingsApp->twitter))
            <a href="{{ $getSystemSettingsApp->twitter }}" class="social-icon social-twitter icon-twitter" target="_blank"></a>
            @endif
            @if (!empty($getSystemSettingsApp->instagram))
            <a href="{{ $getSystemSettingsApp->instagram }}" class="social-icon social-instagram icon-instagram" target="_blank"></a>
            @endif
        </div>
    </div>
    <!-- End .mobile-menu-wrapper -->
</div>
<!-- End .mobile-menu-container -->

<div class="sticky-navbar">
    <div class="sticky-info">
        <a href="{{ url('/') }}">
            <i class="icon-home"></i>Home
        </a>
    </div>
    <div class="sticky-info">
        
        <a href="{{ !empty($getCategories->count()) ? route('front_categories', [$categories->id, Str::slug($categories->name)]) : '' }}">
            <i class="icon-bars"></i>Categories
        </a>
    </div>
    <div class="sticky-info">
        @if (Auth::check())
        <a href="{{ url('my-wishlist') }}" class="">
            <i class="icon-wishlist-2"></i>Wishlist
        </a>
        @else
        <a href="{{ route('decline_wishlist') }}" class="">
            <i class="icon-wishlist-2"></i>Wishlist
        </a>
        @endif
    </div>
    <div class="sticky-info">
        @if (Auth::guard('admin')->check()) 
        <a href="{{ url('admin/dashboard') }}" class="">
            <i class="icon-user-2"></i>Account
        </a>
        @elseif (Auth::check())
        <a href="{{ url('dashboard') }}" class="">
            <i class="icon-user-2"></i>Account
        </a>
        @else
        <a href="{{ url('dashboard') }}" class="">
            <i class="icon-user-2"></i>Account
        </a>
        @endif

    </div>
    <div class="sticky-info">
        <a href="{{ url('cart') }}" class="">
            <i class="icon-shopping-cart position-relative">
                <span class="cart-count badge-circle">{{ Cart::getContent()->count() }}</span>
            </i>Cart
        </a>
    </div>
</div>
{{-- 
<div class="newsletter-popup mfp-hide bg-img" id="newsletter-popup-form"
    style="background: #f1f1f1 no-repeat center/cover url({{ asset('frontend/assets/images/newsletter_popup_bg.jpg') }})">
    <div class="newsletter-popup-content">
        <img src="{{ asset('frontend/assets/images/logo.png') }}" width="111" height="44" alt="Logo" class="logo-newsletter">
        <h2>Subscribe to newsletter</h2>

        <p>
            Subscribe to the Porto mailing list to receive updates on new arrivals, special offers and our promotions.
        </p>

        <form action="#">
            <div class="input-group">
                <input type="email" class="form-control" id="newsletter-email" name="newsletter-email"
                    placeholder="Your email address" required />
                <input type="submit" class="btn btn-primary" value="Submit" />
            </div>
        </form>
        <div class="newsletter-subscribe">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" value="0" id="show-again" />
                <label for="show-again" class="custom-control-label">
                    Don't show this popup again
                </label>
            </div>
        </div>
    </div>
    <!-- End .newsletter-popup-content -->

    <button title="Close (Esc)" type="button" class="mfp-close">
        ×
    </button>
</div> --}}
<!-- End .newsletter-popup -->

<a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>
