<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\HeroPages;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $setting=null;
         if(isset(Setting::all()[0])){
            $setting=Setting::all()[0];
         }
         return  view('dashboard.setting',compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required|string|max:100",
            'phone'=>"required|string|numeric",
            'logo'=>"required|image|mimes:png,svg,jpg|max:5500",
            'email'=>"required|email|string",
            'description'=>"required|string|max:300",
            'adress'=>"required|string|max:50",
            'facebook_link'=>"nullable|url|string",
            'twitter_link'=>"nullable|url|string",
            'youtube_link'=>"nullable|url|string"
        ]);

        $logo=uniqid().".".$request->file('logo')->getClientOriginalExtension();

        $request->file('logo')->storeAs('setting',$logo);

        $setting=$request->except('logo');

        $setting['logo']=$logo;

        $setting=Setting::create($setting);

        return redirect()->route('setting.index')->with('message','تم اضافة عنصر بنجاح');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>"required|string|max:100",
            'phone'=>"required|string|numeric",
            'logo'=>$request->image?"image|mimes:png,svg,jpg|max:5500":"",
            'email'=>"required|email",
            'description'=>"required|string|max:300",
            'adress'=>"required|string",
            'facebook_link'=>"nullable|url|string",
            'twitter_link'=>"nullable|url|string",
            'youtube_link'=>"nullable|url|string"
        ]);

        $setting=Setting::find($id);

        $setting_request=$request->except('logo');

        if($request->logo){
            Storage::delete('setting/'.$setting->logo);

            $logo=uniqid().".".$request->file('logo')->getClientOriginalExtension();

            $request->file('logo')->storeAs('setting',$logo);

            $setting_request['logo']=$logo;
        }

        $setting->update($setting_request);

        return redirect()->route('setting.index')->with('message','تم تعديل عنصر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $setting=Setting::find($id);
        Storage::delete('setting/'.$setting->logo);
        $setting->delete();
        return redirect()->route('setting.index')->with('message','تم حذف عنصر بنجاح');
    }
}
