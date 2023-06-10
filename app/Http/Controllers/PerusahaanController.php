<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use App\Models\checklistPelanggaran;
use App\Models\pelanggaran;
use App\Models\pelanggaranPerusahaan;
use App\Models\perusahaan;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PerusahaanController extends Controller
{
    public function index()
    {
	$perusahaan = DB::connection('sqlsrv2')->select("SELECT id_trader, nm_trader, al_trader, kd_negara FROM [tb_r_trader] WHERE kd_trader_ol IS NOT NULL AND len(npwp) = 20 and email <> '' and email <> '-'");

        return view('Perusahaan.index', ['perusahaan' => $perusahaan]);
    }

    public function detail($id)
    {
        $tahun = date("Y");
        $jimpor = DB::connection('sqlsrv2')->select("SELECT sum(jumlah*nilai_percmdts) AS jumlah, nm_negara
                            FROM [v_rpt_ops_harian]
                            WHERE id_trader = $id and (kd_kegiatan = 'E') and (year(tgl_sert) = $tahun)
                            GROUP BY nm_negara");
        $jenis = DB::connection('sqlsrv2')->select("SELECT  sum(jumlah*nilai_percmdts) as jumlah, konsumsi
                            FROM [v_rpt_ops_harian]
                            where id_trader = $id and (year(tgl_sert) = $tahun)
                            group by konsumsi
                            order by konsumsi asc");
        $satuan = DB::connection('sqlsrv2')->select("SELECT  sum(jumlah) as jumlah, satuan
                            FROM [v_rpt_ops_harian]
                            where id_trader = $id and (year(tgl_sert) = $tahun)
                            group by satuan
                            order by satuan asc");
        // dd(count($jenis));
        if (count($jenis) == 2) {
            if ($jenis[0]->jumlah >= $jenis[1]->jumlah) {
                $jumlah = DB::connection('sqlsrv2')->select("SELECT sum(jumlah*nilai_percmdts) as jumlah
                                    FROM [v_rpt_ops_harian]
                                    where konsumsi = 'K' and (year(tgl_sert) = $tahun)");
                $jml = [$jumlah[0]->jumlah - $jenis[0]->jumlah, $jenis[0]->jumlah];
            } else {
                $jumlah = DB::connection('sqlsrv2')->select("SELECT sum(jumlah*nilai_percmdts) as jumlah
                                    FROM [v_rpt_ops_harian]
                                    where konsumsi = 'N' and (year(tgl_sert) = $tahun) ");
                $jml = [$jumlah[0]->jumlah - $jenis[1]->jumlah, $jenis[1]->jumlah];
            }
        } else if(count($jenis) != 0){
            if($jenis[0]->konsumsi == 'N'){
                $jumlah = DB::connection('sqlsrv2')->select("SELECT sum(jumlah*nilai_percmdts) as jumlah
                                    FROM [v_rpt_ops_harian]
                                    where konsumsi = 'N' and (year(tgl_sert) = $tahun)");
                $jml = [$jumlah[0]->jumlah - $jenis[0]->jumlah, $jenis[0]->jumlah];
            }
            else{
                $jumlah = DB::connection('sqlsrv2')->select("SELECT sum(jumlah*nilai_percmdts) as jumlah
                                    FROM [v_rpt_ops_harian]
                                    where konsumsi = 'K' and (year(tgl_sert) = $tahun)");
                $jml = [$jumlah[0]->jumlah - $jenis[0]->jumlah, $jenis[0]->jumlah];
            }
        }
	else{
            $jml = $jml = [0,0];
        }
        // dd($jumlah);
        $perusahaan = perusahaan::find($id);
        $pelanggaran = perusahaan::find($id)->pelanggaran();
        $jpel = pelanggaranPerusahaan::where('perusahaan_id', $id)->count();
        // $nilai = Catatan::join('sqlsrv2.r_vpt_ops_harian AS s2', 'Catatan.id_ppk', '=', 's2.r_vpt_ops_harian.id_ppk')
        //     ->select('catatan.tanggal_pelanggaran', 'catatan.tingkat_kepatuhan', 'catatan.level_kepatuhan', 's2.r_vpt_ops_harian.no_ppk')
        //     ->where('catatan.perusahaan_id', '=', $id)->get();
        // $nilai = DB::connection('sqlsrv')->table('catatan AS c')
        // ->join(DB::connection('sqlsrv2')->table('r_vpt_ops_harian as p'), 'c.id_ppk', '=', 'p.id_ppk')
        // ->select('c.tanggal_pelanggaran', 'c.tingkat_kepatuhan', 'c.level_kepatuhan', 'p.no_ppk')
        // ->where('catatan.perusahaan_id', '=', $id)->get();
        $nilai = DB::select("SELECT DISTINCT c.tanggal_pelanggaran, c.tingkat_kepatuhan, c.level_kepatuhan, v.no_ppk FROM catatan AS c
        INNER JOIN karimutu.dbo.v_rpt_ops_harian AS v
        ON c.id_ppk = v.id_ppk
        WHERE c.perusahaan_id = $id");
        // dd($nilai);

        return view('Perusahaan.detail', ['satuan' => $satuan,'perusahaan' => $perusahaan, 'pelanggaran' => $pelanggaran, 'jumlahpel' => $jpel, 'impor' => $jimpor, 'nilai' => $nilai, 'jenis' => $jenis, 'jumlah' => $jml]);
    }

    public function pelanggaran($id)
    {
        $perusahaan = perusahaan::find($id);

        $pelanggaran = DB::select("SELECT * FROM pelanggaran_perusahaan AS p 
                                    JOIN pelanggaran AS pe 
                                    ON p.pelanggaran_id = pe.id
                                    JOIN checklist_pelanggaran AS c
                                    ON c.id = pe.checklist_id
                                    JOIN catatan AS ca
                                    ON p.id_catatan = ca.id
                                    WHERE p.perusahaan_id = $id");
        $nilai = DB::select("SELECT DISTINCT catatan.id, catatan.id_ppk, catatan.tanggal_pelanggaran, catatan.tingkat_kepatuhan, catatan.level_kepatuhan, v.no_ppk
                            FROM catatan JOIN karimutu.dbo.v_rpt_ops_harian AS v
                            ON catatan.id_ppk = v.id_ppk
                            WHERE catatan.perusahaan_id = $id
                            ");
        
        $tanggal = Catatan::select('tanggal_pelanggaran')->where('perusahaan_id', '=', $id)->distinct()->get();
        
        $checklist = checklistPelanggaran::get();
        return view('Perusahaan.pelanggaran', ['perusahaan' => $perusahaan, 'pelanggaran' => $pelanggaran, 'checklist' => $checklist, 'tanggal' => $tanggal, 'catatan' => $nilai]);
    }

    public function cetakPdf(Request $request, $id)
    {
        // dd($request);
        // $checklist = checklistPelanggaran::get();
        $perusahaan = perusahaan::find($id);
        // $pelanggaran = DB::select("SELECT * FROM pelanggaran_perusahaan AS p 
        //                             JOIN pelanggaran AS pe 
        //                             ON p.pelanggaran_id = pe.id
        //                             JOIN checklist_pelanggaran AS c
        //                             ON c.id = pe.checklist_id
        //                             JOIN catatan AS ca
        //                             ON ca.id = p.id_catatan
        //                             WHERE p.perusahaan_id = $id AND
        //                             pe.checklist_id = $request->checklist AND
        //                             p.tanggal_pelanggaran BETWEEN ' $request->tanggal_m ' AND ' $request->tanggal_s '");
        // $pelanggaran = DB::select("SELECT * FROM catatan AS c
        // LEFT JOIN pelanggaran_perusahaan AS pp
        // ON pp.id_catatan = c.id
        // JOIN pelanggaran AS p
        // ON pp.pelanggaran_id = p.id
        // JOIN checklist_pelanggaran AS cp
        // ON cp.id = p.checklist_id   
        // WHERE pp.perusahaan_id = $id AND
        // c.id_ppk = $request->ppk");
        $catatan = Catatan::find($request->ppk);
        $no = $catatan->id_ppk;
        $ppk = DB::select("SELECT DISTINCT no_ppk FROM v_rpt_ops_harian where id_ppk = $no" );
        $pelanggaran = DB::select("SELECT * FROM pelanggaran_perusahaan AS p 
                                     JOIN pelanggaran AS pe 
                                     ON p.pelanggaran_id = pe.id
                                     JOIN checklist_pelanggaran AS c
                                     ON c.id = pe.checklist_id
                                     JOIN catatan AS ca
                                     ON ca.id = p.id_catatan
                                     WHERE ca.id = $request->ppk");
        // dd($catatan);
        // dd($pelanggaran);

        // return view('cetakpdf', ['pelanggaran' => $pelanggaran, 'ppk' => $ppk, 'nilai' => $catatan, 'pe' => $perusahaan]);
        $pdf = PDF::loadview('cetakpdf', ['pelanggaran' => $pelanggaran, 'ppk' => $ppk, 'nilai' => $catatan, 'pe' => $perusahaan]);
        return $pdf->download('laporan-pelanggaran.pdf');
    }
}
