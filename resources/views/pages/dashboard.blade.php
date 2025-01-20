@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container mx-auto py-4 flex-grow">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
            <!-- Total Users -->
            <div class="bg-white shadow-md rounded-lg p-4">
                <div class="flex items-center">
                    <div class="flex-1">
                        <p class="text-sm font-semibold uppercase text-gray-500">Total Users</p>
                        <h5 class="text-xl font-bold">{{ $totalUsers }}</h5>
                    </div>
                    <div class="w-12 h-12 bg-red-500 text-white flex items-center justify-center rounded-full">
                        <i class="ni ni-world text-lg"></i>
                    </div>
                </div>
            </div>

            <!-- New Clients Today -->
            <div class="bg-white shadow-md rounded-lg p-4">
                <div class="flex items-center">
                    <div class="flex-1">
                        <p class="text-sm font-semibold uppercase text-gray-500">New Clients Today</p>
                        <h5 class="text-xl font-bold">{{ $newClientsToday }}</h5>
                    </div>
                    <div class="w-12 h-12 bg-green-500 text-white flex items-center justify-center rounded-full">
                        <i class="ni ni-paper-diploma text-lg"></i>
                    </div>
                </div>
            </div>

            <!-- Total Activities -->
            <div class="bg-white shadow-md rounded-lg p-4">
                <div class="flex items-center">
                    <div class="flex-1">
                        <p class="text-sm font-semibold uppercase text-gray-500">Total Activities</p>
                        <h5 class="text-xl font-bold">{{ $totalActivities }}</h5>
                    </div>
                    <div class="w-12 h-12 bg-blue-500 text-white flex items-center justify-center rounded-full">
                        <i class="ni ni-app text-lg"></i>
                    </div>
                </div>
            </div>

            <!-- Total Accommodations -->
            <div class="bg-white shadow-md rounded-lg p-4">
                <div class="flex items-center">
                    <div class="flex-1">
                        <p class="text-sm font-semibold uppercase text-gray-500">Total Accommodations</p>
                        <h5 class="text-xl font-bold">{{ $totalAccommodations }}</h5>
                    </div>
                    <div class="w-12 h-12 bg-indigo-500 text-white flex items-center justify-center rounded-full">
                        <i class="ni ni-building text-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales Overview -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-4 mt-6">
            <div class="bg-white shadow-md rounded-lg p-4">
                <div class="mb-4">
                    <h6 class="text-lg font-bold">Sales Overview</h6>
                    <p class="text-sm text-gray-500">
                        <i class="fa fa-arrow-up text-green-500"></i>
                        <span class="font-bold">{{ $salesIncreasePercentage }}% more</span> in {{ $currentYear }}
                    </p>
                </div>
                <div class="h-72">
                    <canvas id="chart-line"></canvas>
                </div>
            </div>

            <!-- Slideshow -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div id="carouselExampleCaptions" class="relative" data-bs-ride="carousel">
                    <div class="relative overflow-hidden">
                        <!-- Slide 1 -->
                        <div class="carousel-item active relative w-full h-72 bg-cover app-image">
                            <div class="absolute bottom-4 left-4 text-white">
                                <div class="bg-white p-2 rounded-full">
                                    <i class="ni ni-compass-04 text-gray-800"></i>
                                </div>
                                <h5 class="text-xl font-bold">Discover Unique Destinations</h5>
                                <p class="text-sm">Explore handpicked accommodations and activities designed to create unforgettable memories.</p>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="carousel-item relative w-full h-72 bg-cover signup-image">
                            <div class="absolute bottom-4 left-4 text-white">
                                <div class="bg-white p-2 rounded-full">
                                    <i class="ni ni-world-2 text-gray-800"></i>
                                </div>
                                <h5 class="text-xl font-bold">Adventures Tailored for You</h5>
                                <p class="text-sm">Whether you're seeking relaxation or adventure, we have the perfect experience waiting for you.</p>
                            </div>
                        </div>

                        <!-- Slide 3 -->
                        <div class="carousel-item relative w-full h-72 bg-cover home-image">
                            <div class="absolute bottom-4 left-4 text-white">
                                <div class="bg-white p-2 rounded-full">
                                    <i class="ni ni-send text-gray-800"></i>
                                </div>
                                <h5 class="text-xl font-bold">Plan Your Perfect Getaway</h5>
                                <p class="text-sm">From accommodations to activities, customize every detail to suit your needs and preferences.</p>
                            </div>
                        </div>
                    </div>
                    <button class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script src="{{asset('./assets/js/plugins/chartjs.min.js')}}"></script>
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
