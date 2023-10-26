@extends('dashboard.layouts.main')

@section('content')
    <div class="container">
        <h2 class="main-title mt-2 fw-semibold fs-3">Tabel Data Staff</h2>

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

        <button class="btn btn-primary fs-5 fw-normal mt-2" data-bs-toggle="modal" data-bs-target="#tambahStaff"><i
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
                                    <th>NAMA</th>
                                    <th>JABATAN</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staff as $staf)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $staf->name }}</td>
                                        <td>{{ $staf->jabatan->name }}</td>
                                        <td>
                                            @php
                                                if ($staf->isKetua == 1) {
                                                    $role = 'Ketua';
                                                } elseif ($staf->isKetua == 2) {
                                                    $role = 'Anggota';
                                                }
                                            @endphp
                                            {{ $role }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editStaff{{ $loop->iteration }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapusStaff{{ $loop->iteration }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    {{-- Modal Edit User --}}
                                    <x-form_modal>
                                        @slot('id', "editStaff$loop->iteration")
                                        @slot('title', 'Edit Data staff')
                                        @slot('route', route('staff.update', $staf->id))
                                        @slot('method') @method('put') @endslot
                                        @slot('btnPrimaryTitle', 'Perbarui')

                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama</label>
                                            <input type="name" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $staf->name) }}"
                                                autofocus required>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="id_jabatan" class="form-label">Jabatan</label>
                                            <select class="form-select" id="id_jabatan" name="id_jabatan">
                                                @foreach ($jabatans as $jabatan)
                                                    @if (old('id_jabatan', $staf->id_jabatan) == $jabatan->id)
                                                        <option value="{{ $jabatan->id }}" selected>
                                                            {{ $jabatan->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $jabatan->id }}">
                                                            {{ $jabatan->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="isKetua" class="form-label">Status</label>
                                            <select class="form-select" id="isKetua" name="isKetua">
                                                @foreach ([1 => 'Ketua', 2 => 'Anggota'] as $bool => $isKetua)
                                                    <option value="{{ $bool }}"
                                                        {{ old('isKetua', $staf->isKetua) == $bool ? 'selected' : '' }}>
                                                        {{ $isKetua }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </x-form_modal>
                                    {{-- / Modal Edit User --}}

                                    {{-- Modal Hapus User --}}
                                    <x-form_modal>
                                        @slot('id', "hapusStaff$loop->iteration")
                                        @slot('title', 'Hapus Data staff')
                                        @slot('route', route('staff.destroy', $staf->id))
                                        @slot('method') @method('delete') @endslot
                                        @slot('btnPrimaryClass', 'btn-outline-danger')
                                        @slot('btnSecondaryClass', 'btn-secondary')
                                        @slot('btnPrimaryTitle', 'Hapus')

                                        <p class="fs-5">Apakah anda yakin akan menghapus data staff
                                            <b>{{ $staf->name }}</b>?
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

    <!-- Modal Tambah User -->
    <x-form_modal>
        @slot('id', 'tambahStaff')
        @slot('title', 'Tambah Data Staff')
        @slot('overflow', 'overflow-auto')
        @slot('route', route('staff.store'))

        @csrf
        <div class="row">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    autofocus required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="id_jabatan" class="form-label">Jabatan</label>
                <select class="form-select" id="id_jabatan" name="id_jabatan">
                    @foreach ($jabatans as $jabatan)
                        <option value="{{ $jabatan->id }}">
                            {{ $jabatan->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="isKetua" class="form-label">Role</label>
                <select class="form-select" id="isKetua" name="isKetua">
                    <option value="1" selected>Ketua</option>
                    <option value="2">Anggota</option>
                </select>
            </div>
        </div>
    </x-form_modal>
    <!-- Akhir Modal Tambah Staff -->
@endsection
