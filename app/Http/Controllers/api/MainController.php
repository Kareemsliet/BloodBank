<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\Article;
use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Donate;
use App\Models\HeroPages;
use App\Models\Notification;
use App\Models\Setting;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    function getArticles(Request $request)
    {
        $category=$request->category?Category::where('name',$request->category)->firstOrFail():null;

        $search=$request->q?$request->q:"";

        if($category){
            $articles=Article::select('*')->whereHas('category',function($query)use($category,$search){
                $query->where('categories.id','=',$category->id)->where('articles.title','like',"%$search%");
            })->orderByDesc('articles.created_at')->paginate(10);
        }else{
           $articles=Article::select('*')->where('title','like',"%$search%")->orderByDesc('created_at')->paginate(10);
        }

        $articles->withQueryString();

        return responseJson(1, "success", $articles);
    }
    function getDonations(Request $request)
    {
        $state=$request->state?State::where('name','=',$request->state)->firstOrFail():null;

        $blood_type=$request->blood_type?BloodType::where('name','=',$request->blood_type)->firstOrFail():null;

        if($state && $blood_type){
            $donations=Donate::select('*')->whereHas('city',function($query)use($state){
                $query->where('cities.state_id','=',$state->id);
            })->whereHas('bloodTypes',function($query)use($blood_type){
                $query->where('blood_types.id','=',$blood_type->id);
            })->paginate(10);
        }else if ($state) {
            $donations=Donate::select('*')->whereHas('city',function($query)use($state){
                $query->where('cities.state_id','=',$state->id);
            })->paginate(10);
        }else if($blood_type){
            $donations=Donate::select('*')->whereHas('bloodTypes',function($query)use($blood_type){
             $query->where('blood_types.id','=',$blood_type->id);
            })->paginate(10);
        }else{
            $donations=Donate::select('*')->paginate(10);
        }

        $donations->withQueryString();

        return responseJson(1, "success", $donations);
    }

    function getSetting()
    {
        return responseJson(1, "success", Setting::first());
    }

    function getHeroPages()
    {
        return responseJson(1, "success", HeroPages::all());
    }
    function getCategories()
    {
        return responseJson(1, "success", Category::all());
    }

    function getStates(Request $request)
    {
        return responseJson(1, "success", State::all());
    }

    function getCities()
    {
        return responseJson(1, "success", City::all());
    }

    function getBloodTypes()
    {
        return responseJson(1, "success", BloodType::all());
    }

    function addContact(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'phone' => 'required|numeric',
            'email' => 'required|string|email',
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:200',
        ]);

        if ($validation->fails()) {
            return responseJson(0, "failed", $validation->errors());
        }

        $contact = Contact::create($request->all());

        $contact->save();

        return responseJson(1, "success", $contact);
    }
    function addDonate(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name' => 'required|string|max:100',
            'age' => 'required|integer',
            'city_id' => 'required',
            'client_id' => "required",
            'blood_type_id' => 'required',
            'phone' => 'required|numeric',
            'description' => 'required|string|max:250',
            'hospital_adress' => 'required|string',
            'num_bags' => 'required|integer',
            'longitude' => 'nullable',
            'latitude' => 'nullable',
        ]);

        if ($validation->fails()) {
            return responseJson(0, "failed", $validation->errors());
        }

        $donate = Donate::create($request->all());

        $donate->save();

        $clientsIds = $donate->city->state->client_states()->whereHas('clientBloodTypes', function ($query) use ($request) {
            $query->where('blood_types.id', $request->blood_type_id);
        })->pluck('clients.id')->toArray();


        if (count($clientsIds) > 0) {
            $notification = $donate->notifications()->create([
                'title' => "حالة تبرع",
                'description' => "يوجد حالة تبرع بالقرب منك",
            ]);

            $notification->client()->attach($clientsIds);
        }

        return responseJson(1, "success", $donate);
    }

    function getDonation($id){
        $donation=Donate::findOrFail($id);
        return responseJson(1, "success", $donation);
    }

    function getArticle($id){
        $article=Article::findOrFail($id);
        return responseJson(1, "success", $article);
    }

    function citiesByState($id){
        $cities=City::select('*')->where('state_id','=',$id)->get();
        return responseJson(1, "success", $cities);
    }

}
