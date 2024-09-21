<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


         $roles=Role::paginate(10);
         return view('dashboard.roles.index',compact('roles'));
    }

    function create(Request $request){
        $permissions=Permission::all();
        return view('dashboard.roles.add',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'permissions'=>"required|array|min:1",
            'name'=>'required|string|unique:roles,name|max:100',
        ]);

        $role=Role::create($request->except('permissions'));

        $permissions=Permission::findMany($request->permissions);


        $role->syncPermissions($permissions);

        return redirect()->route('roles.create')->with('message','تم اضافة عنصر جديد بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id,Request $request)
    {
        $role=Role::find($id);

        $permissions=Permission::all();

        return view('dashboard.roles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'permissions'=>"required|array|min:1",
            'name'=>"required|string|unique:roles,name,$id|max:100",
        ]);

        $role=Role::find($id);

        $role->update($request->except('permissions'));

        $permissions=Permission::findMany($request->permissions);

        $role->syncPermissions($permissions);

        return redirect()->route('roles.edit',$role->id)->with('message','تم تعديل عنصر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role=Role::find($id);

        $role->syncPermissions();

        $role->delete();

        return redirect()->route('roles.index')->with('message','تم حذف عنصر بنجاح');
    }
}
