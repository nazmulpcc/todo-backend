<?php

namespace App\Controllers;

use App\Helpers\Auth;

class TaskController extends Controller
{
    /**
     * List Tasks
     */
    public function index()
    {
        $this->mustLogin();
        $query = Auth::user()->tasks();
        if($complete = $this->request->get('complete')){
            $query->where('complete', $complete);
        }
        $tasks = $query->get();
        $this->success($tasks);
    }

    /**
     * Create a new task
     */
    public function store()
    {
        $this->mustLogin();
        $body = $this->request->get('body');
        if(strlen($body) < 1){
            $this->failed(null, 'No text found!');
        }
        $task = Auth::user()->tasks()->create([
            'body' => $body,
            'complete' => false
        ]);
        $this->success($task, 'Task added');
    }

    /**
     * Update task
     * @param $task
     */
    public function update($task)
    {
        $this->mustLogin();
        $task = Auth::user()->tasks()->find($task);
        if(! $task){
            $this->failed(null, 'Task not found!', 404);
        }

        $body = $this->request->get('body', $task->body);
        $complete = $this->request->get('complete', $task->complete);

        $task->update(compact('body', 'complete'));
        $this->success($task, 'Task updated');
    }

    /**
     * Clear completed tasks
     */
    public function clear()
    {
        $this->mustLogin();
        Auth::user()
            ->tasks()
            ->where('complete', true)
            ->delete();
        $this->success(null, 'Completed Tasks Cleared!');
    }
}
