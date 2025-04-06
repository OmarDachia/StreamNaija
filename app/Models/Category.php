<?php

namespace App\Models;

// use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
