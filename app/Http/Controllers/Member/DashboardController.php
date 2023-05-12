<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\HistoryMovie;
use App\Models\Movie;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $movies = Movie::orderBy('featured','DESC')
        ->orderBy('created_at','DESC')
        ->get();

        $userId = auth()->user()->id;
        $histories = HistoryMovie::where('user_id', $userId)
            ->join('movies', 'history_movies.movie_id', '=', 'movies.id')
            ->where('history_movies.is_completed',0)
            ->select('movies.*')
            ->get();

        return view('member.dashboard',['movies' => $movies,'histories' => $histories]);
    }
}
