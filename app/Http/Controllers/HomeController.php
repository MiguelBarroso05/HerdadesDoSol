<?php

namespace App\Http\Controllers;

use App\Models\user\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $totalUsers = User::count();
        $newClientsToday = User::whereDate('created_at', now()->toDateString())->count();
        $totalActivities = DB::table('activities')->count();
        $totalAccommodations = DB::table('accommodations')->count();
        $currentYear = now()->year;
        $lastYearSales = DB::table('sales')->whereYear('created_at', $currentYear - 1)->sum('price');
        $currentYearSales = DB::table('sales')->whereYear('created_at', $currentYear)->sum('price');
        $salesIncreasePercentage = $lastYearSales > 0 ? round((($currentYearSales - $lastYearSales) / $lastYearSales) * 100) : 0;

        return view('pages.dashboard', compact('totalUsers', 'newClientsToday', 'totalActivities', 'totalAccommodations', 'salesIncreasePercentage', 'currentYear'));
    }


    /**
     * Fetch data for the Sales Overview Chart.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function salesOverview()
    {
        $salesData = DB::table('sales')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(price) as total'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = $salesData->pluck('month')->map(function ($month) {
            return date('M', mktime(0, 0, 0, $month, 1)); // Convert to (Jan, Feb, etc.)
        });

        $totals = $salesData->pluck('total');

        return response()->json(['labels' => $labels, 'totals' => $totals,]);
    }
}
