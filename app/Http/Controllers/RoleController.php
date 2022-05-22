<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;


class RoleController extends Controller
{
    // Display a listing of the resource.

    function __construct()
    {
        $this->middleware('permission:role-list|role-edit|role-delete', ['only', => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only', => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only', => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only', => ['destroy']]);
    }

    // Display a listing of the resource.

    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        return view('roles.index',compact('roles'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    // Show the form for creating a new resource.

    public function create()
    {
        $permission = Permission::get();
        return view('roles.create',compact('permission'));
    }

    // Store a newly created resource in storage.

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles, name',
            'permission' => 'required'.
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermission($request->input('permission'));

        return redirect()->route('roles.index')->with('success','Role created successfully')''
    }

    //  Display the specified resource.

    public function show($id)
    {
        $role = Role::find($id);
         $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return view('roles.show',compact('role','rolePermissions'));
    }

    // Show the form for editing the specified resource.

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

            return view('roles.edit',compact('role','permission','rolePermissions'));
    }

    // Remove the specified resource from storage.

    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('roles.index')->with('success','Role deleted successfully');
    }
}
