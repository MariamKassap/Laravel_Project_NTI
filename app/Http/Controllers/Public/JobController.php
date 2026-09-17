<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Public jobs browsing - reuses Employee\JobController search logic
     * without auth / application_status filtering.
     * Guest can view, auth gating for Apply is handled in view.
     */
    public function index(Request $request)
    {
        $query = Job::with('employer');

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

        // Optional filter job_type for public
        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }

        $jobs = $query->latest()->paginate(9)->withQueryString();

        return view('public.jobs.index', compact('jobs'));
    }

    public function show(Job $job)
    {
        $job->load('employer');

        return view('public.jobs.show', compact('job'));
    }
}
