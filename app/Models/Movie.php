<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'director_id', 'title', 'slug', 'poster', 'banner', 'desc', 'synopsis', 'trailer',
        'year', 'duration', 'imdb_rating',
    ];

    public function scopeSearch($query, $title)
    {
        return $query->where('title', 'LIKE', "%$title%");
    }

    public function director()
    {
        return $this->belongsTo(Director::class);
    }

    public function genre()
    {
        return $this->belongsToMany(Genre::class, 'genre_movie');
    }

    public function cast()
    {
        return $this->belongsToMany(Cast::class, 'cast_movie');
    }
}
