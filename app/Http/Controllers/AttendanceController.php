<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Child;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    /**
     * Affiche une liste paginée de toutes les absences.
     */
    public function index(): View
    {
        $attendances = Attendance::with('child', 'user')->latest()->paginate(15);
        return view('attendances.index', compact('attendances'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle absence.
     */
    public function create(): View
    {
        $monitor = Auth::user();
        // On s'assure de ne récupérer que les enfants du groupe du moniteur connecté
        $children = $monitor->group ? $monitor->group->children()->orderBy('last_name')->get() : collect();
        return view('attendances.create', compact('children'));
    }

    /**
     * Enregistre une nouvelle absence dans la base de données.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'child_id' => 'required|exists:children,id',
            'absence_date' => 'required|date',
            'reason' => 'nullable|string|max:1000',
        ]);

        Attendance::create([
            'child_id' => $request->child_id,
            'user_id' => Auth::id(),
            'absence_date' => $request->absence_date,
            'reason' => $request->reason,
        ]);

        return redirect()->route('dashboard')->with('success', 'Absence signalée avec succès.');
    }
}
