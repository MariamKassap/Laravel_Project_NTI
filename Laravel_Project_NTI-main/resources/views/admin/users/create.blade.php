<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Create New User') }}
            </h2>
            <a href="{{ route('admin.users.index') }}" 
               style="background-color: #475569; color: #ffffff; font-weight: bold; padding: 8px 16px; border-radius: 6px; text-decoration: none;">
                Back to Users
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div style="background-color: #1e293b; border: 1px solid #334155; border-radius: 8px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <!-- Name -->
                    <div style="margin-bottom: 16px;">
                        <label for="name" style="display: block; color: #cbd5e1; font-weight: 600; margin-bottom: 8px;">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                               style="width: 100%; background-color: #0f172a; border: 1px solid #334155; border-radius: 6px; padding: 10px; color: #ffffff;">
                        @error('name')
                            <span style="color: #ef4444; font-size: 14px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div style="margin-bottom: 16px;">
                        <label for="email" style="display: block; color: #cbd5e1; font-weight: 600; margin-bottom: 8px;">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                               style="width: 100%; background-color: #0f172a; border: 1px solid #334155; border-radius: 6px; padding: 10px; color: #ffffff;">
                        @error('email')
                            <span style="color: #ef4444; font-size: 14px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div style="margin-bottom: 16px;">
                        <label for="password" style="display: block; color: #cbd5e1; font-weight: 600; margin-bottom: 8px;">Password</label>
                        <input type="password" name="password" id="password" required
                               style="width: 100%; background-color: #0f172a; border: 1px solid #334155; border-radius: 6px; padding: 10px; color: #ffffff;">
                        @error('password')
                            <span style="color: #ef4444; font-size: 14px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div style="margin-bottom: 24px;">
                        <label for="role" style="display: block; color: #cbd5e1; font-weight: 600; margin-bottom: 8px;">Role</label>
                            <select name="role" id="role" required style="width: 100%; background-color: #0f172a; border: 1px solid #334155; border-radius: 6px; padding: 10px; color: #ffffff;">
                                <option value="User">User</option>
                                <option value="Admin">Admin</option>
                            </select>
                        @error('role')
                            <span style="color: #ef4444; font-size: 14px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div style="text-align: right;">
                        <button type="submit" 
                                style="background-color: #2563eb; color: #ffffff; font-weight: bold; padding: 10px 20px; border-radius: 6px; border: none; cursor: pointer;">
                            Save User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>