<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Category;
use Illuminate\Http\Request;

class JobController extends Controller
{
public function index()
{
    $jobs = Job::with(['category', 'employer'])->latest()->paginate(10);
    return view('admin.jobs.index', compact('jobs'));
}

    public function create()
    {
        $categories = Category::all();
        return view('admin.jobs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        Job::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $category_id = $request->category_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.jobs.index')->with('success', 'Job created successfully!');
    }

    public function edit(Job $job)
    {
        $categories = Category::all();
        return view('admin.jobs.edit', compact('job', 'categories'));
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $job->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.jobs.index')->with('success', 'Job updated successfully!');
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted successfully!');
    }
}