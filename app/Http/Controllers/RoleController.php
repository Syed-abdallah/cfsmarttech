<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;  
use Spatie\Permission\Models\Permission;  
use Illuminate\Routing\Controller;
class RoleController extends Controller 
{
    // public function __construct()
    // {
    //     $this->middleware('permission:view roles')->only('index');
    //     $this->middleware('permission:edit roles')->only('edit');
    //     $this->middleware('permission:update roles')->only('update');
    //     $this->middleware('permission:delete roles')->only('destroy');
    // }

    public function index()
    {
        $permissions = Permission::all(); 
      
        $groupedPermissions = $permissions->groupBy(function ($permission) {
            $parts = explode(' ', $permission->name);
            return $parts[1] ?? $parts[0]; // Use the second word as the category, fallback to first word if not available
        });
        $roles = Role::all();
        return view('admin.role.index', compact('roles', 'groupedPermissions'));
    }

    // Show form to create a new role with permissions
    public function create()
    {
   
        $permissions = Permission::all(); 
      
        $groupedPermissions = $permissions->groupBy(function ($permission) {
            $parts = explode(' ', $permission->name);
            return $parts[1] ?? $parts[0]; // Use the second word as the category, fallback to first word if not available
        });
        return view('admin.role.create', compact('groupedPermissions'));
    }

    // Store the newly created role with selected permissions
    public function store(Request $request)
    {
       
        $validatior = Validator::make($request->all(), [
            'role' => 'required|unique:roles,name',
        ]);
        if ($validatior->passes()) {
      
           $role =  Role::create(['name' => $request->role]);
            if (!empty($request->permissions)) {
           
                foreach ($request->permissions as $name) {

                        $role->givePermissionTo($name); 
                   
                }
            }
    
        } else {
            return redirect()->route('roles.index')->with('error', 'Role not created.');
        }
        return redirect()->route('cfadmin.roles.index')->with('success', 'Role created successfully.');
    }

    // Show form to edit an existing role with permissions
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        // $rolePermissions = $role->permissions->pluck('id')->toArray(); // Get assigned permissions
        $groupedPermissions = $permissions->groupBy(function ($permission) {
            $parts = explode(' ', $permission->name);
            return $parts[1] ?? $parts[0]; // Use the second word as the category, fallback to first word if not available
        });
        // return view('dashboard.role.edit', compact('role', 'permissions', 'rolePermissions'));
        return view('admin.role.edit', compact('groupedPermissions', 'role'));
    }


    // public function update(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'role' => 'required|unique:roles,name,' . $id,  // Ensure the role name is unique, excluding the current role
    //     ]);
    //     if ($validator->passes()) {
    //         $role = Role::findOrFail($id);
    //         dd($request->all());
            
    //         // Update the role name
    //         $role->name = $request->role;
    //         $role->save();
    
    //         // Sync the permissions
    //         if (!empty($request->permissions)) {
    //             // Clear all permissions and then give the new ones
    //             $role->syncPermissions($request->permissions);
    //         } else {
    //             // If no permissions are selected, remove all assigned permissions
    //             $role->syncPermissions([]);
    //         }
    
    //         return redirect()->route('role.index')->with('success', 'Role updated successfully.');
    //     } else {
    //         return redirect()->route('role.index')->with('error', 'Role not updated.');
    //     }
    // }
    
    public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'role' => 'required|unique:roles,name,' . $id,
        'permissions' => 'nullable|array',
        'permissions.*' => 'exists:permissions,id' // Validate permission IDs
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    $role = Role::findOrFail($id);
    $role->name = $request->role;
    $role->save();

    // Get permission names from the IDs
    $permissionNames = Permission::whereIn('id', $request->permissions ?? [])
        ->pluck('name')
        ->toArray();

    $role->syncPermissions($permissionNames);

    return redirect()->route('cfadmin.roles.index')->with('success', 'Role updated successfully.');
}
    // Delete a role
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('admin.role.index')->with('success', 'Role deleted successfully.');
    }
}
