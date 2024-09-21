<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Donate;
use Illuminate\Http\Request;

class DonationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $q=$request->q?$request->q:'';

         $donations=Donate::select('*')->
         whereAny(['hospital_adress','name'],'like',"%$q%")->
         orWhereHas('city',function($query)use($q){
            $query->where('cities.name','like',"%$q%");
         })->orWhereHas('bloodTypes',function($query)use($q){
            $query->where('blood_types.name','like',"%$q%");
         })->paginate(10);

         return view('dashboard.donations.indx',compact('donations'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation=validator()->make($request->all(),[
            'name'=>'required|string|max:100',
            'age'=>'required|integer',
            'city_id'=>'required',
            'client_id'=>"required",
            'blood_type_id'=>'required',
            'phone'=>'required|numeric',
            'description'=>'required|string|max:250',
            'hospital_adress'=>'required|string',
            'num_bags'=>'required|integer',
            'longitude'=>'nullable',
            'latitude'=>'nullable',
        ]);

        if($validation->fails()){
           return responseJson(0,"failed",$validation->errors());
        }

        $donate=Donate::create($request->all());

        $donate->save();

        return responseJson(1,"success",$donate);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $donate=Donate::find($id);

        if(!$donate){
            return responseJson(1,"failed");
        }

        return responseJson(1,"success",$donate);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation=validator()->make($request->all(),[
            'name'=>'required|string|max:100',
            'age'=>'required|integer',
            'city_id'=>'required',
            'blood_type_id'=>'required',
            'phone'=>'required|numeric',
            'description'=>'required|string|max:250',
            'hospital_adress'=>'required|string',
            'num_bags'=>'required|integer',
            'longitude'=>'nullable',
            'latitude'=>'nullable',
        ]);

        if($validation->fails()){
           return responseJson(0,"failed",$validation->errors());
        }

        $donate=Donate::find($id);

        $donate->update($request->all());

        $donate->save();

        return responseJson(1,"success",$donate);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Donate::destroy($id);
        return redirect()->route('donations.index')->with('message','تم حذف عنصر بنجاح');
    }
}
