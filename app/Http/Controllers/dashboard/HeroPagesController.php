<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\HeroPages;
use Illuminate\Http\Request;

class HeroPagesController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $heros=HeroPages::paginate(10);
         return view('dashboard.heros.index',compact('heros'));
    }

    function create(){
        return view('dashboard.heros.add');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
           'title'=>"required|string|unique:hero_pages,title|max:100",
            'des'=>"required|string|max:150",
            'image'=>"required|image|mimes:png,svg,jpg|max:5500"
        ]);

        $image=uniqid().".".$request->file('image')->getClientOriginalExtension();

        $request->file('image')->move(public_path('uploads/heros'),$image);

        $hero=$request->except('image');

        $hero['image']=$image;

        $hero=HeroPages::create($hero);



        return redirect()->route('heros.create')->with('message','تم اضافة عنصر جديد بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
        $hero=HeroPages::find($id);

        return view('dashboard.heros.edit',compact('hero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>"required|string|unique:hero_pages,title,$id|max:100",
            'des'=>"required|string|max:150",
            'image'=>$request->image?"image|mimes:png,svg,jpg|max:5500":"",
        ]);

        $hero=HeroPages::find($id);

        $hero_request=$request->except('image');

        if($request->image){
            unlink(public_path('uploads/heros/'.$hero->image));
            $image=uniqid().".".$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/heros'),$image);
            $hero_request['image']=$image;
        }

        $hero->update($hero_request);

        

        return redirect()->route('heros.edit',$hero->id)->with('message','تم تعديل عنصر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hero=HeroPages::find($id);
        unlink(public_path('/uploads/heros/'.$hero->image));
        $hero->delete();
        return redirect()->route('heros.index')->with('message','تم حذف عنصر بنجاح');
    }
}
