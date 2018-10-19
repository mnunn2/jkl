<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Worker;
use App\Job;

class WorkerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        factory(Worker::class, 10)->create()->each(function($worker) {
            $worker->jobs()->attach( Job::all()->random()->id );
        });
        $this->assertTrue(true);
    }
}
