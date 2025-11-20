<x-home>
    <section id="beranda" class="py-8 mb-8 lg:py-16 bg-gray-200 rounded-xl md:mx-4">
        <div class="container">
            <div class="mb-10 flex flex-wrap text-center">
                <div class="w-full">
                    <hr class="bg-sea mb-4 h-1 w-32 border-0 md:h-2" />
                    <p class="mb-4 text-6xl font-bold leading-none tracking-wide text-blue-500">
                        Simulasi Biaya Pengiriman Kontainer
                    </p>
                </div>
                <div class="w-full">
                    <p
                        class="mb-10 mt-7 font-medium leading-relaxed bg-red-50 inline-block px-4 py-2 rounded-full text-red-600">
                        Harga tidak mengikat dan dapat berubah sewaktu-waktu sesuai dengan kebijakan perusahaan
                    </p>
                </div>
            </div>
            <div class="w-full">
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-6 items-stretch">

                    <div class="hidden lg:block lg:col-span-3">
                        <img src="https://images.unsplash.com/photo-1494412685616-a5d310fbb07d?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1170"
                            alt="Container shipping" class="w-full h-full rounded-lg object-cover" />
                    </div>

                    <div class="col-span-1 lg:col-span-3 h-full">
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

                        <div id="error"
                            class="mt-6 hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

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
</x-home>
