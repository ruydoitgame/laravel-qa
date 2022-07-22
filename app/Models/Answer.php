<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id',
        'body',
        'user_id'
    ];

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getStatusAttribute() {
        if ($this->id === $this->question->best_answer_id) {
            return "success";
        }
        return "secondary";
    }

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::created(function($answer) {
           $answer->question->answers_count += 1;
           $answer->question->save();
        });

        static::deleted(function($answer) {
            $answer->question->answers_count -= 1;
            $question = $answer->question;
            if ($answer->id === $question->best_answer_id) {
                $question->best_answer_id = null;
                $question->save();
            }

            $answer->question->save();
        });
    }
}
