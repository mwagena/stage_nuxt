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
           'title' => 'required|min:5|max:100',
           'description' => 'required|min:5|max:250',
           'file' => 'required',
            'thumbnail' => 'required'
        ]);

        $task = new Task;

        return $this->save($request, $task);
    }

    public function edit(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:100',
            'description' => 'required|min:5|max:250',
        ]);
        $task = Task::find($request->id);

        if($request->file) {
            Task::deleteImage($task->thumbnail);
        }

        return $this->save($request, $task);
    }

    public function getAll(Request $request)
    {
        return Task::all();
    }

    public static function delete(Request $request)
    {

        $task = Task::find($request->id);

        Task::deleteImage($task->thumbnail);

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

    /**
     * @param Request $request
     * @param $task
     * @return Application|ResponseFactory|Response
     */
    public function save(Request $request, $task): ResponseFactory|Application|Response
    {
        $task->title = $request->title;
        $task->description = $request->description;

        if ($request->file) {

            $imgUrl = Storage::disk('local')->put('/public/images', $request->file);
            $imgName = basename($imgUrl);
            $task->thumbnail = $imgName;
        }

        $task->save();

        return response($task, 200)
            ->header('Content-type', 'application/json');
    }

}
