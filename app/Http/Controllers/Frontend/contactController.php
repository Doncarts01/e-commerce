<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\contact;
use App\Models\subscribers;
use Illuminate\Http\Request;
use illuminate\Support\Carbon;

class contactController extends Controller
{
    //
    public function subscribers(Request $request){
        $data['subscribers'] = subscribers::latest()->get();

        return view('admin.pages.subscribers', $data);
    }
    //
    public function contacts(Request $request){
        $data['contact'] = contact::latest()->get();

        return view('admin.pages.contact', $data);
    }


    public function storeMessage(Request $request){
        contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]); 

            $notification = array(
            'message' => 'Message Successfully Sent', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function deleteMessage($id){
        contact::findOrFail($id)->delete();
        
        $notification = array(
            'message' => 'Message Successfully Deleted', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
