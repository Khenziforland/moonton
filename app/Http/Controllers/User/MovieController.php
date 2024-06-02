<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Movie;

class MovieController extends Controller
{
    public function show(Movie $movie)
    {
        return Inertia('User/Dashboard/Movie/Show', [
            'movie' => $movie,
        ]);
    }
}
