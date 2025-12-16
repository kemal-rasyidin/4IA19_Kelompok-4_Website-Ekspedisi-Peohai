<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulasi Tarif Pengiriman</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen py-12">

    <div class="max-w-4xl mx-auto px-4">

        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">🚚 Simulasi Tarif Pengiriman</h1>
            <p class="text-gray-600">Hitung estimasi biaya pengiriman antar kota di Indonesia</p>
        </div>

        <!-- Form Simulasi -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
            <form action="{{ route('tariff.simulate') }}" method="POST">
                @csrf

                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <!-- Kota Asal -->
                    <div>
                        <label for="origin_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            📍 Kota Asal
                        </label>
                        <select name="origin_id" id="origin_id" required
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            <option value="">-- Pilih Kota Asal --</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}"
                                    {{ old('origin_id', isset($origin) ? $origin->id : '') == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }} ({{ $city->province }})
                                </option>
                            @endforeach
                        </select>
                        @error('origin_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kota Tujuan -->
                    <div>
                        <label for="destination_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            🎯 Kota Tujuan
                        </label>
                        <select name="destination_id" id="destination_id" required
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            <option value="">-- Pilih Kota Tujuan --</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}"
                                    {{ old('destination_id', isset($destination) ? $destination->id : '') == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }} ({{ $city->province }})
                                </option>
                            @endforeach
                        </select>
                        @error('destination_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Pilihan Kontainer -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        📦 Ukuran Kontainer
                    </label>
                    <div class="grid md:grid-cols-2 gap-4">
                        <!-- Kontainer 20ft -->
                        <label
                            class="relative flex items-center p-4 border-2 rounded-lg cursor-pointer transition hover:border-blue-500 {{ old('container_type', isset($containerType) ? $containerType : '20ft') == '20ft' ? 'border-blue-500 bg-blue-50' : 'border-gray-300' }}">
                            <input type="radio" name="container_type" value="20ft" required
                                {{ old('container_type', isset($containerType) ? $containerType : '20ft') == '20ft' ? 'checked' : '' }}
                                class="w-5 h-5 text-blue-600">
                            <div class="ml-4">
                                <div class="font-bold text-gray-800">1x20ft</div>
                                <div class="text-sm text-gray-600">Kontainer 20 feet</div>
                                <div class="text-xs text-blue-600 mt-1">Harga standar</div>
                            </div>
                        </label>

                        <!-- Kontainer 40ft -->
                        <label
                            class="relative flex items-center p-4 border-2 rounded-lg cursor-pointer transition hover:border-blue-500 {{ old('container_type', isset($containerType) ? $containerType : '') == '40ft' ? 'border-blue-500 bg-blue-50' : 'border-gray-300' }}">
                            <input type="radio" name="container_type" value="40ft" required
                                {{ old('container_type', isset($containerType) ? $containerType : '') == '40ft' ? 'checked' : '' }}
                                class="w-5 h-5 text-blue-600">
                            <div class="ml-4">
                                <div class="font-bold text-gray-800">1x40ft</div>
                                <div class="text-sm text-gray-600">Kontainer 40 feet</div>
                                <div class="text-xs text-orange-600 mt-1">+30% dari harga 20ft</div>
                            </div>
                        </label>
                    </div>
                    @error('container_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-4 rounded-lg shadow-lg transform transition hover:scale-105">
                    💰 Hitung Tarif
                </button>
            </form>
        </div>

        <!-- Hasil Simulasi -->
        @isset($result)
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Header Hasil -->
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-6">
                    <h2 class="text-2xl font-bold mb-2">✅ Hasil Simulasi Tarif</h2>
                    <p class="text-green-100">Berikut estimasi biaya pengiriman Anda</p>
                </div>

                <div class="p-8">
                    <!-- Info Rute -->
                    <div class="grid md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-blue-50 rounded-lg p-5">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-2xl">📍</span>
                                <h3 class="font-semibold text-gray-700">Kota Asal</h3>
                            </div>
                            <p class="text-xl font-bold text-blue-600">{{ $result['origin']['name'] }}</p>
                            <p class="text-sm text-gray-600">{{ $result['origin']['province'] }}</p>
                        </div>

                        <div class="bg-indigo-50 rounded-lg p-5">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-2xl">🎯</span>
                                <h3 class="font-semibold text-gray-700">Kota Tujuan</h3>
                            </div>
                            <p class="text-xl font-bold text-indigo-600">{{ $result['destination']['name'] }}</p>
                            <p class="text-sm text-gray-600">{{ $result['destination']['province'] }}</p>
                        </div>
                    </div>

                    <!-- Info Jarak & Waktu -->
                    <div class="grid md:grid-cols-4 gap-4 mb-8">
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <div class="text-3xl mb-2">📏</div>
                            <p class="text-sm text-gray-600 mb-1">Jarak</p>
                            <p class="text-2xl font-bold text-gray-800">{{ number_format($result['distance_km'], 0) }} km
                            </p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <div class="text-3xl mb-2">⏱️</div>
                            <p class="text-sm text-gray-600 mb-1">Estimasi Waktu</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $result['estimated_hours'] }} jam</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <div class="text-3xl mb-2">📦</div>
                            <p class="text-sm text-gray-600 mb-1">Ukuran Kontainer</p>
                            <p class="text-xl font-bold text-gray-800">{{ $result['container_size'] }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <div class="text-3xl mb-2">
                                {{ $result['is_inter_island'] ? '🌊' : '🏝️' }}
                            </div>
                            <p class="text-sm text-gray-600 mb-1">Jenis Rute</p>
                            <p class="text-base font-bold text-gray-800">
                                {{ $result['is_inter_island'] ? 'Antar Pulau' : 'Dalam Pulau' }}
                            </p>
                        </div>
                    </div>

                    <!-- Range Tarif Utama -->
                    <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl p-8 text-white mb-6">
                        <h3 class="text-2xl font-bold mb-4 flex items-center gap-2">
                            💰 Estimasi Tarif {{ $result['container_size'] }}
                        </h3>
                        <div class="grid md:grid-cols-3 gap-6">
                            <!-- Harga Bawah -->
                            <div class="bg-white/10 backdrop-blur rounded-lg p-4 text-center">
                                <p class="text-green-100 text-sm mb-2">Harga Terendah</p>
                                <p class="text-3xl font-bold">Rp
                                    {{ number_format($result['tariff_range']['lower'], 0, ',', '.') }}</p>
                            </div>

                            <!-- Harga Rata-rata -->
                            <div class="bg-white/20 backdrop-blur rounded-lg p-4 text-center border-2 border-white/50">
                                <p class="text-green-100 text-sm mb-2">⭐ Harga Rata-rata</p>
                                <p class="text-3xl font-bold">Rp
                                    {{ number_format($result['tariff_range']['average'], 0, ',', '.') }}</p>
                            </div>

                            <!-- Harga Atas -->
                            <div class="bg-white/10 backdrop-blur rounded-lg p-4 text-center">
                                <p class="text-green-100 text-sm mb-2">Harga Tertinggi</p>
                                <p class="text-3xl font-bold">Rp
                                    {{ number_format($result['tariff_range']['upper'], 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="mt-4 text-center text-green-100 text-sm">
                            ℹ️ Range harga dapat bervariasi ±15% tergantung kondisi dan ketersediaan
                        </div>
                    </div>

                    <!-- Perbandingan Kontainer -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg p-6 mb-6">
                        <h3 class="font-bold text-gray-700 mb-4 text-lg flex items-center gap-2">
                            📊 Perbandingan Harga Kontainer
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <!-- 20ft -->
                            <div
                                class="bg-white rounded-lg p-5 shadow {{ $result['container_type'] == '20ft' ? 'ring-2 ring-blue-500' : '' }}">
                                <div class="flex items-center justify-between mb-3">
                                    <h4 class="font-bold text-lg">Kontainer 1x20ft</h4>
                                    @if ($result['container_type'] == '20ft')
                                        <span class="bg-blue-500 text-white text-xs px-2 py-1 rounded-full">Dipilih</span>
                                    @endif
                                </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Harga Terendah:</span>
                                        <span class="font-semibold">Rp
                                            {{ number_format($result['price_comparison']['20ft']['lower'], 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Harga Tertinggi:</span>
                                        <span class="font-semibold">Rp
                                            {{ number_format($result['price_comparison']['20ft']['upper'], 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- 40ft -->
                            <div
                                class="bg-white rounded-lg p-5 shadow {{ $result['container_type'] == '40ft' ? 'ring-2 ring-blue-500' : '' }}">
                                <div class="flex items-center justify-between mb-3">
                                    <h4 class="font-bold text-lg">Kontainer 1x40ft</h4>
                                    @if ($result['container_type'] == '40ft')
                                        <span class="bg-blue-500 text-white text-xs px-2 py-1 rounded-full">Dipilih</span>
                                    @endif
                                </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Harga Terendah:</span>
                                        <span class="font-semibold">Rp
                                            {{ number_format($result['price_comparison']['40ft']['lower'], 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Harga Tertinggi:</span>
                                        <span class="font-semibold">Rp
                                            {{ number_format($result['price_comparison']['40ft']['upper'], 0, ',', '.') }}</span>
                                    </div>
                                </div>
                                <div class="mt-3 pt-3 border-t border-gray-200">
                                    <span class="text-xs text-orange-600 font-medium">+30% dari harga kontainer 20ft</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Breakdown Tarif -->
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-6 mb-6">
                        <h3 class="font-bold text-gray-700 mb-4 text-lg">📋 Rincian Komponen Biaya</h3>

                        <div class="space-y-3">
                            <div class="flex justify-between items-center pb-2 border-b border-gray-300">
                                <span class="text-gray-600">Biaya Dasar</span>
                                <span class="font-semibold text-gray-800">Rp
                                    {{ number_format($result['tariff_breakdown']['base_fare'], 0, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between items-center pb-2 border-b border-gray-300">
                                <span class="text-gray-600">Biaya Jarak ({{ number_format($result['distance_km'], 0) }}
                                    km)</span>
                                <span class="font-semibold text-gray-800">Rp
                                    {{ number_format($result['tariff_breakdown']['distance_fare'], 0, ',', '.') }}</span>
                            </div>

                            @if ($result['tariff_breakdown']['inter_island_markup'] > 0)
                                <div class="flex justify-between items-center pb-2 border-b border-gray-300">
                                    <span class="text-gray-600">Biaya Antar Pulau</span>
                                    <span class="font-semibold text-orange-600">Rp
                                        {{ number_format($result['tariff_breakdown']['inter_island_markup'], 0, ',', '.') }}</span>
                                </div>
                            @endif

                            <div class="flex justify-between items-center pb-2 border-b border-gray-300">
                                <span class="text-gray-600">Biaya Admin</span>
                                <span class="font-semibold text-gray-800">Rp
                                    {{ number_format($result['tariff_breakdown']['admin_fee'], 0, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between items-center pb-2 border-b border-gray-300">
                                <span class="text-gray-600">Markup Kontainer</span>
                                <span
                                    class="font-semibold text-blue-600">{{ $result['tariff_breakdown']['container_markup'] }}</span>
                            </div>

                            <div class="flex justify-between items-center pt-2">
                                <span class="text-gray-600">Variasi Harga</span>
                                <span
                                    class="font-semibold text-purple-600">{{ $result['tariff_breakdown']['range_info'] }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Disclaimer -->
                    <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                        <p class="text-sm text-yellow-800">
                            <strong>ℹ️ Catatan:</strong> Tarif ini adalah estimasi dan dapat berubah sewaktu-waktu.
                            Untuk informasi lebih lanjut, silakan hubungi layanan pelanggan kami.
                        </p>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-8 flex gap-4">
                        <a href="{{ route('tariff.simulation') }}"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center font-semibold py-3 rounded-lg transition">
                            🔄 Hitung Lagi
                        </a>
                        <button onclick="window.print()"
                            class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 rounded-lg transition">
                            🖨️ Cetak
                        </button>
                    </div>
                </div>
            </div>
        @endisset

    </div>

    <!-- Print Styles -->
    <style>
        @media print {
            body {
                background: white;
            }

            button,
            form {
                display: none;
            }
        }
    </style>

</body>

</html>
