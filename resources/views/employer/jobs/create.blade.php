@extends('layouts.employer')

@section('page_title', 'Post a New Opportunity')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
    <div class="mb-8 border-b border-slate-100 pb-4">
        <h2 class="text-2xl font-bold text-slate-800">Job Details</h2>
        <p class="text-slate-400 text-sm mt-1">Provide precise requirements to automatically screen and match candidates.</p>
    </div>

    <form method="POST" action="{{ route('employer.jobs.store') }}" class="space-y-6">
        @csrf

        <!-- Title -->
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Job Title</label>
            <input type="text" name="title" required value="{{ old('title') }}" placeholder="e.g. Senior Frontend Software Engineer" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('title') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-6">
            <!-- Job Type -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Job Type</label>
                <select name="job_type" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Job Type</option>
                    <option value="full_time" {{ old('job_type') == 'full_time' ? 'selected' : '' }}>Full-time</option>
                    <option value="part_time" {{ old('job_type') == 'part_time' ? 'selected' : '' }}>Part-time</option>
                    <option value="internship" {{ old('job_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                    <option value="contract" {{ old('job_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                </select>
            </div>

            <!-- Location -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Primary Location</label>
                <input type="text" name="location" value="{{ old('location') }}" placeholder="San Francisco, CA or Remote" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <!-- Salary -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Salary ($)</label>
                <input type="number" step="0.01" name="salary" value="{{ old('salary') }}" placeholder="120000" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Deadline -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Application Deadline</label>
                <input type="date" name="deadline" value="{{ old('deadline') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Job Description</label>
            <textarea name="description" rows="5" required placeholder="Describe responsibilities and requirements..." class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
            @error('description') <span class="text-xs text-rose-500 mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="pt-4 flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-xl transition shadow-md">
                Publish Job Listing
            </button>
        </div>
    </form>
</div>
@endsection