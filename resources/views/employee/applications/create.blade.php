<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Apply for Job
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-lg shadow p-8">

                <h1 class="text-2xl font-bold text-gray-800">
                    {{ $job->title }}
                </h1>

                <p class="text-gray-600 mt-2">
                    {{ $job->employer->company ?? $job->employer->name }}
                </p>

                <h3 class="text-lg font-semibold mt-8">
                    Choose your CV
                </h3>

                @if($cvs->count())

                <!-- <form
                    action="{{ route('employee.jobs.store', $job) }}"
                    method="POST"
                    class="mt-4">
                    @csrf

                    @foreach($cvs as $cv)

                    <label class="block border rounded-lg p-4 mb-3 cursor-pointer">

                        <input
                            type="radio"
                            name="cv_id"
                            value="{{ $cv->id }}"
                            class="mr-2"
                            required>

                        <span class="font-semibold">
                            {{ $cv->title ?? 'My CV' }}
                        </span>

                    </label>

                    @endforeach

                    @error('cv_id')
                    <p class="text-red-600 text-sm mb-4">
                        {{ $message }}
                    </p>
                    @enderror

                    <button
                        type="submit"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg">
                        Submit Application
                    </button>

                </form> -->
                <form
                    action="{{ route('employee.jobs.store', $job) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="mt-4">
                    @csrf

                    <h3 class="font-semibold text-lg">
                        Choose an existing CV
                    </h3>

                    @foreach($cvs as $cv)

                    <label class="block border rounded-lg p-4 mb-3 cursor-pointer">

                        <input
                            type="radio"
                            name="cv_id"
                            value="{{ $cv->id }}"
                            class="mr-2">

                        <span class="font-semibold">
                            {{ $cv->title ?? 'My CV' }}
                        </span>

                    </label>

                    @endforeach

                    <div class="my-6 border-t pt-6">

                        <h3 class="font-semibold text-lg">
                            Or upload a new CV
                        </h3>

                        <input
                            type="file"
                            name="new_cv"
                            accept=".pdf,.doc,.docx"
                            class="mt-3">

                        @error('new_cv')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>

                    @error('cv_id')
                    <p class="text-red-600 text-sm mb-4">
                        {{ $message }}
                    </p>
                    @enderror

                    <button
                        type="submit"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg">
                        Submit Application
                    </button>

                </form>

                @else

                <div class="mt-6 bg-yellow-100 text-yellow-800 p-4 rounded-lg">
                    You don't have a CV yet.
                </div>

                @endif

            </div>

        </div>
    </div>

</x-app-layout>