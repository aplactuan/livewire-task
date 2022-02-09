<?php

namespace App\Http\Livewire\Task;

use Livewire\Component;

class CreateTask extends Component
{
    public $priority = 0;
    public $title;
    public $description = '';

    protected $rules = [
        'title' => 'required|string',
    ];

    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    public function addTask()
    {
        $this->validate();
        auth()->user()->tasks()->create([
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority
        ]);

        $this->emitTo('task.task-list', 'refreshList');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.task.create-task');
    }
}
