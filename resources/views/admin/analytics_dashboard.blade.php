<x-admin.layout>
    <div class="space-y-6 animate-fadeInUp">

        <!-- Header -->
        <div class="bg-blue-500 overflow-hidden shadow-md rounded-lg text-lg font-semibold text-white">
            <div class="p-6 text-gray-100">
                {{ __('Dashboard Analitik') }}
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white overflow-hidden shadow-md rounded-lg">
            <div class="p-6">
                <form method="GET" action="{{ route('analytics_dashboard') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-[1fr_1fr_auto] gap-3 items-end">

                        <!-- Filter Tahun -->
                        <div>
                            <label for="filter_tahun" class="block text-sm font-medium text-gray-700 mb-1">
                                Filter Tahun
                            </label>
                            <select name="filter_tahun" id="filter_tahun"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                                <option value="">Semua Tahun</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" {{ $filterTahun == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filter Bulan -->
                        <div>
                            <label for="filter_bulan" class="block text-sm font-medium text-gray-700 mb-1">
                                Filter Bulan
                            </label>
                            <select name="filter_bulan" id="filter_bulan"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                                <option value="">Semua Bulan</option>
                                @php
                                    $bulanList = [
                                        1 => 'Januari',
                                        2 => 'Februari',
                                        3 => 'Maret',
                                        4 => 'April',
                                        5 => 'Mei',
                                        6 => 'Juni',
                                        7 => 'Juli',
                                        8 => 'Agustus',
                                        9 => 'September',
                                        10 => 'Oktober',
                                        11 => 'November',
                                        12 => 'Desember',
                                    ];
                                @endphp
                                @foreach ($bulanList as $key => $value)
                                    <option value="{{ $key }}" {{ $filterBulan == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-2">
                            <button type="submit"
                                class="px-6 py-2 border border-blue-500 bg-blue-50 text-blue-600 hover:text-white hover:bg-blue-500 rounded-md font-semibold shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l5.6 5.6q.275.275.275.7t-.275.7t-.7.275t-.7-.275l-5.6-5.6q-.75.6-1.725.95T9.5 16m0-2q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14" />
                                </svg>
                            </button>
                            <a href="{{ route('analytics_dashboard') }}"
                                class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md font-semibold shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M12 20q-3.35 0-5.675-2.325T4 12t2.325-5.675T12 4q1.725 0 3.3.712T18 6.75V4h2v7h-7V9h4.2q-.8-1.4-2.187-2.2T12 6Q9.5 6 7.75 7.75T6 12t1.75 4.25T12 18q1.925 0 3.475-1.1T17.65 14h2.1q-.7 2.65-2.85 4.325T12 20" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Active Filters Display -->
                    @if ($filterTahun || $filterBulan)
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="text-sm text-gray-600">Filter aktif:</span>

                            @if ($filterTahun)
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Tahun: {{ $filterTahun }}
                                    <a href="{{ route('analytics_dashboard', array_filter(request()->except('filter_tahun'))) }}"
                                        class="ml-2 text-blue-600 hover:text-blue-800">×</a>
                                </span>
                            @endif

                            @if ($filterBulan)
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    Bulan: {{ $bulanList[$filterBulan] }}
                                    <a href="{{ route('analytics_dashboard', array_filter(request()->except('filter_bulan'))) }}"
                                        class="ml-2 text-purple-600 hover:text-purple-800">×</a>
                                </span>
                            @endif
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="group relative bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-200 hover:shadow-2xl hover:border-blue-300 transition-all duration-300 transform hover:-translate-y-1 animate-slideInRight"
                style="animation-delay: 0.1s">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-blue-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-600 mb-1">Total Logistik</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ number_format($totalShipments) }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                                    <p class="text-sm">Jumlah logistik</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="group relative bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-200 hover:shadow-2xl hover:border-yellow-300 transition-all duration-300 transform hover:-translate-y-1 animate-slideInRight"
                style="animation-delay: 0.4s">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-yellow-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-600 mb-1">Menunggu</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $pendingShipments }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                                    <p class="text-sm">Memerlukan perhatian</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="group relative bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-200 hover:shadow-2xl hover:border-purple-300 transition-all duration-300 transform hover:-translate-y-1 animate-slideInRight"
                style="animation-delay: 0.3s">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-purple-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="relative p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-600 mb-1">Selesai</p>
                                    <p class="text-2xl font-bold text-gray-900">
                                        {{ $completedShipments }}</p>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                    <p class="text-sm"><span
                                            class="text-green-600">{{ $totalShipments > 0 ? number_format(($completedShipments / $totalShipments) * 100, 1) : 0 }}%</span>
                                        tingkat keberhasilan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PREDICTION CARD - IMPROVED -->
        @if ($predictedNextMonth !== null)
            <div
                class="bg-gradient-to-br from-indigo-50 to-purple-50 shadow-lg rounded-2xl overflow-hidden border-2 border-indigo-200">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">Prediksi Logistik</h3>
                                    <p class="text-xs text-gray-500">Menggunakan {{ $dataPointsUsed ?? 2 }} bulan data
                                        ({{ $predictionMethod ?? 'Linear Regression' }})</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <!-- Prediksi Bulan 1 -->
                                <div class="bg-white rounded-xl p-4 shadow-md border-l-4 border-indigo-500">
                                    <p class="text-xs font-medium text-gray-600 mb-1">{{ $nextMonthLabelDisplay }}</p>
                                    <p
                                        class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                        {{ number_format($predictedNextMonth) }}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">shipments</p>
                                </div>

                                <!-- Prediksi Bulan 2 -->
                                @if ($predictedSecondMonth !== null)
                                    <div class="bg-white rounded-xl p-4 shadow-md border-l-4 border-purple-500">
                                        <p class="text-xs font-medium text-gray-600 mb-1">
                                            {{ $secondMonthLabelDisplay }}</p>
                                        <p
                                            class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                                            {{ number_format($predictedSecondMonth) }}
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">shipments</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Accuracy Badge -->
                            {{-- @if ($predictionAccuracy !== null)
                                <div
                                    class="mb-3 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                    {{ $predictionAccuracy >= 80 ? 'bg-green-100 text-green-800' : ($predictionAccuracy >= 60 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Tingkat Akurasi: {{ $predictionAccuracy }}%
                                </div>
                            @endif --}}

                            <!-- Warning/Info -->
                            @if ($predictionWarning)
                                <div
                                    class="flex items-start space-x-2 text-xs bg-white rounded-lg p-3 border-l-4 
                                    {{ $dataPointsUsed < 3 ? 'border-yellow-400 bg-yellow-50' : 'border-blue-400 bg-blue-50' }}">
                                    <svg class="h-4 w-4 {{ $dataPointsUsed < 3 ? 'text-yellow-500' : 'text-blue-500' }} flex-shrink-0 mt-0.5"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>
                                        <p
                                            class="{{ $dataPointsUsed < 3 ? 'text-yellow-700' : 'text-blue-700' }} font-medium">
                                            {{ $predictionWarning }}</p>
                                        <p
                                            class="{{ $dataPointsUsed < 3 ? 'text-yellow-600' : 'text-blue-600' }} mt-1">
                                            Prediksi ini menggunakan metode regresi linear. Akurasi akan meningkat
                                            seiring bertambahnya data historis.
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- No Prediction Available -->
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700 font-medium">
                            {{ $predictionWarning ?? 'Data historis tidak cukup untuk membuat prediksi' }}
                        </p>
                        <p class="text-xs text-yellow-600 mt-1">
                            Minimal 2 bulan data diperlukan untuk prediksi logistik.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Charts Row 1 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Logistik Bulanan</h3>
                <canvas id="monthlyChart" class="w-full" style="max-height: 300px;"></canvas>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Logistik</h3>
                <canvas id="statusChart" class="w-full" style="max-height: 300px;"></canvas>
            </div>
        </div>

        <!-- Charts Row 2 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Top Customers -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Top 5 Customers</h3>
                <div class="space-y-4">
                    @php
                        $maxCount = $shipmentsByCustomer->max('total') ?? 1;
                    @endphp
                    @forelse($shipmentsByCustomer as $item)
                        <div class="flex items-center">
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-sm font-medium text-gray-700">{{ $item->customer }}</span>
                                    <span class="text-sm text-gray-500">{{ $item->total }} shipments</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full transition-all duration-300"
                                        style="width: {{ ($item->total / $maxCount) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Belum ada data customer</p>
                    @endforelse
                </div>
            </div>

            <!-- Top Destinations -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Top 5 Tujuan</h3>
                <canvas id="destinationChart" class="w-full" style="max-height: 300px;"></canvas>
            </div>
        </div>

        <!-- Charts Row 3 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Shipments by Pelayaran -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Top 5 Pelayaran</h3>
                <canvas id="pelayaranChart" class="w-full" style="max-height: 300px;"></canvas>
            </div>

            <!-- Shipments by Jenis Barang -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Top 5 Jenis Barang</h3>
                <canvas id="jenisBarangChart" class="w-full" style="max-height: 300px;"></canvas>
            </div>
        </div>

        <!-- Upcoming ETD -->
        @if ($upcomingETD->count() > 0)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-yellow-50">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="h-5 w-5 text-yellow-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        ETD 7 Hari Ke Depan
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No.
                                    Container
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Kapal
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tujuan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ETD</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($upcomingETD as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $item->no_cont }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $item->customer }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $item->nama_kapal }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->tujuan }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 font-medium">
                                        {{ \Carbon\Carbon::parse($item->etd)->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Recent Shipments Table -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Logistik Terbaru</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Container
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tujuan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ETD</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recentShipments as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $item->no_cont }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->customer }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->tujuan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $item->etd ? \Carbon\Carbon::parse($item->etd)->format('d M Y') : '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($item->ba)
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                                    @elseif($item->etd)
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Dalam
                                            Perjalanan</span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp
                                    {{ number_format(floatval(str_replace([',', '.'], '', $item->harga ?? 0)), 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data shipment
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Monthly Shipments Chart with 2 Predictions - FIXED
        const monthlyCtx = document.getElementById('monthlyChart');

        if (monthlyCtx) {
            const ctx = monthlyCtx.getContext('2d');

            const historicalData = [
                @foreach ($monthlyShipments as $month)
                    {{ $month->total }},
                @endforeach
            ];

            const labels = [
                @foreach ($monthlyShipments as $month)
                    '{{ $month->month_label }}',
                @endforeach
                @if (isset($predictedNextMonth) && $predictedNextMonth !== null)
                    '{{ $nextMonthLabelDisplay }}',
                @endif
                @if (isset($predictedSecondMonth) && $predictedSecondMonth !== null)
                    '{{ $secondMonthLabelDisplay }}'
                @endif
            ];

            const allData = [
                ...historicalData,
                @if (isset($predictedNextMonth) && $predictedNextMonth !== null)
                    {{ $predictedNextMonth }},
                @endif
                @if (isset($predictedSecondMonth) && $predictedSecondMonth !== null)
                    {{ $predictedSecondMonth }}
                @endif
            ];

            const predictionStartIndex = historicalData.length - 1;

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Shipments',
                        data: allData,
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true,
                        segment: {
                            borderDash: ctx => {
                                return ctx.p0DataIndex >= predictionStartIndex ? [5, 5] : [];
                            },
                            borderColor: ctx => {
                                return ctx.p0DataIndex >= predictionStartIndex ? 'rgb(147, 51, 234)' :
                                    'rgb(59, 130, 246)';
                            }
                        },
                        pointBackgroundColor: (context) => {
                            return context.dataIndex >= historicalData.length ? 'rgb(147, 51, 234)' :
                                'rgb(59, 130, 246)';
                        },
                        pointBorderColor: (context) => {
                            return context.dataIndex >= historicalData.length ? 'rgb(147, 51, 234)' :
                                'rgb(59, 130, 246)';
                        },
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = 'Shipments: ' + context.parsed.y;
                                    if (context.dataIndex >= historicalData.length) {
                                        label += ' (Prediksi)';
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                callback: function(value) {
                                    return Math.floor(value);
                                }
                            }
                        }
                    }
                }
            });
        }

        // Status Chart
        const statusCtx = document.getElementById('statusChart');
        if (statusCtx) {
            new Chart(statusCtx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: [
                        @foreach ($shipmentsByStatus as $status)
                            '{{ $status['status'] }}',
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($shipmentsByStatus as $status)
                                {{ $status['total'] }},
                            @endforeach
                        ],
                        backgroundColor: [
                            'rgb(34, 197, 94)',
                            'rgb(59, 130, 246)',
                            'rgb(234, 179, 8)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // Destination Chart
        const destCtx = document.getElementById('destinationChart');
        if (destCtx) {
            new Chart(destCtx.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: [
                        @foreach ($topDestinations as $dest)
                            '{{ $dest->tujuan }}',
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Shipments',
                        data: [
                            @foreach ($topDestinations as $dest)
                                {{ $dest->total }},
                            @endforeach
                        ],
                        backgroundColor: 'rgb(147, 51, 234)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }

        // Pelayaran Chart
        const pelayaranCtx = document.getElementById('pelayaranChart');
        if (pelayaranCtx) {
            new Chart(pelayaranCtx.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: [
                        @foreach ($shipmentsByPelayaran as $pel)
                            '{{ $pel->pelayaran }}',
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Shipments',
                        data: [
                            @foreach ($shipmentsByPelayaran as $pel)
                                {{ $pel->total }},
                            @endforeach
                        ],
                        backgroundColor: 'rgb(239, 68, 68)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }

        // Jenis Barang Chart
        const jenisBarangCtx = document.getElementById('jenisBarangChart');
        if (jenisBarangCtx) {
            new Chart(jenisBarangCtx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: [
                        @foreach ($shipmentsByJenisBarang as $jenis)
                            '{{ $jenis->jenis_barang }}',
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($shipmentsByJenisBarang as $jenis)
                                {{ $jenis->total }},
                            @endforeach
                        ],
                        backgroundColor: [
                            'rgb(59, 130, 246)',
                            'rgb(16, 185, 129)',
                            'rgb(245, 158, 11)',
                            'rgb(239, 68, 68)',
                            'rgb(139, 92, 246)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }
    </script>
</x-admin-layout>