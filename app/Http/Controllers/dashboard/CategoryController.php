<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $categories=Category::paginate(10);
         return view('dashboard.categories.index',compact('categories'));
    }

    function create(){
        return view('dashboard.categories.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|unique:categories,name|max:100',
        ]);

        $category=Category::create($request->all());



        return redirect()->route('categories.create')->with('message','تم اضافة عنصر جديد بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
        $category=Category::find($id);

        return view('dashboard.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>"required|string|unique:categories,name,$id|max:100",
        ]);

        $category=Category::find($id);

        $category->update($request->all());

        

        return redirect()->route('categories.edit',$category->id)->with('message','تم تعديل عنصر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);

        return redirect()->route('categories.index')->with('message','تم حذف عنصر بنجاح');
    }
}
