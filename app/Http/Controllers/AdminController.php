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
    }

    public function login(Request $request){
        $validator =  Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required|string|min:6',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        if(! $token = auth()->attempt($validator->validated())){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }
    
    public function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => strtotime(date('Y-m-d H:i:s', strtotime("+60 min"))),
            'user' => auth()->user()
        ]);
    }
    
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|between:2,100',
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
        auth()->logout();
        return response()->json(['message' => 'Admins successfully logged out!']);
    }

    public function userProfile(){
        return response()->json(auth()->user());
    }
}
