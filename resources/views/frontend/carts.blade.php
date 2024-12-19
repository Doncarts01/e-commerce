@extends('frontend.frontend_masters')


@php
$getSystemSettingsApp = App\Models\settings::getSingle();
@endphp

@section('title')
{{ $getSystemSettingsApp->name }} | Shopping Carts
@endsection

@section('main')

<main class="main">
    <div class="container">
        <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
            <li class="active">
                <a>Shopping Cart</a>
            </li>
        </ul>

        @if (!empty(Cart::getContent()->count()))
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-table-container">
                    <form action="{{ route('update_cart') }}" method="POST">
                        @csrf
                        <table class="table table-cart">
                            <thead>
                                <tr>
                                    <th class="thumbnail-col"></th>
                                    <th class="product-col">Product</th>
                                    <th class="price-col">Price</th>
                                    <th class="qty-col">Quantity</th>
                                    <th class="text-right">Subtotal</th>
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
                            @if(!empty($getCartProduct))
                            @php
                                $images = $getCartProduct->getFirstAndSecondImages();
                                $firstImage = $images->first();
                                $secondImage = $images->count() > 1 ? $images->get(1) : null;
                            @endphp
                                <tr class="product-row">
                                    <td>
                                        <figure class="product-image-container">
                                            <a href="{{ route('productDetailsSubCat', [$getCartProduct->category_id, Str::slug($getCartProduct['productCategory']['name']), $getCartProduct->subcategory_id, Str::slug($getCartProduct['productSubCategory']['name']), $getCartProduct->id, Str::slug($getCartProduct->title)]) }}" class="product-image">
                                                @if ($firstImage)
                                                <img src="{{ asset($firstImage->image_name) }}"  alt="{{ $getCartProduct->title }}" alt="{{ $getCartProduct->title }}"/>
                                            @else
                                                <img src="{{ asset('upload/no_image.jpg') }}" 
                                                alt="{{ $getCartProduct->title }}" />
                                            @endif
                                            </a>

                                            <a href="{{ route('cart_delete', $getCartProduct->id) }}" class="btn-remove icon-cancel" title="Remove Product"></a>
                                        </figure>
                                    </td>
                                    <td class="product-col">
                                        <h5 class="product-title">
                                            <a href="{{ route('productDetailsSubCat', [$getCartProduct->category_id, Str::slug($getCartProduct['productCategory']['name']), $getCartProduct->subcategory_id, Str::slug($getCartProduct['productSubCategory']['name']), $getCartProduct->id, Str::slug($getCartProduct->title)]) }}">
                                                {{ $getCartProduct->title }} {{ $getCartProduct->id }}</a>
                                        </h5>
                                    </td>
                                    <td>€{{ number_format($carts->price, 2) }}</td>
                                    <td>
                                        <div class="product-single-qty">
                                            <input class="horizontal-quantity form-control" type="text" value="{{ $carts->quantity }}" name="cart[{{ $key }}][qty]">
                                        </div><!-- End .product-single-qty -->
                                        <input type="hidden" value="{{ $carts->id }}" name="cart[{{ $key }}][id]">
                                    </td>
                                    <td class="text-right"><span class="subtotal-price">€{{ number_format($carts->price * $carts->quantity, 2) }}</span></td>
                                </tr>
                            @endif
                            @endforeach
                            </tbody>


                            <tfoot>
                                <tr>
                                    <td colspan="5" class="clearfix">


                                        <div class="float-right">
                                            <button type="submit" class="btn btn-shop btn-update-cart">
                                                Update Cart
                                            </button>
                                        </div><!-- End .float-right -->
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div><!-- End .cart-table-container -->
            </div><!-- End .col-lg-8 -->

            <div class="col-lg-4">
                <div class="cart-summary">
                    <h3>CART TOTALS</h3>

                    <table class="table table-totals">
                        <tbody>
                            <tr>
                                <td>Subtotal</td>
                                <td>€{{ number_format($cart->getSubTotal(), 2) }}</td>
                            </tr>

                        </tbody>

                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td>€{{ number_format($cart->getSubTotal(), 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="checkout-methods">
                        <a href="{{ url('checkout') }}" class="btn btn-block btn-dark">Proceed to Checkout
                            <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div><!-- End .cart-summary -->
            </div><!-- End .col-lg-4 -->
        </div><!-- End .row -->
        @else
            <h4>Cart is Empty</h4>
        @endif
    </div><!-- End .container -->

    <div class="mb-6"></div><!-- margin -->
</main><!-- End .main -->

@endsection


