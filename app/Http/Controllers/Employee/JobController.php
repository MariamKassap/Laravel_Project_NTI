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
        // Search by job title, location, or company name
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('location', 'like', '%' . $search . '%')
                    ->orWhereHas('employer', function ($q) use ($search) {
                        $q->where('company', 'like', '%' . $search . '%');
                    });
            });
        }
        //filter applied and not applied jobs
        if ($request->filled('application_status')) {

            $appliedJobIds = Application::where('user_id', $employeeId)->pluck('job_id');

            if ($request->application_status === 'applied') {
                $query->whereIn('id', $appliedJobIds);
            }

            if ($request->application_status === 'not_applied') {
                $query->whereNotIn('id', $appliedJobIds);
            }
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
