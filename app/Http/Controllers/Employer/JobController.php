<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $jobs = Job::where('user_id', $request->user()->id)
            ->withCount('applications')
            ->latest()
            ->paginate(10);

        return view('employer.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('employer.jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'salary'      => 'nullable|numeric|min:0',
            'location'    => 'nullable|string|max:255',
            'job_type'    => 'nullable|in:full_time,part_time,internship,contract',
            'deadline'    => 'nullable|date|after_or_equal:today',
        ]);

        $request->user()->jobs()->create($validated);

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job posted successfully!');
    }
}