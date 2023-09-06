<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            User name: {{ $user->username }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-gray-900 dark:text-gray-100 text-2xl text-bold">
                {{ __("Task List") }}
            </div>
            <x-nav-link :href="route('tasks.create')">
                <x-primary-button class="mt-4 mb-4">
                    {{ __("Create task") }}
                </x-primary-button>
            </x-nav-link>
            <table class="table w-full">
                <thead>
                    <tr>
                        <th class="text-gray-900 dark:text-white" scope="col">#</th>
                        <th class="text-gray-900 dark:text-white" scope="col">{{ __("Content") }}</th>
                        <th class="text-gray-900 dark:text-white" scope="col">{{ __("Deadline") }}</th>
                        <th class="text-gray-900 dark:text-white" scope="col">{{ __("Created at" )}}</th>
                        <th class="text-gray-900 dark:text-white" scope="col">{{ __("Action") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->tasks as $index => $task)
                    <tr class="border-b-2 border-b-black">
                        <th class="text-gray-900 dark:text-white text-center p-5" scope="row">{{ $index + 1 }}</th>
                        <td class="text-gray-900 dark:text-white text-center break-words w-2/5">{{ $task->content }}</td>
                        <td class="text-gray-900 dark:text-white text-center">{{ $task->deadline }}</td>
                        <td class="text-gray-900 dark:text-white text-center">{{ formatDateYDM($task->created_at) }}</td>
                        <td class="text-gray-900 dark:text-white text-center">
                            <x-nav-link :href="route('tasks.edit', ['task' => $task])">
                                <x-primary-button class="mt-4">
                                    {{ __('Edit task') }}
                                </x-primary-button>
                            </x-nav-link>
                            <form action="{{route('tasks.destroy', ['task' => $task->id])}}" method="post">
                                @csrf
                                @method("delete")
                                <x-primary-button class="mt-4">
                                    {{ __('Delete task') }}
                                </x-primary-button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
