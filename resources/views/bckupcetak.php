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
            font-size: 9pt;
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
    <center>
        <br>
        <h4>Laporan Pelanggaran Perusahaan</h4>
        <br><br>    
    </center>

    @foreach($checklist as $c)
    <h6>{{$c->checklist}}</h6>
    <h7>Tingkat kepatuhan: {{$nilai[$c->id - 1]}}</h7>
    <br>
    <h7>Level kepatuhan: {{$lvl[$c->id - 1]}}</h7>
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
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @if($c->id == 1)
                @foreach($checklist1 as $p)
                <tr>
                    <td>{{ $p->kriteria }}</td>
                    <td>{{ $p->pelanggaran }}</td>
                    <td>{{ $p->acuan }}</td>
                    <td>{{ $p->keterangan }}</td>
                    <td>{{ $p->created_at }}</td>
                </tr>
                @endforeach
                @elseif($c->id == 2)
                @foreach($checklist2 as $p)
                <tr>
                    <td>{{ $p->kriteria }}</td>
                    <td>{{ $p->pelanggaran }}</td>
                    <td>{{ $p->acuan }}</td>
                    <td>{{ $p->keterangan }}</td>
                    <td>{{ $p->created_at }}</td>
                </tr>
                @endforeach
                @elseif($c->id == 3)
                @foreach($checklist3 as $p)
                <tr>
                    <td>{{ $p->kriteria }}</td>
                    <td>{{ $p->pelanggaran }}</td>
                    <td>{{ $p->acuan }}</td>
                    <td>{{ $p->keterangan }}</td>
                    <td>{{ $p->created_at }}</td>
                </tr>
                @endforeach
                @elseif($c->id == 4)
                @foreach($checklist4 as $p)
                <tr>
                    <td>{{ $p->kriteria }}</td>
                    <td>{{ $p->pelanggaran }}</td>
                    <td>{{ $p->acuan }}</td>
                    <td>{{ $p->keterangan }}</td>
                    <td>{{ $p->created_at }}</td>
                </tr>
                @endforeach
                @endif

            </tbody>
        </table>
        <br><br>
    </div>
    @endforeach



    <script>
        $('#table tr').append('<td>mencoba</td>')
    </script>

</body>

</html>