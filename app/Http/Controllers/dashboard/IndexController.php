<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Donate;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
     function home(){
        $sections=[];

        $sections['states']['count']=State::count('id');
        $sections['states']['name']="المحافظات";

        $sections['cities']['count']=City::count('id');
        $sections['cities']['name']="المدن";

        $sections['articles']['count']=Article::count('id');
        $sections['articles']['name']="المقالات";

        $sections['blood_types']['count']=BloodType::count('id');
        $sections['blood_types']['name']="فصائل الدم";

        $sections['categories']['count']=Category::count('id');
        $sections['categories']['name']="الاقسام";

        $sections['donations']['count']=Donate::count('id');
        $sections['donations']['name']="حالات التبرع";

        $sections['clients']['count']=Client::count('id');
        $sections['clients']['name']="العملاء";

        return view('dashboard.index',compact('sections'));
     }

     function showChangePasswordForm(){
           return view('dashboard.auth.password.reset');
     }

     function updatePassword(Request $request){
        $request->validate([
            'email'=>"required|string|email",
            'password'=>"string|min:8|required",
            'confirm_password'=>"required|same:password",
        ]);

        $user=User::where('email','=',$request->email)->first();

        if(!$user){
            return back()->withErrors(['email'=>"not found record"]);
        }

        $user->update([
            'password'=>Hash::make($request->password),
        ]);

        return redirect()->route('login');
     }
}
