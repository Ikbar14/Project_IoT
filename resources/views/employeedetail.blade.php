@extends('layouts.app')

@section('employeedetail')


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap Data Table with Filter Row Feature</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Roboto', sans-serif;
        }

        .table-responsive {
            margin: 30px 0;
        }

        .table-wrapper {
            width: 100%;
            background: #fff;
            padding: 20px 30px 5px;
            box-shadow: 0 0 1px 0 rgba(0, 0, 0, .25);
        }

        .table-title .btn-group {
            float: right;
        }

        .table-title .btn {
            min-width: 50px;
            border-radius: 2px;
            border: none;
            padding: 6px 12px;
            font-size: 95%;
            outline: none !important;
            height: 30px;
        }

        .table-title {
            min-width: 100%;
            border-bottom: 1px solid #e9e9e9;
            padding-bottom: 15px;
            margin-bottom: 5px;
            background: rgb(0, 50, 74);
            padding: 15px 30px;
            color: #fff;
            text-align: center;
        }

        .table-title h2 {
            margin: 2px 0 0;
            font-size: 24px;
            color: #fff;
            /* Tambahkan baris ini untuk mengubah warna tulisan menjadi putih */
        }

        table.table {
            width: 100%;
            table-layout: fixed;
        }

        table.table th,
        table.table td {
            text-align: center;
            vertical-align: middle;
            border-color: #000000;
            padding: 12px 15px;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table td a {
            color: #2196f3;
        }

        table.table td .btn.manage {
            padding: 2px 10px;
            background: #37BC9B;
            color: #fff;
            border-radius: 2px;
        }

        table.table td .btn.manage:hover {
            background: #2e9c81;
        }
    </style>
</head>

<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Management <b>Pegawai</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-info active">
                                    <input type="radio" name="status" value="all" checked="checked"> All
                                </label>
                                <label class="btn btn-success">
                                    <input type="radio" name="status" value="active"> Active
                                </label>
                                <label class="btn btn-warning">
                                    <input type="radio" name="status" value="deactive"> Deactive
                                </label>
                                <label class="btn btn-danger">
                                    <input type="radio" name="status" value="out"> Out
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Nomor Telepon</th>
                            <th>Posisi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="employeeTableBody">
                        <!-- Data akan diisi dengan JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
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
                                <tr data-status="${employee.Status.toLowerCase()}">
                                    <td>${employee.id}</td>
                                    <td>${employee.Name}</td>
                                    <td>${employee.Email}</td>
                                    <td>${employee.Address}</td>
                                    <td>${employee.Phone_Number}</td>
                                    <td>${employee.Position}</td>
                                    <td><span class="badge badge-${getBadgeClass(employee.Status)}">${employee.Status}</span></td>
                                </tr>
                            `);
                        });
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }

            // Fungsi untuk mendapatkan kelas badge berdasarkan status
            function getBadgeClass(status) {
                switch (status.toLowerCase()) {
                    case 'active':
                        return 'success';
                    case 'deactive':
                        return 'warning';
                    case 'out':
                        return 'danger';
                    default:
                        return 'secondary';
                }
            }

            $(".btn-group .btn").click(function() {
                var inputValue = $(this).find("input").val();
                if (inputValue != 'all') {
                    var target = $('table tr[data-status="' + inputValue + '"]');
                    $("table tbody tr").not(target).hide();
                    target.fadeIn();
                } else {
                    $("table tbody tr").fadeIn();
                }
            });

            $(".badge").each(function() {
                var classStr = $(this).attr("class");
                var newClassStr = classStr.replace(/label/g, "badge");
                $(this).removeAttr("class").addClass(newClassStr);
            });
        });
    </script>
</body>

</html>
@endsection