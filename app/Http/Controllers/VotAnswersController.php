<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class VotAnswersController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function vote(Answer $answer, Request $request) {
        auth()->user()->voteAnswer($answer, (int)$request->vote);
        return back();
    }
}
