<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-nav-link :href="route('users.create')" :active="request()->routeIs('users.create')">
                <x-primary-button class="mt-4 mb-4">
                    {{ __("Create user") }}
                </x-primary-button>
            </x-nav-link>
            <table class="table w-full">
                <thead>
                    <tr>
                        <th class="text-gray-900 dark:text-gray-100" scope="col">#</th>
                        <th class="text-gray-900 dark:text-gray-100" scope="col">Name</th>
                        <th class="text-gray-900 dark:text-gray-100" scope="col">Username</th>
                        <th class="text-gray-900 dark:text-gray-100" scope="col">Tasks</th>
                        <th class="text-gray-900 dark:text-gray-100" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr class="border-b-2 border-b-black">
                            <th class="text-gray-900 dark:text-gray-100 text-center" scope="row">{{ $index + 1 }}</th>
                            <td class="text-gray-900 dark:text-gray-100 text-center">{{ $user->fullName }}</td>
                            <td class="text-gray-900 dark:text-gray-100 text-center">{{ $user['username']}} </td>
                            <td class="text-gray-900 dark:text-gray-100 text-center">
                                @foreach ($user->tasks as $task) 
                                    <span>{{$task['content']}} | </span>
                                @endforeach
                            </td>
                            <td class="text-gray-900 dark:text-gray-100 text-center">
                                <x-nav-link :href="route('users.show', ['user' => $user])">
                                    <x-primary-button class="mt-4">
                                        {{ __("Show user") }}
                                    </x-primary-button>
                                </x-nav-link>
                                <x-nav-link :href="route('users.edit', ['user' => $user])">
                                    <x-primary-button class="mt-4">
                                        {{ __("Edit user") }}
                                    </x-primary-button>
                                </x-nav-link>
                                <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="post" class="inline-block">
                                    @csrf
                                    @method('delete')
                                    <x-danger-button class="mt-4">
                                        {{ __("Delete user") }}
                                    </x-danger-button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
