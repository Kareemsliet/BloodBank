<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $cities=City::paginate(10);
         return view('dashboard.cities.index',compact('cities'));
    }

    function getCities($state_id){
        $cities=City::select('*')->where('state_id','=',$state_id)->get();
        $data="<option>اختار مدينة</option>";
        foreach ($cities as $key => $value) {
            $data.="<option value='$value->id'>$value->name</option>";
        }
        return responseJson(1,"success",$data);
    }

    public function create(){
        $states=State::all();
        return view('dashboard.cities.add',compact('states'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|unique:cities,name|max:100',
            'state_id'=>'required'
        ]);

        $city=City::create($request->all());



        return redirect()->route('cities.create')->with('message','تم اضافة عنصر جديد بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
        $city=City::find($id);
        $states=State::all();
        return view('dashboard.cities.edit',compact('city','states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>"required|string|unique:cities,name,$id|max:100",
            'state_id'=>"required"
        ]);

        $city=City::find($id);

        $city->update($request->all());



        return redirect()->route('cities.edit',$city->id)->with('message','تم تعديل عنصر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        City::destroy($id);
        return redirect()->route('cities.index')->with('message','تم حذف عنصر بنجاح');
    }
}
