<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('تعديل الوظيفة') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <form action="{{ route('admin.jobs.update', $job) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Title Work</label>
                        <input type="text" name="title" value="{{ old('title', $job->title) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        @error('title')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Category</label>
                        <select name="category_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $job->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Description</label>
                        <textarea name="description" rows="5" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('description', $job->description) }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.jobs.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">Cancel</a>
                        <button type="submit" style="background-color: #2563eb; color: #ffffff; font-weight: bold; padding: 10px 20px; border-radius: 6px; border: none; cursor: pointer;">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>