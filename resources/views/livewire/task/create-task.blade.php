<div x-data="{ showForm: false }">
    <x-error for="title"></x-error>
    <form x-show="showForm"
          class="relative"
          style="display: none"
          wire:submit.prevent="addTask"
    >
        <div class="border border-gray-300 rounded-lg shadow-sm overflow-hidden focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
            <label for="title" class="sr-only">Title</label>
            <input type="text" name="title" id="title" class="block w-full border-0 pt-2.5 text-lg font-medium placeholder-gray-500 focus:ring-0" placeholder="Title" wire:model.defer="title">
            <label for="description" class="sr-only">Description</label>
            <textarea rows="2"
                      x-data="{ resize: () => { $el.style.height = '5px'; $el.style.height = $el.scrollHeight + 'px' } }"
                      x-init="resize()"
                      @input="resize()"
                      name="description"
                      id="description" wire:model.defer="description"
                      class="block w-full border-0 py-4 resize-none placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="Write a description..."></textarea>

            <div class="mt-3">
                <div class="py-2">
                    <div class="h-9 mt-3 px-3 space-x-2">
                        @foreach([0 => 'Low', 1 => 'Mid', 2 => 'High', 3 => 'Highest'] as $key => $prio)
                            @if ($priority === $key)
                                <div class="inline-flex items-center px-3 py-2 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-indigo-600">
                                    {{ $prio }}
                                </div>
                            @else
                                <button type="button"
                                        wire:click="setPriority({{ $key }})"
                                        class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:bg-gray-50">
                                    {{ $prio }}
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
                        Create
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div x-show="!showForm">
        <a href="#" @click.prevent="showForm = true">Add Task</a>
    </div>
</div>
