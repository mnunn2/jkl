<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id', 'name', 'description', 'type', 'active',
    ];

    public function workers()
    {
        return $this->belongsToMany('App\Worker');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function timeEntries()
    {
        return $this->hasMany('App\TimeEntry');
    }
}
