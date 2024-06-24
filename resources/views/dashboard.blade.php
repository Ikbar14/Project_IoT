@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Daftar Pegawai</p>
                            <h5 class="font-weight-bolder mb-0" id="total-employees">
                                Loading...
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md"> <!-- Ubah dari bg-gradient-success -->
                            <i class="fa-solid fa-people-group fa-xl opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Pegawai Aktif</p>
                            <h5 class="font-weight-bolder mb-0" id="active-employees">
                                Loading...
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md"> <!-- Ubah dari bg-gradient-success -->
                            <i class="fa-regular fa-circle-check fa-xl opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Pegawai Tidak Aktif</p>
                            <h5 class="font-weight-bolder mb-0" id="deactive-employees">
                                Loading...
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md"> <!-- Ubah dari bg-gradient-success -->
                            <i class="fa-solid fa-user-xmark fa-xl opacity-10" style="color: #ffffff;" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Pegawai Keluar</p>
                            <h5 class="font-weight-bolder mb-0" id="out-employees">
                                Loading...
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md"> <!-- Ubah dari bg-gradient-success -->
                            <i class="fa-solid fa-ban fa-xl opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-7">
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="d-flex flex-column h-100">
                                <p class="mb-1 pt-2 text-bold">Built by Ikbar Hafidh</p>
                                <h5 class="font-weight-bolder">Profil PT ARKATAMA</h5>
                                <p class="mb-5">
                                    PT. Arkatama Multi Solusindo adalah perusahaan penyedia jasa teknologi
                                    informasi yang inovatif dan kreatif, dengan kegiatan utamanya membantu
                                    organisasi untuk meningkatkan pelayanan publik anda. Beberapa pelayanan yang
                                    disediakan oleh PT Arkatama Multi Solusindo adalah pengembangan software,
                                    pengadaan dan konfigurasi infrastruktur teknologi informasi (hardware), optimasi
                                    dan automasi proses bisnis, dan jasa pelatihan skill di bidang teknologi informasi
                                    yang dikhususkan untuk para developer, engineer, user, maupun manager pada
                                    proyek teknologi informasi.
                                </p>
                                <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="https://arkatama.id/">
                                    Read More
                                    <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <div class="position-relative">
                                <img src="/assets/img/shapes/waves-white.svg" class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
                                <div class="position-relative d-flex align-items-center justify-content-center h-100">
                                    <img class="w-100 position-relative z-index-2 pt-4" src="/assets/img/arkatama.jpeg" alt="greenhouse">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function fetchEmployeeData() {
            fetch('/api/employees')
                .then(response => response.json())
                .then(data => {
                    const employees = data.data;
                    const totalEmployees = employees.length;
                    const activeEmployees = employees.filter(emp => emp.Status.toLowerCase() === 'active').length;
                    const deactiveEmployees = employees.filter(emp => emp.Status.toLowerCase() === 'deactive').length;
                    const outEmployees = employees.filter(emp => emp.Status.toLowerCase() === 'out').length;

                    document.getElementById('total-employees').textContent = totalEmployees;
                    document.getElementById('active-employees').textContent = activeEmployees;
                    document.getElementById('deactive-employees').textContent = deactiveEmployees;
                    document.getElementById('out-employees').textContent = outEmployees;
                })
                .catch(error => {
                    console.error('Error fetching employee data:', error);
                    document.getElementById('total-employees').textContent = 'Error';
                    document.getElementById('active-employees').textContent = 'Error';
                    document.getElementById('deactive-employees').textContent = 'Error';
                    document.getElementById('out-employees').textContent = 'Error';
                });
        }

        fetchEmployeeData();
    });
</script>
@endsection