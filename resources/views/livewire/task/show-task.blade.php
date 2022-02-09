<li x-data="{ showEdit: false, showForm: false }">
    <div @mouseover="showEdit = true"
       @mouseout="showEdit = false"
         x-show="!showForm"
       class="block hover:bg-gray-50"
    >
        <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-indigo-600 truncate">{{ $task->title }}</p>
                <div class="ml-2 flex-shrink-0 flex" x-show="showEdit">
                    <a href="#"
                       @click="showForm = true"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </a>
                    <button type="button"
                       wire:click="delete"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="lex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="mt-2 sm:flex sm:justify-between">
                <div class="sm:flex">
                    <p class="flex items-center text-sm text-gray-500">
                        {{ $prio[$task->priority] }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div x-show="showForm" style="display: none">
        <form x-show="showForm"
              class="relative"
              style="display: none"
              wire:submit.prevent="saveTask"
        >
            <div class="border border-gray-300 rounded-lg shadow-sm overflow-hidden focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
                <label for="title" class="sr-only">Title</label>
                <input type="text" name="title" id="title" class="block w-full border-0 pt-2.5 text-lg font-medium placeholder-gray-500 focus:ring-0" placeholder="Title" wire:model="task.title">
                <label for="description" class="sr-only">Description</label>
                <textarea rows="2" name="description" id="description" wire:model="task.description" class="block w-full border-0 py-0 resize-none placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="Write a description..."></textarea>

                <div class="mt-3">
                    <div class="py-2">
                        <div class="h-9 mt-3 px-3">
                            @foreach($prio as $priority)
                                @if ($task->priority == $loop->index)
                                    <div class="inline-flex items-center px-3 py-2 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-indigo-600">
                                        {{ $priority }}
                                    </div>
                                @else
                                    <button type="button"
                                            wire:click="setPriority({{ $loop->index }})"
                                            class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:bg-gray-50">
                                        {{ $priority }}
                                    </button>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="h-px"></div>
                    <div class="py-2">
                        <div class="py-px">
                            <div class="h-9">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="absolute bottom-0 inset-x-px">
                <x-error for="title"></x-error>
                <div class="border-t border-gray-200 px-2 py-2 flex justify-between items-center space-x-3 sm:px-3">
                    <div class="flex-shrink-0">
                        <button type="button"
                                @click="showForm = false"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-800 hover:bg-gray-700 focus:bg-gray-700"
                        >
                            Cancel
                        </button>

                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</li>
