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

        
        $recentJobs = Job::where('user_id', $userId)
            ->withCount('applications')
            ->latest()
            ->take(5)
            ->get();

        
        $totalJobsCount = Job::where('user_id', $userId)->count();

        
        $totalApplicationsCount = Application::whereHas('job', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();

        return view('employer.dashboard', compact(
            'recentJobs', 
            'totalJobsCount', 
            'totalApplicationsCount'
        ));
    }
}