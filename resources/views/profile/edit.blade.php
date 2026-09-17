<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            @include('profile.partials.update-profile-image-form')
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>


            {{-- CVs Section By mariam --}}
            @if(auth()->user()->isEmployee())

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">

                    @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg">
                        {{ session('error') }}
                    </div>
                    @endif

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Upload and manage your CVs. You can choose one when applying for a job.
                    </p>

                    {{-- Upload CV --}}
                    <form
                        method="POST"
                        action="{{ route('profile.cv.store') }}"
                        enctype="multipart/form-data"
                        class="mt-6">
                        @csrf

                        <div>
                            <label
                                for="title"
                                class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                CV Title
                            </label>

                            <input
                                id="title"
                                name="title"
                                type="text"
                                placeholder="e.g. Backend Developer CV"
                                class="mt-1 block w-full rounded-md border-gray-300">

                            @error('title')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label
                                for="cv"
                                class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                CV File
                            </label>

                            <input
                                id="cv"
                                name="cv"
                                type="file"
                                accept=".pdf,.doc,.docx"
                                class="mt-1 block w-full"
                                required>

                            @error('cv')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button
                            type="submit"
                            class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg">
                            Upload CV
                        </button>
                    </form>

                    {{-- Existing CVs --}}
                    <div class="mt-8">

                        <h4 class="font-semibold text-gray-900 dark:text-gray-100">
                            Your CVs
                        </h4>

                        @forelse($cvs as $cv)

                        <div class="mt-3 flex items-center justify-between border rounded-lg p-4">

                            <div>
                                <p class="font-medium text-gray-900 dark:text-gray-100">
                                    {{ $cv->title ?? 'My CV' }}
                                </p>

                                <a
                                    href="{{ asset('storage/' . $cv->file_path) }}"
                                    target="_blank"
                                    class="text-sm text-blue-600 hover:underline">
                                    View CV
                                </a>
                            </div>

                            <form
                                method="POST"
                                action="{{ route('profile.cv.destroy', $cv) }}">
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="text-red-600 hover:underline"
                                    onclick="return confirm('Delete this CV?')">
                                    Delete
                                </button>
                            </form>

                        </div>

                        @empty

                        <p class="mt-3 text-sm text-gray-500">
                            You haven't uploaded any CVs yet.
                        </p>

                        @endforelse

                    </div>

                </div>
            </div>

            @endif

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>