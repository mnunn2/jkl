<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model
{
    protected $fillable = ['job_id', 'worker_id', 'hours', 'date', 'amount', 'type'];

    public function save(array $options = [])
    {
        $worker = Worker::find($this->worker_id);
        //$this->amount = number_format((float) (($this->hours * $dailyRate) / 100), 2);
        $this->amount = ceil($this->hours * ($worker->daily_rate / 8));

        parent::save();
    }

    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }

    public function job()
    {
        return $this->belongsTo('App\Job');
    }
}
