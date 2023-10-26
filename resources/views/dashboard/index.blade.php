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

@endsection
