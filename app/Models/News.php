<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title_of_news',
        'description_of_news',
        'photo_of_news',
        'date_of_news',
        'subadmin_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s a',
        'updated_at' => 'datetime:d-m-Y h:i:s a',
    ];
}
