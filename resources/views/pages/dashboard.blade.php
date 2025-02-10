@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <x-custom-alert type="warning" :session="session('warning')" />
    <x-custom-alert type="success" :session="session('success')" />
    <x-custom-alert type="error" :session="session('error')" />
    <div class="hs-container-fluid hs-flex-grow-1 col-admin mb-3">
        <div class="hs-row">
            <!-- Total Users -->
            <div class="hs-col-xl-3 hs-col-sm-6 hs-mb-xl-0 hs-mb-4">
                <div class="hs-card">
                    <div class="hs-card-body hs-p-3">
                        <div class="hs-row">
                            <div class="hs-col-8">
                                <div class="hs-numbers">
                                    <p class="hs-text-sm hs-mb-0 hs-text-uppercase hs-font-weight-bold">Total Users</p>
                                    <h5 class="hs-font-weight-bolder">
                                        {{ $totalUsers }}
                                    </h5>
                                </div>
                            </div>
                            <div class="hs-col-4 hs-d-flex hs-flex-row-reverse">
                                <div class=" hs-icon hs-icon-shape hs-bg-gradient-danger hs-shadow-danger hs-text-center hs-rounded-circle">
                                    <i class="!top-3   bi bi-globe-europe-africa hs-text-lg hs-opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- New Clients Today -->
            <div class="hs-col-xl-3 hs-col-sm-6 hs-mb-xl-0 hs-mb-4">
                <div class="hs-card">
                    <div class="hs-card-body hs-p-3">
                        <div class="hs-row">
                            <div class="hs-col-8">
                                <div class="hs-numbers">
                                    <p class="hs-text-sm hs-mb-0 hs-text-uppercase hs-font-weight-bold">New Clients Today</p>
                                    <h5 class="hs-font-weight-bolder">
                                        {{ $newClientsToday }}
                                    </h5>
                                </div>
                            </div>
                            <div class="hs-col-4 hs-d-flex hs-flex-row-reverse">
                                <div class="hs-icon hs-icon-shape hs-bg-gradient-success hs-shadow-success hs-text-center hs-rounded-circle">
                                    <i class="!top-3 bi bi-person-add hs-text-lg hs-opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Activities -->
            <div class="hs-col-xl-3 hs-col-sm-6 hs-mb-xl-0 hs-mb-4">
                <div class="hs-card">
                    <div class="hs-card-body hs-p-3">
                        <div class="hs-row">
                            <div class="hs-col-8">
                                <div class="hs-numbers">
                                    <p class="hs-text-sm hs-mb-0 hs-text-uppercase hs-font-weight-bold">Total Activities</p>
                                    <h5 class="hs-font-weight-bolder">
                                        {{ $totalActivities }}
                                    </h5>
                                </div>
                            </div>
                            <div class="hs-col-4 hs-d-flex hs-flex-row-reverse">
                                <div class="hs-icon hs-icon-shape hs-bg-gradient-info hs-shadow-info hs-text-center hs-rounded-circle">
                                    <i class="!top-3 bi bi-backpack2 hs-text-lg hs-opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Accommodations -->
            <div class="hs-col-xl-3 hs-col-sm-6 hs-mb-xl-0 hs-mb-4">
                <div class="hs-card">
                    <div class="hs-card-body hs-p-3">
                        <div class="hs-row">
                            <div class="hs-col-8">
                                <div class="hs-numbers">
                                    <p class="hs-text-sm hs-mb-0 hs-text-uppercase hs-font-weight-bold">Total Accommodations</p>
                                    <h5 class="hs-font-weight-bolder">
                                        {{ $totalAccommodations }}
                                    </h5>
                                </div>
                            </div>
                            <div class="hs-col-4 hs-d-flex hs-flex-row-reverse">
                                <div class="hs-icon hs-icon-shape hs-bg-gradient-primary hs-shadow-primary hs-text-center hs-rounded-circle">
                                    <i class="!top-3 bi bi-houses hs-text-lg hs-opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales Overview -->
        <div class="hs-row hs-mt-4">
            <div class="hs-col-lg-7 hs-mb-lg-0 hs-mb-4">
                <div class="hs-card hs-z-index-2 hs-h-100">
                    <div class="hs-card-header hs-pb-0 hs-pt-3 hs-bg-transparent">
                        <h6 class="hs-text-capitalize">Sales Overview</h6>
                        <p class="hs-text-sm hs-mb-0">
                            <i class="fa fa-arrow-up hs-text-success"></i>
                        </p>
                    </div>
                    <div class="hs-card-body hs-p-3">
                        <div class="hs-chart">
                            <canvas id="chart-line" class="hs-chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hs-col-lg-5 hs-mb-lg-0 hs-mb-4">
                <div class="hs-card hs-z-index-2 hs-h-100">
                    <div class="hs-card-header hs-pb-0 hs-pt-3 hs-bg-transparent">
                        <h6 class="hs-text-capitalize">Users Nationalities</h6>
                        <p class="hs-text-sm hs-mb-0">
                            <i class="fa fa-arrow-up hs-text-success"></i>
                        </p>
                    </div>
                    <div class="hs-card-body hs-p-3">
                        <div class="hs-chart max-h-[300px]">
                            <canvas id="nacionalidadesChart" class="hs-chart-canvas" height="300" ></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hs-row hs-mt-4">
            <div class="hs-col-lg-7 hs-mb-lg-0 hs-mb-4">
                <div class="hs-card hs-z-index-2 hs-h-100">
                    <div class="hs-card-header hs-pb-0 hs-pt-3 hs-bg-transparent">
                        <h6 class="hs-text-capitalize">Most Sold Products</h6>

                    </div>
                    <div class="hs-card-body hs-p-3">
                        <div class="hs-chart">
                            <canvas id="productsChart"  class="hs-chart-canvas" height="300" ></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hs-col-lg-5 hs-mb-lg-0 hs-mb-4">
                <div class="hs-card hs-z-index-2 hs-h-100">
                    <div class="hs-card-header hs-pb-0 hs-pt-3 hs-bg-transparent">
                        <h6 class="hs-text-capitalize">Most Reserved Accommodations</h6>
                        <p class="hs-text-sm hs-mb-0">
                            <i class="fa fa-arrow-up hs-text-success"></i>
                        </p>
                    </div>
                    <div class="hs-card-body hs-p-3">
                        <div class="hs-chart max-h-[300px]">
                            <canvas id="accommodationsChart" class="hs-chart-canvas" height="300" ></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {


            let ctx = document.getElementById('productsChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar', // Gráfico de barras
                data: {
                    labels: {!! json_encode($mostSoldProducts->pluck('name')) !!},
                    datasets: [{
                        label: 'Quantity Sold',
                        data: {!! json_encode($mostSoldProducts->pluck('total_sold')) !!},
                        backgroundColor: '#028090',
                        borderColor: '#114B5F',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            ctx = document.getElementById('accommodationsChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar', // Gráfico de barras
                data: {
                    labels: {!! json_encode($mostReservedAccommodationTypes->pluck('name')) !!},
                    datasets: [{
                        label: 'Most Reserved',
                        data: {!! json_encode($mostReservedAccommodationTypes->pluck('total_reservations')) !!},
                        backgroundColor: '#FAC1A5',
                        borderColor: '#FA824C',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            ctx = document.getElementById('nacionalidadesChart').getContext('2d');

            new Chart(ctx, {
                type: 'pie', // Gráfico circular
                data: {
                    labels: {!! json_encode($usersNationalities->pluck('nationality')) !!},
                    datasets: [{
                        data: {!! json_encode($usersNationalities->pluck('total')) !!},
                        backgroundColor: ['#F15025', '#f8a892','#fcd4c9', '#E6E8E6', '#CED0CE'],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Permite ajustar a altura personalizada
                    plugins: {
                        legend: {
                            display: true,
                            position: 'left' // Legendas abaixo do gráfico
                        }
                    }
                }
            });

            fetch('/dashboard/sales_overview')
                .then(response => response.json())
                .then(data => {
                    var ctx1 = document.getElementById("chart-line").getContext("2d");

                    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
                    gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
                    gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
                    gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');

                    new Chart(ctx1, {
                        type: "line",
                        data: {
                            labels: data.labels, // Labels dinâmicos do JSON
                            datasets: [{
                                label: "Total Sales",
                                tension: 0.4,
                                borderWidth: 0,
                                pointRadius: 0,
                                borderColor: "#fb6340",
                                backgroundColor: gradientStroke1,
                                borderWidth: 3,
                                fill: true,
                                data: data.totals, // Valores dinâmicos do JSON
                                maxBarThickness: 6
                            }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false,
                                }
                            },
                            interaction: {
                                intersect: false,
                                mode: 'index',
                            },
                            scales: {
                                y: {
                                    grid: {
                                        drawBorder: false,
                                        display: true,
                                        drawOnChartArea: true,
                                        drawTicks: false,
                                        borderDash: [5, 5]
                                    },
                                    ticks: {
                                        display: true,
                                        padding: 10,
                                        color: '#000000',
                                        font: {
                                            size: 11,
                                            family: "Open Sans",
                                            style: 'normal',
                                            lineHeight: 2
                                        },
                                    }
                                },
                                x: {
                                    grid: {
                                        drawBorder: false,
                                        display: false,
                                        drawOnChartArea: false,
                                        drawTicks: false,
                                        borderDash: [5, 5]
                                    },
                                    ticks: {
                                        display: true,
                                        color: '#000000',
                                        padding: 20,
                                        font: {
                                            size: 11,
                                            family: "Open Sans",
                                            style: 'normal',
                                            lineHeight: 2
                                        },
                                    }
                                },
                            },
                        },
                    });
                });
        });
    </script>
@endpush
