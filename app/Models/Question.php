<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'user_id'
    ];

//    public function getRouteKeyName()
//    {
//        return 'slug';
//    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getUrlAttribute() {
        return route('questions.show', $this->slug);
    }

    public function getCreatedDateAttribute() {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute() {
        if ($this->answers_count > 0) {
           if ($this->best_answer_id)
               return "success";
           return "warning";
        }
        return "secondary";
    }

    public function favorites() {
        return $this->belongsToMany(User::class, 'favorites');
    }

//    public function getBodyHtmlAttribute() {
//        return \Parsedown::instance()->text($this->body);
//    }


}
