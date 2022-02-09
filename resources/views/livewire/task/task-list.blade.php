<div>
    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <ul class="divide-y divide-gray-200">
            @foreach($tasks as $task)
                <livewire:task.show-task :task="$task" :wire:key="$task->id" />
            @endforeach
        </ul>
    </div>
    <div class="mt-5">
        {{ $tasks->links() }}
    </div>
</div>
