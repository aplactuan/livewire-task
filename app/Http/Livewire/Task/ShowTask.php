<?php

namespace App\Http\Livewire\Task;

use Livewire\Component;
use App\Models\Task;

class ShowTask extends Component
{
    public Task $task;

    protected $rules = [
        'task.title' => 'required|string',
        'task.description' => '',
        'task.priority' => ''
    ];

    public function setPriority($priority)
    {
        //dd($priority);
        $this->task->priority = $priority;
    }

    public function saveTask()
    {
        $this->validate();

        $this->task->save();
    }

    public function delete()
    {
        $this->task->delete();
        $this->emitTo('task.task-list', 'refreshList');
    }

    public function complete()
    {
        $this->task->completed_at = now();
        $this->task->save();
        $this->emitTo('task.task-list', 'refreshList');
    }

    public function render()
    {
        return view('livewire.task.show-task', [
            'prio' => ['Low', 'Mid', 'High', 'Highest']
        ]);
    }
}
