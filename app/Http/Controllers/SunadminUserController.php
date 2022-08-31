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
        \Config::set('auth.defaults.guard', 'admin-api');
    }

//for sunadmins
    public function index_subadmins()
    {
        $sadmins = Subadmin::all();
        return response()->json(['subadmins' => $sadmins],200);
    }
    
    public function show_subadmin($id)
    {
        $sadmin = Subadmin::find($id);
        if(! $sadmin){
            return response()->json(['message' => 'No such subadmin!'],404);
        }

        return response()->json(['subadmin' => $sadmin],200);
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

//for users
    public function index_users()
    {
        $users = User::all();
        return response()->json(['Users' => $users],200);
    }

    public function show_user($id)
    {
        $user = User::find($id);
        if(! $user){
            return response()->json(['message' => 'No such user!'],404);
        }

        return response()->json(['User' => $user],200);
    }

    public function destroy_user($id)
    {
        $user = User::find($id);
        if(! $user ){
            return response()->json(['message' => 'No such user!'],404);
        }
        else{
            $user->delete();
            return response()->json(['message' =>'User successfully deleted!'],200);
        }
    }
}
