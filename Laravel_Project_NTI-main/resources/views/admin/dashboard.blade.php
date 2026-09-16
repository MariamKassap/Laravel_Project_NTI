<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Statistics Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                
                <div class="bg-gray-800 p-6 rounded-lg shadow-md border border-gray-700">
                    <div class="text-sm font-medium text-gray-400">Total Categories</div>
                    <div class="text-3xl font-bold text-white mt-2">{{ $stats['categories'] ?? 0 }}</div>
                </div>

                <div class="bg-gray-800 p-6 rounded-lg shadow-md border border-gray-700">
                    <div class="text-sm font-medium text-gray-400">Total Jobs</div>
                    <div class="text-3xl font-bold text-blue-400 mt-2">{{ $stats['jobs'] ?? 0 }}</div>
                </div>

                <div class="bg-gray-800 p-6 rounded-lg shadow-md border border-gray-700">
                    <div class="text-sm font-medium text-gray-400">Total Users</div>
                    <div class="text-3xl font-bold text-purple-400 mt-2">{{ $stats['users'] ?? 0 }}</div>
                </div>

                <div class="bg-gray-800 p-6 rounded-lg shadow-md border border-gray-700">
                    <div class="text-sm font-medium text-gray-400">Total Applications</div>
                    <div class="text-3xl font-bold text-green-400 mt-2">{{ $stats['applications'] ?? 0 }}</div>
                </div>

            </div>

            <!-- Welcome Card -->
            <div class="bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6 border border-gray-700">
                <h3 class="text-lg font-semibold text-white mb-2">Welcome back, {{ Auth::user()->name }}!</h3>
                <p class="text-gray-300">Your job board admin portal is active. Use the top navigation menu to manage categories, job listings, registered users, and candidate applications.</p>
            </div>

        </div>
    </div>
</x-app-layout>