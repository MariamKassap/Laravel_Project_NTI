<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Job') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.jobs.store') }}" method="POST">
                    @csrf

                    <!-- Job Title -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Job Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <!-- Category -->
                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select name="category_id" id="category_id" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select Category...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Job Details / Description</label>
                        <textarea name="description" id="description" rows="5" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.jobs.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                            Cancel
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Save Job
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>