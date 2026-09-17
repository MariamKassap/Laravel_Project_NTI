<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        // Active jobs
        // Jobs with no deadline are also considered active.
        $activeJobsCount = Job::where('user_id', $userId)
            ->where(function ($query) {
                $query->whereNull('deadline')
                    ->orWhereDate('deadline', '>=', today());
            })
            ->count();

        // Expired jobs
        $expiredJobsCount = Job::where('user_id', $userId)
            ->whereDate('deadline', '<', today())
            ->count();

        // All applications for this employer's jobs
        $totalApplicationsCount = Application::whereHas('job', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();

        // Accepted applications
        $acceptedApplicationsCount = Application::whereHas('job', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->where('status', 'accepted')
            ->count();

        // Recent jobs
        $recentJobs = Job::where('user_id', $userId)
            ->withCount('applications')
            ->latest()
            ->take(5)
            ->get();

        return view('employer.dashboard', compact(
            'recentJobs',
            'activeJobsCount',
            'expiredJobsCount',
            'totalApplicationsCount',
            'acceptedApplicationsCount'
        ));
    }
}
