<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = ['number', 'forename', 'last_name', 'type', 'active', 'daily_rate'];

    public function jobs()
    {
        return $this->belongsToMany('App\Job');
    }

    public function timeEntries()
    {
        $this->hasMany('App\TimeEntry');
    }
}
