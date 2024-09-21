<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $states=State::paginate(10);
         return view('dashboard.states.index',compact('states'));
    }
    /**
     * Store a newly created resource in storage.
     */

     function create(){
        return view('dashboard.states.add');
     }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|unique:states,name|max:100',
            'code'=>'required|string|unique:states,code'
        ]);

        $state=State::create($request->all());

        

        return redirect()->route('states.create')->with('message','تم اضافة عنصر جديد بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
        $state=State::findOrFail($id);
        return view('dashboard.states.edit',compact('state'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>"required|string|unique:states,name,$id|max:100",
            'code'=>"required|string|unique:states,code,$id"
        ]);

        $state=State::find($id);

        $state->update($request->all());

        return redirect()->route('states.edit',$state->id)->with('message','تم تعديل عنصر بنجاح');    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $state=State::findOrFail($id);
        $state->delete();
        return redirect()->route('states.index')->with('message','تم حذف عنصر بنجاح');
    }
}
