<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="POST">
                @csrf
                @method("PUT")
                <div>
                    <x-input-label for="content" :value="__('Content')" />
                    <x-text-input id="content" class="block mt-1 w-full" type="text" name="content" :value="$task->content" required autofocus autocomplete="content" />
                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="deadline" :value="__('Deadline')" />
                    <x-text-input id="deadline" class="block mt-1 w-full" type="date" name="deadline" :value="$task->deadline" required autofocus autocomplete="deadline" />
                    <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-4">
                        {{ __('Edit task') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
