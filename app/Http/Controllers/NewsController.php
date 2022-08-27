<?php

namespace App\Http\Controllers;

use App\Models\News;
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
    public function index_subadmin()
    {
        if((\Auth::id()) && (\Auth::user()->role_type == 'subadmin')){
            $new = News::where('subadmin_id',  auth()->user()->id)->get();
            return response()->json(['news'=>$new],200);
        }
        else{
            $news = News::all();    
            return response()->json(['news'=>$news], 200);
        }    
            
    }

    public function index_user()
    {
        $news = News::all();    
        return response()->json(['news'=>$news], 200);      
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
                'date_of_news' => $request->date_of_news
             
            ]);

            Storage::disk('public')->put($photo, file_get_contents($request->photo_of_news));
            return response()->json(['message'=> 'News successfully stored!'], 200);
        
        } catch(\Exception $e){
            return response()->json(['message'=> 'Something went wrong!'], 500);
        //return response()->json(['Exception' => $e], 500);
        }
    }

    public function show($id)
    {
        $news = News::find($id);
        if($news){
            return response()->json(['news'=>$news], 200);
        }
        else{
            return response()->json(['message' => 'Not Found!'],404);
        }
    }

    public function update(NewsStoreRequest $request, $id)
    {
        try{
            $news = News::find($id);

            if(!$news){
                return response()->json(['message' => 'Not Found!'],404);
            }

            $news->title_of_news = $request->title_of_news;
            $news->description_of_news = $request->description_of_news;
            $news->date_of_news = $request->date_of_news;

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
        
        $storage = Storage::disk('public');
        if($storage->exists($news->photo_of_news))
            $storage->delete($news->photo_of_news);

        $news->delete();

        return response()->json(['message' => 'News successfully deleted!'], 200);
    }
}
