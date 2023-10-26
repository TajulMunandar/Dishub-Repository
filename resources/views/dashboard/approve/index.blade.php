@extends('dashboard.layouts.main')

@section('content')
    <div class="container">
        <h2 class="main-title mt-2 fw-semibold fs-3">Tabel Approve Data Berita Acara</h2>

        <div class="row">
            <div class="col-sm-6 col-md">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session()->has('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('failed') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <div class="card mt-2">
                    <div class="card-body">

                        {{-- Tabel Data User --}}
                        <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>STAFF</th>
                                    <th>WAKTU</th>
                                    <th>URAIAN</th>
                                    <th>KET</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beritas as $berita)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $berita->Staff->name }}</td>
                                        <td>{{ $berita->waktu }}</td>
                                        <td>{{ $berita->uraian }}</td>
                                        <td>{{ $berita->ket }}</td>
                                        <td>
                                            @if ($berita->isApprove == 1)
                                                <span class="badge bg-success">diterima</span>
                                            @elseif($berita->isApprove == 2)
                                                <span class="badge bg-danger">ditolak</span>
                                            @else
                                                <span class="badge bg-warning">diproses</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                data-bs-target="#approveBerita{{ $loop->iteration }}">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#disapproveBerita{{ $loop->iteration }}">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    {{-- Modal Edit berita --}}
                                    <x-form_modal>
                                        @slot('id', "approveBerita$loop->iteration")
                                        @slot('title', 'Approve Data Berita')
                                        @slot('route', route('berita.update', $berita->id))
                                        @slot('method') @method('put') @endslot
                                        @slot('btnPrimaryTitle', 'Approve')

                                        <p class="fs-5">Apakah anda yakin akan <b>Approve</b> data Berita Acara
                                            <b>{{ $berita->name }}</b>?
                                        </p>
                                    </x-form_modal>
                                    {{-- / Modal Edit berita --}}

                                    {{-- Modal Hapus berita --}}
                                    <x-form_modal>
                                        @slot('id', "disapproveBerita$loop->iteration")
                                        @slot('title', 'Disapprove Data Berita')
                                        @slot('route', route('berita.destroy', $berita->id))
                                        @slot('method') @method('delete') @endslot
                                        @slot('btnPrimaryClass', 'btn-outline-danger')
                                        @slot('btnSecondaryClass', 'btn-secondary')
                                        @slot('btnPrimaryTitle', 'Disapprove')

                                        <p class="fs-5">Apakah anda yakin akan <b>Disapprove</b> data Berita Acara
                                            <b>{{ $berita->name }}</b>?
                                        </p>

                                    </x-form_modal>
                                    {{-- / Modal Hapus User  --}}
                                @endforeach
                            </tbody>
                        </table>
                        {{-- / Tabel Data ... --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
