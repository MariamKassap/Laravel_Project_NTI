<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;

class DashboardController extends Controller
{
    public function index()
    {
        $employee = Auth::user();

        $totalApplications = Application::where('user_id', $employee->id)->count();

        $acceptedApplications = Application::where('user_id', $employee->id)->where('status', 'accepted')->count();

        $pendingApplications = Application::where('user_id', $employee->id)->where('status', 'pending')->count();

        $waitingApplications = Application::where('user_id', $employee->id)->where('status', 'waiting_list')->count();

        $rejectedApplications = Application::where('user_id', $employee->id)->where('status', 'rejected')->count();

        $recentApplications = Application::where('user_id', $employee->id)->with('job')->latest()->take(5)->get();

        $availableJobs = Job::whereDoesntHave('applications', function ($query) {
            $query->where('user_id', Auth::id());
        })->latest()->take(5)->get();


        return view('employee.dashboard', compact(
            'employee',
            'totalApplications',
            'acceptedApplications',
            'pendingApplications',
            'waitingApplications',
            'rejectedApplications',
            'recentApplications',
            'availableJobs'
        ));
    }
}
