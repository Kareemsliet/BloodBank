<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use Illuminate\Http\Request;

class BloodTypesController extends Controller
{
  /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $blood_types=BloodType::paginate(10);
         return view('dashboard.blood_types.index',compact('blood_types'));
    }

    function create(){
        return view('dashboard.blood_types.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|unique:blood_types,name|max:100',
        ]);

        $blood_type=BloodType::create($request->all());

        

        return redirect()->route('blood-types.create')->with('message','تم اضافة عنصر جديد بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
        $blood_type=BloodType::find($id);

        return view('dashboard.blood_types.edit',compact('blood_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>"required|string|unique:blood_types,name,$id|max:100",
        ]);

        $blood_type=BloodType::find($id);

        $blood_type->update($request->all());



        return redirect()->route('blood-types.edit',$blood_type->id)->with('message','تم تعديل عنصر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        BloodType::destroy($id);

        return redirect()->route('blood-types.index')->with('message','تم حذف عنصر بنجاح');
    }
}
