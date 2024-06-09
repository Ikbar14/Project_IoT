@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Kontrol Pompa Air -->
    <div class="row my-4">
        <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-7 d-flex justify-content-between align-items-center">
                            <h5>Kontrol Pompa Air</h5>
                            <i class="fa-solid fa-arrow-up-from-water-pump fa-2xl"></i>
                        </div>
                        <div class="col-lg-12 col-7">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault1">
                                <label class="form-check-label" for="flexSwitchCheckDefault1">Tombol Kontrol Pompa Air</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Kontrol Lampu -->
        <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-7 d-flex justify-content-between align-items-center">
                            <h5>Kontrol Lampu</h5>
                            <i class="fa-solid fa-lightbulb fa-2xl"></i>
                        </div>
                        <div class="col-lg-12 col-7">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault2">
                                <label class="form-check-label" for="flexSwitchCheckDefault2">Tombol Kontrol Lampu</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Grafik Sensor -->
    <div class="row my-4">
        <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-7">
                            <h5>Grafik Sensor Suhu</h5>
                            <div id='sensor-suhu'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-7">
                            <h5>Grafik Sensor Kelembaban Udara</h5>
                            <div id='sensor-kelembaban-udara'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-4">
        <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-7">
                            <h5>Grafik Sensor Kelembaban Tanah</h5>
                            <div id="sensor-kelembaban-tanah"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-7">
                            <h5>Grafik Sensor Intensitas Cahaya</h5>
                            <div id="sensor-intensitas"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi data awal untuk grafik
        let dataSensorSuhu = [];
        let dataSensorKelembabanUdara = [];
        let dataSensorKelembabanTanah = [];
        let dataSensorIntensitas = [];

        // Konfigurasi Highcharts untuk sensor suhu
        const chartSuhu = Highcharts.chart('sensor-suhu', {
            chart: { type: 'area' },
            title: { text: 'Data Sensor Suhu' },
            xAxis: { type: 'datetime', title: { text: 'Waktu' } },
            yAxis: { title: { text: 'Suhu' } },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br />',
                pointFormat: 'Waktu = {point.x:%Y-%m-%d %H:%M:%S}, Suhu = {point.y}°'
            },
            series: [{
                name: 'Suhu',
                data: dataSensorSuhu,
                color: '#ff0000',
                fillColor: {
                    linearGradient: { x1: 0, x2: 0, y1: 0, y2: 1 },
                    stops: [
                        [0, '#ff0000'],
                        [0.5, '#ffff00'],
                        [1, '#00ff00']
                    ]
                }
            }]
        });

        // Konfigurasi Highcharts untuk sensor kelembaban udara
        const chartKelembabanUdara = Highcharts.chart('sensor-kelembaban-udara', {
            chart: { type: 'area' },
            title: { text: 'Data Sensor Kelembaban Udara' },
            xAxis: { type: 'datetime', title: { text: 'Waktu' } },
            yAxis: { title: { text: 'Kelembaban Udara' } },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br />',
                pointFormat: 'Waktu = {point.x:%Y-%m-%d %H:%M:%S}, Kelembaban = {point.y}'
            },
            series: [{
                name: 'Kelembaban Udara',
                data: dataSensorKelembabanUdara,
                color: '#000080',
                fillColor: {
                    linearGradient: { x1: 0, x2: 0, y1: 0, y2: 1 },
                    stops: [
                        [0, '#000080'],
                        [0.5, '#00FFFF'],
                        [1, '#FFFFFF']
                    ]
                }
            }]
        });

        // Konfigurasi Highcharts untuk sensor kelembaban tanah
        const chartKelembabanTanah = Highcharts.chart('sensor-kelembaban-tanah', {
            chart: { type: 'area' },
            title: { text: 'Data Sensor Kelembaban Tanah' },
            xAxis: { type: 'datetime', title: { text: 'Waktu' } },
            yAxis: { title: { text: 'Kelembaban Tanah' } },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br />',
                pointFormat: 'Waktu = {point.x:%Y-%m-%d %H:%M:%S}, Kelembaban = {point.y}'
            },
            series: [{
                name: 'Kelembaban Tanah',
                data: dataSensorKelembabanTanah,
                color: '#DAA520',
                fillColor: {
                    linearGradient: { x1: 0, x2: 0, y1: 0, y2: 1 },
                    stops: [
                        [0, '#964B00'],
                        [0.5, '#F0E68C'],
                        [1, '#FFFACD']
                    ]
                }
            }]
        });

        // Konfigurasi Highcharts untuk sensor intensitas cahaya
        const chartIntensitas = Highcharts.chart('sensor-intensitas', {
            chart: { type: 'area' },
            title: { text: 'Data Sensor Intensitas Cahaya' },
            xAxis: { type: 'datetime', title: { text: 'Waktu' } },
            yAxis: { title: { text: 'Intensitas Cahaya' } },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br />',
                pointFormat: 'Waktu = {point.x:%Y-%m-%d %H:%M:%S}, Intensitas = {point.y}'
            },
            series: [{
                name: 'Intensitas Cahaya',
                data: dataSensorIntensitas,
                color: '#FFA500',
                fillColor: {
                    linearGradient: { x1: 0, x2: 0, y1: 0, y2: 1 },
                    stops: [
                        [0, '#ff0000'],
                        [0.5, '#FFFF00'],
                        [1, '#FFFFE0']
                    ]
                }
            }]
        });

        // Fungsi untuk mengambil data dari API log
        function getDataFromApi() {
            fetch('/api/log')
                .then(response => response.json())
                .then(logs => {
                    // Update data sensor suhu
                    dataSensorSuhu = logs.filter(log => log.device_id === 1).map(log => ({
                        x: new Date(log.created_at).getTime(),
                        y: log.value
                    }));
                    chartSuhu.series[0].setData(dataSensorSuhu);

                    // Update data sensor kelembaban udara
                    dataSensorKelembabanUdara = logs.filter(log => log.device_id === 3).map(log => ({
                        x: new Date(log.created_at).getTime(),
                        y: log.value
                    }));
                    chartKelembabanUdara.series[0].setData(dataSensorKelembabanUdara);

                    // Update data sensor kelembaban tanah
                    dataSensorKelembabanTanah = logs.filter(log => log.device_id === 4).map(log => ({
                        x: new Date(log.created_at).getTime(),
                        y: log.value
                    }));
                    chartKelembabanTanah.series[0].setData(dataSensorKelembabanTanah);

                    // Update data sensor intensitas cahaya
                    dataSensorIntensitas = logs.filter(log => log.device_id === 2).map(log => ({
                        x: new Date(log.created_at).getTime(),
                        y: log.value
                    }));
                    chartIntensitas.series[0].setData(dataSensorIntensitas);
                })
                .catch(error => console.error('Error:', error));
        }

        // Panggil fungsi getDataFromApi untuk pertama kali
        getDataFromApi();

        // Refresh data setiap detik
        setInterval(getDataFromApi, 1000);
    });
</script>
@endpush
