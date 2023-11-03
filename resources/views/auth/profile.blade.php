<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/logo.png') }}">

    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- font --}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;600;700&display=swap"
        rel="stylesheet">

    <title>E-Modul</title>
</head>

<body style="background-color: #DDE6ED">
    <div class="body-content">
        <div class="container">
            {{--  ALERT  --}}
            <div class="row mt-3">
                <div class="col">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session()->has('failed'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('failed') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
            {{--  ALERT  --}}
            <div class="row justify-content-center mb-5">
                <div class="col col-md-5">
                    <div class="card border-0 bg-transparent"
                        style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                        <div class="card-body p-4 ">

                            <form action="{{ route('profile.update', auth()->user()->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" value="{{ auth()->user()->name }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="id_jabatan" class="form-label">Jabatan</label>
                                    <select class="form-select" name="id_jabatan" id="id_jabatan" disabled>
                                        @foreach ($jabatans as $jabatan)
                                            @if (old('jabatan', auth()->user()->staff->jabatan->id) == $jabatan->id)
                                                <option value="{{ auth()->user()->staff->jabatan->id }}" selected>
                                                    {{ $jabatan->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="name"
                                        class="form-control @error('tempat_lahir') is-invalid @enderror"
                                        id="tempat_lahir" name="tempat_lahir"
                                        value="{{ old('tempat_lahir', auth()->user()->staff->tempat_lahir) }}" autofocus
                                        required>
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                        id="tanggal_lahir" name="tanggal_lahir"
                                        value="{{ old('tanggal_lahir', auth()->user()->staff->tanggal_lahir) }}"
                                        autofocus required>
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ auth()->user()->staff->email }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="hp" class="form-label">No Hp</label>
                                    <input type="text" class="form-control @error('hp') is-invalid @enderror"
                                        name="hp" id="hp" value="{{ auth()->user()->staff->hp }}" required>
                                    @error('hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="sk" class="form-label">Surat Kerja Pertama</label>
                                    <input type="text" class="form-control @error('sk') is-invalid @enderror"
                                        name="sk" id="sk" value="{{ auth()->user()->staff->sk }}" required>
                                    @error('sk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="aktif" class="form-label">aktif Aktif</label>
                                    <input type="text" class="form-control @error('aktif') is-invalid @enderror"
                                        name="aktif" id="aktif" value="{{ auth()->user()->staff->aktif }}" required>
                                    @error('aktif')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="unit_kerja" class="form-label">Unit Kerja Asal</label>
                                    <input type="text"
                                        class="form-control @error('unit_kerja') is-invalid @enderror"
                                        name="unit_kerja" id="unit_kerja" value="{{ auth()->user()->staff->unit_kerja }}"
                                        required>
                                    @error('unit_kerja')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="atasan" class="form-label">Atasan</label>
                                    @if (isset($atasan) && $atasan->first())
                                        <input type="text"
                                            class="form-control @error('atasan') is-invalid @enderror" id="atasan"
                                            value="{{ $atasan->first()->name }}" disabled>
                                        @error('atasan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @else
                                        <input type="text"
                                            class="form-control @error('atasan') is-invalid @enderror" id="atasan"
                                            value="belum ada atasan" disabled>
                                    @endif

                                </div>
                                <input type="hidden" class="form-control @error('isKetua') is-invalid @enderror"
                                    id="isKetua" name="isKetua" value="{{ auth()->user()->staff->isKetua }}">
                                <input type="hidden" class="form-control @error('id_jabatan') is-invalid @enderror"
                                    id="id_jabatan" name="id_jabatan" value="{{ auth()->user()->staff->id_jabatan }}">
                                <input type="hidden" class="form-control @error('id_user') is-invalid @enderror"
                                    id="id_user" name="id_user" value="{{ auth()->user()->staff->id_user }}">
                                <div class="row text-end">
                                    <div class="col">
                                        <a href="/dashboard" class="btn btn-secondary">Kembali</a>
                                        <button type="submit" class="btn btn-primary">Perbarui</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>


</body>

</html>
