<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    function index(){
        $notifications=Notification::select('*')->paginate(10);
        return view('dashboard.notifications.indx',compact('notifications'));
    }

    function destroy($id){
        $notification=Notification::find($id);
        if($notification->client->count('id')>0){
            abort(404);
        };
        
        return redirect()->route('notifications.index')->with('message','تم حذف عنصر بنجاح');

    }
}
