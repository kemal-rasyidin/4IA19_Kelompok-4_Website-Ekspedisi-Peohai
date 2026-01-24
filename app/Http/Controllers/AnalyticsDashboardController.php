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
     * Predict shipments using multiple methods and choose the best
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

        // Gunakan maksimal 6 bulan terakhir untuk prediksi
        $optimalDataPoints = min(6, $monthlyShipments->count());
        $dataToUse = $monthlyShipments->slice(-$optimalDataPoints);
        $result['dataPointsUsed'] = $dataToUse->count();

        $y = $dataToUse->pluck('total')->values()->toArray();
        $n = count($y);

        // PILIH METODE PREDIKSI TERBAIK
        if ($n >= 4) {
            // Gunakan Weighted Moving Average untuk data >= 4 bulan
            $prediction = $this->predictWithWeightedAverage($y, $n);
            $result['predictionMethod'] = 'Weighted Moving Average';
        } elseif ($n == 3) {
            // Gunakan Exponential Smoothing untuk 3 bulan
            $prediction = $this->predictWithExponentialSmoothing($y, $n);
            $result['predictionMethod'] = 'Exponential Smoothing';
        } else {
            // Gunakan Simple Average untuk 2 bulan
            $prediction = $this->predictWithSimpleAverage($y, $n);
            $result['predictionMethod'] = 'Simple Average';
        }

        $result['predictedNextMonth'] = $prediction['month1'];
        $result['predictedSecondMonth'] = $prediction['month2'];
        $result['predictionAccuracy'] = $prediction['accuracy'];

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
     * Predict using Weighted Moving Average (Best for >= 4 data points)
     * 
     * @param array $y
     * @param int $n
     * @return array
     */
    private function predictWithWeightedAverage($y, $n)
    {
        // Beri bobot lebih besar untuk data terbaru
        $weights = [];
        $totalWeight = 0;

        for ($i = 0; $i < $n; $i++) {
            $weight = $i + 1; // Bobot linear: 1, 2, 3, 4, ...
            $weights[] = $weight;
            $totalWeight += $weight;
        }

        // Hitung weighted average
        $weightedSum = 0;
        for ($i = 0; $i < $n; $i++) {
            $weightedSum += $y[$i] * $weights[$i];
        }
        $weightedAverage = $weightedSum / $totalWeight;

        // Hitung trend (slope sederhana dari 3 bulan terakhir)
        $recentData = array_slice($y, -min(3, $n));
        $recentCount = count($recentData);
        $trend = 0;

        if ($recentCount >= 2) {
            $trend = ($recentData[$recentCount - 1] - $recentData[0]) / $recentCount;
        }

        // Prediksi dengan trend
        $month1 = max(0, round($weightedAverage + $trend));
        $month2 = max(0, round($weightedAverage + (2 * $trend)));

        // Hitung akurasi (berdasarkan konsistensi data)
        $accuracy = $this->calculateSimpleAccuracy($y, $n);

        return [
            'month1' => $month1,
            'month2' => $month2,
            'accuracy' => $accuracy
        ];
    }

    /**
     * Predict using Exponential Smoothing (Best for 3 data points)
     * 
     * @param array $y
     * @param int $n
     * @return array
     */
    private function predictWithExponentialSmoothing($y, $n)
    {
        $alpha = 0.6; // Smoothing factor (0-1), lebih tinggi = lebih responsif ke data terbaru

        $forecast = $y[0];
        for ($i = 1; $i < $n; $i++) {
            $forecast = $alpha * $y[$i] + (1 - $alpha) * $forecast;
        }

        // Hitung trend sederhana
        $trend = ($y[$n - 1] - $y[0]) / $n;

        $month1 = max(0, round($forecast + $trend));
        $month2 = max(0, round($forecast + (2 * $trend)));

        $accuracy = $this->calculateSimpleAccuracy($y, $n);

        return [
            'month1' => $month1,
            'month2' => $month2,
            'accuracy' => $accuracy
        ];
    }

    /**
     * Predict using Simple Average (For 2 data points)
     * 
     * @param array $y
     * @param int $n
     * @return array
     */
    private function predictWithSimpleAverage($y, $n)
    {
        $average = array_sum($y) / $n;
        $trend = $y[$n - 1] - $y[0]; // Trend dari data pertama ke terakhir

        $month1 = max(0, round($average + ($trend / 2)));
        $month2 = max(0, round($average + $trend));

        $accuracy = $this->calculateSimpleAccuracy($y, $n);

        return [
            'month1' => $month1,
            'month2' => $month2,
            'accuracy' => $accuracy
        ];
    }

    /**
     * Calculate simple accuracy based on data consistency (Coefficient of Variation)
     * 
     * @param array $y
     * @param int $n
     * @return float
     */
    private function calculateSimpleAccuracy($y, $n)
    {
        if ($n < 2) {
            return 50; // Default untuk data minimal
        }

        // Hitung coefficient of variation (CV)
        $mean = array_sum($y) / $n;

        if ($mean == 0) {
            return 50;
        }

        $variance = 0;
        for ($i = 0; $i < $n; $i++) {
            $variance += ($y[$i] - $mean) ** 2;
        }
        $stdDev = sqrt($variance / $n);
        $cv = ($stdDev / $mean) * 100; // Coefficient of Variation dalam persen

        // Konversi CV ke accuracy score
        // CV rendah = data konsisten = akurasi tinggi
        // CV tinggi = data volatile = akurasi rendah
        if ($cv <= 10) {
            $accuracy = 95; // Sangat konsisten
        } elseif ($cv <= 20) {
            $accuracy = 90; // Konsisten
        } elseif ($cv <= 30) {
            $accuracy = 85; // Cukup konsisten
        } elseif ($cv <= 40) {
            $accuracy = 75; // Moderat
        } elseif ($cv <= 50) {
            $accuracy = 65; // Cukup volatile
        } elseif ($cv <= 75) {
            $accuracy = 55; // Volatile
        } else {
            $accuracy = 45; // Sangat volatile
        }

        // Bonus akurasi untuk data yang lebih banyak
        $dataBonus = min(15, ($n - 2) * 3); // Maksimal +15% untuk 7+ bulan data

        return min(95, $accuracy + $dataBonus); // Cap maksimal 95%
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
