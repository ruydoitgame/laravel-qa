<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class VoteQuestionController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function vote(Question $question, Request $request) {
        auth()->user()->voteQuestion($question, (int)$request->vote);
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Thanks for feedback',
                'voteCount' => $question->votes_count,
            ]);
        }
        return back();
    }
}
