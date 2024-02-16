<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function deleteExperience(Request $request): RedirectResponse
    {
        $experience = Experience::find($request->input('id'));

        $experience->delete();

        return redirect()->back();
    }
}

