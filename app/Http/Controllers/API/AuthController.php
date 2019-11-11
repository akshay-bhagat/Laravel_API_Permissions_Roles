<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|unique:users',
        //     'password' => 'required',
        // ]);
        // dd($request->all());

        $credentials = $request->only(['email', 'password']);
        if(Auth::attempt($credentials))
        {
            $user = Auth::user();
            // dd($user);
            $roles = Auth::user()->roles;
            // dd($roles);
            $permissions = [];
            foreach($roles as $role)
            {
                // dd($role->role_name);
                $i = 0;
                foreach($role->permissions as $permission){
                    // dd($permission);
                    $permissions[$i] = $permission->permission_name;
                    $i++;
                }
                
            }

            $success['token'] = $user->createToken('MyApp', $permissions)->accessToken;
            return response()->json(['success' => $success,
                                     'user' => $user,
                                     'roles' => $role,
                                     'permissions' => $permissions
                                    ], 200);
        }
    }
}
