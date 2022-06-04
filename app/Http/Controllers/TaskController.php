<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController
{
    public function create(Request $request)
    {
        $request->validate([
           'title' => 'required',
           'description' => 'required',
           'file' => 'required',
            'thumbnail' => 'required'
        ]);

        $task = new Task;

        $task->title = $request->title;
        $task->description = $request->description;

        $imgUrl = Storage::disk('local')->put('/public/images', $request->file);
        $imgName = basename($imgUrl);
        $task->thumbnail = $imgName;

        $task->save();

        return response($task, 200)
            ->header('Content-type', 'application/json');
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
