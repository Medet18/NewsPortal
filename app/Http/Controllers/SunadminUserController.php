<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subadmin;
use Carbon\Carbon;
use Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Validator;


class SunadminUserController extends Controller
{
    public function __construct(){
        \Config::set('auth.defaults.guard', 'admin_api');
    }

    public function index_subadmins()
    {
        $sadmins = Subadmins::all();
        return response()->json(['subadmins' => $sadmins],200);
    }
    
    public function show_subadmin($id)
    {
        $sadmin = Subadmin::find($id);
        if(! $sadmin){
            return response()->json(['message' => 'No such subadmin'],404);
        }

        return response()->json(['subadmin' => $sadmin],200);
    }

    public function store_subadmin(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'name'=>'required|string|between:2,100',
            'email'=>'required|string|email|max:100|unique:subadmins',
            'password'=>'required|string|confirmed|min:6',
            'role_type'=>'required|string|min:8',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        
        $sadmin = Subadmin::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($req->password)]
        ));

        return response()->json([
            'message' => 'Subadmin successfully stored!',
            'user' => $sadmin
            ],201);
    }

    public function update_subadmin(Request $req, $id){
        $req->validate([
            'name'=>'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:subadmins',
            'password' =>'required|string|confirmed|min:6',
            'role_type'=>'required|string|min:8',

        ]);
        
        $sadmin = Subadmin::find($id);
        if($sadmin){
            $sadmin->name = $req->name;
            $sadmin->email = $req->email;
            $sadmin->password = $req->password;
            $sadmin->password_confirmation = $req->password_confirmation;
            $sadmin->role_type = $req->role_type;
            $sadmin->update();
        }
        else{
            return response()->json(['message' => 'No such subadmin!'],404);
        }
    }

    public function destroy_subadmin($id){
        $sadmin = Subadmin::find($id);
        if(! $sadmin ){
            return response()->json(['message' => 'No such subadmin'],404);
        }
        else{
            $sadmin->delete();
            return response()->json(['message' =>'Sadmin successfully deleted!'],200);
        }
    }

}
