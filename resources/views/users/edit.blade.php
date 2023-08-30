<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit user') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-4">
                <form action="{{ route('users.update', ['user' => $user]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <x-input-label for="first_name" :value="__('First name')" />
                    <x-text-input id="first_name" class="block mt-1 w-full"
                        type="text"
                        name="first_name"
                        value="{{ $user->first_name }}"
                        required autocomplete="first_name" 
                    />

                    <x-input-label for="last_name" :value="__('Last name')" />
                    <x-text-input id="last_name" class="block mt-1 w-full"
                        type="text"
                        name="last_name"
                        value="{{ $user->last_name }}"
                        required autocomplete="last_name" 
                    />
                    <x-primary-button class="mt-4">
                        {{ __('Edit user') }}
                    </x-primary-button>
                </form>
            </div>
            
        </div>
    </div>
</x-app-layout>
