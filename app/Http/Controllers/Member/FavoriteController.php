<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $favorites = Favorite::where('user_id', $userId)
            ->join('movies', 'favorites.movie_id', '=', 'movies.id')
            ->select('movies.*')
            ->get();
        return view('member.favorite', ['favorites' => $favorites]);
    }

    public static function getFavoriteCount()
    {
        $userId = auth()->user()->id;
        $favoriteCount = Favorite::where('user_id', $userId)->count();
        return $favoriteCount;
    }

}
