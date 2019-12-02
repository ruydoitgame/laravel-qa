<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class FavortiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Question $question) {
        $question->favorites()->attach(auth()->id());
        return back()->with('success', 'Favorite question');
    }

    public function destroy(Question $question) {
        $question->favorites()->detach(auth()->id());
        return back()->with('success', 'Un favorite question');
    }
}
