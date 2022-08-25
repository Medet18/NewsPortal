<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use App\Http\Requests\ProductStoreRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
 
    public function index()
    {
        $news = News::all();
        return response()->json(['news'=>$news], 200);
    }

    public function store(NewsStoreRequest $request)
    {
        try{
            $photo = Str::random(32).".".$request->photo_of_news->getClientOriginalExtension();

            News::create([
                'title_of_news' => $request->title,
                'photo_of_news' => $photo,
                'description_of_news' => $request->desc,
                'date_of_news' => $request->date
            ]);

            Storage::disk('public')->put($photo, file_get_contents($request->photo_of_news));
            return response()->json(['message'=> 'News successfully stored!'], 200);
        
        } catch(\Exception $e){
            return response()->json(['message'=> 'Something went wrong!'], 500);
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
            $oldnews = News::find($id);
            if(!$news){
                // $newnews = $news;
                // if($oldnews != $newnews){
                //     $news->update();
                //     return response()->json(['message' =>'News successfully updated !'], 200);
                // }
                // else{
                //     return response()->json(['message' => 'Nothing to update!'],500);
                // }
                return response()->json(['message' => 'Not Found!'],404);
            }

            $news->title_of_news = $request->title;
            $news->description_of_news = $request->desc;
            $news->date_of_news = $request->date;

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
            //news update
            $news->save();

            return response()->json(['message' => 'News successfully updated!'], 200);

 
        } catch(\Exception $e){
            return response()->json(['message' => 'Something went wrong!'],500);
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
