<x-dashboard>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-white">Dashboard</h1>
        </div>
    </x-slot>

    <div class="py-12 space-y-4">
        <livewire:task.task-list />
        <livewire:task.create-task />
    </div>
</x-dashboard>
