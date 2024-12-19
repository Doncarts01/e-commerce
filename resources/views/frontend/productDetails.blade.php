@extends('frontend.frontend_masters')

@php
$getSystemSettingsApp = App\Models\settings::getSingle();
@endphp

@section('title')
{{ $getSystemSettingsApp->name }} | Products | {{ $product->title }}
@endsection


@section('main')

    <main class="main">
        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"> <a
                            href="{{ route('front_categories', [$product->category_id, Str::slug($product['productCategory']['name'])]) }} ">{{ $product['productCategory']['name'] }}</a>
                    </li>
                    <li class="breadcrumb-item"> <a
                            href="{{ route('front_sub_categories', [$product->category_id, Str::slug($product['productCategory']['name']), $product->subcategory_id, Str::slug($product['productSubCategory']['name'])]) }} ">{{ $product['productSubCategory']['name'] }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
                </ol>
            </nav>

            <div class="product-single-container product-single-default">
                <div class="cart-message d-none">
                    <strong class="single-cart-notice">“{{ $product->title }}”</strong>
                    <span>has been added to your cart.</span>
                </div>

                <div class="row">
                    <div class="col-lg-5 col-md-6 product-single-gallery">
                        <div class="product-slider-container">
                            <div class="label-group">
                                <div class="product-label label-sale">HOT</div>
                                <!---->
                                @if ($product->isFeatured == 1)
                                <div class="product-label label-hot">
                                    Featured
                                </div>   
                                @endif

                            </div>

                            <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                @foreach ($product->getImage as $image)
                                    @if (!empty($image->getAllImages()) && !empty($image->getAllZoomImages()))
                                        <div class="product-item">
                                            <img class="product-single-image" src="{{ $image->getAllImages() }}"
                                                data-zoom-image="{{ $image->getAllZoomImages() }}" width="468"
                                                height="468" alt="product" />
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <!-- End .product-single-carousel -->
                            <span class="prod-full-screen">
                                <i class="icon-plus"></i>
                            </span>
                        </div>

                        <div class="prod-thumbnail owl-dots">
                            @foreach ($product->getImage as $image)
                                @if (!empty($image->getAllImages()))
                                    <div class="owl-dot">
                                        <img src="{{ $image->getAllImages() }}" width="110" height="110"
                                            alt="product-thumbnail" />
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <!-- End .product-single-gallery -->

                    <div class="col-lg-7 col-md-6 product-single-details">
                        <h1 class="product-title">{{ $product->title }}</h1>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                @php                                 
                                $rating = $product->getReviewRatings($product->id)  * 20;
                                @endphp
                                <span class="ratings" style="width:{{ $rating }}%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <!-- End .product-ratings -->

                            <a href="javascript:;" class="rating-link">( {{ $product->getTotalReview() }} Reviews )</a>
                            {{-- <a href="#" class="rating-link"></a> --}}
                        </div>
                        <!-- End .ratings-container -->

                        <hr class="short-divider">

                        <div class="price-box">
                            <span class="old-price">€{{ number_format($product->old_price, 2) }}</span>
                            <span class="new-price">€{{ number_format($product->price, 2) }}</span>
                        </div>
                        <!-- End .price-box -->

                        <div class="product-desc">
                            <p>
                                {!! $product->short_description !!}
                            </p>
                        </div>
                        <!-- End .product-desc -->

                        <ul class="single-info-list">
                            <!---->
                            <li>
                                SKU:
                                <strong>{{ $product->sku }}</strong>
                            </li>

                            <li>
                                CATEGORY:
                                <strong>
                                    <a href="{{ route('front_categories', [$product->category_id, Str::slug($product['productCategory']['name'])]) }} "
                                        class="product-category">{{ $product['productCategory']['name'] }}</a>
                                </strong>
                            </li>

                            <li>
                                SUBCATEGORY:
                                <strong>
                                    <a href="{{ route('front_sub_categories', [$product->category_id, Str::slug($product['productCategory']['name']), $product->subcategory_id, Str::slug($product['productSubCategory']['name'])]) }} "
                                        class="product-category">{{ $product['productSubCategory']['name'] }}</a>
                                </strong>
                            </li>
                        </ul>

                        <form action="{{ route('product_addToCart') }}" method="POST">
                            @csrf

                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="product-filters-container">

                                @if (!empty($product->getColor->count()))
                                    <div class="product-single-filter"><label>Color:</label>
                                        <ul class="config-size-list config-color-list config-filter-list">
                                            <select name="color_id" id="color_id" class="form-control">
                                                <option value="">Select a Color</option>
                                                @foreach ($product->getColor as $color)
                                                    <option value="{{ $color->getProductColor->id }}">
                                                        {{ $color->getProductColor->name }}</option>
                                                @endforeach
                                            </select>
                                        </ul>
                                    </div>
                                @endif
    
    
                                @if (!empty($product->getSize->count()))
                                    <div class="product-single-filter"><label>Size:</label>
                                        <ul class="config-size-list">
                                            <select name="size_id" id="size_id" class="form-control getSizePrice">
                                                <option data-price="0" value="">Select a Size</option>
                                                @foreach ($product->getSize as $size)
                                                    <option data-price="{{ !empty($size->price) ? $size->price : 0 }}"
                                                        value="{{ $size->id }}">{{ $size->name }}
                                                        @if (!empty($size->price) || $size->price !== 0)
                                                            $ ({{ number_format($size->price, 2) }})
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </ul>
                                    </div>
                                @endif
    
                                <div class="product-single-filter">
                                    <label></label>
                                    <a class="font1 text-uppercase clear-btn" href="#">Clear</a>
                                </div>
                            </div>
    
                            <div class="product-action">
                                <div class="price-box product-filtered-price">
                                    <del class="old-price"><span>€ {{ number_format($product->old_price, 2) }}</span></del>
                                    <span class="product-price">€ <span
                                            id="totalProductPrice">{{ number_format($product->price, 2) }}</span></span>
                                </div>
    
                                <div class="product-single-qty">
                                    <input class="horizontal-quantity form-control" type="text" name="qty" required>
                                </div>
                                <!-- End .product-single-qty -->
    
                                <button type="submit" class="btn btn-dark mr-2 add-cart" title="Add to Cart">
                                    <i class="minicart-icon"></i>
                                    Add to
                                    Cart
                                </button>
    
                                <span class="view-cart d-none">Added to Cart</span>
                            </div>
                            <!-- End .product-action -->
                        </form>


                        <hr class="divider mb-0 mt-0">

                        <div class="product-single-share mb-2">
                            <label class="sr-only">Share:</label>

                            <div class="social-icons mr-2">
                                <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"
                                    title="Facebook"></a>
                                <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"
                                    title="Twitter"></a>
                                <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank"
                                    title="Linkedin"></a>
                                <a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank"
                                    title="Google +"></a>
                                <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank"
                                    title="Mail"></a>
                            </div>
                            <!-- End .social-icons -->

                        {{-- @if (Auth::guard('admin')->check()) 
                        <a href="javascript:;" class="add_to_wishlist btn-icon-wish add-wishlist" title="Add to Wishlist" id="{{ $product->id }}"><i
                            class="icon-wishlist-2"></i><span>Add to
                            Wishlist</span></a> --}}
                            @if (Auth::check() || Auth::guard('admin')->check())
                            <a href="javascript:;" class="add_to_wishlist btn-icon-wish add-wishlist {{ !empty($product->checkWishList($product->id)) ? 'added-wishlist' : '' }}" title="Add to Wishlist" id="{{ $product->id }}">
                                <i class="icon-wishlist-2"></i>
                                <span id="wishListText">
                                    {{ !empty($product->checkWishList($product->id)) ? 'Add to Wishlist' : 'Browse Wishlist' }}
                                </span>
                            </a>
                            @else                            
                                <a href="{{ route('decline_wishlist') }}" class="add-wishlist" title="Add to Wishlist"><i
                                    class="icon-wishlist-2"></i><span>Add to
                                    Wishlist</span></a>
                            @endif
 
                        </div>
                        <!-- End .product single-share -->
                    </div>
                    <!-- End .product-single-details -->
                </div>
                <!-- End .row -->
            </div>
            <!-- End .product-single-container -->

            <div class="product-single-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content"
                            role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="product-tab-tags" data-toggle="tab" href="#product-tags-content"
                            role="tab" aria-controls="product-tags-content" aria-selected="false">Additional
                            Information</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="product-tab-size" data-toggle="tab" href="#product-size-content"
                            role="tab" aria-controls="product-size-content" aria-selected="true">Shipping &
                            Returns</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content"
                            role="tab" aria-controls="product-reviews-content" aria-selected="false">Reviews ({{ $product->getTotalReview() }})</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel"
                        aria-labelledby="product-tab-desc">
                        <div class="product-desc-content">
                            {!! $product->description !!}
                        </div>
                        <!-- End .product-desc-content -->
                    </div>
                    <!-- End .tab-pane -->

                    <div class="tab-pane fade" id="product-tags-content" role="tabpanel"
                        aria-labelledby="product-tab-tags">
                        <div class="product-desc-content">
                            {!! $product->additional_information !!}
                        </div>
                    </div>
                    <!-- End .tab-pane -->

                    <div class="tab-pane fade" id="product-size-content" role="tabpanel"
                        aria-labelledby="product-tab-size">
                        <div class="product-size-content">
                            {!! $product->shipping_returns !!}
                            <!-- End .row -->
                        </div>
                        <!-- End .product-size-content -->
                    </div>
                    <!-- End .tab-pane -->

                    <div class="tab-pane fade" id="product-reviews-content" role="tabpanel"
                        aria-labelledby="product-tab-reviews">
                        <div class="product-reviews-content">
                            <h3 class="reviews-title">{{ $product->getTotalReview() }} review for {{ $product->title }}</h3>

                            @foreach ($getReviewProduct as $review)
                            <div class="comment-list">
                                <div class="comments">
                                    <figure class="img-thumbnail">
                                        <img src="{{  (!empty($review->profile_image)) ? url('upload/user_images/'.$review->profile_image) :url('upload/no_image.PNG')  }}" alt="author" style="width:80px; height: 80px">
                                    </figure>

                                    <div class="comment-block">
                                        <div class="comment-header">
                                            <div class="comment-arrow"></div>

                                            <div class="ratings-container float-sm-right">
                                                <div class="product-ratings">
                                                    @php
                                                        $rating = $review->rating * 20;
                                                    @endphp
                                                    <span class="ratings" style="width:{{ $rating }}%"></span>
                                                    <!-- End .ratings -->
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <!-- End .product-ratings -->
                                            </div>

                                            <span class="comment-by">
                                                <strong>{{ $review->name }}</strong> – {{ Carbon\Carbon::parse($review->created_at)->diffForHumans() }}
                                            </span>
                                        </div>

                                        <div class="comment-content">
                                            <p>{{ $review->review }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>               
                            @endforeach

                            <ul class="pagination toolbox-item">
                                {{ $getReviewProduct->links('vendor.pagination.bootstrap-5') }}
                            </ul>

                            <div class="divider"></div>

                        </div>
                        <!-- End .product-reviews-content -->
                    </div>
                    <!-- End .tab-pane -->
                </div>
                <!-- End .tab-content -->
            </div>
            <!-- End .product-single-tabs -->

            @if ($relatedProducts->count() > 0)
                <div class="products-section pt-0">
                    <h2 class="section-title">Related Products</h2>

                    <div class="products-slider owl-carousel owl-theme dots-top dots-small">
                        @foreach ($relatedProducts as $relProduct)
                            @php
                                $images = $relProduct->getFirstAndSecondImages();
                                $firstImage = $images->first();
                                $secondImage = $images->count() > 1 ? $images->get(1) : null;
                            @endphp

                            <div class="product-default">
                                <figure>
                                    <a
                                        href="{{ route('productDetailsSubCat', [$relProduct->category_id, Str::slug($relProduct['productCategory']['name']), $relProduct->subcategory_id, Str::slug($relProduct['productSubCategory']['name']), $relProduct->id, Str::slug($relProduct->title)]) }}">
                                        @if ($secondImage && $firstImage)
                                            <img src="{{ asset($firstImage->image_name) }}" width="280"
                                                height="280" alt="{{ $relProduct->title }}" />
                                            <img src="{{ asset($secondImage->image_name) }}" width="280"
                                                height="280" alt="{{ $relProduct->title }}" />
                                        @elseif ($firstImage)
                                            <img src="{{ asset($firstImage->image_name) }}" width="280"
                                                height="280" alt="{{ $relProduct->title }}" />
                                            <img src="{{ asset($firstImage->image_name) }}" width="280"
                                                height="280" alt="{{ $relProduct->title }}" />
                                        @else
                                            <img src="{{ asset('upload/no_image.jpg') }}" width="280" height="280"
                                                alt="No image Found" />
                                        @endif
                                    </a>
                                    <div class="label-group">
                                        <div class="product-label label-hot">HOT</div>
                                        <div class="product-label label-sale">-20%</div>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <div class="category-list">
                                        <a href="{{ route('front_sub_categories', [$relProduct->category_id, Str::slug($relProduct['productCategory']['name']), $relProduct->subcategory_id, Str::slug($relProduct['productSubCategory']['name'])]) }}"
                                            class="product-category">{{ $relProduct['productSubCategory']['name'] }}</a>
                                    </div>
                                    <h3 class="product-title">
                                        <a
                                            href="{{ route('productDetailsSubCat', [$relProduct->category_id, Str::slug($relProduct['productCategory']['name']), $relProduct->subcategory_id, Str::slug($relProduct['productSubCategory']['name']), $relProduct->id, Str::slug($relProduct->title)]) }}">{{ $relProduct->title }}</a>
                                    </h3>
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            @php                                 
                                            $rating = $relProduct->getReviewRatings($relProduct->id) * 20;
                                            @endphp
                                            <span class="ratings" style="width:{{ $rating }}%"></span>
                                            <!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <!-- End .product-ratings -->
                                    </div>
                                    <!-- End .product-container -->
                                    <div class="price-box">
                                        <span class="old-price">€{{ number_format($relProduct->old_price, 2) }}</span>
                                        <span class="product-price">€{{ number_format($relProduct->price, 2) }}</span>
                                    </div>
                                    <!-- End .price-box -->
                                    <div class="product-action" style="height: 30px; margin-left: 20px">

                                        @if (Auth::check())
                                            <a href="javascript:;" class="add_to_wishlist btn-icon-wish  {{ !empty($relProduct->checkWishList($relProduct->id)) ? 'added-wishlist' : '' }}" title="wishlist" id="{{ $relProduct->id }}">
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


                    </div>
                    <!-- End .products-slider -->
                </div>
            @endif
            <!-- End .products-section -->

            <hr class="mt-0 m-b-5" />

            {{-- <div class="product-widgets-container row pb-2">
            <div class="col-lg-3 col-sm-6 pb-5 pb-md-0">
                <h4 class="section-sub-title">Featured Products</h4>
                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="assets/images/products/small/product-1.jpg" width="74" height="74"
                                alt="product">
                            <img src="assets/images/products/small/product-1-2.jpg" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Ultimate 3D Bluetooth Speaker</a>
                        </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <!-- End .product-ratings -->
                        </div>
                        <!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div>
                        <!-- End .price-box -->
                    </div>
                    <!-- End .product-details -->
                </div>

                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="assets/images/products/small/product-2.jpg" width="74" height="74"
                                alt="product">
                            <img src="assets/images/products/small/product-2-2.jpg" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Brown Women Casual HandBag</a> </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top">5.00</span>
                            </div>
                            <!-- End .product-ratings -->
                        </div>
                        <!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div>
                        <!-- End .price-box -->
                    </div>
                    <!-- End .product-details -->
                </div>

                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="assets/images/products/small/product-3.jpg" width="74" height="74"
                                alt="product">
                            <img src="assets/images/products/small/product-3-2.jpg" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Circled Ultimate 3D Speaker</a> </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <!-- End .product-ratings -->
                        </div>
                        <!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div>
                        <!-- End .price-box -->
                    </div>
                    <!-- End .product-details -->
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 pb-5 pb-md-0">
                <h4 class="section-sub-title">Best Selling Products</h4>
                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="assets/images/products/small/product-4.jpg" width="74" height="74"
                                alt="product">
                            <img src="assets/images/products/small/product-4-2.jpg" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Blue Backpack for the Young - S</a>
                        </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top">5.00</span>
                            </div>
                            <!-- End .product-ratings -->
                        </div>
                        <!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div>
                        <!-- End .price-box -->
                    </div>
                    <!-- End .product-details -->
                </div>

                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="assets/images/products/small/product-5.jpg" width="74" height="74"
                                alt="product">
                            <img src="assets/images/products/small/product-5-2.jpg" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Casual Spring Blue Shoes</a> </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <!-- End .product-ratings -->
                        </div>
                        <!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div>
                        <!-- End .price-box -->
                    </div>
                    <!-- End .product-details -->
                </div>

                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="assets/images/products/small/product-6.jpg" width="74" height="74"
                                alt="product">
                            <img src="assets/images/products/small/product-6-2.jpg" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Men Black Gentle Belt</a> </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top">5.00</span>
                            </div>
                            <!-- End .product-ratings -->
                        </div>
                        <!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div>
                        <!-- End .price-box -->
                    </div>
                    <!-- End .product-details -->
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 pb-5 pb-md-0">
                <h4 class="section-sub-title">Latest Products</h4>
                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="assets/images/products/small/product-7.jpg" width="74" height="74"
                                alt="product">
                            <img src="assets/images/products/small/product-7-2.jpg" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Brown-Black Men Casual Glasses</a>
                        </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <!-- End .product-ratings -->
                        </div>
                        <!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div>
                        <!-- End .price-box -->
                    </div>
                    <!-- End .product-details -->
                </div>

                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="assets/images/products/small/product-8.jpg" width="74" height="74"
                                alt="product">
                            <img src="assets/images/products/small/product-8-2.jpg" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Brown-Black Men Casual Glasses</a>
                        </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top">5.00</span>
                            </div>
                            <!-- End .product-ratings -->
                        </div>
                        <!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div>
                        <!-- End .price-box -->
                    </div>
                    <!-- End .product-details -->
                </div>

                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="assets/images/products/small/product-9.jpg" width="74" height="74"
                                alt="product">
                            <img src="assets/images/products/small/product-9-2.jpg" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Black Men Casual Glasses</a> </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <!-- End .product-ratings -->
                        </div>
                        <!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div>
                        <!-- End .price-box -->
                    </div>
                    <!-- End .product-details -->
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 pb-5 pb-md-0">
                <h4 class="section-sub-title">Top Rated Products</h4>
                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="assets/images/products/small/product-10.jpg" width="74" height="74"
                                alt="product">
                            <img src="assets/images/products/small/product-10-2.jpg" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Basketball Sports Blue Shoes</a> </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <!-- End .product-ratings -->
                        </div>
                        <!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div>
                        <!-- End .price-box -->
                    </div>
                    <!-- End .product-details -->
                </div>

                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="assets/images/products/small/product-11.jpg" width="74" height="74"
                                alt="product">
                            <img src="assets/images/products/small/product-11-2.jpg" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Men Sports Travel Bag</a> </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top">5.00</span>
                            </div>
                            <!-- End .product-ratings -->
                        </div>
                        <!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div>
                        <!-- End .price-box -->
                    </div>
                    <!-- End .product-details -->
                </div>

                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="assets/images/products/small/product-12.jpg" width="74" height="74"
                                alt="product">
                            <img src="assets/images/products/small/product-12-2.jpg" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Brown HandBag</a> </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <!-- End .product-ratings -->
                        </div>
                        <!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div>
                        <!-- End .price-box -->
                    </div>
                    <!-- End .product-details -->
                </div>
            </div>
        </div> --}}
            <!-- End .row -->
        </div>
        <!-- End .container -->
    </main>

    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
    <script>
        $('.getSizePrice').change(function() {
            var productPrice = '{{ $product->price }}';
            var price = $('option:selected', this).attr('data-price');
            let total = parseFloat(productPrice) + parseFloat(price)

            $('#totalProductPrice').html(total.toFixed(2))
        });
    </script>

@endsection
