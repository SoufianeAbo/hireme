<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Competence;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Language;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Spatie\LaravelPdf\Facades\Pdf;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = Auth::user();

        if ($user->role === 'company') {
            return view('profile.editcompany', [
                'user' => $request->user(),
            ]);
        } else {
            return view('profile.edit', [
                'user' => $request->user(),
            ]);
        }
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

        if ($request->hasFile('pfp')) {
            $request->user()->pfp = $request->file('pfp')->store('pfp', 'public');
            
        }

        if ($request->hasFile('logo')) {
            $request->user()->logo = $request->file('logo')->store('logo', 'public');
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function add(Request $request)
    {
        $user = Auth::user();
        $userId = auth()->user()->id;

        if ($request->filled('competence')) {
            Competence::create([
                'user_id' => $userId,
                'name' => $request->input('competence'),
            ]);
        }
        
        if ($request->filled('experience')) {
            Experience::create([
                'user_id' => $userId,
                'name' => $request->input('experience'),
            ]);
        }
        
        if ($request->filled('education')) {
            Education::create([
                'user_id' => $userId,
                'name' => $request->input('education'),
            ]);
        }
        
        if ($request->filled('langue')) {
            Language::create([
                'user_id' => $userId,
                'name' => $request->input('langue'),
            ]);
        }

        $directory = '/public/cvs/' . $user->email . '.pdf';
        $pfpUrl = asset('$user->pfp');

        return redirect()->back()->with('success', 'Data inserted successfully.');
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
}
