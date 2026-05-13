<x-layoutAdmin>
    <div class="p-6 bg-base-200 min-h-screen">
        <h1 class="text-3xl font-bold mb-8">Analisi Performance Hotel</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="stat bg-white shadow rounded-box">
                <div class="stat-title">Soggiorno Medio</div>
                <div class="stat-value text-primary">{{ $avgStay }} gg</div>
                <div class="stat-desc">Notti per prenotazione</div>
            </div>

            <div class="stat bg-white shadow rounded-box">
                <div class="stat-title">Tasso Cancellazione</div>
                <div class="stat-value text-error">{{ $cancelRate }}%</div>
                <div class="stat-desc">Sul totale ordini</div>
            </div>

            <div class="stat bg-white shadow rounded-box">
                <div class="stat-title">Extra Services</div>
                <div class="stat-value text-success">€{{ number_format($extraRevenue, 2) }}</div>
                <div class="stat-desc">Ricavi da servizi aggiuntivi</div>
            </div>

            <div class="stat bg-white shadow rounded-box">
                <div class="stat-title">Ricavo Totale Camere</div>
                <div class="stat-value">€{{ number_format(array_sum($roomRevenueData->toArray()), 2) }}</div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="card bg-white shadow-xl">
                <div class="card-body">
                    <h2 class="card-title text-gray-500 uppercase text-sm">Occupazione per Camera (%)</h2>
                    <canvas id="occupancyChart"></canvas>
                </div>
            </div>

            <div class="card bg-white shadow-xl">
                <div class="card-body">
                    <h2 class="card-title text-gray-500 uppercase text-sm">Sentiment Ospiti (Voti 1-5)</h2>
                    <canvas id="reviewsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const roomNames = JSON.parse('{!! json_encode($roomStats->pluck("name")) !!}');
        const occupancyRates = JSON.parse('{!! json_encode($roomStats->pluck("occupancy_rate")) !!}');
        const reviewData = JSON.parse('{!! json_encode($reviewRatings) !!}');
        // Grafico Occupazione
        new Chart(document.getElementById('occupancyChart'), {
            type: 'bar',
            data: {
                labels: roomNames,
                datasets: [{
                    label: 'Tasso Occupazione %',
                    data: occupancyRates,
                    backgroundColor: '#570df8',
                    borderRadius: 5
                }]
            }
        });

        // Grafico Recensioni
        new Chart(document.getElementById('reviewsChart'), {
            type: 'doughnut',
            data: {
                labels: ['1⭐', '2⭐', '3⭐', '4⭐', '5⭐'],
                datasets: [{
                    data: reviewData,
                    backgroundColor: ['#f87272', '#fbbd23', '#3abff8', '#36d399', '#570df8']
                }]
            }
        });
    </script>
</x-layoutAdmin>