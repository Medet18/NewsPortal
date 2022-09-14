<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Validator;

class AdminController extends Controller
{
    public function __construct(){
       \Config::set('auth.defaults.guard', 'admin-api');
       //config(['auth.defaults.guard' => 'admin-api']);
       //auth()->setDefaultDriver('admin-api');
    }

    public function login(Request $request){
        $validator =  Validator::make($request->all(),[
            'email'=>'required|email|max:100',
            'password'=>'required|string|min:6',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        if(! $token = auth()->guard(config('auth.guard'))->attempt($validator->validated())){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }
    
    public function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => strtotime(date('Y-m-d H:i:s', strtotime("+60 min"))),
            'user' => auth('admin-api')->user()
        ]);
    }
    
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|between:1,100',
            'email'=>'required|string|email|max:100|unique:admins',
            'password'=>'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        
        $admin = Admin::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => 'Admin successfully registered!',
            'user' => $admin
            ],201);

    }
    
    public function logout(){
        auth('admin-api')->logout();
        return response()->json(['message' => 'Admins successfully logged out!']);
    }

    public function userProfile(){
        return response()->json(auth()->guard(config('auth.guard'))->user());
    }
}

// 'custom' => [
//     'attribute-name' => [
//         'rule-name' => 'custom-message',
//     ],
//     'email' => [
//         'required' => 'We need to know your email address!',
//         'max' => 'Your attribute address is too long!, its  '
//         The :attribute must not be greater than :max characters.
//     ],

//],