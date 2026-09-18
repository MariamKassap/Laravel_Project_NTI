<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-black leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#F4F0EA] min-h-screen">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white border-2 border-black rounded-xl shadow-[4px_4px_0px_0px_#000000]">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white border-2 border-black rounded-xl shadow-[4px_4px_0px_0px_#000000]">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-image-form')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white border-2 border-black rounded-xl shadow-[4px_4px_0px_0px_#000000]">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>


            {{-- CVs Section By mariam --}}
            @if(auth()->user()->isEmployee())

            <div class="p-4 sm:p-8 bg-white border-2 border-black rounded-xl shadow-[4px_4px_0px_0px_#000000]">
                <div class="max-w-xl">

                    @if(session('success'))
                    <div class="mb-4 p-3 bg-emerald-300 border-2 border-black rounded-lg text-black font-bold text-sm shadow-[2px_2px_0px_0px_#000000]">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="mb-4 p-3 bg-rose-300 border-2 border-black rounded-lg text-black font-bold text-sm shadow-[2px_2px_0px_0px_#000000]">
                        {{ session('error') }}
                    </div>
                    @endif

                    <h3 class="text-lg font-black text-black">Your CVs</h3>
                    <p class="mt-1 text-sm font-bold text-slate-600">
                        Upload and manage your CVs. You can choose one when applying for a job.
                    </p>

                    {{-- Upload CV --}}
                    <form
                        method="POST"
                        action="{{ route('profile.cv.store') }}"
                        enctype="multipart/form-data"
                        class="mt-6 space-y-4">
                        @csrf

                        <div>
                            <label
                                for="title"
                                class="block font-bold text-sm text-black mb-2">
                                CV Title
                            </label>

                            <input
                                id="title"
                                name="title"
                                type="text"
                                placeholder="e.g. Backend Developer CV"
                                class="block w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-sm text-black placeholder:text-slate-500 shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0 focus:border-black">

                            @error('title')
                            <p class="text-sm font-bold text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="cv"
                                class="block font-bold text-sm text-black mb-2">
                                CV File
                            </label>

                            <input
                                id="cv"
                                name="cv"
                                type="file"
                                accept=".pdf,.doc,.docx"
                                class="block w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-sm text-black file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-2 file:border-black file:bg-blue-200 file:text-black file:font-bold file:text-xs file:shadow-[1px_1px_0px_0px_#000000] hover:file:bg-blue-300 cursor-pointer shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0"
                                required>

                            @error('cv')
                            <p class="text-sm font-bold text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg px-4 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:bg-blue-700 hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                            Upload CV
                        </button>
                    </form>

                    {{-- Existing CVs --}}
                    <div class="mt-8">

                        <h4 class="font-black text-black">
                            Your CVs
                        </h4>

                        @forelse($cvs as $cv)

                        <div class="mt-3 flex items-center justify-between bg-white border-2 border-black rounded-xl p-4 shadow-[2px_2px_0px_0px_#000000]">

                            <div>
                                <p class="font-black text-sm text-black">
                                    {{ $cv->title ?? 'My CV' }}
                                </p>

                                <a
                                    href="{{ asset('storage/' . $cv->file_path) }}"
                                    target="_blank"
                                    class="inline-flex items-center mt-1 text-sm font-bold text-[#2563EB] hover:underline">
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
                                    class="inline-flex items-center justify-center bg-red-500 text-white font-bold border-2 border-black rounded-lg px-3 py-1.5 text-xs shadow-[2px_2px_0px_0px_#000000] hover:bg-red-600 hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all"
                                    onclick="return confirm('Delete this CV?')">
                                    Delete
                                </button>
                            </form>

                        </div>

                        @empty

                        <p class="mt-3 text-sm font-bold text-slate-600 border-2 border-dashed border-black rounded-lg p-4 bg-[#F4F0EA] text-center">
                            You haven't uploaded any CVs yet.
                        </p>

                        @endforelse

                    </div>

                </div>
            </div>

            @endif

            <div class="p-4 sm:p-8 bg-white border-2 border-black rounded-xl shadow-[4px_4px_0px_0px_#000000]">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
