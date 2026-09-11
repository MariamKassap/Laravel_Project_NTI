<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApplicationController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a list of applications submitted for a specific job.
     */
    public function index(Job $job)
    {
        // 1. Ensure the employer owns this job (or user is Admin)
        $this->authorize('manageApplications', $job);

        // 2. Fetch applications with candidate user details and uploaded CV
        $applications = $job->applications()
            ->with(['user', 'cv'])
            ->latest()
            ->paginate(15);

        return view('employer.applications.index', compact('job', 'applications'));
    }

    /**
     * Update the status of a specific job application.
     */
    public function updateStatus(Request $request, Application $application)
    {
        // 1. Check authorization against the parent Job model
        $this->authorize('manageApplications', $application->job);

        // 2. Validate status input against database enum options
        $validated = $request->validate([
            'status' => 'required|in:pending,waiting_list,accepted,rejected',
        ]);

        // 3. Update application status
        $application->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Application status updated successfully!');
    }
}