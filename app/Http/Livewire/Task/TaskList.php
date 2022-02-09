<?php

namespace App\Http\Livewire\Task;

use Livewire\Component;
use Livewire\WithPagination;

class TaskList extends Component
{
    use WithPagination;

    protected $listeners = [
        'refreshList' => 'render'
    ];

    public function render()
    {
        $user = auth()->user()->load('tasks');

        return view('livewire.task.task-list', [
            'tasks' => $user->tasks()->paginate(10),
        ]);
    }
}
