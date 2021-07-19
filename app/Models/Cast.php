<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image'];

    public function scopeSearch($query, $name)
    {
        return $query->where('name', 'LIKE', "%$name%");
    }

    public function movie()
    {
        return $this->belongsToMany(Movie::class, 'cast_movie');
    }
}
