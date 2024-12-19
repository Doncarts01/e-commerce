<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Log; // Include the Log facade
use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\color;
use App\Models\couponCode;
use App\Models\order_item;
use App\Models\orders;
use App\Models\products;
use App\Models\productSize;
use App\Models\shippingCharge;
use App\Models\User;
use App\Models\settings;
use App\Models\paymentSettings;
use App\Models\notification;
use Darryldecode\Cart\Cart;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Unicodeveloper\Paystack\Facades\Paystack;
// use Cart;

class paymentController extends Controller
{

    public function ProductCarts(Request $request){
        // $cartItems = \Cart::getContent();
        return view('frontend.carts');
    }



    public function productAddToCart(Request $request){

        $product = Products::find($request->product_id);
        $total = $product->price;
        if(!empty($request->size_id)){
            $size_id = $request->size_id;   
            $getSize = productSize::getSingle($size_id);
            $sizePrice = !empty($getSize->price) ? $getSize->price : 0;
            $total = $total + $sizePrice;
        }else{
            $size_id = 0;
        }

        $cart = app('cart'); // Assuming you are using the service container to resolve the cart instance
        $cart->add([
            'id' => $product->id, 
            'name' => 'Product',
            'price' => $total,
            'quantity' => $request->qty,
            'attributes' => array(
                'color_id' => $request->color_id,
                'size_id' => $size_id,
            )
        ]);

        // $cart->clear();

        return redirect()->back();
    }

 

    public function cartDelete($id){
        $cart = app('cart');
        $cart->remove($id);

        $notification = [
            'alert-type' => 'success',
            'message' => 'Cart deleted successfully'
        ];

        return redirect()->back()->with($notification);
    }



    public function updateCart(Request $request){
        foreach ($request->cart as $cart) {
            $cartUpdate = app('cart');
            $cartUpdate->update($cart['id'], array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $cart['qty']
                ),
              ));
        }

        return redirect()->back();

    }



    public function checkOutProducts(){
        $getShipping = shippingCharge::getRecord();
        $paymentSettings = paymentSettings::getSingle();
        return view('frontend.checkout', compact('getShipping', 'paymentSettings'));
    }



    public function applyCoupon(Request $request){
        $getCoupon = couponCode::checkCouponCode($request->couponCode);
        $cart = app('cart');
        $total = $cart->getSubTotal();
        // dd($getCoupon);
        if(!empty($getCoupon)){

            if($getCoupon->type == 'Amount'){
                $coupon_amount = $getCoupon->percent_amount;
                $payable_total = $total - $getCoupon->percent_amount;

            }else{
                $coupon_amount = ($total * $getCoupon->percent_amount) / 100;
                $payable_total = $total - $coupon_amount;
            }

            $json['status'] = true;
            $json['payable_total'] = $payable_total;
            $json['coupon_amount'] = number_format($coupon_amount, 2);
            $json['message'] = 'Successful';
        }else{
           
            $json['payable_total'] = $total;
            $json['coupon_amount'] = '0.00';
            $json['status'] = false;
            $json['message'] = 'Invalid coupon code';
        }

        echo json_encode($json);

    }



    public function placeOrder(Request $request){

        $validation = 0;

        if(!empty(Auth::check())){
            $user_id = Auth::user()->id;
        }else{
            if (!empty($request->isCreate)) {
                try {
                    $request->validate([
                        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                        'password' => ['required', Rules\Password::defaults()],
                    ]);
            
                    $user = User::create([
                        'firstname' => $request->firstName,
                        'lastname' => $request->lastName,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ]);
            
                    event(new Registered($user));
                    $user_id = $user->id;
                    $is_Admin = 0;
                    $url = url('admin/view/users');
                    $message = "New Registered Customer";
            
                    notification::insertRecord($user_id, $url, $message,$is_Admin);
            
                } catch (ValidationException $e) {
                    $validation = 1;
                    $json['status'] = false;
                    $json['message'] = 'Please fill all required fields';
                    $json['errors'] = $e->errors(); // Add this line to include detailed validation errors
                    echo json_encode($json);
                    exit;
                }
            } else {
                $user_id = "";
            }
        }



        if(empty($validation)){
            
                $cart = app('cart');
                $getShipping = shippingCharge::getSingle($request->shipping);
                $total = $cart->getSubTotal();
                $coupon_amount = 0;
                $couponCode = "";
                // 680.0 
                if(!empty($request->couponCode)){
                    $getCoupon = couponCode::checkCouponCode($request->couponCode);

                    if(!empty($getCoupon)){
                        $couponCode = $request->couponCode;

                        if($getCoupon->type == 'Amount'){
                            $coupon_amount = $getCoupon->percent_amount;
                            $total = $total - $getCoupon->percent_amount;
            
                        }else{
                            $coupon_amount = ($total * $getCoupon->percent_amount) / 100;
                            $total = $total - $coupon_amount;
                        }
                    }
                }

                $shipping_amount = !empty($getShipping->price) ? $getShipping->price : 0;
                $payable_total = $shipping_amount + $total;

                $orders = new orders();
                if(!empty($user_id)){
                    $orders->user_id = trim($user_id);
                }
                $orderNo = mt_rand(100000000, 999999999);
                $orders->orderNo = $orderNo;
                $orders->firstName = trim($request->firstName);
                $orders->lastName = trim($request->lastName);
                $orders->country = trim($request->country);
                $orders->address1 = trim($request->address1);
                $orders->address2 = trim($request->address2);
                $orders->city = trim($request->city);
                $orders->state = trim($request->state);
                $orders->postcode = trim($request->postcode);
                $orders->phone = trim($request->phone);
                $orders->email = trim($request->email);
                $orders->notes = trim($request->notes);
                $orders->couponCode = trim($couponCode);
                $orders->couponCode_amount= trim($coupon_amount);
                $orders->shipping_id = trim($request->shipping);
                $orders->shipping_amount = trim($shipping_amount);
                $orders->total_amount = trim($payable_total);
                $orders->payment_method = trim($request->payment_method);
                $orders->save();

                foreach($cart->getContent() as $key => $carts){
                    // dd($carts);
                    $order_item = new order_item();
                    $order_item->order_id = $orders->id;
                    $order_item->product_id = $carts->id;
                    $order_item->quantity = $carts->quantity;
                    $order_item->price = $carts->price;
                    $order_item->color_name = $carts->attributes->color_id;

                    $color_id = $carts->attributes->color_id;
                    if(!empty($color_id)){
                        $getColor = color::getSingle($color_id);
                        $order_item->color_name = $getColor->name;
                    }

                    $size_id = $carts->attributes->size_id;
                    if(!empty($size_id)){
                        $getSize = productSize::getSingle($size_id);
                        $order_item->size_name = $getSize->name;
                        $order_item->size_amount = $getSize->price;
                    }

                    $order_item->total_price =  $carts->price;
                    $order_item->save();

                }
                $json['status'] = true;
                $json['message'] = 'Order Success';
                // $url = url('checkout/payment?order_id='.base64_encode($orders->id));
                $route = route('checkout_payment', base64_encode($orders->id));
                // Log::info('Redirect URL: ' . $url);
                $json['redirect'] = $route;
        }else{
            $json['status'] = false;
            $json['message'] = 'Error Processing Order';
        }

        echo json_encode($json);

    }






















    public function checkoutPayment(Request $request, $id)
    {
        $cart = app('cart');
        if (!empty($cart->getSubTotal()) && !empty($id)) {
            $order_id = base64_decode($id);
            $getOrder = orders::find($order_id);

            if (!empty($getOrder)) {
                // CASH
                if ($getOrder->payment_method == 'cash') {
                    $getOrder->isPayment = 1;
                    $getOrder->save();
                    $getSystemSettingsApp = settings::getSingle();

                    // Email content
                    $subject = "Order Invoice";

                    $message = '
                    <!DOCTYPE html>
                    <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    background-color: #f8f8f8;
                                    color: #333;
                                    padding: 20px;
                                }
                                .invoice-container {
                                    background-color: #ffffff;
                                    border: 1px solid #ddd;
                                    padding: 20px;
                                    max-width: 600px;
                                    margin: auto;
                                }
                                .invoice-header {
                                    margin-bottom: 20px;
                                }
                                .invoice-header h1 {
                                    margin: 0;
                                    font-size: 24px;
                                    color: #333;
                                    text-align: center;
                                }
                                .invoice-header p {
                                    margin: 5px 0;
                                    font-size: 16px;
                                    color: #666;
                                }
                                .invoice-addresses {
                                    margin-bottom: 20px;
                                }
                                .invoice-addresses div {
                                    margin-bottom: 10px;
                                }
                                .invoice-addresses h3 {
                                    margin: 0;
                                    font-size: 18px;
                                    color: #333;
                                }
                                .invoice-addresses p {
                                    margin: 5px 0;
                                    font-size: 16px;
                                    color: #666;
                                }
                                .invoice-details {
                                    margin-bottom: 20px;
                                    overflow: auto;
                                }
                                .invoice-details table {
                                    width: 100%;
                                    border-collapse: collapse;
                                }
                                .invoice-details table th, .invoice-details table td {
                                    padding: 10px;
                                    border: 1px solid #ddd;
                                    text-align: left;
                                }
                                .invoice-details table th {
                                    background-color: #f2f2f2;
                                }
                                .invoice-summary {
                                    margin-top: 20px;
                                }
                                .invoice-summary p {
                                    font-size: 16px;
                                    font-weight: bold;
                                    text-align: right;
                                }
                                .invoice-footer {
                                    margin-top: 20px;
                                    text-align: justify;
                                }
                                .invoice-footer p {
                                    margin: 5px 0;
                                    font-size: 14px;
                                    color: #666;
                                }
                            </style>
                        </head>
                        <body>
                            <div class="invoice-container">
                                <div class="invoice-header">
                                    <h1>Order Details</h1>
                                    <p><b>Order No:</b> '.$getOrder->orderNo.' </p>
                                    <p><b>Date of Purchase:</b> '. Carbon::create($getOrder->created_at)->format('F j, Y') .' at '. Carbon::create($getOrder->created_at)->format('h:i A') . '</p>
                                </div>
                                <div class="invoice-header">
                                    <p>Dear '.$getOrder->lastName .' '. $getOrder->firstName. ',</p>
                                    <p>Thank you for your recent order purchase. Please find the invoice details of your transaction below:</p>
                                </div>
                                <div class="invoice-details">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Quantity (Units)</th>
                                                <th>Price (€)</th>
                                                <th>Total (€)</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                    
                                        $subTotal = 0;
                                        foreach($getOrder->getItem as $item) {
                                            $total = $item->total_price * $item->quantity;
                                            $message .= '
                                            <tr>
                                                <td>'.$item->getProduct->title.'
                                                <br>Color: '.$item->color_name;
                    
                                                if(!empty($item->size_name)){
                                                    $message .= '<br>Size: '.$item->size_name.'
                                                    <br>Size Amount: €'.number_format($item->size_amount, 2);
                                                }
                    
                                                $message .= '</td>
                                                <td>'.$item->quantity.'</td>
                                                <td>'.number_format($item->price, 2).'</td>
                                                <td>'.number_format($total, 2).'</td>
                                            </tr>';
                                            $subTotal += $total;
                                        }
                    
                                        $message .= '
                                        </tbody>
                                    </table>
                                </div>
                                <div class="invoice-summary">
                                    <p>Subtotal: €'.number_format($subTotal, 2).'</p>
                                    <p>Shipping Name: '.$getOrder->getShipping->name.'</p>';
                    
                                    if(!empty($getOrder->couponCode)){
                                        $message .= '<p>Discount Name: '.$getOrder->couponCode.'</p>';
                                        $message .= '<p>Discount Amount: -€'.number_format($getOrder->couponCode_amount, 2).'</p>';
                                    }
                    
                                    $message .= '<p>Shipping Fee: €'.number_format($getOrder->shipping_amount, 2).'</p>
                                    <p>Total Amount: €'.number_format($getOrder->total_amount, 2).'</p>
                                    <p style="text-transform: capitalize;">Payment Method: <i>'.$getOrder->payment_method.'</i></p>
                                </div>
                                <div class="invoice-footer">
                                    <p>Thank you for choosing '. $getSystemSettingsApp->name.'! We appreciate your business. If you have any questions, please contact us at support@example.com. <br><br>
                                        <b>Best Regards,</b>
                                    </p>
                                    <h5>'. $getSystemSettingsApp->name .'</h5>
                                </div>
                            </div>
                        </body>
                    </html>
                    ';
                    
                
                    $emailSuccess = Mail::to($getOrder->email)->send(new Websitemail($subject, $message));

                    // To create notification
                    $user_id = $getOrder->user_id;
                    $is_Admin = 0;
                    $url = url('admin/details/orders/'.$getOrder->id);
                    $message = "New Order Placed #". $getOrder->orderNo;

                    notification::insertRecord($user_id, $url, $message, $is_Admin);


                    $cart->clear();

                    $notification = [
                        'message' => 'Order successfully processed',
                        'alert-type' => 'success'
                    ];

                    return redirect()->route('productCarts')->with($notification);
                } 
                // PAYPAL
                elseif ($getOrder->payment_method == 'paypal') {

                    $amount = intval($getOrder->total_amount);
                    $provider = new PayPalClient;
                    $provider->setApiCredentials(config('paypal'));
                    $paypalToken = $provider->getAccessToken();
                    $response = $provider->createOrder([
                        "intent" => "CAPTURE",
                        "application_context" => [
                            "return_url" => route('success'),
                            "cancel_url" => route('cancel')
                        ],
                        "purchase_units" => [
                            [
                                "amount" => [
                                    "currency_code" => "EUR",
                                    "value" => $amount
                                ]
                            ]
                        ]
                    ]);

                        if (isset($response['id']) && $response['id'] != null) {
                            foreach ($response['links'] as $link) {
                                if ($link['rel'] === 'approve') {
                                    session()->put('orderID', $getOrder->id);
                                    return redirect()->away($link['href']);
                                }
                            }
                        } else {
                            return redirect()->route('cancel');
                        }
                } 
                // STRIPE
                else if($getOrder->payment_method == 'stripe'){
                    $amount = intval($getOrder->total_amount);

                    // Retrieve order items related to the order_id
                    $orderItems = order_item::where('order_id', $getOrder->id)->get();
                    // Initialize an array to hold product names
                    $productNames = [];
                    // Loop through order items to get product names
                    foreach ($orderItems as $item) {
                        // Retrieve the product by product_id
                        $product = products::find($item->product_id);
                        if ($product) {
                            $productNames[] = $product->title; 
                        } 
                    }
                    $serviceName = implode(', ', $productNames);

                    // Combine product names into a single string
                    $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
                    $response = $stripe->checkout->sessions->create([
                        'customer_email' => $getOrder->	email,
                        'line_items' => [
                            [
                                'price_data' => [
                                    'currency' => 'eur',
                                    'product_data' => [
                                        'name' => $serviceName,
                                    ],
                                    'unit_amount' => $amount * 100,
                                ],
                                'quantity' => 1,
                            ],
                        ],
                        'mode' => 'payment',
                        'success_url' => route('stripe_success') . '?session_id={CHECKOUT_SESSION_ID}',
                        'cancel_url' => route('stripe_cancel'),
                    ]);

                    // dd($response);
                    if (isset($response->id) && $response->id != "") {          
                        session()->put('orderID', $getOrder->id);
                        return redirect($response->url);
                    } else {
                        return redirect()->route('stripe_cancel');
                    }
                }
                // PAYSTACK
                else if($getOrder->payment_method == 'paystack') {
                    $orderNo = time();
                    $amount = intval($getOrder->total_amount);
                    $data = array(
                        "amount" => $amount * 100,
                        "reference" => $orderNo,
                        "email" => $getOrder->email,
                        "currency" => "NGN",
                        "orderID" => $getOrder->id,
                        "callback_url" => route('handleGatewayCallback') // Add this line
                    );
                    session()->put('orderID', $getOrder->id);
                
                    return Paystack::getAuthorizationUrl($data)->redirectNow();

                }
            }
            else {
                abort(404);
            }
        } 
        else {
            abort(404);
        }
    }


    // Success payment PAYPAL
    public function paypalSuccessPayment(Request $request)
    {
        $getSystemSettingsApp = settings::getSingle();
        $cart = app('cart');

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        $orderID = session()->get('orderID');


        if (isset($response['status']) && $response['status'] == 'COMPLETED' && !empty($response['id'])) {

            $getOrder = orders::find($orderID);
            $getOrder->isPayment = 1;
            $getOrder->transaction_id = $response['purchase_units'][0]['payments']['captures'][0]['id'];
            $getOrder->currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
            $getOrder->save();

            $subject = "Order Invoice";

            // Email content
            $message = '
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f8f8f8;
                            color: #333;
                            padding: 20px;
                        }
                        .invoice-container {
                            background-color: #ffffff;
                            border: 1px solid #ddd;
                            padding: 20px;
                            max-width: 600px;
                            margin: auto;
                        }
                        .invoice-header {
                            margin-bottom: 20px;
                        }
                        .invoice-header h1 {
                            margin: 0;
                            font-size: 24px;
                            color: #333;
                            text-align: center;
                        }
                        .invoice-header p {
                            margin: 5px 0;
                            font-size: 16px;
                            color: #666;
                        }
                        .invoice-addresses {
                            margin-bottom: 20px;
                        }
                        .invoice-addresses div {
                            margin-bottom: 10px;
                        }
                        .invoice-addresses h3 {
                            margin: 0;
                            font-size: 18px;
                            color: #333;
                        }
                        .invoice-addresses p {
                            margin: 5px 0;
                            font-size: 16px;
                            color: #666;
                        }
                        .invoice-details {
                            margin-bottom: 20px;
                            overflow: auto;
                        }
                        .invoice-details table {
                            width: 100%;
                            border-collapse: collapse;
                        }
                        .invoice-details table th, .invoice-details table td {
                            padding: 10px;
                            border: 1px solid #ddd;
                            text-align: left;
                        }
                        .invoice-details table th {
                            background-color: #f2f2f2;
                        }
                        .invoice-summary {
                            margin-top: 20px;
                        }
                        .invoice-summary p {
                            font-size: 16px;
                            font-weight: bold;
                            text-align: right;
                        }
                        .invoice-footer {
                            margin-top: 20px;
                            text-align: justify;
                        }
                        .invoice-footer p {
                            margin: 5px 0;
                            font-size: 14px;
                            color: #666;
                        }
                    </style>
                </head>
                <body>
                    <div class="invoice-container">
                        <div class="invoice-header">
                            <h1>Order Details</h1>
                            <p><b>Order No:</b> '.$getOrder->orderNo.' </p>
                            <p><b>Date of Purchase:</b> '. Carbon::create($getOrder->created_at)->format('F j, Y') .' at '. Carbon::create($getOrder->created_at)->format('h:i A') . '</p>
                        </div>
                        <div class="invoice-header">
                            <p>Dear '.$getOrder->lastName .' '. $getOrder->firstName. ',</p>
                            <p>Thank you for your recent order purchase. Please find the invoice details of your transaction below:</p>
                        </div>
                        <div class="invoice-details">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantity (Units)</th>
                                        <th>Price (€)</th>
                                        <th>Total (€)</th>
                                    </tr>
                                </thead>
                                <tbody>';
            
                                $subTotal = 0;
                                foreach($getOrder->getItem as $item) {
                                    $total = $item->total_price * $item->quantity;
                                    $message .= '
                                    <tr>
                                        <td>'.$item->getProduct->title.'
                                        <br>Color: '.$item->color_name;
            
                                        if(!empty($item->size_name)){
                                            $message .= '<br>Size: '.$item->size_name.'
                                            <br>Size Amount: €'.number_format($item->size_amount, 2);
                                        }
            
                                        $message .= '</td>
                                        <td>'.$item->quantity.'</td>
                                        <td>'.number_format($item->price, 2).'</td>
                                        <td>'.number_format($total, 2).'</td>
                                    </tr>';
                                    $subTotal += $total;
                                }
            
                                $message .= '
                                </tbody>
                            </table>
                        </div>
                        <div class="invoice-summary">
                            <p>Subtotal: €'.number_format($subTotal, 2).'</p>
                            <p>Shipping Name: '.$getOrder->getShipping->name.'</p>';
            
                            if(!empty($getOrder->couponCode)){
                                $message .= '<p>Discount Name: '.$getOrder->couponCode.'</p>';
                                $message .= '<p>Discount Amount: -€'.number_format($getOrder->couponCode_amount, 2).'</p>';
                            }
            
                            $message .= '<p>Shipping Fee: €'.number_format($getOrder->shipping_amount, 2).'</p>
                            <p>Total Amount: €'.number_format($getOrder->total_amount, 2).'</p>
                            <p style="text-transform: capitalize;">Payment Method: <i>'.$getOrder->payment_method.'</i></p>
                        </div>
                        <div class="invoice-footer">
                            <p>Thank you for choosing '. $getSystemSettingsApp->name.'! We appreciate your business. If you have any questions, please contact us at support@example.com. <br><br>
                                <b>Best Regards,</b>
                            </p>
                            <h5>'. $getSystemSettingsApp->name .'</h5>
                        </div>
                    </div>
                </body>
            </html>
            ';
            
        
            $emailSuccess = Mail::to($getOrder->email)->send(new Websitemail($subject, $message));


            // To create notification
            $user_id = $getOrder->user_id;
            $is_Admin = 0;
            $url = url('admin/details/orders/'.$getOrder->id);
            $message = "New Order Placed #". $getOrder->orderNo;

            notification::insertRecord($user_id, $url, $message,$is_Admin);


            $cart->clear();

            $notification = [
                'message' => 'Payment successfully made',
                'alert-type' => 'success'
            ];

            return redirect()->route('productCarts')->with($notification);
 
        } else {
            return redirect()->route('cancel');
        }
    }

    // CANCEL / ERROR PAYMENT PAYPAL
    public function paypalCancelPayment(Request $request){
        $notification = [
            'message' => 'Unable to complete payment',
            'alert-type' => 'error'
        ];

        return redirect()->route('checkoutProducts')->with($notification);
    }




    


    // Success payment STRIPE
    public function stripeSuccess(Request $request)
    {
        $getSystemSettingsApp = settings::getSingle();
        $cart = app('cart');
        if (isset($request->session_id)) {
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);

            // Log::info("Response: ". );
            $orderNo = time();

            $orderID = session()->get('orderID');
            $getOrder = orders::find($orderID);

            $getOrder->isPayment = 1;
            $getOrder->transaction_id =$orderNo;
            $getOrder->currency = $response->currency;
            $getOrder->stripe_session_id = $response->id;
            $getOrder->save();


            
            $subject = "Order Invoice";

            // Email content
            $message = '
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f8f8f8;
                            color: #333;
                            padding: 20px;
                        }
                        .invoice-container {
                            background-color: #ffffff;
                            border: 1px solid #ddd;
                            padding: 20px;
                            max-width: 600px;
                            margin: auto;
                        }
                        .invoice-header {
                            margin-bottom: 20px;
                        }
                        .invoice-header h1 {
                            margin: 0;
                            font-size: 24px;
                            color: #333;
                            text-align: center;
                        }
                        .invoice-header p {
                            margin: 5px 0;
                            font-size: 16px;
                            color: #666;
                        }
                        .invoice-addresses {
                            margin-bottom: 20px;
                        }
                        .invoice-addresses div {
                            margin-bottom: 10px;
                        }
                        .invoice-addresses h3 {
                            margin: 0;
                            font-size: 18px;
                            color: #333;
                        }
                        .invoice-addresses p {
                            margin: 5px 0;
                            font-size: 16px;
                            color: #666;
                        }
                        .invoice-details {
                            margin-bottom: 20px;
                            overflow: auto;
                        }
                        .invoice-details table {
                            width: 100%;
                            border-collapse: collapse;
                        }
                        .invoice-details table th, .invoice-details table td {
                            padding: 10px;
                            border: 1px solid #ddd;
                            text-align: left;
                        }
                        .invoice-details table th {
                            background-color: #f2f2f2;
                        }
                        .invoice-summary {
                            margin-top: 20px;
                        }
                        .invoice-summary p {
                            font-size: 16px;
                            font-weight: bold;
                            text-align: right;
                        }
                        .invoice-footer {
                            margin-top: 20px;
                            text-align: justify;
                        }
                        .invoice-footer p {
                            margin: 5px 0;
                            font-size: 14px;
                            color: #666;
                        }
                    </style>
                </head>
                <body>
                    <div class="invoice-container">
                        <div class="invoice-header">
                            <h1>Order Details</h1>
                            <p><b>Order No:</b> '.$getOrder->orderNo.' </p>
                            <p><b>Date of Purchase:</b> '. Carbon::create($getOrder->created_at)->format('F j, Y') .' at '. Carbon::create($getOrder->created_at)->format('h:i A') . '</p>
                        </div>
                        <div class="invoice-header">
                            <p>Dear '.$getOrder->lastName .' '. $getOrder->firstName. ',</p>
                            <p>Thank you for your recent order purchase. Please find the invoice details of your transaction below:</p>
                        </div>
                        <div class="invoice-details">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantity (Units)</th>
                                        <th>Price (€)</th>
                                        <th>Total (€)</th>
                                    </tr>
                                </thead>
                                <tbody>';
            
                                $subTotal = 0;
                                foreach($getOrder->getItem as $item) {
                                    $total = $item->total_price * $item->quantity;
                                    $message .= '
                                    <tr>
                                        <td>'.$item->getProduct->title.'
                                        <br>Color: '.$item->color_name;
            
                                        if(!empty($item->size_name)){
                                            $message .= '<br>Size: '.$item->size_name.'
                                            <br>Size Amount: €'.number_format($item->size_amount, 2);
                                        }
            
                                        $message .= '</td>
                                        <td>'.$item->quantity.'</td>
                                        <td>'.number_format($item->price, 2).'</td>
                                        <td>'.number_format($total, 2).'</td>
                                    </tr>';
                                    $subTotal += $total;
                                }
            
                                $message .= '
                                </tbody>
                            </table>
                        </div>
                        <div class="invoice-summary">
                            <p>Subtotal: €'.number_format($subTotal, 2).'</p>
                            <p>Shipping Name: '.$getOrder->getShipping->name.'</p>';
            
                            if(!empty($getOrder->couponCode)){
                                $message .= '<p>Discount Name: '.$getOrder->couponCode.'</p>';
                                $message .= '<p>Discount Amount: -€'.number_format($getOrder->couponCode_amount, 2).'</p>';
                            }
            
                            $message .= '<p>Shipping Fee: €'.number_format($getOrder->shipping_amount, 2).'</p>
                            <p>Total Amount: €'.number_format($getOrder->total_amount, 2).'</p>
                            <p style="text-transform: capitalize;">Payment Method: <i>'.$getOrder->payment_method.'</i></p>
                        </div>
                        <div class="invoice-footer">
                            <p>Thank you for choosing '. $getSystemSettingsApp->name.'! We appreciate your business. If you have any questions, please contact us at support@example.com. <br><br>
                                <b>Best Regards,</b>
                            </p>
                            <h5>'. $getSystemSettingsApp->name .'</h5>
                        </div>
                    </div>
                </body>
            </html>
            ';
            
        
            $emailSuccess = Mail::to($getOrder->email)->send(new Websitemail($subject, $message));

            // To create notification
            $user_id = $getOrder->user_id;
            $is_Admin = 0;
            $url = url('admin/details/orders/'.$getOrder->id);
            $message = "New Order Placed #". $getOrder->orderNo;

            notification::insertRecord($user_id, $url, $message,$is_Admin);

            $cart->clear();

            $notification = [
                'message' => 'Payment successfully made',
                'alert-type' => 'success'
            ];

            return redirect()->route('productCarts')->with($notification);

        } else {
            // Handle the error case where session_id is not provided
            return redirect()->route('stripe_cancel');

        }
    }

       // CANCEL / ERROR PAYMENT STRIPE
    public function stripeCancel(Request $request){
        $notification = [
            'message' => 'Unable to complete payment',
            'alert-type' => 'error'
        ];

        return redirect()->route('checkoutProducts')->with($notification);
    }








    // PAYSTACK
    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        try {
            return Paystack::getAuthorizationUrl()->redirectNow();
        } catch (\Exception $e) {
            $notification = [
                'message' => 'The paystack token has expired. Please refresh the page and try again.',
                'alert-type' => 'error'
            ];
            return Redirect::back()->with($notification);
            // return Redirect::back()->withMessage(['msg' => 'The paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
        }
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $cart = app('cart');

        $paymentDetails = Paystack::getPaymentData();
        Log::info($paymentDetails);
        $transaction_id = $paymentDetails['data']['id'];

        if ($paymentDetails['status'] == 'success') {
            $orderNo = time();

            $orderID = session()->get('orderID');
    
            $getOrder = orders::find($orderID);
            // Log::info('Order Details: ' . json_encode($getOrder));
            $getSystemSettingsApp = settings::getSingle();
    
            $getOrder->isPayment = 1;
            $getOrder->transaction_id =$transaction_id;
            $getOrder->save();

            $subject = "Order Invoice";

            // Email content
            $message = '
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f8f8f8;
                            color: #333;
                            padding: 20px;
                        }
                        .invoice-container {
                            background-color: #ffffff;
                            border: 1px solid #ddd;
                            padding: 20px;
                            max-width: 600px;
                            margin: auto;
                        }
                        .invoice-header {
                            margin-bottom: 20px;
                        }
                        .invoice-header h1 {
                            margin: 0;
                            font-size: 24px;
                            color: #333;
                            text-align: center;
                        }
                        .invoice-header p {
                            margin: 5px 0;
                            font-size: 16px;
                            color: #666;
                        }
                        .invoice-addresses {
                            margin-bottom: 20px;
                        }
                        .invoice-addresses div {
                            margin-bottom: 10px;
                        }
                        .invoice-addresses h3 {
                            margin: 0;
                            font-size: 18px;
                            color: #333;
                        }
                        .invoice-addresses p {
                            margin: 5px 0;
                            font-size: 16px;
                            color: #666;
                        }
                        .invoice-details {
                            margin-bottom: 20px;
                            overflow: auto;
                        }
                        .invoice-details table {
                            width: 100%;
                            border-collapse: collapse;
                        }
                        .invoice-details table th, .invoice-details table td {
                            padding: 10px;
                            border: 1px solid #ddd;
                            text-align: left;
                        }
                        .invoice-details table th {
                            background-color: #f2f2f2;
                        }
                        .invoice-summary {
                            margin-top: 20px;
                        }
                        .invoice-summary p {
                            font-size: 16px;
                            font-weight: bold;
                            text-align: right;
                        }
                        .invoice-footer {
                            margin-top: 20px;
                            text-align: justify;
                        }
                        .invoice-footer p {
                            margin: 5px 0;
                            font-size: 14px;
                            color: #666;
                        }
                    </style>
                </head>
                <body>
                    <div class="invoice-container">
                        <div class="invoice-header">
                            <h1>Order Details</h1>
                            <p><b>Order No:</b> '.$getOrder->orderNo.' </p>
                            <p><b>Date of Purchase:</b> '. Carbon::create($getOrder->created_at)->format('F j, Y') .' at '. Carbon::create($getOrder->created_at)->format('h:i A') . '</p>
                        </div>
                        <div class="invoice-header">
                            <p>Dear '.$getOrder->lastName .' '. $getOrder->firstName. ',</p>
                            <p>Thank you for your recent order purchase. Please find the invoice details of your transaction below:</p>
                        </div>
                        <div class="invoice-details">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantity (Units)</th>
                                        <th>Price (€)</th>
                                        <th>Total (€)</th>
                                    </tr>
                                </thead>
                                <tbody>';
            
                                $subTotal = 0;
                                foreach($getOrder->getItem as $item) {
                                    $total = $item->total_price * $item->quantity;
                                    $message .= '
                                    <tr>
                                        <td>'.$item->getProduct->title.'
                                        <br>Color: '.$item->color_name;
            
                                        if(!empty($item->size_name)){
                                            $message .= '<br>Size: '.$item->size_name.'
                                            <br>Size Amount: €'.number_format($item->size_amount, 2);
                                        }
            
                                        $message .= '</td>
                                        <td>'.$item->quantity.'</td>
                                        <td>'.number_format($item->price, 2).'</td>
                                        <td>'.number_format($total, 2).'</td>
                                    </tr>';
                                    $subTotal += $total;
                                }
            
                                $message .= '
                                </tbody>
                            </table>
                        </div>
                        <div class="invoice-summary">
                            <p>Subtotal: €'.number_format($subTotal, 2).'</p>
                            <p>Shipping Name: '.$getOrder->getShipping->name.'</p>';
            
                            if(!empty($getOrder->couponCode)){
                                $message .= '<p>Discount Name: '.$getOrder->couponCode.'</p>';
                                $message .= '<p>Discount Amount: -€'.number_format($getOrder->couponCode_amount, 2).'</p>';
                            }
            
                            $message .= '<p>Shipping Fee: €'.number_format($getOrder->shipping_amount, 2).'</p>
                            <p>Total Amount: €'.number_format($getOrder->total_amount, 2).'</p>
                            <p style="text-transform: capitalize;">Payment Method: <i>'.$getOrder->payment_method.'</i></p>
                        </div>
                        <div class="invoice-footer">
                            <p>Thank you for choosing '.$getSystemSettingsApp->name.'! We appreciate your business. If you have any questions, please contact us at support@example.com. <br><br>
                                <b>Best Regards,</b>
                            </p>
                            <h5>'. $getSystemSettingsApp->name .'</h5>
                        </div>
                    </div>
                </body>
            </html>
            ';
            
        
            $emailSuccess = Mail::to($getOrder->email)->send(new Websitemail($subject, $message));
            // To create notification
            $user_id = $getOrder->user_id;
            $is_Admin = 0;
            $url = url('admin/details/orders/'.$getOrder->id);
            $message = "New Order Placed #". $getOrder->orderNo;

            notification::insertRecord($user_id, $url, $message,$is_Admin);

            $cart->clear();

            $notification = [
                'message' => 'Payment successfully made',
                'alert-type' => 'success'
            ];

            return redirect()->route('productCarts')->with($notification);

        } else {
            $notification = [
                'message' => 'Payment failed. Please try again',
                'alert-type' => 'error'
            ];
            // Handle payment failure
            return redirect()->route('productCarts')->with($notification);
        }
    }








































    //         $subject = "Payment Confirmation";
    //         // Email content
    //         $message = "<html>";
    //         $message .= "<head>";
    //         $message .= "<style>";
    //         $message .= "body {font-family: Arial, sans-serif;}";
    //         $message .= ".container {max-width: 600px; margin: 0 auto; padding: 20px;}";
    //         $message .= ".btn {background-color: black; color: white; text-decoration: none; padding: 10px 20px; border-radius: 5px;}";
    //         $message .= "</style>";
    //         $message .= "</head>";
    //         $message .= "<body>";
    //         $message .= "<div class='container'>";
    //         $message .= "<h1>Payment Confirmation</h1>";
    //         $message .= "<p>Dear $name </p>";
    //         $message .= "<p>We are pleased to inform you that your payment has been successfully processed.</p>";
    //         $message .= "<p><strong>Transaction Details:</strong></p>";
    //         $message .= "<ul>";
    //         $message .= "<li><strong>Amount Paid:</strong> $ $user_amount</li>";
    //         $message .= "<li><strong>Date of Payment:</strong> $payment_date</li>";
    //         $message .= "</ul>";
    //         $message .= "<p>Please, check your dashboard to get reciept of this transaction.</p>";
    //         $message .= "<p>If you have any questions or concerns regarding your payment, please don't hesitate to contact us.</p>";
    //         $message .= "<p>Thank you for choosing our services.</p>";
    //         $message .= "<h3>Best Regards,</h3>";
    //         $message .= "<h5>Amen Caring Services</h5>";
    //         $message .= "</div>";
    //         $message .= "</body>";
    //         $message .= "</html>";

    //         $emailSuccess = Mail::to($email)->send(new Websitemail($subject, $message));

    //         if ($emailSuccess) {
    //             $mostRecentAppointment = Appointment::where('user_id', $session_id)
    //                 ->orderBy('created_at', 'desc') // Assuming 'created_at' is the timestamp column
    //                 ->first();

    //                 appointment::findOrFail($mostRecentAppointment->id)->update([
    //                     'status' => 'Completed', 
    //                 ]);


    //             return redirect()->route('appointment')->with($notification);
    //         }

    


}
