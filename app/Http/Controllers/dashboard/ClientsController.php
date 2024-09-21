<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    function index(Request $request){
        $q=$request->q?$request->q:"";

        $clients=Client::select('*')->whereAny(['name','phone','email'],'like',"%$q%")->orWhereHas('city',function($query)use($q){
          $query->where('cities.name','like',"%$q%");
        })->orWhereHas('blood_type',function($query)use($q){
          $query->where('blood_types.name','like',"%$q%");
        })->paginate(10);

        return view('dashboard.clients.index',compact('clients'));
   }

   function destroy($id){

    $client=Client::findOrFail($id);

    Client::destroy($id);

    return redirect()->route('clients.index')->with('message','تم حذف عنصر بنجاح');;
 }
}
