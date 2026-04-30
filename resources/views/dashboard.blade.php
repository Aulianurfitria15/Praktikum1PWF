<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white-900">
                    <p class="text-lg font-semibold mb-4">
                        Welcome, {{ Auth::user()->name }}
                    </p>
                    <div class="bg-white-800 text-black p-6 rounded-lg">
                        <p class="text-lg">
                            Role: <span class="font-semibold">{{ ucfirst(Auth::user()->role ?? 'User') }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
