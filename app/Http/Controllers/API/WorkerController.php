<?php

namespace App\Http\Controllers\API;

use App\Worker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers = Worker::all();
        return response()->json($workers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function show(Worker $worker)
    {
        // $worker = Worker::where('last_name', 'Casper')->first();
        return response()->json($worker);
    }

    public function getWorkerJobs(Worker $worker)
    {
        return response()->json($worker->jobs);
    }

    public function postWorkerJob(Worker $worker, $jobId)
    {
        return response()->json($worker->jobs()->attach($jobId));
    }

    public function deleteWorkerJob(Worker $worker, $jobId)
    {
        return response()->json($worker->jobs()->detach($jobId));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Worker $worker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        //
    }
}
