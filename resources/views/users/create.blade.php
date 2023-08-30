<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create user') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-4">
                <x-text-input id="task" class="block mt-1 w-full"
                    type="text"
                    name="task"
                    required autocomplete="task" 
                />

            </div>
            <x-primary-button class="mt-4">
                {{ __('Create user') }}
            </x-primary-button>
        </div>
    </div>
</x-app-layout>
