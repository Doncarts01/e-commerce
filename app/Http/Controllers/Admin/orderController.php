<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\notification;
use App\Models\orders;
use App\Models\settings;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;


class orderController extends Controller
{
    //
    public function vieworders(){
        $orders = orders::getRecord();
        return view('admin.pages.ordersList', compact('orders'));
    }

    public function detailsorders($id, Request $request){

        if(!empty($request->notification_id)){
            $notification = notification::getSingle($request->notification_id);
            if(!empty($notification)){
                $notification->is_read = 1;
                $notification->save();
            }
        }

        $orders = orders::getSingle($id);
        return view('admin.pages.orderDetails', compact('orders'));
    }
    

    public function orderStatus(Request $request){
        $getOrder = orders::getSingle($request->order_id);
        $getOrder->status = $request->status;
        $getOrder->save();
        $getSystemSettingsApp = settings::getSingle();
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
                            <p><b>Order Status:</b> ';
                            if($getOrder->status == 0){
                                $message .= 'Pending';
                            } elseif($getOrder->status == 1){
                                $message .= 'In Progress';
                            } elseif($getOrder->status == 2){
                                $message .= 'Delivered';
                            } elseif($getOrder->status == 3){
                                $message .= 'Completed';
                            } else {
                                $message .= 'Cancelled';
                            }
                            $message .= '</p>
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
        $is_Admin = 1;
        $url = url('user/orders');
        $message = "Your Order Status has been Updated #". $getOrder->orderNo;

        notification::insertRecord($user_id, $url, $message,$is_Admin);

        if (Mail::failures()) {
            return response()->json([
                'message' => 'Something went wrong, try again.',
                'success' => false,
            ]); 
        } else {
            return response()->json([
                'message' => 'Status successfully updated.',
                'success' => true,
            ]);
        }

    }




}
