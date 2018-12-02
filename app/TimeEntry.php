<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model
{
    protected $fillable = ['job_id', 'worker_id', 'hours', 'date', 'amount', 'type'];

    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }

    public function job()
    {
        return $this->belongsTo('App\Job');
    }
}
