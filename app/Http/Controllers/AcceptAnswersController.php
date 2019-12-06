<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class AcceptAnswersController extends Controller
{
    public function accept(Answer $answer) {
        $this->authorize('accept', $answer);
        $answer->question->acceptBestAnswer($answer);
        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'You have accepted this answer as best answer',
            ]);
        }
        return back()->with('success', 'Accept answer');
    }
}
