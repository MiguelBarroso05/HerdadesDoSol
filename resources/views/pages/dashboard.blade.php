@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <x-custom-alert type="warning" :session="session('warning')" />
    <x-custom-alert type="success" :session="session('success')" />
    <x-custom-alert type="error" :session="session('error')" />
    <div class="hs-container-fluid hs-flex-grow-1 col-admin">
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
                                        {{ $totalUsers }} olha lá, que andas fazende
                                    </h5>
                                </div>
                            </div>
                            <div class="hs-col-4 hs-text-end">
                                <div class="hs-icon hs-icon-shape hs-bg-gradient-danger hs-shadow-danger hs-text-center hs-rounded-circle">
                                    <i class="ni ni-world hs-text-lg hs-opacity-10" aria-hidden="true"></i>
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
                            <div class="hs-col-4 hs-text-end">
                                <div class="hs-icon hs-icon-shape hs-bg-gradient-success hs-shadow-success hs-text-center hs-rounded-circle">
                                    <i class="ni ni-paper-diploma hs-text-lg hs-opacity-10" aria-hidden="true"></i>
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
                            <div class="hs-col-4 hs-text-end">
                                <div class="hs-icon hs-icon-shape hs-bg-gradient-info hs-shadow-info hs-text-center hs-rounded-circle">
                                    <i class="ni ni-app hs-text-lg hs-opacity-10" aria-hidden="true"></i>
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
                            <div class="hs-col-4 hs-text-end">
                                <div class="hs-icon hs-icon-shape hs-bg-gradient-primary hs-shadow-primary hs-text-center hs-rounded-circle">
                                    <i class="ni ni-building hs-text-lg hs-opacity-10" aria-hidden="true"></i>
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
                            <span class="hs-font-weight-bold"> {{ $salesIncreasePercentage }}% more</span> in {{ $currentYear }}
                        </p>
                    </div>
                    <div class="hs-card-body hs-p-3">
                        <div class="hs-chart">
                            <canvas id="chart-line" class="hs-chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales by Country -->
        <div class="hs-row hs-mt-4">
            <div class="hs-col-lg-7 hs-mb-lg-0 hs-mb-4">
                <div class="hs-card">
                    <div class="hs-card-header hs-pb-0 hs-p-3">
                        <div class="hs-d-flex hs-justify-content-between">
                            <h6 class="hs-mb-2">Sales by Country</h6>
                        </div>
                    </div>
                </div>

                <div class="hs-table-responsive">
                    <table class="hs-table hs-align-items-center">
                        <tbody>
                            <tr>
                                <td class="hs-w-30">
                                    <div class="hs-d-flex hs-px-2 hs-py-1 hs-align-items-center">
                                        <div class="hs-ms-4">
                                            <p class="hs-text-xs hs-font-weight-bold hs-mb-0">Country:</p>
                                            <h6 class="hs-text-sm hs-mb-0">United States</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="hs-text-center">
                                        <p class="hs-text-xs hs-font-weight-bold hs-mb-0">Sales:</p>
                                        <h6 class="hs-text-sm hs-mb-0">2500</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="hs-text-center">
                                        <p class="hs-text-xs hs-font-weight-bold hs-mb-0">Value:</p>
                                        <h6 class="hs-text-sm hs-mb-0">$230,900</h6>
                                    </div>
                                </td>
                                <td class="hs-align-middle hs-text-sm">
                                    <div class="hs-col hs-text-center">
                                        <p class="hs-text-xs hs-font-weight-bold hs-mb-0">Bounce:</p>
                                        <h6 class="hs-text-sm hs-mb-0">29.9%</h6>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="hs-w-30">
                                    <div class="hs-d-flex hs-px-2 hs-py-1 hs-align-items-center">
                                        <div class="hs-ms-4">
                                            <p class="hs-text-xs hs-font-weight-bold hs-mb-0">Country:</p>
                                            <h6 class="hs-text-sm hs-mb-0">Germany</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="hs-text-center">
                                        <p class="hs-text-xs hs-font-weight-bold hs-mb-0">Sales:</p>
                                        <h6 class="hs-text-sm hs-mb-0">3,900</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="hs-text-center">
                                        <p class="hs-text-xs hs-font-weight-bold hs-mb-0">Value:</p>
                                        <h6 class="hs-text-sm hs-mb-0">$440,000</h6>
                                    </div>
                                </td>
                                <td class="hs-align-middle hs-text-sm">
                                    <div class="hs-col hs-text-center">
                                        <p class="hs-text-xs hs-font-weight-bold hs-mb-0">Bounce:</p>
                                        <h6 class="hs-text-sm hs-mb-0">40.22%</h6>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="hs-w-30">
                                    <div class="hs-d-flex hs-px-2 hs-py-1 hs-align-items-center">
                                        <div class="hs-ms-4">
                                            <p class="hs-text-xs hs-font-weight-bold hs-mb-0">Country:</p>
                                            <h6 class="hs-text-sm hs-mb-0">Great Britain</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="hs-text-center">
                                        <p class="hs-text-xs hs-font-weight-bold hs-mb-0">Sales:</p>
                                        <h6 class="hs-text-sm hs-mb-0">1,400</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="hs-text-center">
                                        <p class="hs-text-xs hs-font-weight-bold hs-mb-0">Value:</p>
                                        <h6 class="hs-text-sm hs-mb-0">$190,700</h6>
                                    </div>
                                </td>
                                <td class="hs-align-middle hs-text-sm">
                                    <div class="hs-col hs-text-center">
                                        <p class="hs-text-xs hs-font-weight-bold hs-mb-0">Bounce:</p>
                                        <h6 class="hs-text-sm hs-mb-0">23.44%</h6>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="hs-w-30">
                                    <div class="hs-d-flex hs-px-2 hs-py-1 hs-align-items-center">
                                        <div class="hs-ms-4">
                                            <p class="hs-text-xs hs-font-weight-bold hs-mb-0">Country:</p>
                                            <h6 class="hs-text-sm hs-mb-0">Brazil</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="hs-text-center">
                                        <p class="hs-text-xs hs-font-weight-bold hs-mb-0">Sales:</p>
                                        <h6 class="hs-text-sm hs-mb-0">562</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="hs-text-center">
                                        <p class="hs-text-xs hs-font-weight-bold hs-mb-0">Value:</p>
                                        <h6 class="hs-text-sm hs-mb-0">$143,960</h6>
                                    </div>
                                </td>
                                <td class="hs-align-middle hs-text-sm">
                                    <div class="hs-col hs-text-center">
                                        <p class="hs-text-xs hs-font-weight-bold hs-mb-0">Bounce:</p>
                                        <h6 class="hs-text-sm hs-mb-0">32.14%</h6>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
                                        color: '#fbfbfb',
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
                                        color: '#ccc',
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
