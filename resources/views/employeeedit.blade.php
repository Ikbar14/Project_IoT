
=@extends('layouts.app')

@section('employeeedit')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pegawai</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
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
</head>

<body>
    <div class="container mt-5">
        <h1>Manajemen Pegawai</h1>
        <div class="row">
            <div class="col-md-6">
                <h2>Buat Pegawai</h2>
                <form id="createEmployeeForm">
                    @csrf
                    <div class="form-group">
                        <label for="number">Nomor</label>
                        <input type="text" id="number" name="Number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" id="name" name="Name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="Email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" id="address" name="Address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor Telepon</label>
                        <input type="text" id="phone" name="Phone_Number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="position">Posisi</label>
                        <input type="text" id="position" name="Position" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="Status" class="form-control" required>
                            <option value="Active">Aktif</option>
                            <option value="Deactive">Tidak Aktif</option>
                            <option value="Out">Keluar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="city">Kota</label>
                        <input type="text" id="city" name="City" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Negara</label>
                        <input type="text" id="country" name="Country" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Buat</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Perbarui Pegawai</h2>
                <form id="updateEmployeeForm">
                    @csrf
                    <input type="hidden" id="update_id" name="id">
                    <div class="form-group">
                        <label for="update_number">Nomor</label>
                        <input type="text" id="update_number" name="Number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="update_name">Nama</label>
                        <input type="text" id="update_name" name="Name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="update_email">Email</label>
                        <input type="email" id="update_email" name="Email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="update_address">Alamat</label>
                        <input type="text" id="update_address" name="Address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="update_phone">Nomor Telepon</label>
                        <input type="text" id="update_phone" name="Phone_Number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="update_position">Posisi</label>
                        <input type="text" id="update_position" name="Position" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="update_status">Status</label>
                        <select id="update_status" name="Status" class="form-control" required>
                            <option value="Active">Aktif</option>
                            <option value="Deactive">Tidak Aktif</option>
                            <option value="Out">Keluar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="update_city">Kota</label>
                        <input type="text" id="update_city" name="City" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="update_country">Negara</label>
                        <input type="text" id="update_country" name="Country" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </form>
            </div>
        </div>

        <h2 class="mt-5">Daftar Pegawai</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nomor</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Nomor Telepon</th>
                    <th>Posisi</th>
                    <th>Status</th>
                    <th>Kota</th>
                    <th>Negara</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="employeeTableBody">
                <!-- Data pegawai akan diisi di sini oleh JavaScript -->
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script>
        $(document).ready(function () {
            fetchEmployees();

            // Ambil semua pegawai
            function fetchEmployees() {
                axios.get('/api/employees')
                    .then(response => {
                        let employees = response.data.data;
                        let employeeTableBody = $('#employeeTableBody');
                        employeeTableBody.empty();
                        employees.forEach(employee => {
                            employeeTableBody.append(`
                                <tr>
                                    <td><a href="#" class="employee-detail" data-id="${employee.id}">${employee.id}</a></td>
                                    <td>${employee.Number}</td>
                                    <td>${employee.Name}</td>
                                    <td>${employee.Email}</td>
                                    <td>${employee.Address}</td>
                                    <td>${employee.Phone_Number}</td>
                                    <td>${employee.Position}</td>
                                    <td>${employee.Status}</td>
                                    <td>${employee.City}</td>
                                    <td>${employee.Country}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" onclick="editEmployee(${employee.id})">Edit</button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteEmployee(${employee.id})">Hapus</button>
                                    </td>
                                </tr>
                            `);
                        });
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }

            // Buat pegawai baru
            $('#createEmployeeForm').submit(function (event) {
                event.preventDefault();
                let formData = $(this).serialize();
                axios.post('/api/employees', formData)
                    .then(response => {
                        alert(response.data.message);
                        fetchEmployees();
                        $('#createEmployeeForm')[0].reset();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });

                       // Edit pegawai
                       window.editEmployee = function (id) {
                axios.get(`/api/employees/${id}`)
                    .then(response => {
                        let employee = response.data.data;
                        $('#update_id').val(employee.id);
                        $('#update_number').val(employee.Number);
                        $('#update_name').val(employee.Name);
                        $('#update_email').val(employee.Email);
                        $('#update_address').val(employee.Address);
                        $('#update_phone').val(employee.Phone_Number);
                        $('#update_position').val(employee.Position);
                        $('#update_status').val(employee.Status);
                        $('#update_city').val(employee.City);
                        $('#update_country').val(employee.Country);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            };

            // Perbarui pegawai
            $('#updateEmployeeForm').submit(function (event) {
                event.preventDefault();
                let id = $('#update_id').val();
                let formData = $(this).serialize();
                axios.put(`/api/employees/${id}`, formData)
                    .then(response => {
                        alert(response.data.message);
                        fetchEmployees();
                        $('#updateEmployeeForm')[0].reset();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });

            // Hapus pegawai
            window.deleteEmployee = function (id) {
                if (confirm('Apakah Anda yakin ingin menghapus pegawai ini?')) {
                    axios.delete(`/api/employees/${id}`)
                        .then(response => {
                            alert(response.data.message);
                            fetchEmployees();
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            };

            // Fungsi untuk menampilkan detail pegawai saat ID pegawai diklik
            $(document).on('click', '.employee-detail', function (e) {
                e.preventDefault();
                var employeeId = $(this).data('id');
                // Lakukan apa yang diperlukan untuk menampilkan detail pegawai, misalnya redirect atau lainnya
            });
        });
    </script>

</body>

</html>
@endsection
