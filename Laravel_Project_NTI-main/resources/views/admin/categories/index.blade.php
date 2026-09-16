<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Categories Management') }}
            </h2>
            <a href="{{ route('admin.categories.create') }}" 
               style="background-color: #2563eb; color: #ffffff; font-weight: bold; padding: 8px 16px; border-radius: 6px; text-decoration: none;">
                + Add Category
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div style="margin-bottom: 16px; padding: 16px; background-color: #16a34a; color: #ffffff; font-weight: 500; border-radius: 8px;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="background-color: #1e293b; border: 1px solid #334155; border-radius: 8px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                <table style="width: 100%; text-align: left; border-collapse: collapse; color: #f8fafc;">
                    <thead>
                        <tr style="border-bottom: 1px solid #475569; background-color: #0f172a;">
                            <th style="padding: 12px; width: 80px; color: #94a3b8; text-align: left;">#</th>
                            <th style="padding: 12px; color: #94a3b8; text-align: left;">Category Name</th>
                            <th style="padding: 12px; text-align: center; width: 180px; color: #94a3b8;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr style="border-bottom: 1px solid #334155;">
                                <td style="padding: 12px; font-weight: 500; text-align: left;">{{ $loop->iteration }}</td>
                                <td style="padding: 12px; font-weight: 600; color: #ffffff; text-align: left;">{{ $category->name }}</td>
                                <td style="padding: 12px; text-align: center;">
                                    <div style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.categories.edit', $category) }}" 
                                           style="background-color: #eab308; color: #000000; font-weight: bold; padding: 6px 14px; border-radius: 4px; font-size: 12px; text-decoration: none; display: inline-block;">
                                            Edit
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline-block; margin: 0;" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    style="background-color: #dc2626; color: #ffffff; font-weight: bold; padding: 6px 14px; border-radius: 4px; font-size: 12px; border: none; cursor: pointer;">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="padding: 16px; text-align: center; color: #94a3b8;">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>