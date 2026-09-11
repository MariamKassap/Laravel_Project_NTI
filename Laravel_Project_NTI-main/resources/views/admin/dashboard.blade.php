<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Companies Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Companies</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                        {{ $stats['companies'] ?? 0 }}
                    </div>
                </div>

                <!-- Categories Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Categories</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                        {{ $stats['categories'] ?? 0 }}
                    </div>
                </div>

                <!-- Saved Jobs Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-medium">Saved Jobs</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                        {{ $stats['saved_jobs'] ?? 0 }}
                    </div>
                </div>
            </div>

            <!-- Welcome Box -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Welcome back, {{ auth()->user()->name }}! Your admin portal is ready.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>