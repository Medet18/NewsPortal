<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\Subadmin;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use Auth;
use App\Http\Requests\NewsStoreRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
//use App\Stock;


class NewsController extends Controller
{
    public function __construct(){
        \Config::set('auth.defaults.guard', 'subadmin-api');
    }

    // Display only for useers 
    public function index_user()
    {
        $news = News::all();    
        return response()->json(['news'=>$news], 200);      
    }

    public function show_user($id)
    {
        $news = News::find($id);
        if(!$news){
            return response()->json(['message' => 'Not Found!'],404);
        }

        return response()->json(['news'=>$news], 200);

    
    }

    // Display only for specific subadmins
    
    public function index_subadmin()
    {   
        $new = News::where('subadmin_id',  auth()->user()->id)->get();
        return response()->json(['news'=>$new],200);
    }
   
    public function store(NewsStoreRequest $request)
    {
       try{
            $photo = Str::random(32).".".$request->photo_of_news->getClientOriginalExtension();

            $news = new News();
            News::create([
                'subadmin_id' => auth()->user()->id,
                'title_of_news' => $request->title_of_news,
                'description_of_news' => $request->description_of_news,
                'photo_of_news' => $photo,
                'date_of_news' => Carbon::create($request->date_of_news)->toDateString()
             
            ]);

            Storage::disk('public')->put($photo, file_get_contents($request->photo_of_news));
            return response()->json(['message'=> 'News successfully stored!'], 200);
        
        } catch(\Exception $e){
            return response()->json(['message'=> 'Something went wrong!'], 500);
        //return response()->json(['Exception' => $e], 500);
        }
    }

    public function show_subadmin($id)
    {
       //$news = News::where('subadmin_id', \Auth::id())->where('id', $id)->first();
        $news = News::find($id);    
        if(!$news){
            return response()->json(['message'=> 'Not Found!'],404);
        }
        elseif($news->subadmin_id == auth()->user()->id){
             return response()->json(['message'=> $news],200);
        }
        else{
            return response()->json(['message'=>"U can see only ur's news! . Look better your id's in show reoute!"],200);
        }
    }

    public function update(NewsStoreRequest $request, $id)
    {
        try{
            $news = News::find($id);

            if(!$news){
                return response()->json(['message' => 'Not Found!'],404);
            }
            elseif($news->subadmin_id == auth()->user()->id){
                
                $news->title_of_news = $request->title_of_news;
                $news->description_of_news = $request->description_of_news;
                $news->date_of_news = Carbon::create($request->date_of_news)->toDateString();

                if($request->photo_of_news){
                    $storage = Storage::disk('public'); //public storage

                    //old image delete
                    if($storage->exists($news->photo_of_news))
                        $storage->delete($news->photo_of_news);

                    //Image name
                    $photo = Str::random(32).".".$request->photo_of_news->getClientOriginalExtension();
                    $news->photo_of_news = $photo;

                    //Image save in public folder
                    $storage->put($photo, file_get_contents($request->photo_of_news));
                }

                $news->save();
                return response()->json(['message' => 'News successfully updated!'], 200);
            }
            else{
                return response()->json(['message' => "U can't update! ,It's not ur's news. U can edit only urs news!"],200);
            }
        
        } catch(\Exception $e){
            return response()->json(['message' => 'Something went wrong!'],500);
            //return response()->json(['message' => $e],500);
        }  
    }

    public function destroy($id)
    {
        $news = News::find($id);
        if(!$news){
            return response()->json(['message' => 'Not Found!'], 404);
        }
        elseif($news->subadmin_id == auth()->user()->id){
        
            $storage = Storage::disk('public');
            if($storage->exists($news->photo_of_news))
                $storage->delete($news->photo_of_news);

            $news->delete();

            return response()->json(['message' => 'News successfully deleted!'], 200);
        }
        else{
            return response()->json(['message' =>"U can't delete news, Delete only urs new"], 200);
        }
    }
}
