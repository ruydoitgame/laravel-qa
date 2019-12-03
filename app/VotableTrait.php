<?php

namespace App;

/**
 * Created by PhpStorm.
 * User: Home
 * Date: 3/12/2019
 * Time: 2:24 PM
 */
trait VotableTrait {
    public function votes() {
        return $this->morphToMany(User::class, 'votable');
    }

    public function upVotes() {
        return $this->votes()->wherePivot('vote', 1);
    }

    public function downVotes() {
        return $this->votes()->wherePivot('vote', -1);
    }
}