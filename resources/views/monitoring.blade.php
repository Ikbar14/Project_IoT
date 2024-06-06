@extends('layouts.app')
@section('content')
<div class="container">
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
</div>
<div class="row my-4">
    <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
        <div class="card w-100">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-7">
                        <h5>Grafik Sensor Suhu</h5>
                        <div class="text-sm mb-0">
                            <i class="" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1"></span>
                            <div id='sensor-suhu'></div>
                        </div>
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
                        <div class="text-sm mb-0">
                            <i class="" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1"></span>
                            <div id='sensor-kelembaban-udara'></div>
                        </div>
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
                        <div class="text-sm mb-0">
                            <i class="" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1"></span>
                            <div id="sensor-kelembaban-tanah"></div>
                        </div>
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
                        <div class="text-sm mb-0">
                            <i class="" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1"></span>
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
    Highcharts.chart('sensor-suhu', {
        chart: {
            type: 'area'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: 'Source: Green House Project'
        },
        xAxis: {
            tickInterval: 1,

            title: {
                text: 'Waktu'
            }
        },
        yAxis: {
            min: 0,
            max: 100,
            tickInterval: 10,
            title: {
                text: 'Suhu'
            },
            labels: {
                format: '{value}°'
            },
            lineWidth: 1
        },
        tooltip: {
            headerFormat: '<b>{series.name}</b><br />',
            pointFormat: 'Waktu = {point.x}, Suhu = {point.y}°'
        },

        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: {
                        x1: 0,
                        x2: 0,
                        y1: 0,
                        y2: 1
                    },
                    stops: [
                        [0, '#ff0000'], // red at top
                        [0.5, '#ffff00'], // yellow at middle
                        [1, '#00ff00'] // green at bottom
                    ]
                },
                marker: {
                    radius: 4
                },
                lineWidth: 2,
                states: {
                    hover: {
                        lineWidth: 3
                    }
                },
                threshold: null
            }
        },
        series: [{
            data: [
                [0, 5.2],
                [5, 10.3],
                [10, 15.7],
                [15, 35.0],
                [20, 43.2],
                [25, 55.3],
                [30, 30.0],
                [35, 70.5],
                [40, 20.2],
                [45, 80.4],
                [50, 25.6],
                [55, 60.7],
                [60, 35.0],
                [65, 50.3],
                [70, 20.4],
                [75, 65.0],
                [80, 45.3],
                [85, 55.0],
                [90, 60.4],
                [95, 70.0],
                [100, 40.1]

            ],
            pointStart: 1,
            name: 'Suhu',
            color: '#ff0000' // Set line color to red
        }]
    });


    Highcharts.chart('sensor-kelembaban-udara', {
        chart: {
            type: 'area'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: 'Source: Green House Project'
        },
        xAxis: {
            tickInterval: 1,

            title: {
                text: 'Waktu'
            }
        },
        yAxis: {
            min: 0,
            max: 100,
            tickInterval: 10,
            title: {
                text: 'Kelembaban Udara'
            },
            labels: {
                format: '{value}°'
            },
            lineWidth: 1
        },
        tooltip: {
            headerFormat: '<b>{series.name}</b><br />',
            pointFormat: 'Waktu = {point.x}, Kelembaban = {point.y}'
        },

        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: {
                        x1: 0,
                        x2: 0,
                        y1: 0,
                        y2: 1
                    },
                    stops: [
                        [0, '#000080'], // dark blue at top
                        [0.5, '#00FFFF'], // blue at middle
                        [1, '#FFFFFF'] // white at bottom
                    ]
                },
                marker: {
                    radius: 4
                },
                lineWidth: 2,
                states: {
                    hover: {
                        lineWidth: 3
                    }
                },
                threshold: null
            }
        },
        series: [{
            data: [
                [0, 5.2],
                [5, 4.3],
                [10, 9.7],
                [15, 25.0],
                [20, 53.2],
                [25, 35.3],
                [30, 30.0],
                [35, 40.5],
                [40, 50.2],
                [45, 60.4],
                [50, 35.6],
                [55, 60.7],
                [60, 55.0],
                [65, 40.3],
                [70, 30.4],
                [75, 25.0],
                [80, 45.3],
                [85, 55.0],
                [90, 50.4],
                [95, 40.0],
                [100, 30.1]

            ],
            pointStart: 1,
            name: 'Kelembaban Udara',
            color: '#000080' // Set line color to blue
        }]
    });


    Highcharts.chart('sensor-kelembaban-tanah', {
        chart: {
            type: 'area'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: 'Source: Green House Project'
        },
        xAxis: {
            tickInterval: 1,

            title: {
                text: 'Waktu'
            }
        },
        yAxis: {
            min: 0,
            max: 100,
            tickInterval: 10,
            title: {
                text: 'Kelembaban Tanah'
            },
            labels: {
                format: '{value}°'
            },
            lineWidth: 1
        },
        tooltip: {
            headerFormat: '<b>{series.name}</b><br />',
            pointFormat: 'Waktu = {point.x}, Suhu = {point.y}'
        },

        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: {
                        x1: 0,
                        x2: 0,
                        y1: 0,
                        y2: 1
                    },
                    stops: [
                        [0, '#964B00'], // Brown  at top
                        [0.5, '#F0E68C'], // light brown at middle
                        [1, '#FFFACD'] // cream at bottom
                    ]
                },
                marker: {
                    radius: 4
                },
                lineWidth: 2,
                states: {
                    hover: {
                        lineWidth: 3
                    }
                },
                threshold: null
            }
        },
        series: [{
            data: [
                [0, 5.2],
                [5, 10.3],
                [10, 15.7],
                [15, 35.0],
                [20, 43.2],
                [25, 55.3],
                [30, 30.0],
                [35, 70.5],
                [40, 20.2],
                [45, 80.4],
                [50, 25.6],
                [55, 60.7],
                [60, 35.0],
                [65, 50.3],
                [70, 20.4],
                [75, 65.0],
                [80, 45.3],
                [85, 55.0],
                [90, 60.4],
                [95, 70.0],
                [100, 40.1]

            ],
            pointStart: 1,
            name: 'Kelembaban Tanah',
            color: '#DAA520 ' // Set line color to brown
        }]
    });
    Highcharts.chart('sensor-intensitas', {
        chart: {
            type: 'area'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: 'Source: Green House Project'
        },
        xAxis: {
            tickInterval: 1,

            title: {
                text: 'Waktu'
            }
        },
        yAxis: {
            min: 0,
            max: 100,
            tickInterval: 10,
            title: {
                text: 'Intensitas Cahaya'
            },
            labels: {
                format: '{value}°'
            },
            lineWidth: 1
        },
        tooltip: {
            headerFormat: '<b>{series.name}</b><br />',
            pointFormat: 'Waktu = {point.x}, Intensitas = {point.y}'
        },

        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: {
                        x1: 0,
                        x2: 0,
                        y1: 0,
                        y2: 1
                    },
                    stops: [
                        [0, '#ff0000 '], // orange at top
                        [0.5, '#FFFF00 '], // yellow at middle
                        [1, '#FFFFE0 '] // light yellow at bottom
                    ]
                },
                marker: {
                    radius: 4
                },
                lineWidth: 2,
                states: {
                    hover: {
                        lineWidth: 3
                    }
                },
                threshold: null
            }
        },
        series: [{
            data: [
                [0, 5.2],
                [5, 10.3],
                [10, 15.7],
                [15, 35.0],
                [20, 43.2],
                [25, 55.3],
                [30, 30.0],
                [35, 70.5],
                [40, 20.2],
                [45, 80.4],
                [50, 25.6],
                [55, 60.7],
                [60, 35.0],
                [65, 50.3],
                [70, 20.4],
                [75, 65.0],
                [80, 45.3],
                [85, 55.0],
                [90, 60.4],
                [95, 70.0],
                [100, 40.1]

            ],
            pointStart: 1,
            name: 'Intensitas Cahaya',
            color: '#FFA500 ' // Set line color to orange
        }]
    });
</script>
@endpush