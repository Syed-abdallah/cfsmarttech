<?php

namespace App\Http\Controllers;


use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ReguserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view register')->only('index');
        $this->middleware('permission:create register')->only('registeruser');
  
    }

   


    public function index()
{
    $roles = Role::where('name', '!=', 'super Admin')->get();
    return view('admin.registeruser.index', compact('roles')); 
}

public function registeruser(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => [
            'required',
            'string',
            'confirmed',
            Password::min(8)
            ->mixedCase()
            ->numbers()
        ],
        'roles' => ['required', 'array'],
        'roles.*' => ['exists:roles,name'],
    ]);
    
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Assign selected roles to the user
    $user->assignRole($request->roles);

    session()->flash('toast', [
        'type'    => 'success',        
        'message' => 'User created successfully with assigned roles',
        'timer'   => 3000,                
        'bar'     => true,                 
    ]);

    return redirect()->back();
}
}

