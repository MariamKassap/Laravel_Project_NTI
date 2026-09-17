<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class JobController extends Controller
{
    public function index(Request $request)
    {
        $jobs = Job::where('user_id', $request->user()->id)
            ->withCount('applications')
            ->latest()
            ->paginate(6);

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
    public function edit(Job $job)
    {
        if ($job->user_id !== Auth::id()) {
            abort(403);
        }

        return view('employer.jobs.edit', compact('job'));
    }

    public function show(Job $job)
    {
        if ($job->user_id !== Auth::id()) {
            abort(403);
        }

        return view('employer.jobs.show', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        if ($job->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'salary'      => 'nullable|numeric|min:0',
            'location'    => 'nullable|string|max:255',
            'job_type'    => 'nullable|in:full_time,part_time,internship,contract',
            'deadline'    => 'nullable|date|after_or_equal:today',
        ]);

        $job->update($validated);

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job updated successfully!');
    }
    public function destroy(Job $job)
    {
        if ($job->user_id !== Auth::id()) {
            abort(403);
        }

        $job->delete();

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job deleted successfully!');
    }
}
