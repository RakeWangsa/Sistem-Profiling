@extends('layouts.main')

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col">
                    <h1 class="mt-4">Dashboard Perusahaan</h1>
                </div>
                <div class="col d-flex mt-4 mb-4 justify-content-end">
                    <div class="btn-group dropleft">
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Lakukan Aksi
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/perusahaan/{{$perusahaan->id_trader}}/pelanggaran">Pelanggaran dan Laporan</a>
                            <a class="dropdown-item" href="/catat/{{$perusahaan->id_trader}}">Catat Pelanggaran</a>
                        </div>
                    </div>
                </div>
            </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/perusahaan">Perusahaan</a></li>
                <li class="breadcrumb-item active">{{$perusahaan->nm_trader}}</li>
            </ol>
            <!-- <h4 class="mb-4 mt-4">Tambah Pengguna</h4> -->
            @if(session()->has('success'))
            <div class="card bg-success text-white mb-4">
                <div class="card-footer">{{ session()->get('success') }}</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('admin.user') }}">Lihat</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Detail Perusahaan
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-3">
                                    Nama Perusahaan
                                </div>
                                <div class="col-5">: {{$perusahaan->nm_trader}}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">Kode Negara</div>
                                <div class="col">: {{$perusahaan->kd_negara}}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">Alamat</div>
                                <div class="col">: {{$perusahaan->al_trader}}</div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-3">No. Telp</div>
                                <div class="col">: {{$perusahaan->ph_trader}}</div>
                            </div>
                            <div class="dropdown-divider mb-2"></div>
                            <div class="row mb-1 h5 justify-content-center">
                                Riwayat Penilaian
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="catatan" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nomor PPK</th>
                                            <th>Tanggal</th>
                                            <th>Kepatuhan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($nilai as $n)
                                        <tr>
                                            <td>{{$n->no_ppk}}</td>
                                            <td>{{Carbon\Carbon::parse($n->tanggal_pelanggaran)->format('d-m-Y')}}</td>
                                            <td>{{$n->level_kepatuhan}} ({{$n->tingkat_kepatuhan}})</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#catatan').DataTable({
                                        "searching": false,
                                        "info": false,
                                        "scrollY": "145px",
                                        "scrollCollapse": true,
                                        "paging": false,
                                        "order": [
                                            [1, "desc"]
                                        ]
                                    });
                                });
                            </script>

                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Jumlah Ekspor
                        </div>
                        <div class="card-body">
                            <canvas id="jumlah" width="200" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Nilai Ekspor
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" width="200" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Nilai per komoditas
                        </div>
                        <div class="card-body">
                            <canvas id="kategori" width="200" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Perbandingan Ekspor Dominan Dengan Negara Lain
                        </div>
                        <div class="card-body">
                            <canvas id="jumlahlain" width="200" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<script>
    var negara = [];
    var jumlah = [];
    var jumlahsatuan = [];
    var satuan = [];
    var ctx = document.getElementById('myChart').getContext('2d');
    var ckategori = document.getElementById('kategori').getContext('2d');
    var cjumlah = document.getElementById('jumlahlain').getContext('2d');
    var csatuan = document.getElementById('jumlah').getContext('2d');
    <?php foreach ($impor as $i) { ?>
        negara.push('<?= $i->nm_negara ?>');
        jumlah.push(<?= intval($i->jumlah) ?>);
    <?php } ?>
    <?php foreach ($satuan as $i) { ?>
        satuan.push('<?= $i->satuan ?>');
        jumlahsatuan.push(<?= intval($i->jumlah) ?>);
    <?php } ?>
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: negara,
            datasets: [{
                label: 'Jumlah Ekspor',
                data: jumlah,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 206, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(153, 102, 255)',
                    'rgb(255, 159, 64)',
                    'rgb(205, 179, 34)'
                ]
            }]
        }
    });
    var myChart = new Chart(csatuan, {
        type: 'pie',
        data: {
            labels: satuan,
            datasets: [{
                label: 'Jumlah Ekspor',
                data: jumlahsatuan,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 206, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(153, 102, 255)',
                    'rgb(255, 159, 64)',
                    'rgb(205, 179, 34)'
                ]
            }]
        }
    });
    <?php if (array_key_exists(1, $jenis)) { ?>
        var data = ['<?= $jenis[0]->jumlah ?>', '<?php ($jenis[1]->jumlah) ?>'];
        <?php } else if(count($jenis) != 0) {
        if ($jenis[0]->konsumsi == 'N') { ?>
            var data = ['0', '<?= $jenis[0]->jumlah ?>'];
        <?php } else { ?>
            var data = ['<?= $jenis[0]->jumlah ?>', '0'];
    <?php }
    } ?>


    var myChart = new Chart(ckategori, {
        type: 'pie',
        data: {
            labels: ['Konsumsi', 'Non Konsumsi'],
            datasets: [{
                label: '',
                data: data,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 206, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(153, 102, 255)',
                    'rgb(255, 159, 64)',
                    'rgb(205, 179, 34)'
                ]
            }]
        }
    });

    var myChart = new Chart(cjumlah, {
        type: 'pie',
        data: {
            labels: ['<?= $perusahaan->nm_trader ?>', 'Perusahaan Lain'],
            datasets: [{
                label: '',
                data: ['<?= $jumlah[1] ?>', <?= $jumlah[0] ?>],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 206, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(153, 102, 255)',
                    'rgb(255, 159, 64)',
                    'rgb(205, 179, 34)'
                ]
            }]
        }
    });
</script>
</main>


@endsection