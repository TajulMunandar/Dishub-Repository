@extends('dashboard.layouts.main')

@section('content')
    <div class="container">
        <h2 class="main-title mt-2 fw-semibold fs-3">Tabel Data Lembaran Kerja Harian</h2>

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

        <button class="btn btn-primary fs-5 fw-normal mt-2" data-bs-toggle="modal" data-bs-target="#tambahBerita"><i
                class="fa-solid fa-square-plus fs-5 me-2"></i>Tambah</button>
        <div class="row mt-3">
            @forelse ($beritas as $berita)
                <div class="col-sm-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title fw-bold">{{ strtoupper($berita->name) }} </h3>
                            <p class="card-text mb-1">Staff : {{ $berita->staff->name }}
                            </p>
                            <p class="card-text mb-1">Tanggal : {{ $berita->created_at }}</p>
                            <p class="card-text">
                                Status:
                                @if ($berita->isApprove == 1)
                                    <span class="badge bg-success">diterima</span>
                                @elseif($berita->isApprove == 2)
                                    <span class="badge bg-danger">ditolak</span>
                                @else
                                    <span class="badge bg-warning">diproses</span>
                                @endif
                            </p>
                            <div class="d-flex gap-2">
                                <div class="w-100">
                                    <a href="{{ route('berita.show', $berita->id) }}" type="button"
                                        class="btn btn-primary w-50">
                                        Masuk
                                    </a>
                                </div>

                                {{-- Admin only --}}
                                @if (auth()->user()->isAdmin == 1)
                                    <button class="btn btn-info text-white" data-bs-toggle="modal"
                                        data-bs-target="#approveModal{{ $loop->iteration }}">
                                        <i class="fa-regular fa-file-check"></i>
                                    </button>
                                @endif
                                {{-- Admin only --}}
                                <a href="{{ route('berita-template.pdf', $berita->id) }}" type="button" class="btn btn-secondary text-white">
                                    <i class="fa-solid fa-print"></i>
                                </a>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#hapusModal{{ $loop->iteration }}">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Delete --}}
                <x-form_modal>
                    @slot('id', 'hapusModal' . $loop->iteration)
                    @slot('title', 'Hapus Daftar Berita')
                    @slot('overflow', 'overflow-auto')
                    @slot('route', route('berita.destroy', $berita->id))
                    @slot('btnPrimaryClass', 'btn-outline-danger')
                    @slot('btnSecondaryClass', 'btn-secondary')
                    @slot('btnPrimaryTitle', 'Hapus')
                    @slot('method') @method('delete') @endslot

                    <p class="fs-5">Apakah anda yakin akan menghapus daftar Berita <b>{{ $berita->name }}</b>
                        ?
                    </p>
                    <div class="alert alert-warning fade show" role="alert">
                        <i class="fa-duotone fa-triangle-exclamation me-2"></i>
                        Semua Data Berita Akan Terhapus
                    </div>
                </x-form_modal>
                {{-- /Modal Delete --}}

                {{-- Modal Approve --}}
                <div class="modal fade " id="approveModal{{ $loop->iteration }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Approve Modal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Anda Ingin Menerima Berita Acara <b>{{ $berita->name }}</b>?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('berita.disapprove', ['beritum' => $berita]) }}" method="post">
                                    @method('post')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                </form>
                                <form action="{{ route('berita.approve', ['beritum' => $berita]) }}" method="post">
                                    @method('post')
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Approve</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- /Modal approve --}}
                @empty
                    <P class="fs-5 text-center">Berita Acara Belum Ada</P>
                @endforelse
            </div>
        </div>
        </div>

        <!-- Modal Tambah berita -->
        <x-form_modal>
            @slot('id', 'tambahBerita')
            @slot('title', 'Tambah Data Berita')
            @slot('overflow', 'overflow-auto')
            @slot('route', route('berita.store'))

            @csrf
            <div class="row">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        autofocus required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                @if (auth()->user()->isAdmin == 1)
                    <div class="mb-3">
                        <label for="id_staff" class="form-label">Staff</label>
                        <select class="form-select" id="id_staff" name="id_staff">
                            @foreach ($staff as $staf)
                                <option value="{{ $staf->id }}">
                                    {{ $staf->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <div class="mb-3">
                        <label for="id_staff" class="form-label">Staff</label>
                        <select class="form-select" id="id_staff" name="id_staff" disabled>
                            <option value="{{ $staff->id }}">
                                {{ $staff->name }}
                            </option>
                        </select>
                    </div>
                @endif

            </div>
        </x-form_modal>
        <!-- Akhir Modal Tambah berita -->
    @endsection
