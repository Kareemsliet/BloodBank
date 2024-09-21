<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\BloodType;
use App\Models\Client;
use App\Models\Setting;
use App\Models\State;
use App\Notifications\ResetPassowrd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    function __construct(){
        $this->middleware('guest:clients')->except(['logout']);
        $this->middleware('auth:clients')->only('logout');
    }

    function showLoginForm(){
        $setting=Setting::first();
        return view('web.auth.login',compact('setting'));
    }

    function showRegisterForm(){
        $setting=Setting::first();
        $blood_types=BloodType::all();
        $states=State::all();
        return view('web.auth.register',compact('blood_types','states','setting'));
    }

    function forgetPassword(){
        $setting=Setting::first();
        return view('web.auth.password.forget',compact('setting'));
    }

    function showUpdateForm($token){
        return view('web.auth.password.update',compact('token',compact('setting')));
    }

    function register(Request $request){
        $request->validate([
            'state_id'=>"required",
            'city_id'=>"required_with:state_id",
            'name'=>"string|required",
            'email'=>"required|email|string|unique:clients,email",
            'password'=>"required|string|min:8",
            "confirm_password"=>"required|same:password|string|min:8",
            'phone'=>"required|numeric|unique:clients,phone",
            'birth_date'=>"required|date",
            'last_donate_date'=>"required|date",
            "blood_type_id"=>"required",
        ]);

        $request->merge(['password'=>\Illuminate\Support\Facades\Hash::make($request->password)]);

        $client=Client::create($request->except(['confirm_password']));

        Auth::guard('clients')->login($client);

        return redirect()->route('index');
    }

    function login(Request $request){

        $request->validate([
            'email'=>"required|email|string",
            'password'=>"required|min:8|string"
        ]);

        if(auth('clients')->attempt($request->only('email', 'password'),$request->remember?true:false)){
            return redirect()->route('index');
        }else{
            return back()->withErrors(['email'=>"لا توجد بيانات"]);
        }
    }
    public function logout(){
        auth('clients')->logout();

        return redirect()->route('client.login');
    }

    function getPhone(Request $request){
       $request->validate([
            'email'=>"required|email|string",
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    function updatePassword(Request $request){
        $request->validate([
            'email'=>"string|required|email",
            'password'=>'required|string|min:8',
            'confirm_password'=>"required|same:password",
            'token'=>"required",
        ]);

        $status = Password::reset(
            $request->only('password','token','email'),
            function (Client $client, string $password) {
                $client->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $client->save();
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('client.login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
