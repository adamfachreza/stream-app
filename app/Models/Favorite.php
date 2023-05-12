<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = "favorites";

    protected $fillable = [
        'user_id',
        'movie_id',
        'is_favorite'
    ];

    public function movie()
    {
        return $this->belongsToMovie(Movie::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
