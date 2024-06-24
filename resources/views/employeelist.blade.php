@extends('layouts.app')

@section('employeelist')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Main</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Employee List</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Daftar Pegawai</h6>
        </nav>
    </div>
</nav>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap Table with Search Column Feature</title>
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
            background: #f7f5f2;
            font-family: 'Roboto', sans-serif;
        }
        .table-responsive {
            margin: 30px 0;
        }
        .table-wrapper {
            min-width: 1000px;
            background: #fff;
            padding: 20px 25px;
            border-radius: 3px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }
        .table-title {
            color: #fff;
            background: #ff0000;
            padding: 16px 25px;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }
        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
            color: #fff;
        }
        .search-box {
            position: relative;
            float: right;
        }
        .search-box .input-group {
            min-width: 300px;
            position: absolute;
            right: 0;
        }
        .search-box .input-group-addon, .search-box input {
            border-color: #ddd;
            border-radius: 0;
        }
        .search-box input {
            height: 34px;
            padding-right: 35px;
            background: #f4fcfd;
            border: none;
            border-radius: 2px !important;
        }
        .search-box input:focus {
            background: #fff;
        }
        .search-box input::placeholder {
            font-style: italic;
        }
        .search-box .input-group-addon {
            min-width: 35px;
            border: none;
            background: transparent;
            position: absolute;
            right: 0;
            z-index: 9;
            padding: 6px 0;
        }
        .search-box i {
            color: #a0a5b1;
            font-size: 19px;
            position: relative;
            top: 2px;
        }
        table.table {
            table-layout: fixed;
            margin-top: 15px;
        }
        table.table tr th, table.table tr td {
            border-color: #e9e9e9;
        }
        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }
        table.table th:first-child {
            width: 60px;
        }
        table.table th:last-child {
            width: 120px;
        }
        table.table td a {
            color: #a0a5b1;
            display: inline-block;
            margin: 0 5px;
        }
        table.table td a.view {
            color: #03A9F4;
        }
        table.table td a.edit {
            color: #FFC107;
        }
        table.table td a.delete {
            color: #E34724;
        }
        table.table td i {
            font-size: 19px;
        }
    </style>
    <script>
        $(document).ready(function() {
            // Activate tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Fetch and display employees
            function fetchEmployees() {
                $.ajax({
                    url: '/api/employees',
                    method: 'GET',
                    success: function(response) {
                        var employees = response.data;
                        var employeeRows = '';
                        employees.forEach(function(employee, index) {
                            employeeRows += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${employee.Name}</td>
                                    <td>${employee.Address}</td>
                                    <td>${employee.Email}</td>
                                    <td>${employee.City}</td>
                                    <td>${employee.Country}</td>
                                </tr>
                            `;
                        });
                        $('table tbody').html(employeeRows);
                    }
                });
            }

            // Filter table rows based on searched term
            $("#search").on("keyup", function() {
                var term = $(this).val().toLowerCase();
                $("table tbody tr").each(function() {
                    $row = $(this);
                    var name = $row.find("td:nth-child(2)").text().toLowerCase();
                    if (name.search(term) < 0) {
                        $row.hide();
                    } else {
                        $row.show();
                    }
                });
            });

            // Fetch employees on page load
            fetchEmployees();
        });
    </script>
</head>

<body>
    <div class="container-lg">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Daftar <b>Pegawai</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <div class="search-box">
                                <div class="input-group">
                                    <input type="text" id="search" class="form-control" placeholder="Search by Name">
                                    <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
                                </div>
                            </div>
                            <a href="#" class="btn btn-primary"><i class="material-icons">&#xE863;</i>
                                <span>Refresh List</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="width: 22%;">Name</th>
                            <th style="width: 22%;">Address</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Country</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
@endsection
