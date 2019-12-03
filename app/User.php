<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function getUrlAttribute() {
        return "#";
    }

    public function answers() {
        return $this::hasMany(Answer::class);
    }

    public function getAvatarAttribute() {
        //https://vi.gravatar.com/site/implement/images/php/
        $email = $this->email;
        $size = 20;
        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "&s=" . $size;
    }

    public function favorites() {
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps();
    }

    public function voteQuestions() {
        return $this->morphedByMany(Question::class, 'votable');
    }

    public function voteAnswers() {
        return $this->morphedByMany(Answer::class, 'votable');
    }

    public function voteQuestion($question, $vote) {
        $voteQuestions = $this->voteQuestions();
        if ($voteQuestions->where('votable_id', $question->id)->exists()) {
            $voteQuestions->updateExistingPivot($question->id, ['vote' => $vote]);
        }
        else {
            $voteQuestions->attach($question, ['vote' => $vote]);
        }

        $question->load('votes');
        $downVote = $question->downVotes()->sum('vote');
        $upVote = $question->upVotes()->sum('vote');
        $question->votes_count = $upVote + $downVote;
        $question->save();
    }

    public function voteAnswer($answer, $vote) {
        $voteAnswers = $this->voteAnswers();
        if ($voteAnswers->where('votable_id', $answer->id)->exists()) {
            $voteAnswers->updateExistingPivot($answer->id, ['vote' => $vote]);
        }
        else {
            $voteAnswers->attach($answer, ['vote' => $vote]);
        }

        $answer->load('votes');
        $downVote = $answer->downVotes()->sum('vote');
        $upVote = $answer->upVotes()->sum('vote');
        $answer->votes_count = $upVote + $downVote;
        $answer->save();
    }
}
