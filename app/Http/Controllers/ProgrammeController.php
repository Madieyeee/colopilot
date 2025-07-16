<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProgrammeController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $tomorrow = Carbon::today()->addDay();

        $todayActivity = Activity::whereDate('date', $today)->first();
        $tomorrowActivity = Activity::whereDate('date', $tomorrow)->first();

        return view('programme.index', [
            'today' => $today,
            'tomorrow' => $tomorrow,
            'todayActivity' => $todayActivity,
            'tomorrowActivity' => $tomorrowActivity,
        ]);
    }
}
