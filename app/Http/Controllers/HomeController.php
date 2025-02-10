<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        $mostReservedAccommodationTypes = DB::table('reservations')
            ->join('accommodations', 'reservations.accommodation_id', '=', 'accommodations.id')
            ->join('accommodation_types', 'accommodations.accommodation_type_id', '=', 'accommodation_types.id')
            ->select('accommodation_types.name', DB::raw('COUNT(*) as total_reservations'))
            ->groupBy('accommodation_types.name')
            ->orderByDesc('total_reservations')
            ->get();

        $usersNationalities = User::select('nationality')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('nationality')
            ->get();
        $mostSoldProducts = Product::select('products.id', 'products.name', DB::raw('SUM(orders_products.quantity) as total_sold'))
            ->join('orders_products', 'products.id', '=', 'orders_products.product_id')
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();
        return view('pages.dashboard', compact('mostSoldProducts','usersNationalities', 'mostReservedAccommodationTypes', 'totalUsers', 'newClientsToday', 'totalActivities', 'totalAccommodations', 'currentYear'));
    }


    /**
     * Fetch data for the Sales Overview Chart.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function salesOverview()
    {
        // Agrega as vendas (soma de price) por mês, utilizando a tabela 'orders'
        $ordersData = DB::table('orders')
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(price) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->limit(10) // se quiseres limitar a 10 meses (opcional)
            ->get();

        // Converte o número do mês para abreviação (Jan, Feb, etc.)
        $labels = $ordersData->pluck('month')->map(function ($month) {
            return date('M', mktime(0, 0, 0, $month, 1));
        });

        // Extrai os totais de vendas por mês
        $totals = $ordersData->pluck('total');

        return response()->json([
            'labels' => $labels,
            'totals' => $totals,
        ]);
    }
}
