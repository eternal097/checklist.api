<?php

namespace App\Http\Controllers\Api;

use App\Checklist;
use App\Task;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\TaskRequest;
use App\Http\Controllers\Api\BaseController as BaseController;

class TaskController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($checklist_id)
    {
        $user_checklists = User::find(Auth::id())->checklists;

        if (!$user_checklists->contains($checklist_id)) {
            return $this->sendError('Not Found', null, 404);
        }

        $tasks = Checklist::find($checklist_id)->tasks;
        if ($tasks->count() == null) {
            $tasks = 'Tasks is empty';
        }

        return $this->sendResponse($tasks, 'Tasks retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request, $checklist_id)
    {
        $user_checklists = User::find(Auth::id())->checklists;

        if (!$user_checklists->contains($checklist_id)) {
            return $this->sendError('Not Found', null, 404);
        }

        $task = Task::create([
            'checklist_id' => $checklist_id,
            'message' => $request->message,
            'completed' => 0,
        ]);

        return $this->sendResponse($task->toArray(), 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Checklist $checklist)
    {
        return $this->sendError('Not Found', null, 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $checklist_id, $task_id)
    {
        $user_checklists = User::find(Auth::id())->checklists;
        if (!$user_checklists->contains($checklist_id)) {
            return $this->sendError('Not Found', null, 404);
        }

        $user_tasks = Checklist::find($checklist_id)->tasks;
        if (!$user_tasks->contains($task_id)) {
            return $this->sendError('Not Found', null, 404);
        }
        // dd($request->all());
        $task = Task::find($task_id);
        $task->update($request->all());
        return $this->sendResponse($task->toArray(), 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskRequest $request, $checklist_id, $task_id)
    {
        $user_checklists = User::find(Auth::id())->checklists;
        if (!$user_checklists->contains($checklist_id)) {
            return $this->sendError('Not Found', null, 404);
        }

        $user_tasks = Checklist::find($checklist_id)->tasks;
        if (!$user_tasks->contains($task_id)) {
            return $this->sendError('Not Found', null, 404);
        }

        $task = Task::find($task_id);
        $task->delete();
        return $this->sendResponse($task->toArray(), 'Task deleted successfully.');
    }
}
