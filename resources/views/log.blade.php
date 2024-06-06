@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>

<head>
    <title>Manajemen Log</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Tambahkan CSS untuk styling tabel */
        .table {
            border: 1px solid #ddd;
            background-color: #ACE1AF;
            /* Warna hijau muda */
        }

        .table th {
            background-color: #ACE1AF;
            /* Warna hijau muda */
            color: #343a40;
            /* Warna teks hitam */
        }

        .table tbody tr:nth-child(odd) {
            background-color: #f8f9fa;
            /* Warna putih */
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
            /* Warna putih */
        }

        .table td,
        .table th {
            color: #155724;
            /* Warna teks hijau gelap */
        }

        .btn-warning,
        .btn-danger {
            color: #ffffff;
            /* Warna teks putih */
        }
    </style>
    <title>Manajemen Log</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1>Manajemen Log</h1>
        <div class="row">
            <div class="col-md-6">
                <h2>Buat Log</h2>
                <form id="createLogForm">
                    <div class="form-group">
                        <label for="device_id">ID Perangkat</label>
                        <input type="number" id="device_id" name="device_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="value">Nilai</label>
                        <input type="number" step="any" id="value" name="value" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="max_value">Nilai Maksimum</label>
                        <input type="number" id="max_value" name="max_value" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="min_value">Nilai Minimum</label>
                        <input type="number" id="min_value" name="min_value" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Buat</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Perbarui Log</h2>
                <form id="updateLogForm">
                    <input type="hidden" id="update_id" name="id">
                    <div class="form-group">
                        <label for="update_device_id">ID Perangkat</label>
                        <input type="number" id="update_device_id" name="device_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="update_value">Nilai</label>
                        <input type="number" step="any" id="update_value" name="value" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="update_max_value">Nilai Maksimum</label>
                        <input type="number" id="update_max_value" name="max_value" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="update_min_value">Nilai Minimum</label>
                        <input type="number" id="update_min_value" name="min_value" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </form>
            </div>
        </div>

        <h2 class="mt-5">Daftar Log</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Perangkat</th>
                    <th>Nilai</th>
                    <th>Nilai Maksimum</th>
                    <th>Nilai Minimum</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="logTableBody">
                <!-- Data log akan diisi di sini oleh JavaScript -->
            </tbody>
        </table>

        <h2 class="mt-5">Grafik Sensor</h2>
        <canvas id="sensorChart"></canvas>
    </div>

    <script>
        $(document).ready(function() {
            fetchLogs();
            fetchSensorData();

            // Ambil semua log
            function fetchLogs() {
                axios.get('/api/log')
                    .then(response => {
                        let logs = response.data;
                        let logTableBody = $('#logTableBody');
                        logTableBody.empty();
                        logs.forEach(log => {
                            logTableBody.append(`
                                <tr>
                                    <td><a href="#" class="log-detail" data-id="${log.id}">${log.id}</a></td>
                                    <td>${log.device_id}</td>
                                    <td>${log.value}</td>
                                    <td>${log.max_value}</td>
                                    <td>${log.min_value}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" onclick="editLog(${log.id})">Edit</button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteLog(${log.id})">Hapus</button>
                                    </td>
                                </tr>
                            `);
                        });
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }

            // Buat log baru
            $('#createLogForm').submit(function(event) {
                event.preventDefault();
                let formData = $(this).serialize();
                axios.post('/api/log', formData)
                    .then(response => {
                        alert(response.data.message);
                        fetchLogs();
                        fetchSensorData(); // Refresh data grafik setelah membuat log
                        $('#createLogForm')[0].reset();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });

            // Edit log
            window.editLog = function(id) {
                axios.get(`/api/log/${id}`)
                    .then(response => {
                        let log = response.data;
                        $('#update_id').val(log.id);
                        $('#update_device_id').val(log.device_id);
                        $('#update_value').val(log.value);
                        $('#update_max_value').val(log.max_value);
                        $('#update_min_value').val(log.min_value);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            };

            // Perbarui log
            $('#updateLogForm').submit(function(event) {
                event.preventDefault();
                let id = $('#update_id').val();
                let formData = $(this).serialize();
                axios.put(`/api/log/${id}`, formData)
                    .then(response => {
                        alert(response.data.message);
                        fetchLogs();
                        fetchSensorData(); // Refresh data grafik setelah memperbarui log
                        $('#updateLogForm')[0].reset();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });

            // Hapus log
            window.deleteLog = function(id) {
                if (confirm('Apakah Anda yakin ingin menghapus log ini?')) {
                    axios.delete(`/api/log/${id}`)
                        .then(response => {
                            alert(response.data.message);
                            fetchLogs();
                            fetchSensorData(); // Refresh data grafik setelah menghapus log
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            };

            // Fungsi untuk mengambil data sensor dan menampilkan grafik
            function fetchSensorData() {
                axios.get('/api/log')
                    .then(response => {
                        let logs = response.data;
                        let sensorData = {
                            suhu: [],
                            kelembabanUdara: [],
                            kelembabanTanah: [],
                            intensitasCahaya: []
                        };
                        logs.forEach(log => {
                            switch (log.device_id) {
                                case 1:
                                    sensorData.suhu.push(log.value);
                                    break;
                                case 3:
                                    sensorData.kelembabanUdara.push(log.value);
                                    break;
                                case 4:
                                    sensorData.kelembabanTanah.push(log.value);
                                    break;
                                case 5:
                                    sensorData.intensitasCahaya.push(log.value);
                                    break;
                            }
                        });

                        renderChart(sensorData);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }

            // Fungsi untuk merender grafik menggunakan Chart.js
            function renderChart(sensorData) {
                const ctx = document.getElementById('sensorChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: Array.from({
                            length: Math.max(sensorData.suhu.length, sensorData.kelembabanUdara
                                .length, sensorData.kelembabanTanah.length, sensorData
                                .intensitasCahaya.length)
                        }, (_, i) => i + 1),
                        datasets: [{
                                label: 'Sensor Suhu',
                                data: sensorData.suhu,
                                borderColor: 'rgba(255, 99, 132, 1)',
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                fill: true,
                            },
                            {
                                label: 'Sensor Kelembaban Udara',
                                data: sensorData.kelembabanUdara,
                                borderColor: 'rgba(54, 162, 235, 1)',
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                fill: true,
                            },
                            {
                                label: 'Sensor Kelembaban Tanah',
                                data: sensorData.kelembabanTanah,
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                fill: true,
                            },
                            {
                                label: 'Sensor Intensitas Cahaya',
                                data: sensorData.intensitasCahaya,
                                borderColor: 'rgba(153, 102, 255, 1)',
                                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                fill: true,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                beginAtZero: true
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            // Fungsi untuk menampilkan detail log saat ID log diklik
            $(document).on('click', '.log-detail', function(e) {
                e.preventDefault();
                var logId = $(this).data('id');
                window.location.href = '/api/log/' + logId;
            });
        });
    </script>

</body>

</html>
@endsection