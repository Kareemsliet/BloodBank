<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    function states(Request $request){
    $client=auth('sanctum')->user();
    $client = $request->user();
    return $client;
       if($client){
           return responseJson("1","success",$client->clientStates);
       }else{
        responseJson("0","لا يوجد بيانات لهذا المستخدم");
       }
    }

    function bloodTypes(Request $request){
         $client=auth('sanctum')->user();
         $client = $request->user();
        if($client){
            return responseJson("1","success",$client->clientBloodTypes);
        }else{
         responseJson("0","لا يوجد بيانات لهذا المستخدم");
        }
    }

    function favourites(Request $request){
         $client=auth('sanctum')->user();
         $client = $request->user();
        if($client){
            return responseJson("1","success",$client->clientFavourites);
        }else{
         responseJson("0","لا يوجد بيانات لهذا المستخدم");
        }
    }

    function notifications(Request $request){
         $client=auth('sanctum')->user();
         $client = $request->user();
        if($client){
            return responseJson("1","success",[
                'unread'=>$client->clientNotifications()->select('*')->where('read_at',null)->get(),
                'read'=>$client->clientNotifications()->select('*')->whereNot('read_at')->get()
            ]);
        }else{
         responseJson("0","لا يوجد بيانات لهذا المستخدم");
        }
    }

    function toggleFavourite(Request $request,$article_id){
         $client=auth('sanctum')->user();
         $client = $request->user();
        if($client){
            $client->clientFavourites()->toggle([$article_id=>['created_at'=>now(),'updated_at'=>now()]]);
            $client_favourite=$client->clientFavourites()->where('article_id',$article_id)->get();
            return responseJson(1,isset($client_favourite[0])?"like":"dislike");
        }else{
         responseJson("0","لا يوجد بيانات لهذا المستخدم");
        }
    }

    function addData(Request $request){
        $validation=validator()->make($request->all(),[
            'states'=>"required|array|min:1",
            'blood_types'=>"required|array|min:1",
        ]);

        if($validation->fails()){
            return responseJson(1,"failed",$validation->errors());
        }

        $client=auth('sanctum')->user();

        $client=$request->user();

        if($client){
            $client->clientStates()->sync($request->states);

            $client->clientBloodTypes()->sync($request->blood_types);

            return responseJson(1,"success",[
                'blood_types'=>$client->clientBloodTypes,
                'states'=>$client->clientStates,
            ]);
        }else{
         responseJson("0","لا يوجد بيانات لهذا المستخدم");
        }

    }

    function readNotification($notify_id,Request $request){
        $client=auth('sanctum')->user();
        $client=$request->user();
        if($client){
            $client->clientNotifications()->updateExistingPivot($notify_id,['read_at'=>now()]);
            return responseJson("1","success",[
                'unread'=>$client->clientNotifications()->select('*')->where('read_at',null)->get(),
                'read'=>$client->clientNotifications()->select('*')->whereNot('read_at')->get()
            ]);
        }else{
           responseJson("0","لا يوجد بيانات لهذا المستخدم");
        }
    }
}
