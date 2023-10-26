@extends('dashboard.layouts.main')

@section('content')
    <div class="container">
        <h2 class="main-title mt-2 fw-semibold fs-3">Tabel Data Berita Acara</h2>
        <p> Staff: <span class="fw-bold"> {{ strtoupper($beritum->staff->name) }}</span></p>
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

        <a class="btn btn-outline-secondary fs-5 fw-normal mt-2" href="{{ route('berita.index') }}"><i
                class="fa-solid fa-chevron-left fs-5 me-2"></i>Kembali</a>
        <button class="btn btn-primary fs-5 fw-normal mt-2" data-bs-toggle="modal" data-bs-target="#tambahBerita"><i
                class="fa-solid fa-square-plus fs-5 me-2"></i>Tambah</button>
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
                                    <th>WAKTU</th>
                                    <th>URAIAN</th>
                                    <th>KET</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beritas as $berita)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $berita->waktu }}</td>
                                        <td>{{ $berita->uraian }}</td>
                                        <td>{{ $berita->ket }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editBerita{{ $loop->iteration }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapusBerita{{ $loop->iteration }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    {{-- Modal Edit berita --}}
                                    <x-form_modal>
                                        @slot('id', "editBerita$loop->iteration")
                                        @slot('title', 'Edit Data Berita')
                                        @slot('route', route('berita-detail.update', $berita->id))
                                        @slot('method') @method('put') @endslot
                                        @slot('btnPrimaryTitle', 'Perbarui')

                                        <div class="mb-3">
                                            <input type="hidden" name="id_berita_acara" value="{{ $beritum->id }}">
                                            <label for="waktu" class="form-label">Waktu</label>
                                            <input type="time" class="form-control @error('waktu') is-invalid @enderror"
                                                id="waktu" name="waktu" value="{{ old('waktu', $berita->waktu) }}"
                                                autofocus required>
                                            @error('waktu')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="uraian" class="form-label">Uraian</label>
                                            <input type="name" class="form-control @error('uraian') is-invalid @enderror"
                                                id="uraian" name="uraian" autofocus required
                                                value="{{ old('uraian', $berita->uraian) }}">
                                            @error('uraian')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="ket" class="form-label">Ket</label>
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="ket">{{ $berita->ket }}</textarea>
                                                <label for="floatingTextarea">Keterangan</label>
                                            </div>
                                        </div>
                                    </x-form_modal>
                                    {{-- / Modal Edit berita --}}

                                    {{-- Modal Hapus berita --}}
                                    <x-form_modal>
                                        @slot('id', "hapusBerita$loop->iteration")
                                        @slot('title', 'Hapus Data Berita')
                                        @slot('route', route('berita-detail.destroy', $berita->id))
                                        @slot('method') @method('delete') @endslot
                                        @slot('btnPrimaryClass', 'btn-outline-danger')
                                        @slot('btnSecondaryClass', 'btn-secondary')
                                        @slot('btnPrimaryTitle', 'Hapus')

                                        <p class="fs-5">Apakah anda yakin akan menghapus data Berita Acara
                                            <b>{{ $berita->uraian }}</b>?
                                        </p>
                                        <input type="hidden" name="id_berita_acara" value="{{ $beritum->id }}">

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

    <!-- Modal Tambah berita -->
    <x-form_modal>
        @slot('id', 'tambahBerita')
        @slot('title', 'Tambah Data Berita')
        @slot('overflow', 'overflow-auto')
        @slot('route', route('berita-detail.store'))

        @csrf
        <div class="row">
            <input type="hidden" name="id_berita_acara" value="{{ $beritum->id }}">
            <div class="mb-3">
                <label for="waktu" class="form-label">Waktu</label>
                <input type="time" class="form-control @error('waktu') is-invalid @enderror" id="waktu"
                    name="waktu" autofocus required>
                @error('waktu')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="uraian" class="form-label">Uraian</label>
                <input type="name" class="form-control @error('uraian') is-invalid @enderror" id="uraian"
                    name="uraian" autofocus required>
                @error('uraian')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="ket" class="form-label">Ket</label>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="ket"></textarea>
                    <label for="floatingTextarea">Keterangan</label>
                </div>
            </div>
        </div>
    </x-form_modal>
    <!-- Akhir Modal Tambah berita -->
@endsection
