<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MonitorReportController;

// Route publique
Route::get('/', function () {
    return redirect()->route('login');
});

// Routes publiques pour les avis des colons
Route::get('/avis', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('/avis', [FeedbackController::class, 'store'])->name('feedback.store');

// Routes pour les rapports des moniteurs
Route::get('/rapport', [MonitorReportController::class, 'create'])->name('monitor-report.create');
Route::post('/rapport', [MonitorReportController::class, 'store'])->name('monitor-report.store');

// Routes nécessitant une authentification
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Le tableau de bord est accessible à tous les utilisateurs connectés.
    // Le contrôleur se charge d'afficher la vue appropriée en fonction du rôle.
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Routes de gestion du profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes sécurisées par rôle

    // Routes pour Moniteur uniquement (création)
    Route::middleware('role:moniteur')->group(function () {
        Route::get('/incidents/create', [IncidentController::class, 'create'])->name('incidents.create');
        Route::post('/incidents', [IncidentController::class, 'store'])->name('incidents.store');
        Route::get('/attendances/create', [AttendanceController::class, 'create'])->name('attendances.create');
        Route::post('/attendances', [AttendanceController::class, 'store'])->name('attendances.store');
    });

    // Routes pour Admin, Directeur, Infirmier
    Route::middleware('role:administrateur,directeur,infirmier')->group(function () {
        Route::get('/incidents', [IncidentController::class, 'index'])->name('incidents.index');
        Route::get('/incidents/{incident}', [IncidentController::class, 'show'])->name('incidents.show');
        Route::put('/incidents/{incident}', [IncidentController::class, 'update'])->name('incidents.update');
    });

    // Routes pour Admin et Directeur uniquement
        Route::middleware('role:administrateur,directeur')->group(function () {
        Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
        Route::get('/rapports', [MonitorReportController::class, 'index'])->name('monitor-report.index');
        Route::get('/rapports/{report}', [MonitorReportController::class, 'show'])->name('monitor-report.show');
        Route::get('/children', [ChildController::class, 'index'])->name('children.index');
        Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
        Route::get('/reports/daily', [ReportController::class, 'generateDailyReport'])->name('reports.daily');
    });
});

Route::get('/programme', [ProgrammeController::class, 'index'])->middleware(['auth'])->name('programme');

require __DIR__ . '/auth.php';
