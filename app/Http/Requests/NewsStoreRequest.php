<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if(request()->isMethod('post')){
            return [
                //'subadmin_id' => 'required|bigInteger',
                'title_of_news' => 'required|string|max:255',
                'description_of_news' => 'required|string',
                'photo_of_news' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'date_of_news' => 'required|date'
            ];
        }
        else{
            return [
               // 'subadmin_id' => 'required|bigInteger',
                'title_of_news' => 'required|string|max:255',
                'description_of_news' => 'required|string',
                'photo_of_news' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'date_of_news' => 'required|date'
            ];
        }
    }
    public function messages(){
        if(request()->isMethod('post')){
            return [
                //'subadmin_id' => 'required|bigInteger',
                'title_of_news.required' => 'The title of the news is required!!!',
                'description_of_news.required' => 'The description of the news is required!!!',
                'photo_of_news.required' => 'The photo is required!!!',
                'date_of_news.required' => 'The date is required!!!'
            ];
        }
        else{
            return [
                'title_of_news.required' => 'The title of the news is required!!!',
                'description_of_news.required' => 'The description of thr news is required!!!',
                'date_of_news.required' => 'The date is required!!!'
            ];
        }
    }
}
