<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{

    public function index(Request $request)
    {
        $employeeId = Auth::id();

        $query = Job::with('employer');
        //search by job title 
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        //gey jobs with pagination
        $jobs = $query->latest()->paginate(6)->withQueryString();

        $appliedJobIds = Application::where('user_id', $employeeId)->pluck('job_id')->toArray();

        return view('employee.jobs.index', compact('jobs', 'appliedJobIds'));
    }

    public function show(Job $job)
    {
        $job->load('employer');

        return view('employee.jobs.show', compact('job'));
    }
}
