<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmployerProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('employer.profile', compact('user'));
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        $path = $request->file('image')->store('profiles', 'public');

        $user->update([
            'image' => $path,
        ]);

        return redirect()->back()->with('success', 'Profile image updated successfully!');
    }
}