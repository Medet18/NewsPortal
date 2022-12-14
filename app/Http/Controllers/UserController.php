<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;

class UserController extends Controller
{
    public function __construct(){
        \Config::set('auth.defaults.guard', 'user-api');
   }

    public function login(Request $request){
        $validator =  Validator::make($request->all(),[
            'email'=>'required|email|max:100',
            'password'=>'required|string|min:6',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        if(! $token = auth('user-api')->attempt($validator->validated())){ //user-api
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }
    
    public function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => strtotime(date('Y-m-d H:i:s', strtotime("+60 min"))),
            'user' => auth('user-api')->user()
        ]);
    }
    
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|between:1,100',
            'email'=>'required|string|email|max:100|unique:users',
            'password'=>'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        
        $admin = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => 'User successfully registered!',
            'user' => $admin
            ],201);

    }
    
    public function logout(){
        auth('user-api')->logout();
        return response()->json(['message' => 'User successfully logged out!']);
    }

    public function userProfile(){
        return response()->json(auth('user-api')->user());
    }
}

