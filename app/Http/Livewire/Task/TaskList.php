<?php

namespace App\Http\Livewire\Task;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TaskList extends Component
{
    use WithPagination;

    public $showCompleted = false;
    public $order='priority';

    protected $listeners = [
        'refreshList' => 'render'
    ];

    public function render()
    {
        $user = User::withCount([
            'tasks',
            'tasks as tasks_completed_count' => fn ($query) => $query->completed()
        ])
            ->with('tasks')
            ->find(auth()->user()->id);

        $tasks = $user->tasks();

        if ($this->order === 'priority') {
            $tasks->orderBy('priority', 'DESC');
        }

        if ($this->order === 'title') {
            $tasks->orderBy('title', 'ASC');
        }

        if (!$this->showCompleted) {
            $tasks->pending();
        }

        return view('livewire.task.task-list', [
            'tasks' => $tasks->paginate(10),
            'tasks_completed_count' => $user->tasks_completed_count,
            'tasks_count' => $user->tasks_count
        ]);
    }
}
