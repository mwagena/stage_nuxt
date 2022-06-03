<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController
{
    public function create(Request $request)
    {
        return $request;
//        $task = new Task;
//
//        $task->title = $request->title;
//        $task->description = $request->description;
//        $task->thumbnail = $request->thumbnail;

        $task->save();
    }
    public function getAll(Request $request)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Authorization');

        return Task::all();
    }
    public static function toggleComplete(Request $request)
    {
        $task = Task::find($request->id);

        $task->done = !$task->done;
        $task->save();
        return response('success', 200)
            ->header('Content-type', 'application/json');
    }
}
