<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catatan;
use App\Models\checklistPelanggaran;
use App\Models\pelanggaran;
use App\Models\pelanggaranPerusahaan;
use App\Models\perusahaan;
use App\Models\Kategorisasi;
use App\Models\Bobot;
use App\Models\penilaian;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\Auth;
use PDF;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;


class BobotController extends Controller
{   
    public function index(Request $request){
        $id_trader = request()->segment(2);
        $header = DB::connection('sqlsrv2')->select("SELECT id_trader, nm_trader, al_trader FROM [tb_r_trader] WHERE id_trader = $id_trader");
        return view('Bobot.index', ['header' => $header , 'id_trader' => $id_trader]);
    }
    
    public function submit(Request $request){
        $id_trader = request()->segment(2);

        //Verifikasi 1
        $kategori_1 = explode(':', $request->kategori_1);
        //Verifikasi 2 
        $kategori_2 = explode(':', $request->kategori_2);
        //Verifikasi 3 
        $kategori_3 = explode(':', $request->kategori_3);
        //Verifikasi 4
        $kategori_4 = explode(':', $request->kategori_4);
        $total=$request->bobot_1+$request->bobot_2+$request->bobot_3+$request->bobot_4;
        if($total>0 and $total<=100){
            $cekDB = Bobot::get();
            if (count($cekDB)>0) {
                Bobot::where('kode', $kategori_1[0])
                ->update([
                    'bobot' => $request->bobot_1,
                ]);
                Bobot::where('kode', $kategori_2[0])
                    ->update([
                        'bobot' => $request->bobot_2,
                ]);
                Bobot::where('kode', $kategori_3[0])
                    ->update([
                        'bobot' => $request->bobot_3,
                ]);
                Bobot::where('kode', $kategori_4[0])
                    ->update([
                        'bobot' => $request->bobot_4,
                ]);
            }else{
                Bobot::insert([
                    'kode' => $kategori_1[0],
                    'kategori' => $kategori_1[1],
                    'bobot' => $request->bobot_1,
                ]);
                Bobot::insert([
                    'kode' => $kategori_2[0],
                    'kategori' => $kategori_2[1],
                    'bobot' => $request->bobot_2,
                ]);
                Bobot::insert([
                    'kode' => $kategori_3[0],
                    'kategori' => $kategori_3[1],
                    'bobot' => $request->bobot_3,
                ]);
                Bobot::insert([
                    'kode' => $kategori_4[0],
                    'kategori' => $kategori_4[1],
                    'bobot' => $request->bobot_4,
                ]);
            }
            $id_trader = DB::connection('sqlsrv')->table('penilaian')
            ->select('id_trader')
            ->get();
            foreach ($id_trader as $row) {
                $sumA = DB::connection('sqlsrv2')->table('kepatuhan')
                ->where('id_trader', $row->id_trader)
                ->where('kode', 'A')
                ->sum('nilai');
                $bobotA = DB::connection('sqlsrv2')->table('bobot')
                    ->where('kode', 'A')
                    ->pluck('bobot')
                    ->first();
                $nilaiA=($sumA/35)*10;

                $sumB = DB::connection('sqlsrv2')->table('kepatuhan')
                    ->where('id_trader', $row->id_trader)
                    ->where('kode', 'B')
                    ->sum('nilai');
                $bobotB = DB::connection('sqlsrv2')->table('bobot')
                    ->where('kode', 'B')
                    ->pluck('bobot')
                    ->first();
                $nilaiB=($sumB/35)*20;

                $sumC = DB::connection('sqlsrv2')->table('kepatuhan')
                    ->where('id_trader', $row->id_trader)
                    ->where('kode', 'C')
                    ->sum('nilai');
                $bobotC = DB::connection('sqlsrv2')->table('bobot')
                    ->where('kode', 'C')
                    ->pluck('bobot')
                    ->first();
                $nilaiC=($sumC/60)*30;

                $sumD = DB::connection('sqlsrv2')->table('kepatuhan')
                    ->where('id_trader', $row->id_trader)
                    ->where('kode', 'D')
                    ->sum('nilai');
                $bobotD = DB::connection('sqlsrv2')->table('bobot')
                    ->where('kode', 'D')
                    ->pluck('bobot')
                    ->first();
                $nilaiD=($sumD/20)*40;
                $skor=$nilaiA+$nilaiB+$nilaiC+$nilaiD;
//$skor=100;
                $cekDBnilai = DB::connection('sqlsrv')->table('penilaian')
                ->where('id_trader',$row->id_trader)
                ->select('*')
                ->get();
                if(count($cekDBnilai)>0){
                    $pengurangan = DB::connection('sqlsrv')->table('penilaian')
                    ->where('id_trader', $row->id_trader)
                    ->pluck('pengurangan')
                    ->first();
                    $total=$skor - $pengurangan;
                    if($total>=75){
                        $kepatuhan="tinggi";
                    }elseif($total<75 && $total>=45){
                        $kepatuhan="sedang";
                    }else{
                        $kepatuhan="rendah";
                    }
                    penilaian::where('id_trader', $row->id_trader)
                    ->update([
                        'skor' => $skor,
                        'total' => $total,
                        'kepatuhan' => $kepatuhan
                    ]);
                }else{
                    if($skor>=75){
                        $kepatuhan="tinggi";
                    }elseif($skor<75 && $skor>=45){
                        $kepatuhan="sedang";
                    }else{
                        $kepatuhan="rendah";
                    }
                    penilaian::insert([
                        'id_trader' => $row->id_trader,
                        'skor'=> $skor,
                        'pengurangan'=> 0,
                        'total'=> $skor,
                        'kepatuhan' => $kepatuhan
                    ]);
                }
            }
            
            return redirect('/') ; 
        }else{
            return redirect('/bobot/' . $id_trader)->with('gagal', 'Jumlah bobot harus antara 0-100');
        }
        
    
    }
}
