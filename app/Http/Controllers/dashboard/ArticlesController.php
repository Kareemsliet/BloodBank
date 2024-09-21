<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user=$request->user();

        $q=$request->q?$request->q:"";

         $articles=Article::where('title','like',"%$q%")->paginate(10);

         return view('dashboard.articles.index',compact('articles'));
    }

    function create(){
        $categories=Category::all();
        return view('dashboard.articles.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
           'title'=>"required|string|unique:articles,title|max:100",
            'description'=>"required|string|max:150",
            'cat_id'=>"required",
            'image'=>"required|image|mimes:png,svg,jpg,jpeg|max:5500"
        ]);

        $image=uniqid().".".$request->file('image')->getClientOriginalExtension();

        $request->file('image')->move(public_path('uploads/articles'),$image);

        $article=$request->except('image');

        $article['image']=$image;

        $article=Article::create($article);

        return redirect()->route('articles.create')->with('message','تم اضافة عنصر جديد بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
        $article=Article::find($id);
        $categories=Category::all();
        return view('dashboard.articles.edit',compact('article','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>"required|string|unique:articles,title,$id|max:100",
            'description'=>"required|string|max:150",
            'cat_id'=>"required",
            'image'=>$request->image?"image|mimes:png,svg,jpg,jpeg|max:5500":""
        ]);

        $article=Article::find($id);

        $article_request=$request->except('image');

        if($request->image){
            unlink(public_path('uploads/articles/'.$article->image));
            $image=uniqid().".".$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/articles'),$image);
            $article_request['image']=$image;
        }

        $article->update($article_request);

        return redirect()->route('articles.edit',$article->id)->with('message','تم تعديل عنصر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article=Article::find($id);
        unlink(public_path("uploads/articles/".$article->image));
        $article->delete();
        return redirect()->route('articles.index')->with('message','تم حذف عنصر بنجاح');
    }
}
