<?php

use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;
use Spatie\LaravelPdf\Facades\Pdf;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return view('admindashboard');
    } else {
        return view('userdashboard');
    }

})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/add', [ProfileController::class, 'add'])->name('profile.add');
    Route::post('/profile', [CompetenceController::class, 'deleteCompetence'])->name('delete.competence');
    Route::post('/profile', [ExperienceController::class, 'deleteExperience'])->name('delete.experience');
    Route::post('/profile', [EducationController::class, 'deleteEducation'])->name('delete.education');
    Route::post('/profile', [LanguageController::class, 'deleteLanguage'])->name('delete.language');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/download-pdf', function () {
        // try {
        //     $user = Auth::user();
        //     $pfpUrl = asset('storage/' . $user->pfp);
        //     $pdf = PDF::loadView('cv', compact('user', 'pfpUrl'));
        //     return $pdf->download('cv.pdf');
        // } catch (\Exception $e) {
        //     Log::error('Error generating PDF: ' . $e->getMessage());
        //     // Return an error response or redirect to an error page
        //     return response()->json(['error' => 'Failed to generate PDF'], 500);
        // }   

        $user = Auth::user();
        $pfpUrl = asset('storage/' . $user->pfp);
        return Pdf::view('cv', ['user' => $user, 'pfpUrl' => $pfpUrl])->format('a4')->download('cv.pdf');
    })->name('download-pdf');
});

require __DIR__.'/auth.php';
