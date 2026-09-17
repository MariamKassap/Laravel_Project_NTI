<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\CV;
use App\Models\Application;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            //Employee CV mariam
            'cvs' => $request->user()->isEmployee()
                ? $request->user()->cvs
                : collect(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
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


    //employee CV uploud by mariam 
    public function storeCV(Request $request)
    {
        $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'cv' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ]);

        $path = $request->file('cv')->store('cvs', 'public');

        CV::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'file_path' => $path,
        ]);

        return back()->with('success', 'CV uploaded successfully!');
    }

    public function destroyCV(CV $cv)
    {
        if ($cv->user_id !== Auth::id()) {
            abort(403);
        }

        if (Application::where('cv_id', $cv->id)->exists()) {
            return back()->with(
                'error',
                'You cannot delete this CV because it is being used by an application.'
            );
        }

        if (Storage::disk('public')->exists($cv->file_path)) {
            Storage::disk('public')->delete($cv->file_path);
        }

        $cv->delete();

        return redirect()
            ->back()
            ->with('success', 'CV deleted successfully!')
            ->withFragment('my-cvs');
    }
}
