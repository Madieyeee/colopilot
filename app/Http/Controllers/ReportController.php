<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use App\Models\Incident;
use App\Models\Attendance;
use App\Models\Activity;
use App\Models\Child;

class ReportController extends Controller
{
    public function generateDailyReport()
    {
        $today = Carbon::today();

        // 1. Récupérer les données réelles
        $incidents = Incident::with('child', 'user')->whereDate('created_at', $today)->get();
        $attendances = Attendance::with('child')->where('absence_date', $today)->get();
        $activity = Activity::whereDate('date', $today)->first();
        $totalChildren = Child::count();
        $absentCount = $attendances->count();
        $presentChildren = $totalChildren - $absentCount;

        // 2. Préparer les données pour la vue
        $data = [
            'date' => $today,
            'totalChildren' => $totalChildren,
            'presentChildren' => $presentChildren,
            'absentCount' => $absentCount,
            'incidents' => $incidents,
            'attendances' => $attendances,
            'activity' => $activity,
        ];

        $pdf = Pdf::loadView('pdf.daily_report', $data);
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download('rapport-journalier-' . $today->format('Y-m-d') . '.pdf');
    }
    //
}
