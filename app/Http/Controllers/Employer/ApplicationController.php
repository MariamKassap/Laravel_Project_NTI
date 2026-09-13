<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $applications = Application::whereHas('job', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->with(['user', 'job', 'cv'])
        ->latest()
        ->paginate(10);

        return view('employer.applications.index', compact('applications'));
    }

   
    public function show(Request $request, Application $application)
    {
        
        if ($application->job->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized access.');
        }

        $application->load(['user', 'job', 'cv']);

        return view('employer.applications.show', compact('application'));
    }

    
    public function updateStatus(Request $request, Application $application)
    {
       
        if ($application->job->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,waiting_list,accepted,rejected',
        ]);

        $application->update([
            'status' => $validated['status'],
        ]);

        return redirect()->back()
            ->with('success', 'Application status updated successfully!');
    }
}