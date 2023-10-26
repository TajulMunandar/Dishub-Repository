<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .table th {

            font-weight: bold;
        }

        .header-table {
            font-weight: 600;
        }

        .text-center {
            text-align: center;
        }

        hr {
            border-top: 2px solid #000;
        }
    </style>
</head>

<body style="padding-left: 0px 20px 0px 20px; ">
    <div style=" font-weight: 600; margin-left: 20px; text-align: center">
        <h2 style="margin-bottom: 0"> LEMBARAN KERJA HARIAN ( LKH ) </h2>
        <h3 style="margin-bottom: 0; margin-top: 0;"> TENAGA KONTRAK </h3>
        DINAS PERHUBUNGAN KABUPATEN ACEH UTARA
    </div>
    <p>NAMA : {{ $berita->name }}</p>
    <p>STAF : {{ $berita->staff->name }}</p>
    <table class="table" style="width: 100%;  table-layout: fixed;">

        <tr>
            <th>NO</th>
            <th>Waktu</th>
            <th>Uraian Tugas</th>
            <th>KET</th>
        </tr>
        @foreach ($details as $berita)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $berita->waktu }}</td>
            <td>{{ $berita->uraian }}</td>
            <td>{{ $berita->ket }}</td>
        </tr>
        @endforeach
    </table>


    <div style="margin-top: 130px; padding: 0px 5px 0px 5px">
        <div style="display:flex; justify-content:space-between; padding-right: 20px ">
            <div style="float: left;">
                Mengetahui <span style="width: 80px; display: inline-block;"></span>
                <br>
                Atasan Langsung <span style="width: 80px; display: inline-block;"></span>
                <br><br>
                <br><br><br>
                {{-- {{ strtoupper($kontrak->kelas->mahasiswa->where('isKomisaris', 1)->first()->name) }} --}}
                <hr style="border-width: 1px; border-color: black; border-style: solid;">
                {{-- NPM. {{ $kontrak->kelas->mahasiswa->where('isKomisaris', 1)->first()->npm }}<br> --}}
            </div>
            <div style="float: right;">
                @php
                    date_default_timezone_set('Asia/Jakarta');

                    // Get the current day, month, and year
                    $day = date('j');
                    $month = date('F');
                    $year = date('Y');

                    // Create the formatted date string
                    $formattedDate = $day . ' ' . $month . ' ' . $year;
                @endphp
                Bayu, {{ $formattedDate }}<br><br><br><br><br><br>
                <hr style="border-width: 1px; border-color: black; border-style: solid;">
            </div>
        </div>
    </div>



</body>

</html>
