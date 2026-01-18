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
            ->get()
            ->map(function ($item) use ($bulanIndonesia) {
                $date = Carbon::create($item->tahun, $item->bulan, 1);

                return (object) [
                    'month' => $date->format('Y-m'),
                    'month_label' => $bulanIndonesia[$item->bulan] . ' ' . $item->tahun,
                    'total' => $item->total,
                    'tahun' => $item->tahun,
                    'bulan' => $item->bulan
                ];
            });

        // ========== PREDICTION - IMPROVED VERSION ==========
        $predictionResult = $this->predictShipments($monthlyShipments, $bulanIndonesia);

        $predictedNextMonth = $predictionResult['predictedNextMonth'];
        $predictedSecondMonth = $predictionResult['predictedSecondMonth'];
        $nextMonthLabel = $predictionResult['nextMonthLabel'];
        $secondMonthLabel = $predictionResult['secondMonthLabel'];
        $nextMonthLabelDisplay = $predictionResult['nextMonthLabelDisplay'];
        $secondMonthLabelDisplay = $predictionResult['secondMonthLabelDisplay'];
        $predictionAccuracy = $predictionResult['predictionAccuracy'];
        $predictionWarning = $predictionResult['predictionWarning'];
        $predictionMethod = $predictionResult['predictionMethod'];
        $dataPointsUsed = $predictionResult['dataPointsUsed'];

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
            'predictedSecondMonth',
            'nextMonthLabel',
            'secondMonthLabel',
            'nextMonthLabelDisplay',
            'secondMonthLabelDisplay',
            'predictionAccuracy',
            'predictionWarning',
            'predictionMethod',
            'dataPointsUsed'
        ));
    }

    /**
     * Predict shipments using linear regression with improved accuracy
     * 
     * @param \Illuminate\Support\Collection $monthlyShipments
     * @param array $bulanIndonesia
     * @return array
     */
    private function predictShipments($monthlyShipments, $bulanIndonesia)
    {
        $result = [
            'predictedNextMonth' => null,
            'predictedSecondMonth' => null,
            'nextMonthLabel' => null,
            'secondMonthLabel' => null,
            'nextMonthLabelDisplay' => null,
            'secondMonthLabelDisplay' => null,
            'predictionAccuracy' => null,
            'predictionWarning' => null,
            'predictionMethod' => null,
            'dataPointsUsed' => 0
        ];

        // Minimal data requirement check
        if ($monthlyShipments->count() < 2) {
            $result['predictionWarning'] = 'Data historis tidak cukup untuk prediksi (minimal 2 bulan diperlukan)';
            $result['predictionMethod'] = 'none';
            return $result;
        }

        // Determine optimal data points to use (max 6 months, min 2)
        $optimalDataPoints = min(6, $monthlyShipments->count());
        $dataToUse = $monthlyShipments->slice(-$optimalDataPoints);

        $result['dataPointsUsed'] = $dataToUse->count();

        // Extract data for regression
        $y = $dataToUse->pluck('total')->values()->toArray();
        $n = count($y);
        $x = range(1, $n);

        // Calculate regression coefficients
        $sumX = array_sum($x);
        $sumY = array_sum($y);
        $sumXY = 0;
        $sumX2 = 0;

        for ($i = 0; $i < $n; $i++) {
            $sumXY += $x[$i] * $y[$i];
            $sumX2 += $x[$i] ** 2;
        }

        $denominator = ($n * $sumX2) - ($sumX ** 2);

        // Check if regression is possible
        if ($denominator == 0) {
            // All X values are the same (shouldn't happen with our data)
            $result['predictionWarning'] = 'Tidak dapat menghitung prediksi (data tidak valid)';
            $result['predictionMethod'] = 'failed';
            return $result;
        }

        // Calculate slope (m) and intercept (b) for y = mx + b
        $slope = (($n * $sumXY) - ($sumX * $sumY)) / $denominator;
        $intercept = ($sumY - ($slope * $sumX)) / $n;

        // Predict next month (n+1) and second month (n+2)
        $result['predictedNextMonth'] = max(0, round(($slope * ($n + 1)) + $intercept));
        $result['predictedSecondMonth'] = max(0, round(($slope * ($n + 2)) + $intercept));

        // Calculate month labels
        $lastMonth = $monthlyShipments->last();

        // Next month
        $nextMonth = Carbon::create($lastMonth->tahun, $lastMonth->bulan, 1)->addMonth();
        $result['nextMonthLabel'] = $nextMonth->format('Y-m');
        $result['nextMonthLabelDisplay'] = $bulanIndonesia[$nextMonth->month] . ' ' . $nextMonth->year;

        // Second month
        $secondMonth = Carbon::create($lastMonth->tahun, $lastMonth->bulan, 1)->addMonths(2);
        $result['secondMonthLabel'] = $secondMonth->format('Y-m');
        $result['secondMonthLabelDisplay'] = $bulanIndonesia[$secondMonth->month] . ' ' . $secondMonth->year;

        // Calculate prediction accuracy
        $accuracyResult = $this->calculatePredictionAccuracy($x, $y, $slope, $intercept, $n);
        $result['predictionAccuracy'] = $accuracyResult['accuracy'];
        $result['predictionMethod'] = $accuracyResult['method'];

        // Set warning based on data points
        if ($n < 3) {
            $result['predictionWarning'] = 'Prediksi berdasarkan ' . $n . ' bulan data (akurasi terbatas)';
        } elseif ($n < 4) {
            $result['predictionWarning'] = 'Prediksi berdasarkan ' . $n . ' bulan data (akurasi moderat)';
        } else {
            $result['predictionWarning'] = 'Prediksi berdasarkan ' . $n . ' bulan data historis';
        }

        return $result;
    }

    /**
     * Calculate prediction accuracy using appropriate metrics
     * 
     * @param array $x
     * @param array $y
     * @param float $slope
     * @param float $intercept
     * @param int $n
     * @return array
     */
    private function calculatePredictionAccuracy($x, $y, $slope, $intercept, $n)
    {
        $result = [
            'accuracy' => 0,
            'method' => 'unknown'
        ];

        // Method 1: MAPE (Mean Absolute Percentage Error)
        // Better for understanding percentage deviation
        $totalPercentageError = 0;
        $validCount = 0;

        for ($i = 0; $i < $n; $i++) {
            $yPredicted = ($slope * $x[$i]) + $intercept;
            if ($y[$i] != 0) {
                $percentageError = abs(($y[$i] - $yPredicted) / $y[$i]) * 100;
                $totalPercentageError += $percentageError;
                $validCount++;
            }
        }

        if ($validCount > 0) {
            $mape = $totalPercentageError / $validCount;
            // Accuracy = 100 - MAPE, capped at 0-100
            $accuracy = max(0, min(100, 100 - $mape));
            $result['accuracy'] = round($accuracy, 1);
            $result['method'] = 'MAPE';
            return $result;
        }

        // Method 2: R-squared (Coefficient of Determination)
        // Fallback if MAPE can't be calculated
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
            // Convert R² to percentage
            $accuracy = max(0, min(100, $rSquared * 100));
            $result['accuracy'] = round($accuracy, 1);
            $result['method'] = 'R²';
        } else {
            // All Y values are the same (perfect prediction in a sense)
            $result['accuracy'] = 100;
            $result['method'] = 'Perfect (no variance)';
        }

        return $result;
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

        $baseQuery = clone $query;

        $data = [
            'total_shipments' => (clone $baseQuery)->count(),
            'total_revenue' => (clone $baseQuery)->get()->sum(function ($entry) {
                return floatval(str_replace([',', '.'], '', $entry->harga ?? 0));
            }),
            'pending' => (clone $baseQuery)->whereNull('ba')->count(),
            'completed' => (clone $baseQuery)->whereNotNull('ba')->count(),
            'in_transit' => (clone $baseQuery)->whereNull('ba')->whereNotNull('etd')->count(),
        ];

        return response()->json($data);
    }

    /**
     * Get prediction data for AJAX requests
     */
    public function getPrediction(Request $request)
    {
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
            ->get()
            ->map(function ($item) use ($bulanIndonesia) {
                $date = Carbon::create($item->tahun, $item->bulan, 1);

                return (object) [
                    'month' => $date->format('Y-m'),
                    'month_label' => $bulanIndonesia[$item->bulan] . ' ' . $item->tahun,
                    'total' => $item->total,
                    'tahun' => $item->tahun,
                    'bulan' => $item->bulan
                ];
            });

        $prediction = $this->predictShipments($monthlyShipments, $bulanIndonesia);

        return response()->json($prediction);
    }

    /**
     * Export dashboard data
     */
    public function export(Request $request)
    {
        // Implement export logic with maatwebsite/excel
    }
}
