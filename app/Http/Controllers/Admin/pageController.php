<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\page;
use App\Models\settings;
use App\Models\paymentSettings;
use App\Models\slider;
use App\Models\supportBrands;
use App\Models\notification;
use Intervention\Image\Facades\Image;

class pageController extends Controller
{
    //
    public function pageList(){
        $pageList = page::getRecord();
        return view('admin.pages.pageList', compact('pageList'));
    }


    public function pageEdit($id){
        $pageEdit = page::getSingle($id);
        return view('admin.edits.editPage', compact('pageEdit'));
    }


    public function pageUpdate(Request $request){


        // dd($request->all());
        $request->validate([
            'name' =>'required',
            'title' =>'required',
        ]);

        $page = page::find($request->id);
        $page->name = trim($request->name);
        $page->title = trim($request->title);
        $page->description = trim($request->description);
        // $page->name = trim($request->name);

        if (!empty($request->file('image_name'))) {

            if(!empty($page->image_name)){
                unlink($page->image_name);
                $page->image_name = "";
            }


            if ($request->file('image_name')->isValid()) {
                $image = $request->file('image_name');
                $extension = $image->getClientOriginalExtension();
                $uniqueName = hexdec(uniqid()).'.'.$extension;

                // Save normal image
                $normalPath = 'upload/pages/'.$uniqueName;
                Image::make($image)->resize(1970, 300)->save($normalPath);
                $page->image_name = $normalPath;
            }
        }

        $page->save();

        $notification = [
           'message' => 'Page successfully updated',
            'alert-type' =>'success'
        ];

        return redirect()->route('page_list')->with($notification);
    }







    public function systemSettings(){
        $settinga = settings::getSingle();
        return view('admin.pages.pageSetting', compact('settinga'));
    }


    public function updateSettings(Request $request){
        $save = settings::getSingle();
        $save->name = trim($request->name);
        $save->footer_description = trim($request->footer_description);
        $save->address = trim($request->address);
        $save->phone1 = trim($request->phone1);
        $save->phone2 = trim($request->phone2);
        $save->contact_email = trim($request->contact_email);
        $save->email1 = trim($request->email1);
        $save->email2 = trim($request->email2);
        $save->working_hours = trim($request->working_hours);
        $save->facebook = trim($request->facebook);
        $save->twitter = trim($request->twitter);
        $save->instagram = trim($request->instagram);

        if (!empty($request->file('logo'))) {

            if(!empty($save->logo)){
                unlink($save->logo);
                $save->logo = "";
            }


            if ($request->file('logo')->isValid()) {
                $logo = $request->file('logo');
                $extension = $logo->getClientOriginalExtension();
                $uniqueName = hexdec(uniqid()).'.'.$extension;

                // Save normal image
                $normalPath = 'upload/settings/'.$uniqueName;
                Image::make($logo)->save($normalPath);
                $save->logo = $normalPath;
            }
        }


        if (!empty($request->file('favicon'))) {

            if(!empty($save->favicon)){
                unlink($save->favicon);
                $save->favicon = "";
            }


            if ($request->file('favicon')->isValid()) {
                $favicon = $request->file('favicon');
                $extension = $favicon->getClientOriginalExtension();
                $uniqueName = hexdec(uniqid()).'.'.$extension;

                // Save normal image
                $normalPath = 'upload/settings/'.$uniqueName;
                Image::make($favicon)->save($normalPath);
                $save->favicon = $normalPath;
            }
        }

            $save->save();


            $notification = [
                'message' => 'Settings successfully updated',
                 'alert-type' =>'success'
             ];
     
             return redirect()->back()->with($notification);
    }








    public function sliderSettings(){
        $pageList = slider::getRecord();
        return view('admin.pages.slider', compact('pageList'));
    }


    public function sliderEdit($id){
        $pageEdit = slider::getSingle($id);
        return view('admin.edits.eidtSlider', compact('pageEdit'));
    }


    public function sliderUpdate(Request $request){

        $request->validate([
            'text1' => 'required',
            'text2' => 'required',
            'redirect_url' => 'required',
        ]);

        $page = slider::getSingle($request->id);
        $page->text1 = trim($request->text1);
        $page->text2 = trim($request->text2);
        $page->redirect_url = trim($request->redirect_url);
        // $page->name = trim($request->name);

        if (!empty($request->file('image'))) {

            if(!empty($page->image)){
                unlink($page->image);
                $page->image = "";
            }


            if ($request->file('image')->isValid()) {
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $uniqueName = hexdec(uniqid()).'.'.$extension;

                // Save normal image
                $normalPath = 'upload/banner/'.$uniqueName;
                Image::make($image)->resize(1903, 499)->save($normalPath);
                $page->image = $normalPath;
            }
        }

        $page->save();

        $notification = [
           'message' => 'Banner successfully updated',
            'alert-type' =>'success'
        ];

        return redirect()->route('sliderSettings')->with($notification);
    }








    public function supportedBrands(){
        $pageList = supportBrands::getRecord();
        return view('admin.pages.supportedBrands', compact('pageList'));
    }



    public function supportBRandsEdit($id){
        $pageEdit = supportBrands::getSingle($id);
        return view('admin.edits.editsupportBrands', compact('pageEdit'));
    }


    public function supportBrandUpdate(Request $request){

        $page = supportBrands::getSingle($request->id);
  
        if (!empty($request->file('image'))) {

            // if(!empty($page->image)){
            //     unlink($page->image);
            //     $page->image = "";
            // }


            if ($request->file('image')->isValid()) {
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $uniqueName = hexdec(uniqid()).'.'.$extension;

                // Save normal image
                $normalPath = 'upload/brands/'.$uniqueName;
                Image::make($image)->resize(150, 65)->save($normalPath);
                $page->image = $normalPath;
            }


            
            $page->save();

            $notification = [
            'message' => 'Banner successfully updated',
                'alert-type' =>'success'
            ];

            return redirect()->route('supportedBrands')->with($notification);
        }else{
            $notification = [
                'message' => 'Please add an image',
                 'alert-type' =>'error'
             ];
     
             return redirect()->abck()->with($notification);
        }

    }
    // 


    public function notification(){
        $pageList = notification::getRecord();
        return view('admin.pages.notification', compact('pageList'));
    }




    public function paymentSettings(){
        $settinga = paymentSettings::getSingle(); 
        return view('admin.pages.paymentSettings', compact('settinga'));
    }
    



    public function updatePaymentSettings(Request $request){
        $save = paymentSettings::getSingle();

        $save->paypal_id = trim($request->paypal_id);
        $save->paypal_sk = trim($request->paypal_sk);
        $save->paypal_status = trim($request->paypal_status);

        $save->stripe_pk = trim($request->stripe_pk);
        $save->stripe_sk = trim($request->stripe_sk);

        $save->paystack_pk = trim($request->paystack_pk);
        $save->paystack_sk = trim($request->paystack_sk);
        $save->merchant_email = trim($request->merchant_email);


        $save->is_cash = !empty($request->is_cash) ? 1 : 0;
        $save->is_paypal = !empty($request->is_paypal) ? 1 : 0;
        $save->is_stripe = !empty($request->is_stripe) ? 1 : 0;
        $save->is_paystack = !empty($request->is_paystack) ? 1 : 0;


        $save->save();


        $notification = [
            'message' => 'Payment Settings successfully updated',
                'alert-type' =>'success'
            ];
    
            return redirect()->back()->with($notification);
    }
    // 


}
