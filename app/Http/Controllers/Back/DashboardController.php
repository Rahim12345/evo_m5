<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $visitors = collect();
        $period = now()->subDays(29)->daysUntil(now());

        $visitorData = DB::table('visitors')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->where('created_at', '>=', now()->subDays(29)->startOfDay())
            ->groupBy('date')
            ->get()
            ->pluck('count', 'date');

        foreach ($period as $date) {
            $dateString = $date->format('Y-m-d');
            $visitors->put($dateString, $visitorData[$dateString] ?? 0);
        }

        return view('back.pages.dashboard.index', [
            'visitors' => $visitors,
        ]);
    }
}
