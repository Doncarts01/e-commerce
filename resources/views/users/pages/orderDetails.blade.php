
{{-- to join the two pages together --}}
@extends('users.user-master')

@section('user_title')
    <title>
        User | Order Details
    </title>    
@endsection

{{-- to add the @yield('admin') from the admin masters page --}}
@section('users') 


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Your Orders</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Order</a></li>
                            <li class="breadcrumb-item active">Details</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        @php
            $getSystemSettingsApp = App\Models\settings::getSingle();
        @endphp
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="invoice-title">
                                    <h4 class="float-end font-size-16"><strong>Order # {{ !empty($orders->transaction_id )  ? $orders->transaction_id : $orders->orderNo }}</strong></h4>
                                    <h3>
                                        <img src="{{ url($getSystemSettingsApp->logo) }}" alt="logo" height="24"/>
                                    </h3>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6 mb-0">
                                        <address>
                                            <strong>Details:</strong><br>
                                            <b class="text-dark">#: </b><span class="text-muted">  {{ $orders->id }} </span><br>
                                            <b class="text-dark">Name: </b><span class="text-muted"> {{ $orders->lastName ." ". $orders->firstName }} </span><br>
                                            <b class="text-dark">Country: </b><span class="text-muted">  {{ $orders->country }} </span><br>
                                            <b class="text-dark">Address: </b><span class="text-muted">  {{ $orders->address1 }}, {{ $orders->address2 }}  </span><br>
                                            <b class="text-dark">City: </b><span class="text-muted">  {{ $orders->city }} </span><br>
                                            <b class="text-dark">State: </b><span class="text-muted">  {{ $orders->state }} </span><br>
                                            <b class="text-dark">Postcode: </b><span class="text-muted">  {{ $orders->postcode }} </span><br>
                                            <b class="text-dark">Phone: </b><span class="text-muted">  {{ $orders->phone }} </span><br>
                                            <b class="text-dark">Email: </b><span class="text-muted">  {{ $orders->email }} </span>
                                        </address>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 text-left mt-0">
                                        <address>
                                            <strong>Other Details</strong><br>
                                            <b class="text-dark">Coupon Code: </b><span class="text-muted">  {{ $orders->couponCode }} </span><br>
                                            <b class="text-dark">Coupon Amount (€): </b><span class="text-muted">  {{ number_format($orders->couponCode_amount,2) }} </span><br>
                                            <b class="text-dark">Shipping Name: </b><span class="text-muted">  {{ $orders->getShipping->name }} </span><br>
                                            <b class="text-dark">Shipping Amount (€): </b><span class="text-muted">  {{ number_format($orders->shipping_amount, 2) }} </span><br>
                                            <b class="text-dark">Total Amount (€): </b><span class="text-muted">  {{ number_format($orders->total_amount, 2) }} </span><br>
                                            <b class="text-dark">Payment Method: </b><span class="text-muted text-capitalize">  {{ $orders->payment_method }} </span><br>
                                            <b class="text-dark">Status: </b><span class="text-muted text-capitalize"> 
                                                @if($orders->status == 0)
                                                    Pending
                                                @elseif($orders->status == 1)
                                                    In Progress
                                                @elseif($orders->status == 2)
                                                    Delivered
                                                @elseif($orders->status == 3)
                                                    Completed
                                                @else 
                                                    Cancelled
                                                @endif   
                                             </span><br>
                                            <b class="text-dark">Created at: </b><span class="text-muted text-capitalize">  {{ Carbon\Carbon::create($orders->created_at)->format('F j, Y - h:i A') }} </span><br>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <div class="p-2">
                                        <h3 class="font-size-16"><strong>Order summary</strong></h3>
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <td><strong>Item</strong></td>
                                                    <td class="text-left"><strong>Product Name</strong></td>
                                                    <td class="text-center"><strong>Size Name</strong></td>
                                                    <td class="text-center"><strong>Color Name</strong></td>
                                                    <td class="text-center"><strong>QTY</strong></td>
                                                    <td class="text-center"><strong>Price (€)</strong></td>
                                                    <td class="text-center"><strong>Size Amount (€)</strong></td>
                                                    <td class="text-end"><strong>Totals (€)</strong></td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                @php
                                                $subTotal = 0;
                                                @endphp
                                                @foreach ($orders->getItem as $item)
                                                <tr>
                                                    @php
                                                    $images = $item->getProduct->getFirstAndSecondImages();
                                                    $firstImage = $images->first();
                                                    $secondImage = $images->count() > 1 ? $images->get(1) : null;
                                                    $total = $item->total_price * $item->quantity;
                                                @endphp
                                                    <td>
                                                        <img src="{{ asset($firstImage->image_name) }}" alt="{{ $item->getProduct->title }}" width="100px" height="100px" class="img-fluid">
                                                    </td>
                                                    <td class="text-left">
                                                        <a href="{{ route('productDetailsSubCat', [$item->getProduct->category_id, Str::slug($item->getProduct['productCategory']['name']),$item->getProduct->subcategory_id, Str::slug($item->getProduct['productSubCategory']['name']), $item->getProduct->id, Str::slug($item->getProduct->title) ]) }}" target="_blank">
                                                            {{ $item->getProduct->title }}
                                                        </a>


                                                        <br><br>
                                                        @if ($orders->status == 3)
                                                            @php
                                                                $getReview = $item->getReview($item->getProduct->id, $item->id);
                                                            @endphp

                                                            @if (!empty($getReview))
                                                            <div class="rating-star">
                                                                <input type="hidden" class="rating" data-filled="mdi mdi-star text-primary" data-empty="mdi mdi-star-outline text-muted" data-readonly value="{{ $getReview->rating }}"/>
                                                            </div>    
                                                            @else
                                                            <button
                                                                class="btn btn-primary btn-sm makeReview" id="{{ $item->getProduct->id }}" data-order="{{ $item->id }}" title="View Message"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#ViewMessage{{ $item->id }}"> <i
                                                                    class="fas fa-edit"></i>Add a Review
                                                            </button>
                                                            @endif

                                                        @endif



                                                    </td>
                                                    <td class="text-center">{{ $item->size_name }}</td>
                                                    <td class="text-center">{{ $item->color_name }}</td>
                                                    <td class="text-center">{{ $item->quantity }}</td>
                                                    <td class="text-center">{{ $item->getProduct->price }}</td>
                                                    <td class="text-center">{{ number_format($item->size_amount, 2) }}</td>

                                                    <td class="text-end">{{ number_format($total, 2)  }}</td>
                                                </tr>                        
                                                @php
                                                    $subTotal += $total;
                                                @endphp                   
                                                




                                                <div class="modal fade" id="ViewMessage{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Product Review
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('submit_review') }}" method="POST">
                                                                    @csrf

                                                                    <input type="hidden" name="order_id" value="{{ $item->id }}">
                                                                    <input type="hidden" name="product_id" value="{{ $item->getProduct->id }}">

                                                                    <label for="ratingq">Your rating</label>
                                                                    <div class="rating-star">
                                                                        <input required type="hidden" class="rating tooltip" name="rating" data-filled="mdi mdi-star text-primary" data-empty="mdi mdi-star-outline text-muted"/>
                                                                    </div>    

                                                                    <label for="review">Your review</label> 
                                                                    <textarea name="review" id="review" cols="30" rows="10" class="form-control" required></textarea>
    
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <input type="submit" class="btn btn-primary" value="Submit">
                                                            </div>
                                                        </form>

                                                        </div>
                                                    </div>
                                                </div>


                                                @endforeach

                                                <tr>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line text-center">
                                                        <strong>Subtotal</strong></td>
                                                    <td class="thick-line text-end">€{{ number_format($subTotal ,2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line text-center">
                                                        <strong>Discount</strong></td>
                                                    <td class="thick-line text-end">- €{{ number_format($orders->couponCode_amount,2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-center">
                                                        <strong>Shipping</strong></td>
                                                    <td class="no-line text-end">€{{ number_format($orders->shipping_amount, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-center">
                                                        <strong>Total</strong></td>
                                                    <td class="no-line text-end"><h4 class="m-0">€{{ number_format($orders->total_amount, 2) }}</h4></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="d-print-none">
                                            <div class="float-end">
                                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                {{-- <a href="#" class="btn btn-primary waves-effect waves-light ms-2">Send</a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- end row -->

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->






    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->



<script>
    $('body').delegate('.makeReview', 'click', function () {
        var product_id = $(this).attr('id');
        let order_id = $(this).attr('data-order');
    });
</script>

@endsection
