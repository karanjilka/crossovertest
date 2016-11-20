<?php

namespace App;

class User extends \Cartalyst\Sentinel\Users\EloquentUser
{
    /**
     * Get all of the tasks for the user.
     */
    public function news()
    {
        return $this->hasMany(News::class);
    }
}
