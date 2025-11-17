<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Simulasi Tarif Ekspedisi Kontainer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-2xl font-bold mb-6 text-gray-800">Simulasi Tarif Ekspedisi Kontainer</h1>

            <form id="shippingForm">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Pelabuhan Asal</label>
                    <input type="text" name="origin_port" class="w-full border rounded px-3 py-2"
                        placeholder="Contoh: Jakarta" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Pelabuhan Tujuan</label>
                    <input type="text" name="destination_port" class="w-full border rounded px-3 py-2"
                        placeholder="Contoh: Singapore" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Tipe Kontainer</label>
                    <select name="container_type" class="w-full border rounded px-3 py-2" required>
                        <option value="">Pilih Tipe Kontainer</option>
                        <option value="20ft">Kontainer 20 Feet (1x20)</option>
                        <option value="40ft">Kontainer 40 Feet (1x40)</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Jumlah Kontainer</label>
                    <input type="number" name="quantity" min="1" value="1"
                        class="w-full border rounded px-3 py-2" required>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                    Hitung Tarif
                </button>
            </form>

            <div id="result" class="mt-6 hidden">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Hasil Perhitungan</h2>
                <div class="bg-gray-50 p-4 rounded">
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div class="font-semibold">Rute:</div>
                        <div id="route"></div>

                        <div class="font-semibold">Tipe Kontainer:</div>
                        <div id="containerType"></div>

                        <div class="font-semibold">Jumlah:</div>
                        <div id="quantity"></div>

                        <div class="font-semibold">Tarif Dasar:</div>
                        <div id="baseRate"></div>

                        <div class="font-semibold">Biaya BBM:</div>
                        <div id="fuelSurcharge"></div>

                        <div class="font-semibold">Biaya Handling:</div>
                        <div id="handlingFee"></div>

                        <div class="font-semibold">Total per Kontainer:</div>
                        <div id="totalPerContainer" class="font-semibold"></div>

                        <div class="font-bold text-lg pt-2 border-t-2">Total Keseluruhan:</div>
                        <div id="grandTotal" class="font-bold text-lg text-blue-600 pt-2 border-t-2"></div>
                    </div>
                </div>
            </div>

            <div id="error" class="mt-6 hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            </div>
        </div>
    </div>

    <script>
        document.getElementById('shippingForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData);

            document.getElementById('result').classList.add('hidden');
            document.getElementById('error').classList.add('hidden');

            try {
                const response = await fetch('{{ route('logistic.calculate') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (result.success) {
                    const d = result.data;
                    document.getElementById('route').textContent = `${d.origin_port} → ${d.destination_port}`;
                    document.getElementById('containerType').textContent = d.container_type;
                    document.getElementById('quantity').textContent = `${d.quantity} kontainer`;
                    document.getElementById('baseRate').textContent =
                        `$${parseFloat(d.base_rate).toLocaleString()}`;
                    document.getElementById('fuelSurcharge').textContent =
                        `$${parseFloat(d.fuel_surcharge).toLocaleString()}`;
                    document.getElementById('handlingFee').textContent =
                        `$${parseFloat(d.handling_fee).toLocaleString()}`;
                    document.getElementById('totalPerContainer').textContent =
                        `$${parseFloat(d.total_per_container).toLocaleString()}`;
                    document.getElementById('grandTotal').textContent =
                        `$${parseFloat(d.grand_total).toLocaleString()}`;

                    document.getElementById('result').classList.remove('hidden');
                } else {
                    throw new Error(result.message);
                }
            } catch (error) {
                document.getElementById('error').textContent = error.message;
                document.getElementById('error').classList.remove('hidden');
            }
        });
    </script>
</body>

</html>
