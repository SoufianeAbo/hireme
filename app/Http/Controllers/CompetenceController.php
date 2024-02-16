<?php

namespace App\Http\Controllers;

use App\Models\Competence;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CompetenceController extends Controller
{
    public function deleteCompetence(Request $request): RedirectResponse
    {
        $competence = Competence::find($request->input('id'));

        $competence->delete();

        return redirect()->back();
    }
}
