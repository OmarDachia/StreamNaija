<?php

namespace App\Models;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'video_url',
        'thumbnail_url',
        'views',
        'is_published',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
