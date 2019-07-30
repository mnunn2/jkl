<?php

namespace App\Http\Controllers\API;

use phpDocumentor\Reflection\Types\Object_;
use Validator;
use App\TimeEntry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimeEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$entries = TimeEntry::all();
        $entries = TimeEntry::with('worker', 'job')->orderBy('id', 'desc')->paginate(10);
        //$entries = TimeEntry::with('worker', 'job')->get();
        return response()->json($entries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->json()->all(), [
            "job_id" => 'required',
            "worker_id" => 'required',
            "hours" => 'required',
            "date" => 'required',
            "type" => 'required'
        ]);

        if($validator->fails()){
            $errors = [];
            foreach ($validator->errors()->all() as $msg) {
                $errors[] = $msg;
            }
            return response()->json(["errors" => $errors], 400);
        }

        $entry = TimeEntry::create($request->all());
        $entry->save();
        return response()->json($entry);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($entry = TimeEntry::find($id)){
            $entry->delete();
            return response()->json($entry);
        }
        return response()->json([
            'message' => 'Record not found',
        ], 404);
    }
}
