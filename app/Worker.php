<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    //
    public function jobs()
    {
        return $this->belongsToMany('App\Job');
    }

    public function timeEntries()
    {
        $this->hasMany('App\TimeEntry');
    }
}
