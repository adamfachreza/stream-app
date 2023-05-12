<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryMovie extends Model
{
    use HasFactory;

    protected $table = "history_movies";

    protected $fillable = [
        'user_id',
        'movie_id',
        'is_completed'
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
