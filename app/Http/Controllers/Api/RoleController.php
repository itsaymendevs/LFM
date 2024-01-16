<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use stdClass;

class RoleController extends Controller
{



    public function index()
    {


        // 1: get roles
        $roles = Role::with('permissions')->get();


        // 2: dependencies
        $permissions = Permission::all();



        // :: combine - response
        $combine = new stdClass();
        $combine->roles = $roles;
        $combine->permissions = $permissions;



        return response()->json($combine, 200);



    } // end function









    // ------------------------------------------------------------------------------





    public function store(Request $request)
    {


        // 1: create instance
        $role = new Role();


        // 1.2: basic
        $role->name = $request->name;
        $role->nameAr = $request->nameAr;


        $role->save();





        // 2: permissions
        foreach ($request->permissions as $permission) {


            // 2.1: create instance
            $rolePermission = new RolePermission();

            $rolePermission->roleId = $role->id;
            $rolePermission->permissionId = $permission;

            $rolePermission->save();

        } // end loop








        // :: response
        return response()->json(['status' => true, 'message' => 'Role has been added'], 200);


    } // end function







    // ------------------------------------------------------------------------------





    public function update(Request $request)
    {


        // 1: get instance
        $role = Role::find($request->id);


        // 1.2: basic
        $role->name = $request->name;
        $role->nameAr = $request->nameAr;


        $role->save();







        // 2: remove / create permissions
        RolePermission::where('roleId', $role->id)->delete();


        foreach ($request->permissions as $permission) {


            // 2.1: create instance
            $rolePermission = new RolePermission();

            $rolePermission->roleId = $role->id;
            $rolePermission->permissionId = $permission;

            $rolePermission->save();

        } // end loop






        // :: response
        return response()->json(['status' => true, 'message' => 'Role has been updated'], 200);


    } // end function








    // ------------------------------------------------------------------------------





    public function remove($id)
    {


        // 1: get instance
        $role = Role::find($id);
        $role->delete();



        // :: response
        return response()->json(['status' => true, 'message' => 'Role has been removed'], 200);


    } // end function







} // end controller
