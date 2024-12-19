@extends('frontend.frontend_masters')

@section('main')

@php
$getSystemSettingsApp = App\Models\settings::getSingle();
@endphp

@section('title')
{{ $getSystemSettingsApp->name }} | Wishlists
@endsection


<main class="main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Wishlist
                        </li>
                    </ol>
                </div>
            </nav>

            <h1>Wishlist</h1>
        </div>
    </div>

    <div class="container">
        <div class="wishlist-title">
            <h2 class="p-2">My wishlist <span style="font-size: 25px" class="text-muted">({{ $getProduct->count() }})</span>  </h2>
        </div>
        <div class="wishlist-table-container">
            <table class="table table-wishlist mb-0">
                <thead>
                    <tr>
                        <th class="thumbnail-col"></th>
                        <th class="product-col">Product</th>
                        <th class="price-col">Price</th>
                        <th class="status-col">Stock Status</th>
                        <th class="action-col">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @if (!empty($getProduct))
                        @foreach ($getProduct as $product)
                        @php
                        $images = $product->getFirstAndSecondImages();
                        $firstImage = $images->first();
                        $secondImage = $images->count() > 1 ? $images->get(1) : null;
                        @endphp
                        <tr class="product-row">
                            <td>
                                <figure class="product-image-container">
                                    <a href="{{ route('productDetailsSubCat', [$product->category_id, Str::slug($product['productCategory']['name']), $product->subcategory_id, Str::slug($product['productSubCategory']['name']), $product->id, Str::slug($product->title)]) }}" class="product-image">
                                    @if ($firstImage)
                                    <img src="{{ asset($firstImage->image_name) }}"  alt="{{ $product->title }}" alt="{{ $product->title }}"/>
                                    @else
                                        <img src="{{ asset('upload/no_image.jpg') }}" 
                                        alt="{{ $product->title }}" />
                                    @endif

                                    <a href="{{ route('delete_wishlist', $product->id) }}" class="btn-remove icon-cancel" title="Remove Product"></a>
                                </figure>
                            </td>
                            <td>
                                <h5 class="product-title">
                                    <a href="{{ route('productDetailsSubCat', [$product->category_id, Str::slug($product['productCategory']['name']), $product->subcategory_id, Str::slug($product['productSubCategory']['name']), $product->id, Str::slug($product->title)]) }}">{{ $product->title }}</a>
                                </h5>
                            </td>
                            <td class="price-box"> € {{ number_format($product->price, 2) }}</td>
                            <td>
                                <span class="stock-status">In stock</span>
                            </td>
                            <td class="action">
                                <a href="{{ route('productDetailsSubCat', [$product->category_id, Str::slug($product['productCategory']['name']), $product->subcategory_id, Str::slug($product['productSubCategory']['name']), $product->id, Str::slug($product->title)]) }}" class="btn btn-dark btn-add-cart ">
                                    ADD TO CART
                                </a>
                            </td>
                        </tr>
                        @endforeach
 
                    @endif

                </tbody>
            </table>
        </div><!-- End .cart-table-container -->
    </div><!-- End .container -->
</main><!-- End .main -->
@endsection


