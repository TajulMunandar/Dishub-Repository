@extends('dashboard.layouts.main')
@section('page-heading', 'Dashboard')

@section('content')

    <div class="col-xl-4 col-lg-6 col-md-12 col-12 mt-6">
        <!-- card -->
        <div class="card ">
            <!-- card body -->
            <div class="card-body">
                <!-- heading -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="mb-0 fw-bold">{{ $staff }}
                        </h4>
                    </div>
                    <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                        <i class="fa-sharp fa-regular fa-user-police fa-fw"></i>
                    </div>
                </div>

                <!-- project number -->
                <div>
                    <h5 class="fw-bold"> Staff</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-12 col-12 mt-6">
        <!-- card -->
        <div class="card ">
            <!-- card body -->
            <div class="card-body">
                <!-- heading -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="mb-0 fw-bold">{{ $disapprove }}
                        </h4>
                    </div>
                    <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                </div>

                <!-- project number -->
                <div>
                    <h5 class="fw-bold"> Berita Belum Diterima </h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-12 col-12 mt-6">
        <!-- card -->
        <div class="card ">
            <!-- card body -->
            <div class="card-body">
                <!-- heading -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="mb-0 fw-bold">{{ $approve }}
                        </h4>
                    </div>
                    <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                        <i class="fa-solid fa-check"></i>
                    </div>
                </div>

                <!-- project number -->
                <div>
                    <h5 class="fw-bold"> Berita Di terima</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h3 class=" mt-4">Data Laporan</h3>
        <div class="card px-4 mb-4">
            <canvas id="myChart"></canvas>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Bulanan', 'Mingguan', 'Kemarin', 'Hari Ini'],
                datasets: [{
                    label: 'Traffic',
                    borderColor: "#8f44fd",
                    backgroundColor: "#8f44fd",
                    data: [{{ $bulan_lalu }}, {{ $minggu_lalu }}, {{ $kemarin }}, {{ $harian }}],
                    fill: true,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        suggestedMin: 0,
                        suggestedMax: 50,
                        grid: {
                            display: true,
                            drawBorder: true,
                            drawOnChartArea: true,
                            drawTicks: true,
                            color: "rgba(255, 255, 255, 0.08)",
                            borderColor: "transparent",
                            borderDash: [5, 5],
                            borderDashOffset: 2,
                            tickColor: "transparent"
                        },
                        beginAtZero: true
                    }
                },
                tension: 0.3,
                elements: {
                    point: {
                        radius: 8,
                        hoverRadius: 12,
                        backgroundColor: "#9BD0F5",
                        borderWidth: 0,
                    },
                },
            }
        });
    </script>
@endsection
