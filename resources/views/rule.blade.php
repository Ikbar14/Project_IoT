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
            background-color: #f8f9fa
                /* Warna  putih */
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
            /* Warna  putih */
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
    <title>Manajemen Rules</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1>Manajemen Rules</h1>
        <div class="row">
            <div class="col-md-6">
                <h2>Buat Rule</h2>
                <form id="createRuleForm">
                    @csrf
                    <div class="form-group">
                        <label for="rule_cluster_id">Rule Cluster ID</label>
                        <input type="number" id="rule_cluster_id" name="rule_cluster_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sensor_id">Sensor ID</label>
                        <input type="number" id="sensor_id" name="sensor_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sensor_operator">Sensor Operator</label>
                        <select id="sensor_operator" name="sensor_operator" class="form-control" required>
                            <option value="more than">More Than</option>
                            <option value="less than">Less Than</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sensor_value">Sensor Value</label>
                        <input type="number" id="sensor_value" name="sensor_value" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="actuator_id">Actuator ID</label>
                        <input type="number" id="actuator_id" name="actuator_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="actuator_value">Actuator Value</label>
                        <input type="number" id="actuator_value" name="actuator_value" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Buat</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Perbarui Rule</h2>
                <form id="updateRuleForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="update_id" name="id">
                    <div class="form-group">
                        <label for="update_rule_cluster_id">Rule Cluster ID</label>
                        <input type="number" id="update_rule_cluster_id" name="rule_cluster_id" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="update_sensor_id">Sensor ID</label>
                        <input type="number" id="update_sensor_id" name="sensor_id" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="update_sensor_operator">Sensor Operator</label>
                        <select id="update_sensor_operator" name="sensor_operator" class="form-control">
                            <option value="more than">More Than</option>
                            <option value="less than">Less Than</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="update_sensor_value">Sensor Value</label>
                        <input type="number" id="update_sensor_value" name="sensor_value" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="update_actuator_id">Actuator ID</label>
                        <input type="number" id="update_actuator_id" name="actuator_id" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="update_actuator_value">Actuator Value</label>
                        <input type="number" id="update_actuator_value" name="actuator_value" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </form>
            </div>
        </div>

        <h2 class="mt-5">Daftar Rules</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Rule Cluster ID</th>
                    <th>Sensor ID</th>
                    <th>Sensor Operator</th>
                    <th>Sensor Value</th>
                    <th>Actuator ID</th>
                    <th>Actuator Value</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="ruleTableBody">
                <!-- Data rules akan diisi di sini oleh JavaScript -->
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            fetchRules();

            // Ambil semua rules
            function fetchRules() {
                axios.get('/api/rule')
                    .then(response => {
                        let rules = response.data;
                        let ruleTableBody = $('#ruleTableBody');
                        ruleTableBody.empty();
                        rules.forEach(rule => {
                            ruleTableBody.append(`
                                <tr>
                                    <td>${rule.id}</td>
                                    <td>${rule.rule_cluster_id}</td>
                                    <td>${rule.sensor_id}</td>
                                    <td>${rule.sensor_operator}</td>
                                    <td>${rule.sensor_value}</td>
                                    <td>${rule.actuator_id}</td>
                                    <td>${rule.actuator_value}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" onclick="editRule(${rule.id})">Edit</button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteRule(${rule.id})">Hapus</button>
                                    </td>
                                </tr>
                            `);
                        });
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }

            // Buat rule baru
            $('#createRuleForm').submit(function(event) {
                event.preventDefault();
                let formData = $(this).serialize();
                axios.post('/api/rule', formData)
                    .then(response => {
                        alert(response.data.message);
                        fetchRules();
                        $('#createRuleForm')[0].reset();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });

            // Edit rule
            window.editRule = function(id) {
                axios.get(`/api/rule/${id}`)
                    .then(response => {
                        let rule = response.data;
                        $('#update_id').val(rule.id);
                        $('#update_rule_cluster_id').val(rule.rule_cluster_id);
                        $('#update_sensor_id').val(rule.sensor_id);
                        $('#update_sensor_operator').val(rule.sensor_operator);
                        $('#update_sensor_value').val(rule.sensor_value);
                        $('#update_actuator_id').val(rule.actuator_id);
                        $('#update_actuator_value').val(rule.actuator_value);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            };

            // Perbarui rule
            $('#updateRuleForm').submit(function(event) {
                event.preventDefault();
                let id = $('#update_id').val();
                let formData = $(this).serialize();
                axios.put(`/api/rule/${id}`, formData)
                    .then(response => {
                        alert(response.data.message);
                        fetchRules();
                        $('#updateRuleForm')[0].reset();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });

            // Hapus rule
            window.deleteRule = function(id) {
                if (confirm('Apakah Anda yakin ingin menghapus rule ini?')) {
                    axios.delete(`/api/rule/${id}`)
                        .then(response => {
                            alert(response.data.message);
                            fetchRules();
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            };
        });
    </script>

</body>

</html>
@endsection