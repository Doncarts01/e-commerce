@extends('frontend.frontend_masters')
@php
$getSystemSettingsApp = App\Models\settings::getSingle();
@endphp

@section('title')
{{ $getSystemSettingsApp->name }} | Home
@endsection

@section('main')
    <main class="main">
        <div class="home-slider slide-animate owl-carousel owl-theme show-nav-hover nav-big mb-2 text-uppercase"
            data-owl-options="{
        'loop': false
    }">
            @foreach ($banner as $slider)
            <div class="home-slide home-slide1 banner banner-md-vw">
                <img class="slide-bg"  style="background-color: #ccc;" src="{{ url($slider->image) }}"width="1903" height="499" alt="slider image">
                <div class="container d-flex align-items-center">
                    <div class="banner-layer appear-animate" data-animation-name="fadeInUpShorter">
                        <h4 class="text-transform-none m-b-3">{{ $slider->text1 }}</h4>
                        <h3 class="m-b-3">{{ $slider->text2 }}</h3>
                        <div class="">
                            <a href="{{ url($slider->redirect_url) }}" class="btn btn-dark btn-lg">Shop Now!</a>
                        </div>
                    </div>
                    <!-- End .banner-layer -->
                </div>
            </div>
            @endforeach

            <!-- End .home-slide -->
        </div>
        <!-- End .home-slider -->




        {{-- Money Guarantee Section --}}
        <div class="container">
            <div class="info-boxes-slider owl-carousel owl-theme mb-2"
                data-owl-options="{
                        'dots': false,
                        'loop': false,
                        'responsive': {
                            '576': {
                                'items': 2
                            },
                            '992': {
                                'items': 3
                            }
                        }
                    }">
                <div class="info-box info-box-icon-left">
                    <i class="icon-shipping"></i>

                    <div class="info-box-content">
                        <h4>FREE SHIPPING &amp; RETURN</h4>
                        <p class="text-body">Shipping & devlivery at affordable prices.</p>
                    </div>
                    <!-- End .info-box-content -->
                </div>
                <!-- End .info-box -->

                <div class="info-box info-box-icon-left">
                    {{-- <i class="icon-money"></i> --}}
                    <i class="fa-solid fa-euro-sign"></i>

                    <div class="info-box-content">
                        <h4>MONEY BACK GUARANTEE</h4>
                        <p class="text-body">100% money back guarantee</p>
                    </div>
                    <!-- End .info-box-content -->
                </div>
                <!-- End .info-box -->

                <div class="info-box info-box-icon-left">
                    <i class="icon-support"></i>

                    <div class="info-box-content">
                        <h4>ONLINE SUPPORT 24/7</h4>
                        <p class="text-body">Always Here, Always Ready: Support That Never Sleeps.</p>
                    </div>
                    <!-- End .info-box-content -->
                </div>
                <!-- End .info-box -->
            </div>
            <!-- End .info-boxes-slider -->

            {{-- <div class="banners-container mb-2">
                <div class="banners-slider owl-carousel owl-theme"
                    data-owl-options="{
                         'dots': false
                             }">
                    <div class="banner banner1 banner-sm-vw d-flex align-items-center appear-animate"
                        style="background-color: #ccc;" data-animation-name="fadeInLeftShorter" data-animation-delay="500">
                        <figure class="w-100">
                            <img src="{{ asset('frontend/assets/images/demoes/demo4/banners/banner-1.jpg') }}"
                                alt="banner" width="380" height="175" />
                        </figure>
                        <div class="banner-layer">
                            <h3 class="m-b-2">Porto Watches</h3>
                            <h4 class="m-b-3 text-primary"><sup class="text-dark"><del>20%</del></sup>30%<sup>OFF</sup></h4>
                            <a href="category.html" class="btn btn-sm btn-dark">Shop Now</a>
                        </div>
                    </div>
                    <!-- End .banner -->

                    <div class="banner banner2 banner-sm-vw text-uppercase d-flex align-items-center appear-animate"
                        data-animation-name="fadeInUpShorter" data-animation-delay="200">
                        <figure class="w-100">
                            <img src="{{ asset('frontend/assets/images/demoes/demo4/banners/banner-2.jpg') }}"
                                style="background-color: #ccc;" alt="banner" width="380" height="175" />
                        </figure>
                        <div class="banner-layer text-center">
                            <div class="row align-items-lg-center">
                                <div class="col-lg-7 text-lg-right">
                                    <h3>Deal Promos</h3>
                                    <h4 class="pb-4 pb-lg-0 mb-0 text-body">Starting at $99</h4>
                                </div>
                                <div class="col-lg-5 text-lg-left px-0 px-xl-3">
                                    <a href="category.html" class="btn btn-sm btn-dark">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .banner -->

                    <div class="banner banner3 banner-sm-vw d-flex align-items-center appear-animate"
                        style="background-color: #ccc;" data-animation-name="fadeInRightShorter" data-animation-delay="500">
                        <figure class="w-100">
                            <img src="{{ asset('frontend/assets/images/demoes/demo4/banners/banner-3.jpg') }}"
                                alt="banner" width="380" height="175" />
                        </figure>
                        <div class="banner-layer text-right">
                            <h3 class="m-b-2">Handbags</h3>
                            <h4 class="m-b-2 text-secondary text-uppercase">Starting at $99</h4>
                            <a href="category.html" class="btn btn-sm btn-dark">Shop Now</a>
                        </div>
                    </div>
                    <!-- End .banner -->
                </div>
            </div> --}}
        </div>
        <!-- End .container -->
        {{-- Money Guarantee Section Ends  --}}





        {{-- Featured Products --}}
        <section class="featured-products-section">
            <div class="container">
                <h2 class="section-title heading-border ls-20 border-0">Featured Products</h2>

                <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center"
                    data-owl-options="{
                            'dots': false,
                            'nav': true
                        }">
                    @if (!empty($featuredProducts))
                        @foreach ($featuredProducts as $product)
                            @php
                                $images = $product->getFirstAndSecondImages();
                                $firstImage = $images->first();
                                $secondImage = $images->count() > 1 ? $images->get(1) : null;
                            @endphp
                            <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                                <figure>
                                    <a href="{{ (!empty($product->category_id)) ? route('productDetailsSubCat', [$product->category_id, Str::slug($product['productCategory']['name']), $product->subcategory_id, Str::slug($product['productSubCategory']['name']), $product->id, Str::slug($product->title)]) : '#' }}">
                                        @if ($secondImage && $firstImage)
                                        <img src="{{ asset($firstImage->image_name) }}" width="220"
                                            height="220" alt="{{ $product->title }}">
                                        <img src="{{ asset($secondImage->image_name) }}" width="220"
                                            height="220" alt="{{ $product->title }}">
                                    @elseif ($firstImage)
                                        <img src="{{ asset($firstImage->image_name) }}" width="220"
                                        height="220" alt="{{ $product->title }}">
                                        <img src="{{ asset($firstImage->image_name) }}" width="220"
                                        height="220" alt="{{ $product->title }}">
                                    @else
                                        <img src="{{ asset('upload/no_image.jpg') }}" width="280" height="280"
                                            alt="No image Found" />
                                    @endif
                                    </a>
                                    <div class="label-group">
                                        <div class="product-label label-hot">FEATURED</div>
                                        <div class="product-label label-sale">HOT</div>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <div class="category-list">
                                        <a href="{{ 
                                                !empty($product->category_id) && !empty($product['productCategory']) && !empty($product['productSubCategory']) 
                                                ? route('front_sub_categories', [
                                                    $product->category_id, 
                                                    Str::slug($product['productCategory']['name']), 
                                                    $product->subcategory_id, 
                                                    Str::slug($product['productSubCategory']['name'])
                                                ]) 
                                                : '#' 
                                            }}" class="product-category">
                                                {{ $product['productSubCategory']['name'] ?? '' }}</a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="{{ !empty($product->category_id) ? route('productDetailsSubCat', [$product->category_id, Str::slug($product['productCategory']['name']), $product->subcategory_id, Str::slug($product['productSubCategory']['name']), $product->id, Str::slug($product->title)]) : '#' }}">
                                            {{ $product->title }}
                                        </a>
                                    </h3>
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            @php                                 
                                            $rating = $product->getReviewRatings($product->id) * 20;
                                            @endphp
                                            <span class="ratings" style="width:{{ $rating }}%"></span>
                                            <!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <!-- End .product-ratings -->
                                    </div>
                                    <!-- End .product-container -->
                                    <div class="price-box">
                                        <del class="old-price">€{{ number_format($product->old_price, 2) }}</del>
                                        <span class="product-price">€{{ number_format($product->price, 2) }}</span>
                                    </div>
                                    <!-- End .price-box -->
                                    <div class="product-action" style="height: 30px; margin-left: 40px">
                                        @if (Auth::check() || Auth::guard('admin')->check())
                                        <a href="javascript:;" class="add_to_wishlist btn-icon-wish  {{ !empty($product->checkWishList($product->id)) ? 'added-wishlist' : '' }}" title="wishlist" id="{{ $product->id }}">
                                            <i class="icon-heart"></i></a>
                                        @else                            
                                            <a href="{{ route('decline_wishlist') }}" class="btn-icon-wish" title="wishlist">
                                                <i class="icon-heart"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <!-- End .product-details -->
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- End .featured-proucts -->
            </div>
        </section>
        {{-- Featured Products ends --}}





        {{-- New Arrivals --}}
        <section class="new-products-section">
            <div class="container">
                <h2 class="section-title heading-border ls-20 border-0">New Products</h2>

                <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center mb-2"
                    data-owl-options="{
                            'dots': false,
                            'nav': true,
                            'responsive': {
                                '992': {
                                    'items': 4
                                },
                                '1200': {
                                    'items': 5
                                }
                            }
                        }">
                    @if (!empty($products))
                        @foreach ($products as $product)
                            @php
                                $images = $product->getFirstAndSecondImages();
                                $firstImage = $images->first();
                                $secondImage = $images->count() > 1 ? $images->get(1) : null;
                            @endphp
                                <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                                    <figure>
                                        <a href="{{ !empty($product->category_id) ? route('productDetailsSubCat', [$product->category_id, Str::slug($product['productCategory']['name']), $product->subcategory_id, Str::slug($product['productSubCategory']['name']), $product->id, Str::slug($product->title)]) : '#' }}">
                                        @if ($secondImage && $firstImage)
                                            <img src="{{ asset($firstImage->image_name) }}" width="220"
                                                height="220" alt="{{ $product->title }}">
                                            <img src="{{ asset($secondImage->image_name) }}" width="220"
                                                height="220" alt="{{ $product->title }}">
                                        @elseif ($firstImage)
                                            <img src="{{ asset($firstImage->image_name) }}" width="220"
                                            height="220" alt="{{ $product->title }}">
                                            <img src="{{ asset($firstImage->image_name) }}" width="220"
                                            height="220" alt="{{ $product->title }}">
                                        @else
                                            <img src="{{ asset('upload/no_image.jpg') }}" width="280" height="280"
                                                alt="No image Found" />
                                        @endif
                                        </a>
                                        <div class="label-group">
                                            <div class="product-label label-sale">HOT</div>
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <div class="category-list">
                                            <a href="{{ 
                                                !empty($product->category_id) && !empty($product['productCategory']) && !empty($product['productSubCategory']) 
                                                ? route('front_sub_categories', [
                                                    $product->category_id, 
                                                    Str::slug($product['productCategory']['name']), 
                                                    $product->subcategory_id, 
                                                    Str::slug($product['productSubCategory']['name'])
                                                ]) 
                                                : '#' 
                                            }}" class="product-category">
                                                {{ $product['productSubCategory']['name'] ?? '' }}
                                            </a>
                                            
                                        </div>
                                        <h3 class="product-title">
                                            <a href="{{ !empty($product->category_id) ? route('productDetailsSubCat', [$product->category_id, Str::slug($product['productCategory']['name']), $product->subcategory_id, Str::slug($product['productSubCategory']['name']), $product->id, Str::slug($product->title)]) : '#' }}">
                                                {{ $product->title }}
                                            </a>
                                        </h3>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                @php                                 
                                                $rating = $product->getReviewRatings($product->id) * 20;
                                                @endphp
                                                <span class="ratings" style="width:{{ $rating }}%"></span>
                                                <!-- End .ratings -->
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <!-- End .product-ratings -->
                                        </div>
                                        <!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="old-price">€{{ number_format($product->old_price, 2) }}</span>
                                            <span class="product-price">€{{ number_format($product->price, 2) }}</span>
                                        </div>
                                        <!-- End .price-box -->
                                        <div class="product-action" style="height: 30px; margin-left: 40px">
                                            @if (Auth::check() || Auth::guard('admin')->check())
                                            <a href="javascript:;" class="add_to_wishlist btn-icon-wish  {{ !empty($product->checkWishList($product->id)) ? 'added-wishlist' : '' }}" title="wishlist" id="{{ $product->id }}">
                                                <i class="icon-heart"></i></a>
                                            @else                            
                                                <a href="{{ route('decline_wishlist') }}" class="btn-icon-wish" title="wishlist">
                                                    <i class="icon-heart"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- End .product-details -->
                                </div>
                        @endforeach
                    @endif
                </div>
                <!-- End .featured-proucts -->


                {{-- Categories Product --}}
                <h2 class="section-title categories-section-title heading-border border-0 ls-0 appear-animate"
                    data-animation-delay="100" data-animation-name="fadeInUpShorter">Browse Our Categories
                </h2>

                <div class="categories-slider owl-carousel owl-theme show-nav-hover nav-outer">


                    @if (!empty($ourCategories))
                        @foreach ($ourCategories as $categories)
                        <div class="product-category appear-animate" data-animation-name="fadeInUpShorter">
                            <a href="{{ route('front_categories', [$categories->id, Str::slug($categories->name)]) }}">
                                <figure>
                                    <img src="{{ !empty($categories->image) ? url($categories->image) : asset('upload/no_image.jpg') }}"
                                        alt="category"  style="width: 200px; height:240px" />
                                </figure>
                                <div class="category-content">
                                    <h3>{{ $categories->name }}</h3>
                                    <span><mark class="count">{{ \App\Models\Category::getProductCountByCategory($categories->id) }}</mark> products</span>
                                </div>
                            </a>
                        </div>                        
                        @endforeach
                    @endif



                  {{-- {{  dd($ourCategories) }} --}}


                </div>
                {{-- Categories Product ends --}}

            </div>
        </section>
        {{-- New Arrivals end --}}




        {{-- Featured boxes --}}
        <section class="feature-boxes-container">
            <div class="container appear-animate" data-animation-name="fadeInUpShorter">
                <div class="row">
                    <div class="col-md-4">
                        <div class="feature-box px-sm-5 feature-box-simple text-center">
                            <div class="feature-box-icon">
                                <i class="icon-earphones-alt"></i>
                            </div>

                            <div class="feature-box-content p-0">
                                <h3>Customer Support</h3>
                                <h5>You Won't Be Alone</h5>

                                <p>We handpick the best products, and our 24/7 customer support ensures you're always satisfied with your purchase.</p>
                            </div>
                            <!-- End .feature-box-content -->
                        </div>
                        <!-- End .feature-box -->
                    </div>
                    <!-- End .col-md-4 -->

                    <div class="col-md-4">
                        <div class="feature-box px-sm-5 feature-box-simple text-center">
                            <div class="feature-box-icon">
                                <i class="fa-solid fa-bowl-food"></i>
                            </div>

                            <div class="feature-box-content p-0">
                                <h3>Freshness Guaranteed</h3>
                                <h5>Enjoy Quality Meal</h5>

                                <p>We source locally and deliver daily, ensuring you get the freshest ingredients for every meal.</p>
                            </div>
                            <!-- End .feature-box-content -->
                        </div>
                        <!-- End .feature-box -->
                    </div>
                    <!-- End .col-md-4 -->

                    <div class="col-md-4">
                        <div class="feature-box px-sm-5 feature-box-simple text-center">
                            <div class="feature-box-icon">
                                <i class="icon-shipping"></i>
                            </div>
                            <div class="feature-box-content p-0">
                                <h3>Best Prices & Offers</h3>
                                <h5>Unbeatable Deals:<h5>

                                <p>Enjoy top-quality food at the best prices, with exclusive offers and discounts that make every meal more affordable.</p>
                            </div>
                            <!-- End .feature-box-content -->
                        </div>
                        <!-- End .feature-box -->
                    </div>
                    <!-- End .col-md-4 -->
                </div>
                <!-- End .row -->
            </div>
            <!-- End .container-->
        </section>
        <!-- End .feature-boxes-container -->
        {{-- Featured boxes ends --}}




        {{-- Blog snd Others --}}
        <section class="blog-section pb-0">
            <div class="container">
                <hr class="mt-0 m-b-5">

                {{-- Brands Slider --}}
                <div class="brands-slider owl-carousel owl-theme images-center appear-animate"
                    data-animation-name="fadeIn" data-animation-duration="500"
                    data-owl-options="{
                        'margin': 0}">
                        @foreach ($supportBrands as $brands)
                        <img src="{{ url($brands->image) }}" width="130" height="56"
                        alt="brand">     
                        @endforeach


                </div>
                <!-- End .brands-slider -->
                {{-- Brands Slider  ends--}}

                <hr class="mt-4 m-b-5">

                {{-- Products Widgets --}}
                <div class="product-widgets-container row pb-2">


                    <div class="col-lg-3 col-sm-6 pb-5 pb-md-0 appear-animate" data-animation-name="fadeInLeftShorter"
                        data-animation-delay="200">
                        <h4 class="section-sub-title">Featured Products</h4>

                        {{-- featuredProductsLimit --}}
                        @foreach ($featuredProductsLimit as $product)
                        @php
                            $images = $product->getFirstAndSecondImages();
                            $firstImage = $images->first();
                            $secondImage = $images->count() > 1 ? $images->get(1) : null;
                        @endphp
                        <div class="product-default left-details product-widget">
                            <figure>
                                <a href="{{ !empty($product->category_id) ? route('productDetailsSubCat', [$product->category_id, Str::slug($product['productCategory']['name']), $product->subcategory_id, Str::slug($product['productSubCategory']['name']), $product->id, Str::slug($product->title)]) : '#' }}">
                                    @if ($secondImage && $firstImage)
                                    <img src="{{ asset($firstImage->image_name) }}"width="84" height="84" alt="{{ $product->title }}">
                                    <img src="{{ asset($secondImage->image_name) }}"width="84" height="84" alt="{{ $product->title }}">
                                @elseif ($firstImage)
                                    <img src="{{ asset($firstImage->image_name) }}"width="84" height="84" alt="{{ $product->title }}">
                                    <img src="{{ asset($firstImage->image_name) }}"width="84" height="84" alt="{{ $product->title }}">
                                @else
                                    <img src="{{ asset('upload/no_image.jpg') }}" width="84" height="84"
                                        alt="No image Found" />
                                @endif
                                  
                                </a>
                            </figure>

                            <div class="product-details">
                                <h3 class="product-title"> 
                                    <a href="{{ !empty($product->category_id) ? route('productDetailsSubCat', [$product->category_id, Str::slug($product['productCategory']['name']), $product->subcategory_id, Str::slug($product['productSubCategory']['name']), $product->id, Str::slug($product->title)]) : '#' }}">
                                        {{ $product->title }}
                                    </a>
                                </h3>

                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        @php                                 
                                        $rating = $product->getReviewRatings($product->id) * 20;
                                        @endphp
                                        <span class="ratings" style="width:{{ $rating }}%"></span>
                                        <!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <!-- End .product-ratings -->
                                </div>
                                <!-- End .product-container -->

                                <div class="price-box">
                                    <span class="product-price">€{{ number_format($product->price, 2) }}</span>
                                </div>
                                <!-- End .price-box -->
                            </div>
                            <!-- End .product-details -->
                        </div>
                        @endforeach
                    </div>

                    <div class="col-lg-3 col-sm-6 pb-5 pb-md-0 appear-animate" data-animation-name="fadeInLeftShorter"
                        data-animation-delay="500">
                        <h4 class="section-sub-title">Best Selling Products</h4>

                        @foreach ($bestSellingLimit as $product)
                        @php
                            $images = $product->getFirstAndSecondImages();
                            $firstImage = $images->first();
                            $secondImage = $images->count() > 1 ? $images->get(1) : null;
                        @endphp
                        <div class="product-default left-details product-widget">
                            <figure>
                                <a href="{{ !empty($product->category_id) ? route('productDetailsSubCat', [$product->category_id, Str::slug($product['productCategory']['name']), $product->subcategory_id, Str::slug($product['productSubCategory']['name']), $product->id, Str::slug($product->title)]) : '#' }}">
                                    @if ($secondImage && $firstImage)
                                    <img src="{{ asset($firstImage->image_name) }}"width="84" height="84" alt="{{ $product->title }}">
                                    <img src="{{ asset($secondImage->image_name) }}"width="84" height="84" alt="{{ $product->title }}">
                                @elseif ($firstImage)
                                    <img src="{{ asset($firstImage->image_name) }}"width="84" height="84" alt="{{ $product->title }}">
                                    <img src="{{ asset($firstImage->image_name) }}"width="84" height="84" alt="{{ $product->title }}">
                                @else
                                    <img src="{{ asset('upload/no_image.jpg') }}" width="84" height="84"
                                        alt="No image Found" />
                                @endif
                                  
                                </a>
                            </figure>

                            <div class="product-details">
                                <h3 class="product-title"> 
                                    <a href="{{ !empty($product->category_id) ? route('productDetailsSubCat', [$product->category_id, Str::slug($product['productCategory']['name']), $product->subcategory_id, Str::slug($product['productSubCategory']['name']), $product->id, Str::slug($product->title)]) : '#' }}">
                                        {{ $product->title }}
                                    </a>
                                </h3>

                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        @php                                 
                                        $rating = $product->getReviewRatings($product->id) * 20;
                                        @endphp
                                        <span class="ratings" style="width:{{ $rating }}%"></span>
                                        <!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <!-- End .product-ratings -->
                                </div>
                                <!-- End .product-container -->

                                <div class="price-box">
                                    <span class="product-price">€{{ number_format($product->price, 2) }}</span>
                                </div>
                                <!-- End .price-box -->
                            </div>
                            <!-- End .product-details -->
                        </div>
                        @endforeach

                    </div>


                    <div class="col-lg-3 col-sm-6 pb-5 pb-md-0 appear-animate" data-animation-name="fadeInLeftShorter"
                        data-animation-delay="200">
                        <h4 class="section-sub-title">LATEST PRODUCTS</h4>

                        @foreach ($latestProductsLimit as $product)
                        @php
                            $images = $product->getFirstAndSecondImages();
                            $firstImage = $images->first();
                            $secondImage = $images->count() > 1 ? $images->get(1) : null;
                        @endphp
                        <div class="product-default left-details product-widget">
                            <figure>
                                <a href="{{ !empty($product->category_id) ? route('productDetailsSubCat', [$product->category_id, Str::slug($product['productCategory']['name']), $product->subcategory_id, Str::slug($product['productSubCategory']['name']), $product->id, Str::slug($product->title)]) : '#' }}">

                                    @if ($secondImage && $firstImage)
                                    <img src="{{ asset($firstImage->image_name) }}"width="84" height="84" alt="{{ $product->title }}">
                                    <img src="{{ asset($secondImage->image_name) }}"width="84" height="84" alt="{{ $product->title }}">
                                @elseif ($firstImage)
                                    <img src="{{ asset($firstImage->image_name) }}"width="84" height="84" alt="{{ $product->title }}">
                                    <img src="{{ asset($firstImage->image_name) }}"width="84" height="84" alt="{{ $product->title }}">
                                @else
                                    <img src="{{ asset('upload/no_image.jpg') }}" width="84" height="84"
                                        alt="No image Found" />
                                @endif
                                  
                                </a>
                            </figure>

                            <div class="product-details">
                                <h3 class="product-title"> 
                                    <a href="{{ !empty($product->category_id) ? route('productDetailsSubCat', [$product->category_id, Str::slug($product['productCategory']['name']), $product->subcategory_id, Str::slug($product['productSubCategory']['name']), $product->id, Str::slug($product->title)]) : '#' }}">
                                        {{ $product->title }}
                                    </a>
                                </h3>

                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        @php                                 
                                        $rating = $product->getReviewRatings($product->id) * 20;
                                        @endphp
                                        <span class="ratings" style="width:{{ $rating }}%"></span>
                                        <!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <!-- End .product-ratings -->
                                </div>
                                <!-- End .product-container -->

                                <div class="price-box">
                                    <span class="product-price">€{{ number_format($product->price, 2) }}</span>
                                </div>
                                <!-- End .price-box -->
                            </div>
                            <!-- End .product-details -->
                        </div>
                        @endforeach

                    </div>

                    <div class="col-lg-3 col-sm-6 pb-5 pb-md-0 appear-animate" data-animation-name="fadeInLeftShorter"
                        data-animation-delay="500">
                        <h4 class="section-sub-title">TOP RATED PRODUCTS</h4>

                        @foreach ($topRatedProducts as $product)
                        @php
                            $images = $product->getFirstAndSecondImages();
                            $firstImage = $images->first();
                            $secondImage = $images->count() > 1 ? $images->get(1) : null;
                        @endphp
                        <div class="product-default left-details product-widget">
                            <figure>
                                <a href="{{ !empty($product->category_id) ? route('productDetailsSubCat', [$product->category_id, Str::slug($product['productCategory']['name']), $product->subcategory_id, Str::slug($product['productSubCategory']['name']), $product->id, Str::slug($product->title)]) : '#' }}">
                                    @if ($secondImage && $firstImage)
                                    <img src="{{ asset($firstImage->image_name) }}"width="84" height="84" alt="{{ $product->title }}">
                                    <img src="{{ asset($secondImage->image_name) }}"width="84" height="84" alt="{{ $product->title }}">
                                @elseif ($firstImage)
                                    <img src="{{ asset($firstImage->image_name) }}"width="84" height="84" alt="{{ $product->title }}">
                                    <img src="{{ asset($firstImage->image_name) }}"width="84" height="84" alt="{{ $product->title }}">
                                @else
                                    <img src="{{ asset('upload/no_image.jpg') }}" width="84" height="84"
                                        alt="No image Found" />
                                @endif
                                  
                                </a>
                            </figure>

                            <div class="product-details">
                                <h3 class="product-title"> 
                                    <a href="{{ !empty($product->category_id) ? route('productDetailsSubCat', [$product->category_id, Str::slug($product['productCategory']['name']), $product->subcategory_id, Str::slug($product['productSubCategory']['name']), $product->id, Str::slug($product->title)]) : '#' }}">
                                        {{ $product->title }}
                                    </a>
                                </h3>

                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        @php                                 
                                        $rating = $product->getReviewRatings($product->id) * 20;
                                        @endphp
                                        <span class="ratings" style="width:{{ $rating }}%"></span>
                                        <!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <!-- End .product-ratings -->
                                </div>
                                <!-- End .product-container -->

                                <div class="price-box">
                                    <span class="product-price">€{{ number_format($product->price, 2) }}</span>
                                </div>
                                <!-- End .price-box -->
                            </div>
                            <!-- End .product-details -->
                        </div>
                        @endforeach

                    </div>


                </div>
                {{-- Products Widgets ends --}}

                <!-- End .row -->
            </div>
        </section>
        {{-- Blog snd Others ends--}}

    </main>
    <!-- End .main -->
@endsection
