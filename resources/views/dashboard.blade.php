<x-app-layout>
    <x-title-page>Dashboard</x-title-page>

    <x-horizontal-line></x-horizontal-line>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Analytics Overview</h3>

                    <!-- Section for Graphs -->
                    <div class="charts-container grid grid-cols-2 gap-4 mb-6">
                        <!-- Line chart (Target Measurements) -->
                        <div class="chart-wrapper bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h4 class="font-semibold mb-2">Target Measurements</h4>
                            <canvas id="targetMeasurementsChart"></canvas>
                        </div>

                        <!-- Donut chart (Percentage of Targets) -->
                        <div class="chart-wrapper bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h4 class="font-semibold mb-2">Percentage of Targets (2024)</h4>
                            <canvas id="percentageOfTargetsChart"></canvas>
                        </div>
                    </div>

                    <!-- Overlay -->
                    <div id="overlay"></div>

                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/popterms.css') }}">
    <script src="{{ asset('js/popterms.js') }}" defer></script>

    <script>
        // Function to resize the canvas for both charts
        const resizeCanvas = (canvasId, width, height) => {
            const canvas = document.getElementById(canvasId);
            canvas.width = width;
            canvas.height = height;
        };

        // Set the canvas size for both charts
        resizeCanvas('targetMeasurementsChart', 500, 400);  // Set canvas size for line chart
        resizeCanvas('percentageOfTargetsChart', 500, 400); // Set canvas size for doughnut chart

        // Line Chart for Target Measurements
        const targetMeasurementsCtx = document.getElementById('targetMeasurementsChart').getContext('2d');
        const targetMeasurementsChart = new Chart(targetMeasurementsCtx, {
            type: 'line',
            data: {
                labels: ['2024', '2025', '2026', '2027', '2028', '2029'], // X-axis labels
                datasets: [{
                    label: 'Above Target',
                    data: [60, 65, 70, 75, 80, 85], // Your dataset
                    borderColor: 'green',
                    fill: false
                }, {
                    label: 'On Target',
                    data: [40, 45, 50, 55, 60, 65],
                    borderColor: 'blue',
                    fill: false
                }, {
                    label: 'Below Target',
                    data: [30, 35, 40, 45, 50, 55],
                    borderColor: 'red',
                    fill: false
                }]
            },
            options: {
                responsive: false, // Disable responsive behavior since we're manually resizing
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Doughnut Chart for Percentage of Targets
        const percentageOfTargetsCtx = document.getElementById('percentageOfTargetsChart').getContext('2d');
        const percentageOfTargetsChart = new Chart(percentageOfTargetsCtx, {
            type: 'doughnut',
            data: {
                labels: ['Above Target', 'On Target', 'Below Target'],
                datasets: [{
                    label: 'Percentage of Targets',
                    data: [40, 40, 20], // Replace with dynamic data
                    backgroundColor: ['green', 'blue', 'red'],
                }]
            },
            options: {
                responsive: false // Disable responsive behavior since we're manually resizing
            }
        });
    </script>
</x-app-layout>
