<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\User;
use App\Models\Incident;
use App\Models\Attendance;
use Carbon\Carbon;
use App\Models\Child;
use App\Http\Controllers\MonitorReportController;

class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord en fonction du rôle de l'utilisateur.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $data = [];

        switch ($user->role) {
            case 'administrateur':
            case 'directeur':
                $data = [
                    'totalGroups' => Group::count(),
                    'totalChildren' => Child::count(),
                    'totalUsers' => User::count(),
                    'groups' => Group::withCount('children')->get(),
                    'absentToday' => Attendance::whereDate('absence_date', Carbon::today())->count(),
                    'incidents' => Incident::with('child')->latest()->take(5)->get(),
                    'attendances' => Attendance::with('child')->latest()->take(5)->get(),
                    'codeDuJour' => MonitorReportController::getCodeDuJour(),
                ];
                break;

            case 'moniteur':
                $group = $user->group;
                if ($group) {
                    // On ne charge les enfants que si le groupe existe
                    $group->load('children');
                }
                $children = $group ? $group->children : collect();
                $data = [
                    'group' => $group,
                    'children' => $children->isNotEmpty() ? $children->sortBy('last_name') : $children,
                ];
                break;

            case 'infirmier':
                $data['incidents'] = Incident::where('type', 'médical')
                    ->with('child')
                    ->latest()
                    ->take(10)
                    ->get();
                break;
        }

        return view('dashboard', $data);
    }
}
