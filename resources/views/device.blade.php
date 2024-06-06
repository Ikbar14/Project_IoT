@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>

<head>
    <title>Manajemen Device</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <style>
        /* Tambahkan CSS untuk styling tabel */
        .table {
            border: 1px solid #ddd;
            background-color: #ACE1AF; /* Warna hijau muda */
        }
        .table th {
            background-color: #ACE1AF; /* Warna hijau muda */
            color: #343a40; /* Warna teks hitam */
        }
        .table tbody tr:nth-child(odd) {
            background-color: #f8f9fa /* Warna  putih */
        }
        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa ; /* Warna  putih */
        }
        .table td, .table th {
            color: #155724; /* Warna teks hijau gelap */
        }
        .btn-warning, .btn-danger {
            color: #ffffff; /* Warna teks putih */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1></h1>
        <div class="row">
            <div class="col-md-6">
                <h2>Buat Device</h2>
                <form id="createDeviceForm">
                    <div class="form-group">
                        <label for="device_name">Nama Perangkat</label>
                        <input type="text" id="device_name" name="device_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="device_type">Tipe Perangkat</label>
                        <select id="device_type" name="device_type" class="form-control" required>
                            <option value="sensor">Sensor</option>
                            <option value="actuator">Aktuator</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Buat</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Perbarui Device</h2>
                <form id="updateDeviceForm">
                    <input type="hidden" id="update_id" name="id">
                    <div class="form-group">
                        <label for="update_device_name">Nama Perangkat</label>
                        <input type="text" id="update_device_name" name="device_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="update_device_type">Tipe Perangkat</label>
                        <select id="update_device_type" name="device_type" class="form-control" required>
                            <option value="sensor">Sensor</option>
                            <option value="actuator">Aktuator</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </form>
            </div>
        </div>

        <h2 class="mt-5">Daftar Device</h2>
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6></h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Perangkat</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipe Perangkat</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                  </tr>
                </thead>
                <tbody id="deviceTableBody">
                  <!-- Data device akan diisi di sini oleh JavaScript -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            fetchDevices();

            // Ambil semua device
            function fetchDevices() {
                axios.get('/api/device')
                    .then(response => {
                        let devices = response.data;
                        let deviceTableBody = $('#deviceTableBody');
                        deviceTableBody.empty();
                        devices.forEach(device => {
                            deviceTableBody.append(`
                                <tr>
                                    <td><a href="#" class="device-detail" data-id="${device.id}">${device.id}</a></td>
                                    <td>${device.device_name}</td>
                                    <td>${device.device_type}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" onclick="editDevice(${device.id})">Edit</button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteDevice(${device.id})">Hapus</button>
                                    </td>
                                </tr>
                            `);
                        });
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }

            // Buat device baru
            $('#createDeviceForm').submit(function(event) {
                event.preventDefault();
                let formData = $(this).serialize();
                axios.post('/api/device', formData)
                    .then(response => {
                        alert(response.data.message);
                        fetchDevices();
                        $('#createDeviceForm')[0].reset();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });

            // Edit device
            window.editDevice = function(id) {
                axios.get(`/api/device/${id}`)
                    .then(response => {
                        let device = response.data;
                        $('#update_id').val(device.id);
                        $('#update_device_name').val(device.device_name);
                        $('#update_device_type').val(device.device_type);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            };

            // Perbarui device
            $('#updateDeviceForm').submit(function(event) {
                event.preventDefault();
                let id = $('#update_id').val();
                let formData = $(this).serialize();
                axios.put(`/api/device/${id}`, formData)
                    .then(response => {
                        alert(response.data.message);
                        fetchDevices();
                        $('#updateDeviceForm')[0].reset();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });

            // Hapus device
            window.deleteDevice = function(id) {
                if (confirm('Apakah Anda yakin ingin menghapus device ini?')) {
                    axios.delete(`/api/device/${id}`)
                        .then(response => {
                            alert(response.data.message);
                            fetchDevices();
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            };

            // Handle click to view device detail
            $(document).on('click', '.device-detail', function(e) {
                e.preventDefault();
                var deviceId = $(this).data('id');
                window.location.href = `/api/device/${deviceId}`;
            });
        });
    </script>

    <!-- Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
@endsection
