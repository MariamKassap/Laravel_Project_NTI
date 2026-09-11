<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\CV;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::where('user_id', Auth::id())
            ->with(['job.employer', 'cv'])
            ->latest()
            ->get();

        return view('employee.applications.index', compact('applications'));
    }

    public function create(Job $job)
    {
        $cvs = CV::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('employee.applications.create', compact('job', 'cvs'));
    }

    public function store(Request $request, Job $job)
    {

        $employeeId = Auth::id();

        if (Application::where('user_id', $employeeId)->where('job_id', $job->id)->exists()) {

            return back()->with('error', 'You have already applied for this job.');
        }

        $request->validate(['cv_id' => 'required|exists:cvs,id',]);

        // Make sure the selected CV belongs to this employee
        $cv = CV::where('id', $request->cv_id)->where('user_id', $employeeId)->firstOrFail();

        Application::create([
            'user_id' => $employeeId,
            'job_id' => $job->id,
            'cv_id' => $cv->id,
            'status' => 'pending',
        ]);

        return redirect()->route('employee.applications.index')->with('success', 'Application submitted successfully.');
    }


    public function show(Application $application)
    {
        if ($application->user_id !== Auth::id()) {
            abort(403);
        }

        $application->load(['job.employer', 'cv']);

        return view('employee.applications.show', compact('application'));
    }
}
