<?php

namespace App\Http\Controllers;

use App\Models\EntryMain;
use App\Models\EntryPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get filter parameters
        $filterTahun = $request->get('filter_tahun');
        $filterBulan = $request->get('filter_bulan');
        $filterPeriodId = $request->get('filter_period_id');

        // Get all years for filter dropdown
        $years = EntryPeriod::select('tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        // Get all periods for filter dropdown
        $periods = EntryPeriod::orderByDesc('tahun')
            ->orderByDesc('bulan')
            ->get();

        // Query base dengan filter
        $query = EntryMain::query();

        // Filter by period if selected
        if ($filterPeriodId) {
            $query->where('entry_period_id', $filterPeriodId);
            $activePeriod = EntryPeriod::find($filterPeriodId);
        } else {
            // Filter by tahun and bulan
            $query->whereHas('entryPeriod', function ($q) use ($filterTahun, $filterBulan) {
                if ($filterTahun) {
                    $q->where('tahun', $filterTahun);
                }
                if ($filterBulan) {
                    $q->where('bulan', $filterBulan);
                }
            });

            // Get active period based on filter or latest
            if ($filterTahun && $filterBulan) {
                $activePeriod = EntryPeriod::where('tahun', $filterTahun)
                    ->where('bulan', $filterBulan)
                    ->first();
            } else {
                $activePeriod = EntryPeriod::orderByDesc('tahun')
                    ->orderByDesc('bulan')
                    ->first();
            }
        }

        // Clone query for different statistics
        $baseQuery = clone $query;

        // ========== STATISTIK CARDS ==========

        // Total Shipments
        $totalShipments = (clone $baseQuery)->count();

        // Shipments bulan ini (dari created_at)
        $shipmentsThisMonth = (clone $baseQuery)
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();

        // Total Revenue (konversi harga dari string ke numeric)
        $totalRevenue = (clone $baseQuery)
            ->get()
            ->sum(function ($entry) {
                return floatval(str_replace([',', '.'], '', $entry->harga ?? 0));
            });

        // Revenue bulan ini
        $revenueThisMonth = (clone $baseQuery)
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->get()
            ->sum(function ($entry) {
                return floatval(str_replace([',', '.'], '', $entry->harga ?? 0));
            });

        // Pending Shipments (yang belum ada BA)
        $pendingShipments = (clone $baseQuery)
            ->whereNull('ba')
            ->count();

        // Completed Shipments (yang sudah ada BA)
        $completedShipments = (clone $baseQuery)
            ->whereNotNull('ba')
            ->count();

        // In Transit (ada ETD tapi belum ada BA)
        $inTransitShipments = (clone $baseQuery)
            ->whereNull('ba')
            ->whereNotNull('etd')
            ->count();

        // ========== CHARTS DATA ==========

        // 1. Shipments by Customer (Top 5)
        $shipmentsByCustomer = (clone $baseQuery)
            ->select('customer', DB::raw('count(*) as total'))
            ->whereNotNull('customer')
            ->where('customer', '!=', '')
            ->groupBy('customer')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // 2. Shipments by Status
        $completedCount = (clone $baseQuery)->whereNotNull('ba')->count();
        $inTransitCount = (clone $baseQuery)->whereNull('ba')->whereNotNull('etd')->count();
        $pendingCount = (clone $baseQuery)->whereNull('ba')->whereNull('etd')->count();

        $shipmentsByStatus = [
            ['status' => 'Selesai', 'total' => $completedCount],
            ['status' => 'Dalam Perjalanan', 'total' => $inTransitCount],
            ['status' => 'Menunggu', 'total' => $pendingCount],
        ];

        // 3. Monthly Shipments (6 bulan terakhir atau berdasarkan filter)
        if ($filterTahun && $filterBulan) {
            // Jika ada filter spesifik, ambil data 6 bulan sebelumnya
            $startDate = Carbon::create($filterTahun, $filterBulan, 1)->subMonths(5);
            $endDate = Carbon::create($filterTahun, $filterBulan, 1)->endOfMonth();

            $monthlyShipments = EntryMain::select(
                DB::raw('DATE_FORMAT(tgl_stuffing, "%Y-%m") as month'),
                DB::raw('count(*) as total')
            )
                ->whereBetween('tgl_stuffing', [$startDate, $endDate])
                ->groupBy('month')
                ->orderBy('month')
                ->get();
        } else {
            $monthlyShipments = (clone $baseQuery)
                ->select(
                    DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                    DB::raw('count(*) as total')
                )
                ->where('created_at', '>=', now()->subMonths(6))
                ->groupBy('month')
                ->orderBy('month')
                ->get();
        }

        // 4. Top Destinations
        $topDestinations = (clone $baseQuery)
            ->select('tujuan', DB::raw('count(*) as total'))
            ->whereNotNull('tujuan')
            ->where('tujuan', '!=', '')
            ->groupBy('tujuan')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // 5. Shipments by Jenis Barang
        $shipmentsByJenisBarang = (clone $baseQuery)
            ->select('jenis_barang', DB::raw('count(*) as total'))
            ->whereNotNull('jenis_barang')
            ->where('jenis_barang', '!=', '')
            ->groupBy('jenis_barang')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // 6. Shipments by Pelayaran
        $shipmentsByPelayaran = (clone $baseQuery)
            ->select('pelayaran', DB::raw('count(*) as total'))
            ->whereNotNull('pelayaran')
            ->where('pelayaran', '!=', '')
            ->groupBy('pelayaran')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // ========== RECENT SHIPMENTS ==========
        $recentShipments = (clone $baseQuery)
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        // ========== UPCOMING ETD (7 hari ke depan) ==========
        $upcomingETD = (clone $baseQuery)
            ->whereNotNull('etd')
            ->whereBetween('etd', [now(), now()->addDays(7)])
            ->orderBy('etd')
            ->limit(5)
            ->get();

        // ========== REVENUE BY CUSTOMER ==========
        $revenueByCustomer = (clone $baseQuery)
            ->select('customer')
            ->whereNotNull('customer')
            ->where('customer', '!=', '')
            ->get()
            ->groupBy('customer')
            ->map(function ($entries) {
                return [
                    'total' => $entries->sum(function ($entry) {
                        return floatval(str_replace([',', '.'], '', $entry->harga ?? 0));
                    }),
                    'count' => $entries->count()
                ];
            })
            ->sortByDesc('total')
            ->take(5);

        return view('admin.analytics_dashboard', compact(
            'years',
            'periods',
            'activePeriod',
            'filterTahun',
            'filterBulan',
            'filterPeriodId',
            'totalShipments',
            'shipmentsThisMonth',
            'totalRevenue',
            'revenueThisMonth',
            'pendingShipments',
            'completedShipments',
            'inTransitShipments',
            'shipmentsByCustomer',
            'shipmentsByStatus',
            'monthlyShipments',
            'topDestinations',
            'shipmentsByJenisBarang',
            'shipmentsByPelayaran',
            'recentShipments',
            'upcomingETD',
            'revenueByCustomer'
        ));
    }

    /**
     * Get analytics data for AJAX requests
     */
    public function getAnalytics(Request $request)
    {
        $filterTahun = $request->get('filter_tahun');
        $filterBulan = $request->get('filter_bulan');
        $filterPeriodId = $request->get('filter_period_id');

        $query = EntryMain::query();

        if ($filterPeriodId) {
            $query->where('entry_period_id', $filterPeriodId);
        } else {
            $query->whereHas('entryPeriod', function ($q) use ($filterTahun, $filterBulan) {
                if ($filterTahun) {
                    $q->where('tahun', $filterTahun);
                }
                if ($filterBulan) {
                    $q->where('bulan', $filterBulan);
                }
            });
        }

        $data = [
            'total_shipments' => $query->count(),
            'total_revenue' => $query->get()->sum(function ($entry) {
                return floatval(str_replace([',', '.'], '', $entry->harga ?? 0));
            }),
            'pending' => (clone $query)->whereNull('ba')->count(),
            'completed' => (clone $query)->whereNotNull('ba')->count(),
        ];

        return response()->json($data);
    }

    /**
     * Export dashboard data
     */
    public function export(Request $request)
    {
        // Implement export logic with maatwebsite/excel
    }
}
