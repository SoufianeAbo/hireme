<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function deleteLanguage(Request $request): RedirectResponse
    {
        $language = Language::find($request->input('id'));

        $language->delete();

        return redirect()->back();
    }
}
