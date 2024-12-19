

<div class="row">

    @foreach ($products as $product)
        @php
            $images = $product->getFirstAndSecondImages();
            $firstImage = $images->first();
            $secondImage = $images->count() > 1 ? $images->get(1) : null;
        @endphp

        <div class="col-6 col-sm-6 col-lg-4 col-md-4">
            <div class="product-default">
                <figure>
                    <a href="{{ route('productDetailsSubCat', [$product->category_id, Str::slug($product['productCategory']['name']),$product->subcategory_id, Str::slug($product['productSubCategory']['name']), $product->id, Str::slug($product->title) ]) }}">

                        @if ($secondImage && $firstImage)
                            <img src="{{ asset($firstImage->image_name) }}" width="280" height="280"
                                alt="{{ $product->title }}" />
                            <img src="{{ asset($secondImage->image_name) }}" width="280" height="280"
                                alt="{{ $product->title }}" />
                        @elseif ($firstImage)
                            <img src="{{ asset($firstImage->image_name) }}" width="280" height="280"
                                alt="{{ $product->title }}" />
                            <img src="{{ asset($firstImage->image_name) }}" width="280" height="280"
                                alt="{{ $product->title }}" />
                        @else
                            <img src="{{ asset('upload/no_image.jpg') }}" width="280" height="280"
                                alt="No image Found" />
                        @endif
                    </a>

                    <div class="label-group">
                        @if ($product->isFeatured == 1)
                        <div class="product-label label-sale">
                            Featured
                        </div>   
                        @endif
                    </div>
                </figure>

                <div class="product-details">
                    <div class="category-wrap">
                        <div class="category-list">
                            <a href="{{ route('front_sub_categories', [$product->category_id, Str::slug($product['productCategory']['name']), $product->subcategory_id, Str::slug($product['productSubCategory']['name'])]) }}"
                                class="product-category">{{ $product['productSubCategory']['name'] }}</a>
                        </div>
                    </div>

                    <h3 class="product-title"> <a href="{{ route('productDetailsSubCat', [$product->category_id, Str::slug($product['productCategory']['name']),$product->subcategory_id, Str::slug($product['productSubCategory']['name']), $product->id, Str::slug($product->title) ]) }}">{{ $product->title }}</a> </h3>

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

                    <div class="product-action" style="height: 30px; margin-left: 20px">
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
        </div>
    @endforeach
    <!-- End .col-sm-4 -->


    
</div>

<!-- End .row -->

<nav class="toolbox toolbox-pagination">
    <div class="toolbox-item toolbox-show">
    </div>
    <!-- End .toolbox-item -->

    <ul class="pagination toolbox-item">
        {{ $products->links('vendor.pagination.bootstrap-5') }}
    </ul>
</nav>



