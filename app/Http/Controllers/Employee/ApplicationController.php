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

        $query = Application::where('user_id', Auth::id())->with(['job.employer', 'cv']);
        $applications = $query->latest()->paginate(4)->withQueryString();

        return view('employee.applications.index', compact('applications'));
    }

    public function create(Job $job)
    {
        $cvs = CV::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('employee.applications.create', compact('job', 'cvs'));
    }

    // public function store(Request $request, Job $job)
    // {
    //     if ($job->deadline && now()->startOfDay()->gt($job->deadline)) {
    //         return back()->with('error', 'The application deadline has passed.');
    //     }

    //     $employeeId = Auth::id();

    //     if (Application::where('user_id', $employeeId)->where('job_id', $job->id)->exists()) {

    //         return back()->with('error', 'You have already applied for this job.');
    //     }

    //     $request->validate(['cv_id' => 'required|exists:cvs,id',]);

    //     // Make sure the selected CV belongs to this employee
    //     $cv = CV::where('id', $request->cv_id)->where('user_id', $employeeId)->firstOrFail();

    //     Application::create([
    //         'user_id' => $employeeId,
    //         'job_id' => $job->id,
    //         'cv_id' => $cv->id,
    //         'status' => 'pending',
    //     ]);

    //     return redirect()->route('employee.applications.index')->with('success', 'Application submitted successfully.');
    // }

    public function store(Request $request, Job $job)
    {
        if ($job->deadline && now()->startOfDay()->gt($job->deadline)) {
            return back()->with('error', 'The application deadline has passed.');
        }

        $employeeId = Auth::id();

        if (Application::where('user_id', $employeeId)
            ->where('job_id', $job->id)
            ->exists()
        ) {

            return back()->with('error', 'You have already applied for this job.');
        }

        $request->validate([
            'cv_id' => ['nullable', 'integer'],
            'new_cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ]);

        // Employee must choose an existing CV OR upload a new one
        if (!$request->cv_id && !$request->hasFile('new_cv')) {
            return back()->withErrors([
                'cv_id' => 'Please choose an existing CV or upload a new CV.',
            ])->withInput();
        }

        /*
    |--------------------------------------------------------------------------
    | Existing CV
    |--------------------------------------------------------------------------
    */

        if ($request->cv_id) {

            // Make sure the selected CV belongs to this employee
            $cv = CV::where('id', $request->cv_id)
                ->where('user_id', $employeeId)
                ->firstOrFail();

            /*
    |--------------------------------------------------------------------------
    | New CV
    |--------------------------------------------------------------------------
    */
        } else {

            $path = $request->file('new_cv')->store('cvs', 'public');

            $cv = CV::create([
                'user_id' => $employeeId,
                'title' => 'CV for ' . $job->title,
                'file_path' => $path,
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | Create Application
    |--------------------------------------------------------------------------
    */

        Application::create([
            'user_id' => $employeeId,
            'job_id' => $job->id,
            'cv_id' => $cv->id,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('employee.applications.index')
            ->with('success', 'Application submitted successfully.');
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
