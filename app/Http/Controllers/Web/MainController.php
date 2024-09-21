<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\BloodType;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Donate;
use App\Models\HeroPages;
use App\Models\Setting;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class MainController extends Controller
{
    function home(Request $request){
        $heros=HeroPages::all();
        $setting=Setting::first();
        $articles=Article::select('*')->orderByDesc('created_at')->get();
        return view('web.index',compact('setting','heros','articles'));
    }

    function getDonations(Request $request){
        $setting=Setting::first();

        $blood_types=BloodType::all();

        $states=State::all();

        $state=$request->state?State::where('name','=',$request->state)->first():null;

        $blood_type=$request->blood_type?BloodType::where('name','=',$request->blood_type)->first():null;

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

      return view('web.donations',compact('setting','blood_types','states','donations'));
    }

    function getDonation($id){
        $setting=Setting::first();
        $donation=Donate::findOrFail($id);
        return view('web.donation-details',compact('setting','donation'));
    }

    function getArticles(Request $request){
        $setting=Setting::first();

        $categories=Category::all();

        $category=$request->category?Category::where('name',$request->category)->first():null;

        $search=$request->q?$request->q:"";

        if($category){
            $articles=Article::select('*')->whereHas('category',function($query)use($category,$search){
                $query->where('categories.id','=',$category->id)->where('articles.title','like',"%$search%");
            })->orderByDesc('articles.created_at')->paginate(10);
        }else{
           $articles=Article::select('*')->where('title','like',"%$search%")->orderByDesc('created_at')->paginate(10);
        }

        $articles->withQueryString();

        return view('web.articles',compact('setting','categories','articles'));

    }

    function getArticle($title){
        $title=implode(' ',explode('-',$title));
        $article=Article::where('title','=',$title)->firstOrFail();
        $articles=Article::select('*')->whereHas('category',function($query)use($article){
               $query->where('categories.id','=',$article->category->id)->whereNot('articles.id',$article->id);
        })->get();
        $setting=Setting::first();
        return view('web.article-details',compact('setting','article','articles'));
    }

    function about(){
        $setting=Setting::first();
        return view('web.who-are-us',compact('setting'));
    }

    function contact(){
        $setting=Setting::first();
        return view('web.contact-us',compact('setting'));
    }

    function contactRequest(Request $request){
        $request->validate( [
            'phone' => 'required|numeric',
            'email' => 'required|string|email',
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:200',
        ]);

        Contact::create($request->all());

        return back()->with('message',"شكرا لتواصل معنا وسيتم الرد عليك في اسرع وقت");
    }

    function createDonation(){
        $setting=Setting::first();
        $blood_types=BloodType::all();
        $states=State::all();
        return view('web.donation-request',compact('blood_types','states','setting'));
    }

    function requestDonation(Request $request){
        $request->validate([
            'name' => 'required|string|max:100',
            'age' => 'required|integer',
            'city_id' => 'required|required_with:state_id',
            'state_id'=>"required",
            'blood_type_id' => 'required',
            'phone' => 'required|numeric',
            'description' => 'required|string|max:250',
            'hospital_adress' => 'required|string',
            'num_bags' => 'required|integer',
            'longitude' => 'nullable',
            'latitude' => 'nullable',
        ]);

        $request->merge(['client_id'=>auth('clients')->user()->id]);

        $donate = Donate::create($request->all());

        $clientsIds = $donate->city->state->client_states()->whereHas('clientBloodTypes', function ($query) use ($request) {
            $query->where('blood_types.id',$request->blood_type_id);
        })->pluck('clients.id')->toArray();

        if (count($clientsIds) > 0) {
            $notification = $donate->notifications()->create([
                'title' => " حالة تبرع",
                'description' => "يوجد حالة تبرع بالقرب منك",
            ]);

            $notification->client()->attach($clientsIds);
        }

        return redirect()->back()->with('message','تم ارسال حالة التبرع بنجاح');
    }

    function changeSetting(){
        $setting=Setting::first();
         return view('web.setting',compact('setting'));
    }

    function getProfile(){
        $setting=Setting::first();

        $articles=auth('clients')->user()->clientFavourites()->paginate(8);
        return view('web.profile',compact('setting','articles'));
    }
}
