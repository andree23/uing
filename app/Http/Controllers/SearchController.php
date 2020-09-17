<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Serie;

class SearchController extends Controller
{
    // returns all the movies, animes and livetv that match the search
    public function index($query)
    {
        $movies = Movie::where('title', 'LIKE', "%$query%")->limit(10)->get();
        $series = Serie::where('name', 'LIKE', "%$query%")->limit(10)->get();
        

        $array = array_merge($movies->toArray(), $series->toArray());


        return response()->json(['search' => $array], 200);
    }
}