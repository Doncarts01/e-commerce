<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\notification;
use App\Models\orders;
use App\Models\product_review;
use App\Models\product_wishlist;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class userController extends Controller
{

    public function Usernotification(){
        $pageList = notification::getUserRecord(Auth::user()->id);
        return view('users.pages.notification', compact('pageList'));

    }

   public function userDashboard() {

        $data['totalOrders'] = orders::getTotalOrderUser(Auth::user()->id);
        $data['todayOrders'] = orders::todayOrdersUser(Auth::user()->id);
        $data['totalAmount'] = orders::totalAmountUser(Auth::user()->id);
        $data['todayTotalAmount'] = orders::todayTotalAmountUser(Auth::user()->id);

        $data['totalPending'] = orders::totalStatusUser(Auth::user()->id, 0);
        $data['totalInprogress'] = orders::totalStatusUser(Auth::user()->id, 1);
        $data['totalCompleted'] = orders::totalStatusUser(Auth::user()->id, 3);
        $data['totalCancelled'] = orders::totalStatusUser(Auth::user()->id, 4);



        return view('users.index', $data);
    }

    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Successfully Logged out', 
            'alert-type' => 'success'
        );

        return redirect('/')->with($notification);
    }

    // view profile page 
    public function userProfile() {
            $id = Auth::user()->id;
            $userData = User::find($id);
    
            return view('users.profile-view', compact('userData'));
        }


    public function userEditProfile() {
        $id = Auth::user()->id;
        $editData = User::find($id);

        return view('users.edits.profile_edit', compact('editData'));
    }

    public function userStoreProfile(Request $request){
        // dd($request->all());
        $id = Auth::user()->id;
        $data = User::find($id);
        // To get the user details
        $data->name = $request->name;
        $data->email = $request->email;

        $data->firstname = $request->firstname;
        $data->lastname = $request->lastname;
        $data->country = $request->country;
        $data->address1 = $request->address1;
        $data->address2 = $request->address2;
        $data->city = $request->city;
        $data->state = $request->state;
        $data->postcode = $request->postcode;
        $data->phone = $request->phone;

        // profile_image is the name given to the input file field 
        if ($request->file('profile_image')) {
           $file = $request->file('profile_image');

        // adding date to the filenae 
           $filename = date('YmdHi').$file->getClientOriginalName();
        //    moving the file to another folder to save the image 
           $file->move(public_path('upload/user_images'),$filename);
           $data['profile_image'] = $filename;
        }
        // saving the data 
        $data->save();
        
        $notification = array(
            'message' => 'Header content updated', 
            'alert-type' => 'success'
        );
        return redirect()->route('user_Profile')->with($notification);

    }// End Method

    // All Users

    // public function viewAllUsers(){
    //     $viewAllUsers = user::all();
    //     return view("admin.pages.viewAllUsers", compact('viewAllUsers'));
    // }



      /**
     * Delete the user's account.
     */
    public function delete(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }




    public function user_order_list(Request $request){
        if(!empty($request->notification_id)){
            $notification = notification::getSingle($request->notification_id);
            if(!empty($notification)){
                $notification->is_read = 1;
                $notification->save();
            }
        }
            $orders = orders::getRecordUser(Auth::user()->id);
            return view('users.pages.orderList', compact('orders'));
    }


    // 
    public function user_order_details($id){
        $orders = orders::getSingle($id);
        return view('users.pages.orderDetails', compact('orders'));
    }


    public function declineWishList(){
        $notification = array(
            'message' => 'Please Log in first', 
            'alert-type' => 'error'
        );
        return redirect()->route('login')->with($notification);
    }


    public function add_to_wishlist(Request $request){
        $check = product_wishlist::checkAlready($request->product_id, Auth::user()->id );

        if(empty($check)){
            $save = new product_wishlist();
            $save->user_id = Auth::user()->id;
            $save->product_id = trim( $request->product_id);
            $save->save();

            $json['isWishlist'] = 1;
        }else{
            $check = product_wishlist::deleteRecord($request->product_id, Auth::user()->id );
            $json['isWishlist'] = 0;
        }

        $json['status'] = true;
        $json['product_id'] = $request->product_id; 
        echo json_encode($json);

    }



    public function deleteWishlist($id){
        $deleteMyWishList = product_wishlist::deleteRecord($id, Auth::user()->id );
        $notification = array(
            'message' => 'Product Succesfully removed', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }



    public function submitReview(Request $request){

        $save = new product_review();
        $save->product_id = trim( $request->product_id);
        $save->order_id = trim($request->order_id);
        $save->user_id = Auth::user()->id;
        $save->rating = trim($request->rating);
        $save->review = trim($request->review);
        $save->save();

        $notification = array(
            'message' => 'Thank you for your feedback', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


}
