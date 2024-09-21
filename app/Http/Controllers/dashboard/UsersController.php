<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      
        $q=$request->q?$request->q:"";

         $users=User::whereAny(['name','email'],'like',"%$q%")->paginate(10);

         return view('dashboard.users.index',compact('users'));
    }

    function create(){

        $roles=Role::all();

        return view('dashboard.users.add',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required|string|unique:users,name|max:100",
            'email'=>"required|string|email|unique:users,email",
            'password'=>"required|string|min:8",
            'roles'=>"required|array|min:1|max:2"
        ]);

        $request->merge(['password'=>Hash::make($request->password)]);

        $user=User::create($request->except('roles'));

        $user->syncRoles($request->roles);

        return redirect()->route('users.create')->with('message','تم اضافة عنصر جديد بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
        $user=User::find($id);

        $roles=Role::all();

        return view('dashboard.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>"required|string|unique:users,name,$id|max:100",
            'email'=>"required|string|email|unique:users,email,$id",
            'password'=>$request->password?"string|min:8":"",
            'roles'=>"required|array|min:1|max:2",
        ]);

        $user=User::find($id);

        $data=$request->except(['roles','password']);

        if($request->password){
            $request->merge(['password'=>Hash::make($request->password)]);
            $data=$request->except('roles');
        }

        $user->update($data);

        $user->syncRoles($request->roles);

        return redirect()->route('users.edit',$user->id)->with('message','تم تعديل عنصر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=User::find($id);

        $user->syncRoles();

        $user->delete();

        return redirect()->route('users.index')->with('message','تم حذف عنصر بنجاح');
    }
}
