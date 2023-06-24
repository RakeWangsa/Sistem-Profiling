

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
                                    <th style="padding: 10px;">Alamat</th>
                                    <th style="padding: 10px;">Nilai Assesment Awal</th>
                                    <th style="padding: 10px;">Pelanggaran</th>
                                    <th style="padding: 10px;">Skor Kepatuhan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($nilai as $p)
                                <tr>
                                    <td style="padding: 10px;">
                                        <?php
                                            $nm_trader = DB::connection('sqlsrv2')->table('tb_r_trader')
                                            ->where('id_trader', $p->id_trader)
                                            ->pluck('nm_trader')
                                            ->first();
                                            echo $nm_trader;
                                        ?>
                                    </td>
                                    <td style="padding: 10px;">
                                        <?php
                                            $al_trader = DB::connection('sqlsrv2')->table('tb_r_trader')
                                            ->where('id_trader', $p->id_trader)
                                            ->pluck('al_trader')
                                            ->first();
                                            echo $al_trader;
                                        ?>
                                    </td>
                                    <td style="padding: 10px;">{{ $p->skor }}</td>
                                    <td style="padding: 10px;">{{ $p->pengurangan }}
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
                                            echo "Administrasi : ".$jumlah_administrasi."<br>";
                                            echo "Teknis : ".$jumlah_teknis*3;
                                        ?>
                                    </td>
                                    <td style="padding: 10px;">
                                        <span style="display: block;">{{ $p->total }}</span>
                                        <span style="display: block;">({{ $p->kepatuhan }})</span>
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

