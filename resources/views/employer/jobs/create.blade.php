@extends('layouts.employer')

@section('page_title', 'Post a New Opportunity')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl border-2 border-black shadow-[4px_4px_0px_0px_#000000] p-8">
    <div class="mb-8 border-b-2 border-black pb-4">
        <h2 class="text-2xl font-black text-black">Job Details</h2>
        <p class="text-slate-600 text-sm mt-1 font-bold">Provide precise requirements to automatically screen and match candidates.</p>
    </div>

    <form method="POST" action="{{ route('employer.jobs.store') }}" class="space-y-6">
        @csrf

        <!-- Title -->
        <div>
            <label class="block text-sm font-bold text-black mb-2">Job Title</label>
            <input type="text" name="title" required value="{{ old('title') }}" placeholder="e.g. Senior Frontend Software Engineer" class="w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-sm text-black placeholder:text-slate-500 shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0">
            @error('title') <span class="text-xs text-red-600 font-bold mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-6">
            <!-- Job Type -->
            <div>
                <label class="block text-sm font-bold text-black mb-2">Job Type</label>
                <select name="job_type" class="w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-sm text-black shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0">
                    <option value="">Select Job Type</option>
                    <option value="full_time" {{ old('job_type') == 'full_time' ? 'selected' : '' }}>Full-time</option>
                    <option value="part_time" {{ old('job_type') == 'part_time' ? 'selected' : '' }}>Part-time</option>
                    <option value="internship" {{ old('job_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                    <option value="contract" {{ old('job_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                </select>
            </div>

            <!-- Location -->
            <div>
                <label class="block text-sm font-bold text-black mb-2">Primary Location</label>
                <input type="text" name="location" value="{{ old('location') }}" placeholder="San Francisco, CA or Remote" class="w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-sm text-black placeholder:text-slate-500 shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <!-- Salary -->
            <div>
                <label class="block text-sm font-bold text-black mb-2">Salary ($)</label>
                <input type="number" step="0.01" name="salary" value="{{ old('salary') }}" placeholder="120000" class="w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-sm text-black placeholder:text-slate-500 shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0">
            </div>

            <!-- Deadline -->
            <div>
                <label class="block text-sm font-bold text-black mb-2">Application Deadline</label>
                <input type="date" name="deadline" value="{{ old('deadline') }}" class="w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-sm text-black shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0">
            </div>
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-bold text-black mb-2">Job Description</label>
            <textarea name="description" rows="5" required placeholder="Describe responsibilities and requirements..." class="w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-sm text-black placeholder:text-slate-500 shadow-[2px_2px_0px_0px_#000000] focus:outline-none focus:ring-0">{{ old('description') }}</textarea>
            @error('description') <span class="text-xs text-red-600 font-bold mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="pt-4 flex justify-end">
            <button type="submit" class="bg-[#2563EB] hover:bg-blue-700 text-white font-bold border-2 border-black rounded-lg px-4 py-2 shadow-[2px_2px_0px_0px_#000000] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_0px_#000000] transition">
                Publish Job Listing
            </button>
        </div>
    </form>
</div>
@endsection
