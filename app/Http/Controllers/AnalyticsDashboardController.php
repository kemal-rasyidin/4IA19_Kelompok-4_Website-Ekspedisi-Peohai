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

        // 3. Monthly Shipments - berdasarkan entry_period_id
        $bulanIndonesia = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des'
        ];

        $monthlyShipments = EntryMain::select(
            'entry_periods.tahun',
            'entry_periods.bulan',
            DB::raw('count(entry_mains.id) as total')
        )
            ->join('entry_periods', 'entry_mains.entry_period_id', '=', 'entry_periods.id')
            ->groupBy('entry_periods.id', 'entry_periods.tahun', 'entry_periods.bulan')
            ->orderBy('entry_periods.tahun')
            ->orderBy('entry_periods.bulan')
            ->limit(12)
            ->get()
            ->map(function ($item) use ($bulanIndonesia) {
                $date = Carbon::create($item->tahun, $item->bulan, 1);

                return (object) [
                    'month' => $date->format('Y-m'), // Format: "2026-01" - untuk parse
                    'month_label' => $bulanIndonesia[$item->bulan] . ' ' . $item->tahun, // Format: "Jan 2026" - untuk display
                    'total' => $item->total,
                    'tahun' => $item->tahun,
                    'bulan' => $item->bulan
                ];
            });

        // Prediction
        // Prediction - 2 bulan ke depan
        $predictedNextMonth = null;
        $predictedSecondMonth = null;
        $nextMonthLabel = null;
        $secondMonthLabel = null;
        $nextMonthLabelDisplay = null;
        $secondMonthLabelDisplay = null;
        $predictionAccuracy = null;

        if ($monthlyShipments->count() >= 2) {
            // Ambil hanya 2 bulan terakhir untuk prediksi
            $last2Months = $monthlyShipments->slice(-2);

            $y = $last2Months->pluck('total')->values()->toArray();
            $n = count($y);
            $x = range(1, $n);

            $sumX = array_sum($x);
            $sumY = array_sum($y);
            $sumXY = 0;
            $sumX2 = 0;

            for ($i = 0; $i < $n; $i++) {
                $sumXY += $x[$i] * $y[$i];
                $sumX2 += $x[$i] ** 2;
            }

            $denominator = ($n * $sumX2) - ($sumX ** 2);

            if ($denominator != 0) {
                $slope = (($n * $sumXY) - ($sumX * $sumY)) / $denominator;
                $intercept = ($sumY - ($slope * $sumX)) / $n;

                // Prediksi bulan ke-3 (bulan depan)
                $predictedNextMonth = round(($slope * ($n + 1)) + $intercept);
                $predictedNextMonth = max(0, $predictedNextMonth);

                // Prediksi bulan ke-4 (2 bulan ke depan)
                $predictedSecondMonth = round(($slope * ($n + 2)) + $intercept);
                $predictedSecondMonth = max(0, $predictedSecondMonth);

                // Hitung label bulan berikutnya
                $lastMonth = $monthlyShipments->last();

                // Bulan pertama prediksi
                $nextMonth = Carbon::create($lastMonth->tahun, $lastMonth->bulan, 1)->addMonth();
                $nextMonthLabel = $nextMonth->format('Y-m');
                $nextMonthLabelDisplay = $bulanIndonesia[$nextMonth->month] . ' ' . $nextMonth->year;

                // Bulan kedua prediksi
                $secondMonth = Carbon::create($lastMonth->tahun, $lastMonth->bulan, 1)->addMonths(2);
                $secondMonthLabel = $secondMonth->format('Y-m');
                $secondMonthLabelDisplay = $bulanIndonesia[$secondMonth->month] . ' ' . $secondMonth->year;

                // Hitung akurasi menggunakan MAPE (Mean Absolute Percentage Error)
                // Lebih cocok untuk data kecil
                $totalPercentageError = 0;
                $validCount = 0;

                for ($i = 0; $i < $n; $i++) {
                    $yPredicted = ($slope * $x[$i]) + $intercept;
                    if ($y[$i] != 0) { // Hindari division by zero
                        $percentageError = abs(($y[$i] - $yPredicted) / $y[$i]) * 100;
                        $totalPercentageError += $percentageError;
                        $validCount++;
                    }
                }

                if ($validCount > 0) {
                    $mape = $totalPercentageError / $validCount;
                    // Akurasi = 100 - MAPE
                    // Tapi batasi antara 0-100
                    $predictionAccuracy = max(0, min(100, 100 - $mape));
                    $predictionAccuracy = round($predictionAccuracy, 1);
                } else {
                    // Fallback: hitung menggunakan R² dengan penyesuaian
                    $yMean = array_sum($y) / $n;
                    $ssTotal = 0;
                    $ssResidual = 0;

                    for ($i = 0; $i < $n; $i++) {
                        $yPredicted = ($slope * $x[$i]) + $intercept;
                        $ssTotal += ($y[$i] - $yMean) ** 2;
                        $ssResidual += ($y[$i] - $yPredicted) ** 2;
                    }

                    if ($ssTotal > 0) {
                        $rSquared = 1 - ($ssResidual / $ssTotal);
                        // Konversi R² ke persentase dan pastikan tidak negatif
                        $predictionAccuracy = max(0, min(100, $rSquared * 100));
                        $predictionAccuracy = round($predictionAccuracy, 1);
                    } else {
                        // Jika variance = 0 (semua data sama), berarti prediksi sempurna
                        $predictionAccuracy = 100;
                    }
                }
            }
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
            'revenueByCustomer',
            'predictedNextMonth',
            'predictedSecondMonth',  // TAMBAHKAN
            'nextMonthLabel',
            'secondMonthLabel',      // TAMBAHKAN
            'nextMonthLabelDisplay',
            'secondMonthLabelDisplay', // TAMBAHKAN
            'predictionAccuracy'
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
