<div>
    <div class="flex justify-between">
        <div class="flex items-center">
            <div>
                <label for="order" class="block text-sm font-medium text-gray-700">Order By</label>
                <select id="order" name="order" wire:model="order" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="priority">Priority</option>
                    <option value="title">Name</option>
                </select>
            </div>
            <div class="ml-5 flex items-start">
                <div class="flex items-center h-5">
                    <input id="show-completed" wire:model="showCompleted" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                </div>
                <div class="ml-3 text-sm">
                    <label for="show-completed" class="font-medium text-gray-700">Show Completed Task</label>
                </div>
            </div>
        </div>
        <div class="space-x-2 block text-sm font-medium text-gray-700">
            <span><b class="font-bold">Completed Task:</b> {{ $tasks_completed_count }}</span>
            <span><b class="font-bold">Total Tasks:</b> {{ $tasks_count }}</span>
        </div>
    </div>
    <div class="bg-white shadow overflow-hidden sm:rounded-md mt-10">
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
