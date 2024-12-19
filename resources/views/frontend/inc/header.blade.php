
<style>
    .menus_link{
        color: #008FD7;
    }
</style>
<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left d-none d-sm-block">
                {{-- <p class="top-message text-uppercase">FREE Returns. Standard Shipping Orders $99+</p> --}}
                
                <div class="header-dropdown">
                    <span><i class="flag-de flag"></i>DEU</span>
                </div><!-- End .header-dropown -->

            </div><!-- End .header-left -->

            <div class="header-right header-dropdowns ml-0 ml-sm-auto w-sm-100">
                <div class="header-dropdown dropdown-expanded d-none d-lg-block">
                    <a href="#">Links</a>
                    <div class="header-menu">
                        <ul>
                            <li class="{{ Request::is('about') ? 'menus_link' : '' }}"><a href="{{ url('about') }}" >About Us</a></li>
                            <li class="{{ Request::is('contact') ? 'menus_link' : '' }}"><a href="{{ url('contact') }}">Contact Us</a></li>
                            @if (Auth::check())
                            <li class="{{ Request::is('my-wishlist') ? 'menus_link' : '' }}"><a href="{{ url('my-wishlist') }}">My Wishlist</a></li>
                            @else 
                            <li class="{{ Request::is('my-wishlist') ? 'menus_link' : '' }}"><a href="{{ route('decline_wishlist') }}">My Wishlist</a></li>
                            @endif

                            @if (Auth::guard('admin')->check()) 
                                <li><a href="{{ route('admin_logout') }}" class="">Logout</a></li>
                             @elseif (Auth::check())
                                <li><a href="{{ route('user_logout') }}" class="">Logout</a></li>
                            @else
                                <li><a href="{{ url('login') }}" class="">Log in</a></li>
                            @endif
                        
                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropown -->

                <span class="separator"></span>

                <span class="separator"></span>

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
                </div><!-- End .social-icons -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-top -->

    <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
        <div class="container">
            <div class="header-left col-lg-2 w-auto pl-0">
                <button class="mobile-menu-toggler text-primary mr-2" type="button">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ $getSystemSettingsApp->getLogo() }}" width="111" height="44" alt="{{ $getSystemSettingsApp->name }}">
                </a>
            </div><!-- End .header-left -->
                @php
                    use App\Models\category;
                    use App\Models\subCategory;
                @endphp
            <div class="header-right w-lg-max">
                <div
                    class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mt-0">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                    <form action="{{ route('search_product') }}" method="GET">
                        <div class="header-search-wrapper">
                            <input type="search" class="form-control" name="q" id="q"
                                placeholder="Search..." required>
                            <button class="btn icon-magnifier p-0" type="submit"></button>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->

                <div class="header-contact d-none d-lg-flex pl-4 pr-4">
                    <img alt="phone" src="{{ asset('frontend/assets/images/phone.png') }}" width="30" height="30" class="pb-1">
                    <h6><span>Call us now</span><a href="tel:{{ $getSystemSettingsApp->phone1 }}" class="text-dark font1">{{ $getSystemSettingsApp->phone1 }}</a></h6>
                </div>
                @if (Auth::guard('admin')->check()) 
                <a href="{{ url('admin/dashboard') }}" class="header-icon" title="Admin Dashboard"><i class="icon-user-2"></i></a>
                @elseif (Auth::check())
                <a href="{{ url('dashboard') }}" class="header-icon" title="Dashboard"><i class="icon-user-2"></i></a>
                @else
                <a href="{{ url('login') }}" class="header-icon" title="login"><i class="icon-user-2"></i></a>
                @endif

                <div class="dropdown cart-dropdown">
                    <a href="#" title="Cart" class="dropdown-toggle {{ (Cart::getContent()->count() != 0) ? 'dropdown-arrow' : '' }} cart-toggle"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        data-display="static">
                        <i class="minicart-icon"></i>
                        <span class="cart-count badge-circle">{{ Cart::getContent()->count() }}</span>
                    </a>

                    @if (!empty(Cart::getContent()->count()))
                    <div class="cart-overlay"></div>
                    <div class="dropdown-menu mobile-cart">
                        <a href="#" title="Close (Esc)" class="btn-close">×</a>

                        <div class="dropdownmenu-wrapper custom-scrollbar">
                            <div class="dropdown-cart-header">Shopping Cart</div>
                            <!-- End .dropdown-cart-header -->

                            <div class="dropdown-cart-products">
                                @php
                                    $cart = app('cart'); 
                                @endphp
                                @foreach ($cart->getContent() as $headerCart)
                                @php
                                    $getCartProduct = App\Models\products::getSingle($headerCart->id);
                                @endphp
                                @if(!empty($getCartProduct))
                                @php
                                    $images = $getCartProduct->getFirstAndSecondImages();
                                    $firstImage = $images->first();
                                    $secondImage = $images->count() > 1 ? $images->get(1) : null;
                                @endphp
                                <div class="product">
                                    <div class="product-details">
                                        <h4 class="product-title">
                                            <a href="{{ route('productDetailsSubCat', [$getCartProduct->category_id, Str::slug($getCartProduct['productCategory']['name']), $getCartProduct->subcategory_id, Str::slug($getCartProduct['productSubCategory']['name']), $getCartProduct->id, Str::slug($getCartProduct->title)]) }}">{{ $getCartProduct->title }}</a>
                                        </h4>

                                        <span class="cart-product-info">
                                            <span class="cart-product-qty">{{ $headerCart->quantity }}</span>
                                            × €{{ number_format($headerCart->price, 2) }}
                                        </span>
                                    </div><!-- End .product-details -->

                                    <figure class="product-image-container">
                                        <a href="{{ route('productDetailsSubCat', [$getCartProduct->category_id, Str::slug($getCartProduct['productCategory']['name']), $getCartProduct->subcategory_id, Str::slug($getCartProduct['productSubCategory']['name']), $getCartProduct->id, Str::slug($getCartProduct->title)]) }}" class="product-image">
                                            @if ($firstImage)
                                            <img src="{{ asset($firstImage->image_name) }}" width="80"
                                                height="80" alt="{{ $getCartProduct->title }}" alt="{{ $getCartProduct->title }}"/>
                                        @else
                                            <img src="{{ asset('upload/no_image.jpg') }}" width="80" height="80"
                                            alt="{{ $getCartProduct->title }}" />
                                        @endif
                                        </a>

                                        <a href="{{ route('cart_delete', $getCartProduct->id) }}" class="btn-remove"
                                            title="Remove Product"><span>×</span></a>
                                    </figure>
                                </div><!-- End .product -->
                                @endif
                                @endforeach

                            </div><!-- End .cart-product -->

                            <div class="dropdown-cart-total">
                                <span>SUBTOTAL:</span>

                                <span class="cart-total-price float-right">€{{ number_format($cart->getSubTotal(), 2) }}</span>
                            </div><!-- End .dropdown-cart-total -->

                            <div class="dropdown-cart-action">
                                <a href="{{ url('cart') }}" class="btn btn-gray btn-block view-cart">View
                                    Cart</a>
                                <a href="{{ url('checkout') }}" class="btn btn-dark btn-block">Checkout</a>
                            </div><!-- End .dropdown-cart-total -->
                        </div><!-- End .dropdownmenu-wrapper -->
                    </div><!-- End .dropdown-menu -->                        
                    @endif


                </div><!-- End .dropdown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->

    <div class="header-bottom sticky-header d-none d-lg-block" data-sticky-options="{'mobile': false}">
        <div class="container">
            <nav class="main-nav w-100">
                <ul class="menu">
                    <li  class="{{ Request::is('/') ? 'active' : '' }}">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    {{-- <li class="{{ Route::is('front_categories') ? 'active' : '' }}">
                        <a href="javascript:void(0)">Shop</a>
                        <div class="megamenu megamenu-fixed-width megamenu-3cols">
                            <div class="row">
                                @php
                                    $getCategories = category::where('status', 0)
                                    ->where('isdelete', 0)
                                    ->inRandomOrder()
                                    ->limit(6)
                                    ->get();
                                @endphp
                                @foreach ($getCategories as $categories)
                                 @if (!empty($categories->getSubCategory->count()))

                                <div class="col-lg-4">
                                    <a href="{{ route('front_categories', [$categories->id, Str::slug($categories->name)]) }}" class="nolink">{{ $categories->name }}</a>
                                    @php
                                        $getSubcategories = subCategory::where('category_id', $categories->id)->where('isdelete', 0)->where('status', 0)->limit(5)->get();
                                    @endphp
                                    <ul class="submenu">
                                        @foreach ($getSubcategories as $subCategory)
                                        <li><a href="{{ route('front_sub_categories', [$categories->id, Str::slug($categories->name), $subCategory->id, Str::slug($subCategory->name) ]) }}">{{ $subCategory->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>

                                @endif
                                @endforeach
                            </div>
                        </div><!-- End .megamenu -->
                    </li> --}}


                    <li class="{{ Route::is('front_categories', 'front_sub_categories') ? 'active' : '' }}">
                        <a href="javascript:void(0)">Shop</a>
                        <div class="megamenu megamenu-fixed-width megamenu-3cols">
                            <div class="row">
                                @php
                                    $getCategories = category::where('status', 0)
                                        ->where('isdelete', 0)
                                        ->inRandomOrder()
                                        ->limit(6)
                                        ->get();
                                @endphp
                                @foreach ($getCategories as $categories)
                                    @if ($categories->getSubCategory->count() > 0)
                                        <div class="col-lg-4">
                                            <a href="{{ route('front_categories', [$categories->id, Str::slug($categories->name)]) }}" class="nolink">
                                                {{ $categories->name }}
                                            </a>
                                            @php
                                                $getSubcategories = subCategory::where('category_id', $categories->id)
                                                    ->where('isdelete', 0)
                                                    ->where('status', 0)
                                                    ->limit(5)
                                                    ->get();
                                            @endphp
                                            <ul class="submenu">
                                                @foreach ($getSubcategories as $subCategory)
                                                    <li>
                                                        <a href="{{ route('front_sub_categories', [$categories->id, Str::slug($categories->name), $subCategory->id, Str::slug($subCategory->name) ]) }}">
                                                            {{ $subCategory->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div><!-- End .megamenu -->
                    </li>
                    




                    @php
                        $getMenuCategory = App\Models\category::menuCategory();
                    @endphp
                    @foreach ($getMenuCategory as $menuCategory)
                        <li class="{{ request()->route('cat_id') == $menuCategory->id ? 'active' : '' }}">
                            <a href="{{ route('front_categories', [$menuCategory->id, Str::slug($menuCategory->name)]) }}">
                                {{ $menuCategory->name }}
                            </a>
                        </li>
                    @endforeach

                    @if (Auth::guard('admin')->check()) 
                    <li class="float-right"><a href="{{ url('admin/dashboard') }}" class="pl-5">{{ Auth::guard('admin')->user()->name }}</a></li>
                    @endif

                    @if (Auth::check())
                    <li class="float-right"><a href="{{ url('dashboard') }}" class="pl-5">{{ Auth::user()->name }}</a></li>
                    @endif
                </ul>
            </nav>
        </div><!-- End .container -->
    </div><!-- End .header-bottom -->

</header><!-- End .header -->
