<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $guarded = [];

    public function user ()
    {
      return $this->belongTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
