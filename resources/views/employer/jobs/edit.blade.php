@extends('layouts.employer')

@section('page_title', 'Edit Job')

@section('content')

<div class="max-w-4xl mx-auto bg-white rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_#000000] p-8">


    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-black text-black">Edit Job Listing</h2>

        <a href="{{ route('employer.jobs.index', $job->id) }}"
            class="bg-white text-black font-bold border-2 border-black rounded-lg px-4 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_0px_#000000] transition">
            ← Back to Job
        </a>
    </div>

    <form method="POST"
        action="{{ route('employer.jobs.update', $job->id) }}"
        class="space-y-6">

        @csrf
        @method('PUT')

        {{-- Job Title --}}
        <div>
            <label class="block text-sm font-bold text-black mb-2">
                Job Title
            </label>

            <input
                type="text"
                name="title"
                value="{{ old('title', $job->title) }}"
                required
                class="w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-sm text-black shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0">

            @error('title')
            <p class="text-red-600 text-xs mt-1 font-bold">{{ $message }}</p>
            @enderror
        </div>


        {{-- Description --}}
        <div>
            <label class="block text-sm font-bold text-black mb-2">
                Description
            </label>

            <textarea
                name="description"
                rows="6"
                required
                class="w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-sm text-black shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0">{{ old('description', $job->description) }}</textarea>

            @error('description')
            <p class="text-red-600 text-xs mt-1 font-bold">{{ $message }}</p>
            @enderror
        </div>


        {{-- Salary + Location --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Salary --}}
            <div>
                <label class="block text-sm font-bold text-black mb-2">
                    Salary
                </label>

                <input
                    type="number"
                    name="salary"
                    value="{{ old('salary', $job->salary) }}"
                    min="0"
                    step="0.01"
                    class="w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-sm text-black shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0">

                @error('salary')
                <p class="text-red-600 text-xs mt-1 font-bold">{{ $message }}</p>
                @enderror
            </div>


            {{-- Location --}}
            <div>
                <label class="block text-sm font-bold text-black mb-2">
                    Location
                </label>

                <input
                    type="text"
                    name="location"
                    value="{{ old('location', $job->location) }}"
                    class="w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-sm text-black shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0">

                @error('location')
                <p class="text-red-600 text-xs mt-1 font-bold">{{ $message }}</p>
                @enderror
            </div>

        </div>


        {{-- Job Type + Deadline --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Job Type --}}
            <div>
                <label class="block text-sm font-bold text-black mb-2">
                    Job Type
                </label>

                <select
                    name="job_type"
                    class="w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-sm text-black shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0">
                    <option value="">Select Job Type</option>

                    <option value="full_time"
                        {{ old('job_type', $job->job_type) === 'full_time' ? 'selected' : '' }}>
                        Full Time
                    </option>

                    <option value="part_time"
                        {{ old('job_type', $job->job_type) === 'part_time' ? 'selected' : '' }}>
                        Part Time
                    </option>

                    <option value="internship"
                        {{ old('job_type', $job->job_type) === 'internship' ? 'selected' : '' }}>
                        Internship
                    </option>

                    <option value="contract"
                        {{ old('job_type', $job->job_type) === 'contract' ? 'selected' : '' }}>
                        Contract
                    </option>
                </select>

                @error('job_type')
                <p class="text-red-600 text-xs mt-1 font-bold">{{ $message }}</p>
                @enderror
            </div>


            {{-- Deadline --}}
            <div>
                <label class="block text-sm font-bold text-black mb-2">
                    Application Deadline
                </label>

                <input
                    type="date"
                    name="deadline"
                    value="{{ old('deadline', $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('Y-m-d') : '') }}"
                    class="w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-sm text-black shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0">

                @error('deadline')
                <p class="text-red-600 text-xs mt-1 font-bold">{{ $message }}</p>
                @enderror
            </div>

        </div>


        {{-- Buttons --}}
        <div class="flex justify-end gap-4 pt-4 border-t-2 border-black">

            <a href="{{ route('employer.jobs.index') }}"
                class="bg-white text-black font-bold border-2 border-black rounded-lg px-4 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_0px_#000000] transition">
                Cancel
            </a>

            <button
                type="submit"
                class="bg-[#2563EB] text-white font-bold border-2 border-black rounded-lg px-4 py-2 text-sm shadow-[2px_2px_0px_0px_#000000] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_0px_#000000] transition">
                Update Job
            </button>

        </div>

    </form>


</div>
@endsection
