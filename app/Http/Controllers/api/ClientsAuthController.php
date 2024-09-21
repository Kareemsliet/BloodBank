<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\Client;
use App\Notifications\ResetPassowrd;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

class ClientsAuthController extends Controller
{
    public function regstire(Request $request){

        $validation=validator()->make($request->all(),[
            'name'=>"string|required",
            'email'=>"required|email|string|unique:clients,email",
            'password'=>"required|string|min:8",
            "confirmed_password"=>"required|same:password|string|min:8",
            'phone'=>"required|numeric|unique:clients,phone",
            'birth_date'=>"required|date",
            'last_donate_date'=>"required|date",
            "blood_type_id"=>"required",
            'city_id'=>"required"
        ]);

        if($validation->fails()){
            return responseJson(1,"failed",$validation->errors());
        }

        $request->merge(['password'=>\Illuminate\Support\Facades\Hash::make($request->password)]);

        $client=Client::create($request->except(['confirmed_password']));

        $client->save();

        return responseJson(1,"نم الاضافة  بالنجاح",[
            "client"=>$client
        ]);
    }

    function login(Request $request){
        $validation=validator()->make($request->all(),[
            'phone'=>"required|numeric",
            'password'=>"required|min:8|string"
        ]);

        if($validation->fails()){
            return responseJson(1,"failed",$validation->errors());
        }

        $client=Client::select('*')->where('phone','=',$request->phone)->get();

        if(isset($client[0])){
            if(\Illuminate\Support\Facades\Hash::check($request->password,$client[0]->password)){
                $token=$client[0]->createToken('token',['*'],now()->addWeek())->plainTextToken;
                return responseJson(0,"تسجيل الدخول بنجاح",[
                    'token'=>$token,
                    'client'=>$client[0],
                ]);
            }else{
                return responseJson(0,"خطا في تسجيل البيانات");
            }
        }else{
            return responseJson(0,"خطا في تسجيل البيانات");
        }
    }
    function logout(Request $request){
        $client=$request->user();
        if($client){
            $client->currentToken()->delete();
            
            return responseJson(1,"تسجيل الخروج بانجاح");
        }else{
            return responseJson(0,"فشل في تسجيل اخروج");
        }
    }

    function getPhone(Request $request){
        $validation=validator()->make($request->all(),[
            'phone'=>"required|numeric"
        ]);

        if($validation->fails()){
            return responseJson(0,"failed",$validation->errors());
        }

        $client=Client::select('*')->where('phone','=',$request->phone)->first();

        if($client){
             $pin_code=rand(111,999);
             $client->pin_code=$pin_code;
             $client->save();

             $client->notify(new ResetPassowrd($pin_code));

             Mail::to($client->email)
             ->send(new ResetPassword($pin_code));

             return responseJson(1,"يوجد بيانات و تم ارسال كود تحقق");
        }else{
            return responseJson(0,"لا توجد بيانات");
        }
    }

    function updatePassword(Request $request){
        $validation=validator()->make($request->all(),[
            'password'=>'required|string|min:8',
            'confirm_password'=>"required|same:password",
            'code'=>"required|max:6|string",
        ]);

        if($validation->fails()){
            return responseJson(0,"failed",$validation->errors());
        }

        $client=Client::where('pin_code','=',$request->code)->first();

        $request->merge(['password'=>\Illuminate\Support\Facades\Hash::make($request->password)]);

        if($client){
              $client->password=$request->password;
              $client->save();
              return responseJson(1,"تم تحديث كلمة السر بنجاح");
        }else{
            return responseJson(1,"هذا الكود غير صحيح");
        }
    }
}
