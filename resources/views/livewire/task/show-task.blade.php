<li x-data="{ showEdit: false, showForm: false, showModal: false }">
    <div @mouseover="showEdit = true"
       @mouseout="showEdit = false"
         x-show="!showForm"
       class="block hover:bg-gray-50"
    >
        <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
                <div class="flex">
                    @if($task->completed_at)
                        <x-icon type="circle-check" class="text-green-600"></x-icon>
                    @else
                        <button type="button" wire:click="complete">
                                <x-icon type="circle-check" class="text-gray-200 hover:text-green-600"></x-icon>
                        </button>
                    @endif
                    <p class="text-sm font-medium text-indigo-600 truncate">{{ $task->title }}</p>
                </div>
                <div class="ml-2 flex-shrink-0 flex" x-show="showEdit">
                    <a href="#"
                       @click="showForm = true"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </a>
                    <a href="#"
                       @click="showModal = true"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
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
                <input type="text" name="title" id="title" class="block w-full border-0 pt-2.5 text-lg font-medium placeholder-gray-500 focus:ring-0" placeholder="Title" wire:model.defer="task.title">
                <label for="description" class="sr-only">Description</label>
                <textarea rows="2"
                          x-data="{ resize: () => { $el.style.height = '5px'; $el.style.height = $el.scrollHeight + 'px' } }"
                          x-init="resize()"
                          @input="resize()"
                          name="description"
                          id="description" wire:model.defer="task.description"
                          class="block w-full border-0 py-6 resize-none placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="Write a description...">

                </textarea>
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
    <!-- modal details of the task -->
    <div class="fixed z-10 inset-0 overflow-y-auto"
         aria-labelledby="modal-title"
         role="dialog"
         aria-modal="true"
         @click.outside="showModal = false"
         x-show="showModal"
         style="display: none"
    >
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div class="sm:flex sm:items-start">
                     <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">{{ $task->title }}</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                {!! nl2br(e($task->description)) !!}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:ml-10 sm:pl-4 sm:flex">
                    <button
                        @click="showModal = false"
                        type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 px-4 py-2 bg-white text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</li>
