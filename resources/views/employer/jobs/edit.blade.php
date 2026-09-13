@extends('layouts.employer')

@section('page_title', 'Edit Job')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
    <h2 class="text-2xl font-bold text-slate-800 mb-6">Edit Job Listing</h2>
    
    <form method="POST" action="{{ route('employer.jobs.index') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Job Title</label>
            <input type="text" name="title" value="{{ $job->title }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
            <textarea name="description" rows="5" required class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm">{{ $job->description }}</textarea>
        </div>
        <div class="flex justify-end gap-4">
            <a href="{{ route('employer.jobs.index') }}" class="px-6 py-3 border border-slate-200 rounded-xl text-sm font-semibold text-slate-600">Cancel</a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-xl text-sm font-semibold">Update Job</button>
        </div>
    </form>
</div>
@endsection