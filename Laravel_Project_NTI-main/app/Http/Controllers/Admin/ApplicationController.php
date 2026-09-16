<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with(['user', 'job'])->latest()->paginate(10);
        return view('admin.applications.index', compact('applications'));
    }

    public function destroy(Application $application)
    {
        $application->delete();
        return back()->with('success', 'تم حذف الطلب بنجاح');
    }
}