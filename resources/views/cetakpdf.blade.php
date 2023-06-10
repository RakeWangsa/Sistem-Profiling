<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pelanggaran Perusahaan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 12pt;
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
    <center>
        <br>
        <h4>Checklist Kepatuhan Perusahaan</h4>
        <h5>"{{$pelanggaran[0]->checklist}}"</h5>
        <h5>Tanggal {{Carbon\Carbon::parse($pelanggaran[0]->tanggal_pelanggaran)->format('d-m-Y')}}</h5>
        <br><br>
    </center>
    <table class="mb-2">
        <tr>
            <td class="mr-2">Nama Perusahaan</td>
            <td>: {{$pe->nm_trader}}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{$pe->al_trader}}</td>
        </tr>
        <tr>
            <td>Kd Kota</td>
            <td>: {{intval($pe->kt_trader)}}</td>
        </tr>
        <tr>
            <td>Kd Negara</td>
            <td>: {{$pe->kd_negara}}</td>
        </tr>
        <tr>
            <td>Nomor PPK</td>
            <td>: {{$ppk[0]->no_ppk}}</td>
        </tr>

        <tr>
            <td>Tingkat kepatuhan</td>
            <td>: {{$nilai->level_kepatuhan}} ({{$nilai->tingkat_kepatuhan}})</td>
        </tr>
    </table>
    <br>
    <p>List Pelanggaran:</p>
    <div>
        <table class='table table-bordered' id="tabel">
            <thead>
                <tr>
                    <th>Kriteria</th>
                    <th>Pelanggaran</th>
                    <th>Acuan</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pelanggaran as $p)
                <tr>
                    <td>{{ $p->kriteria }}</td>
                    <td>{{ $p->pelanggaran }}</td>
                    <td>{{ $p->acuan }}</td>
                    <td>{{ $p->ket }}</td>
                </tr>
                @endforeach

        </table>
        <br>

        <p class="text-right">
            Dicatat Oleh
            <br><br><br><br>
            {{$nilai->pencatat}}
        </p>
    </div>

</body>

</html>