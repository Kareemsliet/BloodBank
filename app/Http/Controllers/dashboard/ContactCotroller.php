<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactCotroller extends Controller
{
    function index(Request $request){
        $q=$request->q?$request->q:"";

        $contacts=Contact::select('*')->whereAny(['title','email','phone'],'like',"%$q%")->paginate(10);

        return view('dashboard.contacts.index',compact('contacts'));
     }

     function destroy($id){
        
        Contact::destroy($id);

        return redirect()->route('contacts.index')->with('message','تم حذف عنصر بنجاح');;
     }

}
