<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the employer dashboard with stats and overview lists.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // 1. Fetch Employer's Active Jobs with Applicant Counts
        $activeJobs = Job::where('user_id', $user->id)
            ->where('status', 'active')
            ->withCount('applications')
            ->latest()
            ->take(5)
            ->get();

        // 2. Aggregate Stat Counts
        $activeJobsCount = Job::where('user_id', $user->id)
            ->where('status', 'active')
            ->count();

        $totalApplicantsCount = Application::whereHas('job', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();

        // 3. Fetch Recent Applicants for this Employer's Jobs
        $recentApplicants = Application::whereHas('job', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with(['user', 'job', 'cv'])
        ->latest()
        ->take(5)
        ->get();

        return view('employer.dashboard', compact(
            'activeJobs',
            'activeJobsCount',
            'totalApplicantsCount',
            'recentApplicants'
        ));
    }
}