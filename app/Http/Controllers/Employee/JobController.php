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

        // Search
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

        // Jobs employee already applied to
        $appliedJobIds = Application::where('user_id', $employeeId)
            ->pluck('job_id')
            ->toArray();

        // Application filter
        if ($request->application_status === 'applied') {

            // Show applied jobs
            $query->whereIn('id', $appliedJobIds);
        } elseif ($request->application_status === 'all') {

            // Show all jobs
            // No additional filter

        } else {

            // DEFAULT: Show NOT APPLIED jobs
            $query->whereNotIn('id', $appliedJobIds);
        }

        // Pagination happens AFTER filtering
        $jobs = $query->latest()
            ->paginate(6)
            ->withQueryString();

        return view('employee.jobs.index', compact(
            'jobs',
            'appliedJobIds'
        ));
    }

    public function show(Job $job)
    {
        $job->load('employer');

        $application = Application::where('user_id', Auth::id())
            ->where('job_id', $job->id)
            ->first();

        return view('employee.jobs.show', compact('job', 'application'));
    }
}
