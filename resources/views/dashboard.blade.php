@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Temperature</p>
                            <h5 class="font-weight-bolder mb-0">
                                28°C

                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                            <i class="fa-solid fa-temperature-high opacity+5" aria-hidden="true"></i>
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
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Intensity</p>
                            <h5 class="font-weight-bolder mb-0">
                                2,300

                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                            <i class="fa-solid fa-lightbulb opacity+10" aria-hidden="true"></i>
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
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Humidity</p>
                            <h5 class="font-weight-bolder mb-0">
                                40,5

                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                            <i class="fa-solid fa-droplet opacity+10" style="color: #ffffff;" aria-hidden="true"></i>
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
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Soil & Moisture</p>
                            <h5 class="font-weight-bolder mb-0">
                                66,7

                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                            <i class="fa-solid fa-arrow-up-from-ground-water fa-rotate-180 opacity-10" aria-hidden="true"></i>
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
                                <h5 class="font-weight-bolder">Green House Based with IoT</h5>
                                <p class="mb-5">
                                    Rumah kaca atau "greenhouse" adalah struktur yang dirancang untuk menumbuhkan tanaman dalam lingkungan terkendali.
                                    Ia memanfaatkan sinar matahari yang menembus melalui dinding transparan untuk menghangatkan interior, memungkinkan tanaman tumbuh
                                    optimal meski di luar kondisi kurang mendukung. Teknologi canggih seperti sensor suhu, kelembaban, dan pencahayaan sering diterapkan
                                    untuk mengoptimalkan kondisi pertumbuhan tanaman di dalamnya.
                                </p>
                                <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="https://id.wikipedia.org/wiki/Rumah_kaca">
                                    Read More
                                    <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <div class="position-relative">
                                <img src="/assets/img/shapes/waves-white.svg" class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
                                <div class="position-relative d-flex align-items-center justify-content-center h-100">
                                    <img class="w-100 position-relative z-index-2 pt-4" src="/assets/img/background2.jpg" alt="greenhouse">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

