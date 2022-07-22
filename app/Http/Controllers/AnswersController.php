<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {
        $request->validate([
           'body' => 'required'
        ]);
        $question = Question::where('slug', $slug)->first();
        //$question->answer->create();
        Answer::create($request->only('body') + [
                'question_id' => $question->id,
                'user_id' => User::pluck('id')->random(),
            ]);
        return back()->with('success', 'Your answer has been submitted');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit($slug, Answer $answer)
    {
        $question = Question::where('slug', $slug)->first();
        return view('answers.edit', [
           'question' => $question,
           'answer' => $answer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug, Answer $answer)
    {
        $question = Question::where('slug', $slug)->first();
        $answer->update($request->only('body'));
        return redirect()->route('questions.show', $question->slug)->with('success', 'Your question has been submitted');
        //return back()->with('success', 'Your answer has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug, Answer $answer)
    {
        $answer->delete();
        return back()->with('success', 'Your answer has been deleted');

    }

    public function accept(Answer $answer)
    {
        $question = $answer->question;
        $question->best_answer_id = $answer->id;
        $question->save();
        return back()->with('success', 'Your answer has been accepted');

    }
}
