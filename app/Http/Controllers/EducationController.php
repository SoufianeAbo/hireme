<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function deleteEducation(Request $request): RedirectResponse
    {
        $education = Education::find($request->input('id'));

        $education->delete();

        return redirect()->back();
    }
}
