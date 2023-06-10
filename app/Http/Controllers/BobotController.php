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
        if($total>0 and $total<=1){
            if(isset($request->bobot_1)){
                $cekDB1 = Bobot::where('kode', $kategori_1[0])->first();
                if ($cekDB1) {
                    Bobot::where('kode', $kategori_1[0])
                    ->update([
                        'bobot' => $request->bobot_1,
                    ]);
                }else {
                    Bobot::insert([
                        'kode' => $kategori_1[0],
                        'kategori' => $kategori_1[1],
                        'bobot' => $request->bobot_1,
                    ]);
                }
            }else{
                $cekDB1 = Bobot::where('kode', $kategori_1[0])->first();
                if ($cekDB1) {
                    Bobot::where('kode', $kategori_1[0])
                    ->update([
                        'bobot' => '0'
                    ]);
                }else {
                    Bobot::insert([
                        'kode' => $kategori_1[0],
                        'kategori' => $kategori_1[1],
                        'bobot' => '0'
                    ]);
                }
            }
            if(isset($request->bobot_2)){
                $cekDB2 = Bobot::where('kode', $kategori_2[0])->first();
                if ($cekDB2) {
                    Bobot::where('kode', $kategori_2[0])
                    ->update([
                        'bobot' => $request->bobot_2,
                    ]);
                } else {
                    Bobot::insert([
                        'kode' => $kategori_2[0],
                        'kategori' => $kategori_2[1],
                        'bobot' => $request->bobot_2,
                    ]);
                }
            }else{
                $cekDB2 = Bobot::where('kode', $kategori_2[0])->first();
                if ($cekDB2) {
                    Bobot::where('kode', $kategori_2[0])
                    ->update([
                        'bobot' => '0'
                    ]);
                } else {
                    Bobot::insert([
                        'kode' => $kategori_2[0],
                        'kategori' => $kategori_2[1],
                        'bobot' => '0'
                    ]);
                }
            }
            if(isset($request->bobot_3)){
                $cekDB3 = Bobot::where('kode', $kategori_3[0])->first();
                if ($cekDB3) {
                    Bobot::where('kode', $kategori_3[0])
                    ->update([
                        'bobot' => $request->bobot_3,
                    ]);
                } else {
                    Bobot::insert([
                        'kode' => $kategori_3[0],
                        'kategori' => $kategori_3[1],
                        'bobot' => $request->bobot_3,
                    ]);
                }
            }else{
                $cekDB3 = Bobot::where('kode', $kategori_3[0])->first();
                if ($cekDB3) {
                    Bobot::where('kode', $kategori_3[0])
                    ->update([
                        'bobot' => '0'
                    ]);
                } else {
                    Bobot::insert([
                        'kode' => $kategori_3[0],
                        'kategori' => $kategori_3[1],
                        'bobot' => '0'
                    ]);
                }
            }
            if(isset($request->bobot_4)){
                $cekDB4 = Bobot::where('kode', $kategori_4[0])->first();
                if ($cekDB4) {
                    Bobot::where('kode', $kategori_4[0])
                    ->update([
                        'bobot' => $request->bobot_4,
                    ]);
                } else {
                    Bobot::insert([
                        'kode' => $kategori_4[0],
                        'kategori' => $kategori_4[1],
                        'bobot' => $request->bobot_4,
                    ]);
                }
            }else{
                $cekDB4 = Bobot::where('kode', $kategori_4[0])->first();
                if ($cekDB4) {
                    Bobot::where('kode', $kategori_4[0])
                    ->update([
                        'bobot' => '0'
                    ]);
                } else {
                    Bobot::insert([
                        'kode' => $kategori_4[0],
                        'kategori' => $kategori_4[1],
                        'bobot' => '0'
                    ]);
                }
            }
    
            return redirect('/') ; 
        }else{
            return redirect('/bobot/' . $id_trader)->with('gagal', 'Jumlah bobot harus antara 0-1');
        }
        
    
    }
}
