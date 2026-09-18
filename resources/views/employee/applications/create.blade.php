<x-app-layout>

    <x-slot name="header">
        <h2 class="font-black text-xl text-black leading-tight">
            Apply for Job
        </h2>
    </x-slot>

    <div class="min-h-screen bg-[#F4F0EA] py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_#000000] p-8">

                <h1 class="text-2xl font-black text-black">
                    {{ $job->title }}
                </h1>

                <p class="font-bold text-black mt-2">
                    {{ $job->employer->company ?? $job->employer->name }}
                </p>

                <h3 class="text-lg font-black text-black mt-8">
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

                    <h3 class="font-bold text-lg text-black">
                        Choose an existing CV
                    </h3>

                    @foreach($cvs as $cv)

                    <label class="block bg-white border-2 border-black rounded-xl p-4 mb-3 cursor-pointer shadow-[2px_2px_0px_0px_#000000] hover:shadow-[4px_4px_0px_0px_#000000] transition-all">

                        <input
                            type="radio"
                            name="cv_id"
                            value="{{ $cv->id }}"
                            class="mr-2 rounded border-2 border-black text-[#2563EB] shadow-[1px_1px_0px_0px_#000000] focus:ring-0 focus:border-black">

                        <span class="font-bold text-black">
                            {{ $cv->title ?? 'My CV' }}
                        </span>

                    </label>

                    @endforeach

                    <div class="my-6 border-t-2 border-black pt-6">

                        <h3 class="font-bold text-lg text-black">
                            Or upload a new CV
                        </h3>

                        <label class="block font-bold text-black text-sm mt-3 mb-1">New CV File</label>
                        <input
                            type="file"
                            name="new_cv"
                            accept=".pdf,.doc,.docx"
                            class="mt-1 block w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-black shadow-[2px_2px_0px_0px_#000000] focus:ring-0 focus:outline-none file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-2 file:border-black file:bg-white file:text-black file:font-bold file:shadow-[1px_1px_0px_0px_#000000]">

                        @error('new_cv')
                        <p class="text-red-600 font-semibold text-sm mt-1">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>

                    @error('cv_id')
                    <p class="text-red-600 font-semibold text-sm mb-4">
                        {{ $message }}
                    </p>
                    @enderror

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg px-6 py-3 shadow-[2px_2px_0px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                        Submit Application
                    </button>

                </form>

                @else

                <div class="mt-6 bg-amber-300 text-black font-bold border-2 border-black p-4 rounded-xl shadow-[4px_4px_0px_0px_#000000]">
                    You don't have a CV yet.
                </div>

                @endif

            </div>

        </div>
    </div>

</x-app-layout>
