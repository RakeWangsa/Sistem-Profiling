

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4" style="text-align: center;">Data Perusahaan</h1>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="padding: 10px;">Nama Perusahaan</th>
                                    <th style="padding: 10px;">Id Negara</th>
                                    <th style="padding: 10px;">Alamat</th>
                                    <th style="padding: 10px;">Skor</th>
                                    <th style="padding: 10px;">Pelanggaran</th>
                                    <th style="padding: 10px;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($perusahaan as $p)
                                <tr>
                                    <td style="padding: 10px;">{{$p->nm_trader}}</td>
                                    <td style="padding: 10px;">{{$p->kd_negara}}</td>
                                    <td style="padding: 10px;">{{$p->al_trader}}</td>
                                    <td style="padding: 10px;">
                                        <?php
                                            $skor = DB::table('penilaian')
                                            ->where('id_trader', $p->id_trader)
                                            ->pluck('skor')
                                            ->first();
                                            echo $skor;
                                        ?>
                                    </td>
                                    <td style="padding: 10px;">
                                        <?php
                                            $pelanggaran_perusahaan = DB::table('pelanggaran_perusahaan')
                                            ->where('perusahaan_id', $p->id_trader)
                                            ->pluck('pelanggaran_id');
                                            $pengurangan = DB::table('pelanggaran')
                                            ->whereIn('id', $pelanggaran_perusahaan)
                                            ->pluck('kriteria');
                                            $text = implode(" ", $pengurangan->toArray());
                                            $jumlah_administrasi = substr_count($text, "ADMINISTRASI");
                                            $jumlah_teknis = substr_count($text, "TEKNIS");
                                            $totalPengurangan = $jumlah_administrasi + (3 * $jumlah_teknis);
                                            echo $totalPengurangan;
                                        ?>
                                    </td>
                                    <td style="padding: 10px;">
                                        <?php
                                            $totalSkor = DB::table('penilaian')
                                            ->where('id_trader', $p->id_trader)
                                            ->pluck('total')
                                            ->first();
                                            $patuh = DB::table('penilaian')
                                            ->where('id_trader', $p->id_trader)
                                            ->pluck('kepatuhan')
                                            ->first();
                                            echo $totalSkor."<br>";
                                            echo $patuh;
                                        ?>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
</main>
</div>
<style>
    table.table-bordered {
        border: 1px solid #000000;
    }

    table.table-bordered th,
    table.table-bordered td {
        border: 1px solid #000000;
    }
</style>

<script>
    // Fungsi untuk mencetak halaman
    function printPage() {
        window.print(); // Pencetakan halaman
    }

    // Menjalankan fungsi printPage() saat halaman dimuat
    window.onload = function() {
        printPage(); // Pemanggilan fungsi printPage()
    };
</script>

