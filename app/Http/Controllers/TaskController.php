<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

        if($request->file) {
            $imgUrl = Storage::disk('local')->put('/public/images', $request->file);
            $imgName = basename($imgUrl);
            $task->thumbnail = $imgName;
        }

        $task->save();

        return response($task, 200)
            ->header('Content-type', 'application/json');
    }

    public function edit(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $task = Task::find($request->id);

        $task->title = $request->title;
        $task->description = $request->description;

        if($request->file) {
            $imgUrl = Storage::disk('local')->put('/public/images', $request->file);
            $imgName = basename($imgUrl);
            $task->thumbnail = $imgName;
        }


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

    public static function delete(Request $request)
    {
        $task = Task::find($request->id);

        $task->delete();
        return response('success', 200)
            ->header('Content-type', 'application/json');
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
