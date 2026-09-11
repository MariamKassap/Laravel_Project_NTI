<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of jobs posted by the employer.
     */
    public function index(Request $request)
    {
        $jobs = Job::where('user_id', $request->user()->id)
            ->withCount('applications')
            ->latest()
            ->paginate(10);

        return view('employer.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new job.
     */
    public function create()
    {
        return view('employer.jobs.create');
    }

    /**
     * Store a newly created job in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|string|max:255',
            'job_type'    => 'required|string', // e.g., Full-time, Part-time
            'location'    => 'required|string|max:255',
            'salary_min'  => 'nullable|numeric|min:0',
            'salary_max'  => 'nullable|numeric|gte:salary_min',
            'description' => 'required|string',
            'deadline'    => 'nullable|date|after:today',
        ]);

        $request->user()->jobs()->create($validated);

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job posted successfully!');
    }

    /**
     * Show the form for editing the specified job.
     */
    public function edit(Job $job)
    {
        $this->authorize('update', $job);

        return view('employer.jobs.edit', compact('job'));
    }

    /**
     * Update the specified job in the database.
     */
    public function update(Request $request, Job $job)
    {
        $this->authorize('update', $job);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|string|max:255',
            'job_type'    => 'required|string',
            'location'    => 'required|string|max:255',
            'salary_min'  => 'nullable|numeric|min:0',
            'salary_max'  => 'nullable|numeric|gte:salary_min',
            'description' => 'required|string',
            'status'      => 'required|in:active,draft,closed,expired',
            'deadline'    => 'nullable|date',
        ]);

        $job->update($validated);

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job updated successfully!');
    }

    /**
     * Remove the specified job from the database.
     */
    public function destroy(Job $job)
    {
        $this->authorize('delete', $job);

        $job->delete();

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job deleted successfully!');
    }
}