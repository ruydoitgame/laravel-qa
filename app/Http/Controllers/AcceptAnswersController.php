<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class AcceptAnswersController extends Controller
{
    public function accept(Answer $answer) {
        $this->authorize('accept', $answer);
        $answer->question->acceptBestAnswer($answer);
        return back()->with('success', 'Accept answer');
    }
}
