<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Request $request, Job $job)
    {
        // Make sure this job belongs to the logged-in employer
        if ($job->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized access.');
        }

        // Get applications ONLY for this specific job
        $applications = Application::where('job_id', $job->id)
            ->with(['employee', 'job', 'cv'])
            ->latest()
            ->paginate(10);

        return view('employer.applications.index', compact('applications', 'job'));
    }


    public function show(Request $request, Application $application)
    {
        // Make sure this application belongs to one of this employer's jobs
        if ($application->job->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized access.');
        }

        $application->load(['employee', 'job', 'cv']);

        return view('employer.applications.show', compact('application'));
    }


    public function updateStatus(Request $request, Application $application)
    {
        // Make sure this application belongs to one of this employer's jobs
        if ($application->job->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,waiting_list,accepted,rejected',
        ]);

        $application->update([
            'status' => $validated['status'],
        ]);

        return redirect()->back()
            ->with('success', 'Application status updated successfully!');
    }
}
