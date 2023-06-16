<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catatan;
use App\Models\checklistPelanggaran;
use App\Models\pelanggaran;
use App\Models\pelanggaranPerusahaan;
use App\Models\perusahaan;
use App\Models\penilaian;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\Auth;
use PDF;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

class CatatanController extends Controller
{

    public function index($id)
    {
        $checklist = checklistPelanggaran::get();
        $perusahaan = perusahaan::find($id);
        $pelanggaran = DB::table('pelanggaran')->join('checklist_pelanggaran', 'checklist_id', '=', 'checklist_pelanggaran.id')->get();
        // $ppk = DB::table('r_vpt_ops_harian')->select('no_ppk', 'id_ppk')->where('id_trader', '=', $id)->distinct()->get();
        $ppk = DB::connection('sqlsrv2')->table('v_rpt_ops_harian')->select('no_ppk', 'id_ppk')->where('id_trader', '=', $id)->distinct()->get();
        return view('Catatan.index', ['perusahaan' => $perusahaan, 'pelanggaran' => $pelanggaran, 'checklist' => $checklist, 'ppk' => $ppk]);

        // $checklist = checklistPelanggaran::get();
        // $perusahaan = perusahaan::find($id);
        // $data = DB::select("SELECT p.id, p.pelanggaran, p.kriteria, p.nomor, p.acuan, p.checklist_id, c.checklist, p.checklist_id
        //                     FROM checklist_pelanggaran AS c join pelanggaran AS p
        //                     ON p.checklist_id = c.id
        //                     WHERE p.checklist_id = $id");
        // return view('testpelanggaran', ['perusahaan' => $perusahaan, 'data' => $data, 'checklist' => $checklist]);
    }

    public function kriteria($id)
    {
        $data = DB::table('pelanggaran')->select('kriteria')->where('checklist_id', $id)->distinct()->get();
        $output = '<option value="">Pilih Kriteria</option>';
        foreach ($data as $data) {
            $output .= '<option value="' . $data->kriteria . '">' .  $data->kriteria . '</option>';
        }
        echo $output;
    }

    public function kriteriaPelanggaran($kriteria)
    {
        $data = pelanggaran::select('id', 'pelanggaran')->where('kriteria', $kriteria)->get();
        $output = '<option value="">Pilih Kriteria</option>';
        foreach ($data as $data) {
            $output .= '<option value="' . $data->id . '">' .  $data->pelanggaran . '</option>';
        }
        echo $output;
    }

    public function deskripsiPelanggaran($id)
    {
        $data = pelanggaran::find($id);
        $output =   '<div class="form-group row">Nomor: ' . $data->nomor . '</div> <div class="form-group row">Pelanggaran: ' . $data->pelanggaran . '</div> <div class="form-group row">Acuan: ' . $data->acuan . '</div>';

        echo $output;
    }

    public function getPelanggaran($id)
    {
        $data = DB::select("SELECT p.id, p.pelanggaran, p.kriteria, p.acuan, p.checklist_id, c.checklist, p.checklist_id
                            FROM checklist_pelanggaran AS c join pelanggaran AS p
                            ON p.checklist_id = c.id
                            WHERE p.checklist_id = $id");
        $output = '
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
        <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">                    
        <thead>
        <tr>
                                <th>Kriteria</th>
                                <th>Pelanggaran</th>
                                <th>Acuan</th>
                                <th>Aksi</th>
                                <th>keterangan</th>
                            </tr>
                        </thead><tbody><div>';
        foreach ($data as $p) {
            $output .= '
            <tr>
            <td>' . $p->kriteria . '</td>
            <td>' . $p->pelanggaran . '</td>
            <td >' . $p->acuan . '</td>
            <td>
                <input type="checkbox" name="data[]" id="' . $p->id . '" value="' . $p->id . ' data-value = ' . $p->kriteria . ' required">
            </td>
            <td>
                <input class="form-control" disabled id="' . $p->id . 'ket" name="keterangan[]">
            </td>
            <script>
                $(document).ready(function() {
                    $("#' . $p->id . '").click(function() {
                        var checked_status = this.checked;
                        if (checked_status == true) {
                            $("#' . $p->id . 'ket").removeAttr("disabled");
                        } else {
                            $("#' . $p->id . 'ket").attr("value", "");
                            $("#' . $p->id . 'ket").attr("disabled", "disabled");
                        }
                    });
                    
                }); 
                </script>
            </tr>';
        };
        $output .= '</tbody>
                    </div>
                    </table>
                    
                </div>
            </div></div>';

        $output .= '
        
        ';

        echo $output;
    }


    public function store(Request $request, $id)
    {
        if ($request->data == null) {
            return redirect()->back()->with('error', 'Data tidak boleh kosong');
        }
        $s = $request->tanggal;
        $i = 0;
        $ppk = intval($request->ppk);
        $ss = strtotime($s);
        $date = date('Y-m-d', $ss);

        $administrasi = 0;
        $teknis = 0;
        foreach ($request->data as $p) {
            if (strpos($p, 'ASI')) {
                $administrasi += 1;
            }
            if (strpos($p, 'EKNIS')) {
                $teknis += 1;
            }
        }

        $catatan = new Catatan;
        $catatan->perusahaan_id = $id;
        $catatan->id_ppk = $ppk;
        $catatan->tanggal_pelanggaran = $date;
        $catatan->pencatat = Auth::user()->name;
        $catatan->pencatat_id = Auth::user()->id;

        if ($administrasi <= 3 && $teknis == 0) {
            $catatan->tingkat_kepatuhan = 'Tinggi';
            $catatan->level_kepatuhan =  4;
        }
        if ($administrasi > 3 && $teknis == 0) {
            $catatan->tingkat_kepatuhan = 'Sedang';
            $catatan->level_kepatuhan =  3;
        }
        if ($administrasi >= 0 && $teknis <= 2 && $teknis > 0) {
            $catatan->tingkat_kepatuhan = 'Rendah';
            $catatan->level_kepatuhan =  2;
        }
        if ($administrasi >= 0 && $teknis > 2) {
            $catatan->tingkat_kepatuhan = 'Sangat Rendah';
            $catatan->level_kepatuhan =  1;
        }

        $catatan->save();

        foreach ($request->data as $r) {
            $store = pelanggaranPerusahaan::create([
                'id_catatan' => $catatan->id,
                'pelanggaran_id' => intval($r),
                'perusahaan_id' => $id,
                'keterangan' => $request['keterangan'][$i]
            ]);
            $i++;
        };
        $pelanggaran_perusahaan = DB::table('pelanggaran_perusahaan')
        ->where('perusahaan_id', $id)
        ->pluck('pelanggaran_id');
        $pengurangan = DB::table('pelanggaran')
        ->whereIn('id', $pelanggaran_perusahaan)
        ->pluck('kriteria');
        $text = implode(" ", $pengurangan->toArray());
        $jumlah_administrasi = substr_count($text, "ADMINISTRASI");
        $jumlah_teknis = substr_count($text, "TEKNIS");
        $totalPengurangan = $jumlah_administrasi + (3 * $jumlah_teknis);
        $cekDBnilai = DB::connection('sqlsrv')->table('penilaian')
        ->where('id_trader',$id)
        ->select('*')
        ->get();
        if(count($cekDBnilai)>0){
            $skor = DB::connection('sqlsrv')->table('penilaian')
            ->where('id_trader', $id)
            ->pluck('skor')
            ->first();
            $total = $skor - $totalPengurangan;
            penilaian::where('id_trader', $id)
            ->update([
                'pengurangan' => $totalPengurangan,
                'total' => $total
            ]);
        }else{
            $total = 0 - $totalPengurangan;
            penilaian::insert([
                'id_trader' => $id,
                'skor'=> 0,
                'pengurangan'=> $totalPengurangan,
                'total'=> $total,
            ]);
        }

        return redirect()->route('perusahaan.pelanggaran', ['id' => $catatan->perusahaan_id])->with('success', 'Pelanggaran berhasil dicatat');


        // if (!$store) {
        //     return redirect()->back()->with('error', 'terjadi kesalahan');
        // }

        // if ($store) {
        //     $catatan = new Catatan;
        //     $catatan->perusahaan_id = $id;
        //     $catatan->id_ppk = $ppk;
        //     $catatan->tanggal_pelanggaran = $date;

        //     if ($administrasi <= 3 && $teknis == 0) {
        //         $catatan->tingkat_kepatuhan = 'Tinggi';
        //         $catatan->level_kepatuhan =  4;
        //     }
        //     if ($administrasi > 3 && $teknis == 0) {
        //         $catatan->tingkat_kepatuhan = 'Sedang';
        //         $catatan->level_kepatuhan =  3;
        //     }
        //     if ($administrasi >= 0 && $teknis <= 2 && $teknis > 0) {
        //         $catatan->tingkat_kepatuhan = 'Rendah';
        //         $catatan->level_kepatuhan =  2;
        //     }
        //     if ($administrasi >= 0 && $teknis > 2) {
        //         $catatan->tingkat_kepatuhan = 'Sangat Rendah';
        //         $catatan->level_kepatuhan =  1;
        //     }

        //     $catatan->save();

        //     return redirect()->back()->with('success', 'pelanggaran telah di catat');
        // }


        // $pelanggaran = new pelanggaranPerusahaan;
        // $pelanggaran->perusahaan_id = $id;
        // $pelanggaran->pelanggaran_id = $request->pelanggaran;
        // $pelanggaran->created_at = now();
        // $pelanggaran->save();
    }

    public function halamanEditCatatan($id)
    {
        $prev = DB::select("SELECT p.pelanggaran_id, p.keterangan, pel.checklist_id
                            from pelanggaran_perusahaan as p join catatan as c
                            on p.id_catatan = c.id
                            join pelanggaran as pel
                            on p.pelanggaran_id = pel.id
                            WHERE c.id = $id");
        $chck = $prev[0]->checklist_id;
        $data = DB::select("SELECT p.id, p.pelanggaran, p.kriteria, p.acuan, p.checklist_id, c.checklist, p.checklist_id
                            FROM checklist_pelanggaran AS c join pelanggaran AS p
                            ON p.checklist_id = c.id
                            WHERE p.checklist_id = $chck
                            ORDER BY p.id ASC");

        // dd($prev);
        // dd($data);
        return view('Catatan.edit', ['data' => $data, 'prev' => $prev, 'id' => $id]);
    }

    public function editCatatan($id, Request $request)
    {
        if ($request->data != null) {
            $administrasi = 0;
            $teknis = 0;
            foreach ($request->data as $p) {
                if (strpos($p, 'ASI')) {
                    $administrasi += 1;
                }
                if (strpos($p, 'EKNIS')) {
                    $teknis += 1;
                }
            }

            $catatan = Catatan::find($id);
            // dd($catatan);

            if ($administrasi <= 3 && $teknis == 0) {
                $catatan->tingkat_kepatuhan = 'Tinggi';
                $catatan->level_kepatuhan =  4;
            }
            if ($administrasi > 3 && $teknis == 0) {
                $catatan->tingkat_kepatuhan = 'Sedang';
                $catatan->level_kepatuhan =  3;
            }
            if ($administrasi >= 0 && $teknis <= 2 && $teknis > 0) {
                $catatan->tingkat_kepatuhan = 'Rendah';
                $catatan->level_kepatuhan =  2;
            }
            if ($administrasi >= 0 && $teknis > 2) {
                $catatan->tingkat_kepatuhan = 'Sangat Rendah';
                $catatan->level_kepatuhan =  1;
            }
            $catatan->pencatat = Auth::user()->name;
            $catatan->save();
            $i = 0;
            $perusahaan = intval($catatan->perusahaan_id);
            $delete = DB::table('pelanggaran_perusahaan')->where('id_catatan', '=', $id)->delete();
            if ($delete) {
                foreach ($request->data as $r) {
                    $store = pelanggaranPerusahaan::create([
                        'id_catatan' => $catatan->id,
                        'pelanggaran_id' => intval($r),
                        'perusahaan_id' => $perusahaan,
                        'keterangan' => $request['keterangan'][$i]
                    ]);
                    $i++;
                };
                if ($store) {
                    $id_trader = DB::table('pelanggaran_perusahaan')
                    ->where('id_catatan', $id)
                    ->pluck('perusahaan_id')
                    ->first();
                    $pelanggaran_perusahaan = DB::table('pelanggaran_perusahaan')
                    ->where('perusahaan_id', $id_trader)
                    ->pluck('pelanggaran_id');
                    $pengurangan = DB::table('pelanggaran')
                    ->whereIn('id', $pelanggaran_perusahaan)
                    ->pluck('kriteria');
                    $text = implode(" ", $pengurangan->toArray());
                    $jumlah_administrasi = substr_count($text, "ADMINISTRASI");
                    $jumlah_teknis = substr_count($text, "TEKNIS");
                    $totalPengurangan = $jumlah_administrasi + (3 * $jumlah_teknis);
                    $cekDBnilai = DB::connection('sqlsrv')->table('penilaian')
                    ->where('id_trader',$id_trader)
                    ->select('*')
                    ->get();
                    if(count($cekDBnilai)>0){
                        $skor = DB::connection('sqlsrv')->table('penilaian')
                        ->where('id_trader', $id_trader)
                        ->pluck('skor')
                        ->first();
                        $total = $skor - $totalPengurangan;
                        penilaian::where('id_trader', $id_trader)
                        ->update([
                            'pengurangan' => $totalPengurangan,
                            'total' => $total
                        ]);
                    }else{
                        $total = 0 - $totalPengurangan;
                        penilaian::insert([
                            'id_trader' => $id_trader,
                            'skor'=> 0,
                            'pengurangan'=> $totalPengurangan,
                            'total'=> $total,
                        ]);
                    }
                    return redirect()->route('perusahaan.pelanggaran', ['id' => $catatan->perusahaan_id])->with('success', 'data berhasil di edit');
                }
            } else {
                return redirect()->route('perusahaan.pelanggaran', ['id' => $catatan->perusahaan_id])->with('error', 'data gagal di edit');
            }
        } else {
            return redirect()->back()->with('delete', 'Data tidak boleh kosong, anda dapat menghapus catatan di halaman pelanggaran perusahaan');
        }
    }

    public function delete($id)
    {
        $id_trader = DB::table('pelanggaran_perusahaan')
        ->where('id_catatan', $id)
        ->pluck('perusahaan_id')
        ->first();
        
        $delete = DB::delete("DELETE FROM pelanggaran_perusahaan
                                WHERE id_catatan = $id");
        $catatan = Catatan::find($id);
        $pid = intval($catatan->perusahaan_id);
        if ($delete) {
            $rm = $catatan->delete();
            if ($rm) {
                $pelanggaran_perusahaan = DB::table('pelanggaran_perusahaan')
                ->where('perusahaan_id', $id_trader)
                ->pluck('pelanggaran_id');
                $pengurangan = DB::table('pelanggaran')
                    ->whereIn('id', $pelanggaran_perusahaan)
                    ->pluck('kriteria');
                    $text = implode(" ", $pengurangan->toArray());
                    $jumlah_administrasi = substr_count($text, "ADMINISTRASI");
                    $jumlah_teknis = substr_count($text, "TEKNIS");
                    $totalPengurangan = $jumlah_administrasi + (3 * $jumlah_teknis);
                    $cekDBnilai = DB::connection('sqlsrv')->table('penilaian')
                    ->where('id_trader',$id_trader)
                    ->select('*')
                    ->get();
                    if(count($cekDBnilai)>0){
                        $skor = DB::connection('sqlsrv')->table('penilaian')
                        ->where('id_trader', $id_trader)
                        ->pluck('skor')
                        ->first();
                        $total = $skor - $totalPengurangan;
                        penilaian::where('id_trader', $id_trader)
                        ->update([
                            'pengurangan' => $totalPengurangan,
                            'total' => $total
                        ]);
                    }else{
                        $total = 0 - $totalPengurangan;
                        penilaian::insert([
                            'id_trader' => $id_trader,
                            'skor'=> 0,
                            'pengurangan'=> $totalPengurangan,
                            'total'=> $total,
                        ]);
                    }
                return redirect()->route('perusahaan.pelanggaran', ['id' => $pid])->with('success', 'Catatan telah terhapus');
            }
        }
        return redirect()->route('perusahaan.pelanggaran', ['id' => $pid])->with('error', 'Terjadi keasalah, Catatan gagal dihapus');
    }

    public function cetakLaporan(Request $request, $id)
    {
        $perusahaan = perusahaan::find($id);
        $catatan = Catatan::find($request->ppk);
        $no = $catatan->id_ppk;
        $ppk = DB::connection('sqlsrv2')->select("SELECT DISTINCT no_ppk FROM v_rpt_ops_harian where id_ppk = $no");
        $noppk = $ppk[0]->no_ppk;
        $pelanggaran = DB::select("SELECT *, p.keterangan as ket FROM pelanggaran_perusahaan AS p 
                                     JOIN pelanggaran AS pe 
                                     ON p.pelanggaran_id = pe.id
                                     JOIN checklist_pelanggaran AS c
                                     ON c.id = pe.checklist_id
                                     JOIN catatan AS ca
                                     ON ca.id = p.id_catatan
                                     WHERE ca.id = $request->ppk");
        // dd($pelanggaran);

        $pdf = PDF::loadview('cetakpdf', ['pelanggaran' => $pelanggaran, 'ppk' => $ppk, 'nilai' => $catatan, 'pe' => $perusahaan]);
        return $pdf->download("Laporan Pelanggaran $perusahaan->nm_trader PPK $noppk.pdf");
    }
}
