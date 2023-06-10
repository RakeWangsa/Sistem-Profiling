<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use App\Models\checklistPelanggaran;
use App\Models\pelanggaran;
use App\Models\pelanggaranPerusahaan;
use App\Models\perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

class PelanggaranController extends Controller
{
    public function index()
    {
        $data = DB::select("SELECT p.id, p.pelanggaran, p.kriteria, p.acuan, p.checklist_id, c.checklist, p.checklist_id
                            FROM checklist_pelanggaran AS c join pelanggaran AS p
                            ON p.checklist_id = c.id");
        return view('Pelanggaran.index', ['pelanggaran' => $data]);
    }

    public function tambah()
    {
        $checklist = checklistPelanggaran::get();
        return view('Pelanggaran.insert', ['checklist' => $checklist]);
    }

    public function edit($id)
    {
        $data = pelanggaran::find($id);
        $checklist = checklistPelanggaran::get();
        return view('Pelanggaran.edit', [
            'pelanggaran' => $data,
            'checklist' => $checklist
        ]);
    }

    public function insert(Request $request)
    {
        $store = DB::table('pelanggaran')->insert([
            'checklist_id' => $request->checklist_id,
            'pelanggaran' => $request->pelanggaran,
            'kriteria' => $request->kriteria,
            'acuan' => $request->acuan,
            'keterangan' => $request->keterangan
        ]);

        if(!$store){
            return redirect()->back()->with('error', 'data gagal ditambahkan');
        }
        return redirect()->back()->with('success', 'data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $pelanggaran = pelanggaran::find($id);
        $pelanggaran->timestamps = false;
        $pelanggaran->kriteria = $request->kriteria;
        $pelanggaran->checklist_id = $request->checklist;
        $pelanggaran->pelanggaran = $request->pelanggaran;
        $pelanggaran->acuan = $request->acuan;

        $result = $pelanggaran->save();
        if ($result) {
            return redirect()->route('pelanggaran')->with('success', 'Data telah terupdate');
        } else {
            return redirect()->route('pelanggaran')->with('error', $result);
        }
    }

    public function delete($id)
    {
        // $result = DB::delete("DELETE FROM pelanggaran WHERE id = $id");
        $pelanggaran = pelanggaran::find($id);
        $do = DB::connection('sqlsrv')->select("SELECT pelanggaran_id
        FROM pelanggaran_perusahaan where pelanggaran_id = $id");
        if(count($do)){
            return redirect()->route('pelanggaran')->with('error', 'data gagal di hapus, karena data masih ada dalam catatan');
        }
        $result = $pelanggaran->delete();
        if (!$result) {
            return redirect()->route('pelanggaran')->with('error', 'data gagal di hapus');
        }
        return redirect()->route('pelanggaran')->with('success', 'Data telah terhapus');
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
                <input type="checkbox" name="data[]" id="' . $p->id . '" value="' . $p->id . ' data-value = ' . $p->kriteria . '">
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

}
