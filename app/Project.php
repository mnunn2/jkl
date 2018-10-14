<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'type', 'active',
    ];

    public function jobs()
    {
        return $this->hasMany('App\Job');
    }
    //
}
