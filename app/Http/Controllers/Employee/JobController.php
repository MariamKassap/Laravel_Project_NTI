<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Job;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->get();

        return view('employee.jobs.index', compact('jobs'));
    }

    public function show(Job $job)
    {
        $job->load('employer');

        return view('employee.jobs.show', compact('job'));
    }
}
