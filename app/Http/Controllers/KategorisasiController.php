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


class KategorisasiController extends Controller
{   
    public function index(Request $request){
        $id_trader = request()->segment(2);
        $header = DB::connection('sqlsrv2')->select("SELECT id_trader, nm_trader, al_trader FROM [tb_r_trader] WHERE id_trader = $id_trader");
        return view('Kategorisasi.index', ['header' => $header , 'id_trader' => $id_trader]);
    }
    

    public function submit(Request $request){
       $id_trader = request()->segment(2);
       $nilai = 0;
    //    $kategorisasi = Kategorisasi::find($id_trader);
    // $kategorisasi = DB::table('kepatuhan')
    //     ->where('id_trader',$id_trader)
    //     ->select('*')
    //     ->get();
    
       //Verifikasi 1
       $v1_1 = explode(':', $request->v1_1);
       $v3_1 = explode(':', $request->v3_1);
       $v3_2 = explode(':', $request->v3_2);
       $v3_3 = explode(':', $request->v3_3);
       $v3_4 = explode(':', $request->v3_4);
       $v3_5 = explode(':', $request->v3_5);
       $v3_6 = explode(':', $request->v3_6);
       $v3_7 = explode(':', $request->v3_7);
       //Verifikasi 2 
       $v1_2 = explode(':', $request->v1_2);
       $v3_8 = explode(':', $request->v3_8);
       $v3_9 = explode(':', $request->v3_9);
       $v3_10 = explode(':', $request->v3_10);
       $v3_11 = explode(':', $request->v3_11);
       $v3_12 = explode(':', $request->v3_12);
       $v3_13 = explode(':', $request->v3_13);
       $v3_14 = explode(':', $request->v3_14);
       //Verifikasi 3 
       $v1_3 = explode(':', $request->v1_3);
       $v3_15 = explode(':', $request->v3_15);
       $v3_16 = explode(':', $request->v3_16);
       $v3_17 = explode(':', $request->v3_17);
       $v3_18 = explode(':', $request->v3_18);
       $v3_19 = explode(':', $request->v3_19);
       $v3_20 = explode(':', $request->v3_20);
       $v3_21 = explode(':', $request->v3_21);
       $v3_22 = explode(':', $request->v3_22);
       $v3_23 = explode(':', $request->v3_23);
       $v3_24 = explode(':', $request->v3_24);
       $v3_25 = explode(':', $request->v3_25);
       $v3_26 = explode(':', $request->v3_26);
       //Verifikasi 4
       $v1_4 = explode(':', $request->v1_4);
       $v3_27 = explode(':', $request->v3_27);
       $v3_28 = explode(':', $request->v3_28);
       $v3_29 = explode(':', $request->v3_29);
       $v3_30 = explode(':', $request->v3_30);

       // Verifikasi 1 
        // if ($kategorisasi) {
        //     // Lakukan update data
        //     $kategorisasi->verifikasi1 = $request->v1_1;
        //     $kategorisasi->verifikasi2 = $request->v2_1;
        //     $kategorisasi->verifikasi3 = $v3_1[1];
        //     $kategorisasi->nilai = $v3_1[0];
        //     $kategorisasi->save();

        //     // Lakukan langkah yang sama untuk data lainnya
        //     // ...

        // } else {
        //     // Lakukan insert data
        //     Kategorisasi::insert([
        //         'id_trader' => $id_trader,
        //         'verifikasi1' => $request->v1_1,
        //         'verifikasi2' => $request->v2_1,
        //         'verifikasi3' => $v3_1[1],
        //         'nilai' => $v3_1[0]
        //     ]);

        //     // Lakukan langkah yang sama untuk data lainnya
        //     // ...
        // }
        $cekDB = DB::connection('sqlsrv2')->table('kepatuhan')
        ->where('id_trader',$id_trader)
        ->select('*')
        ->get();
        if(count($cekDB)>0){
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_1)
            ->update([
                'verifikasi3' => $v3_1[1],
                'nilai' => $v3_1[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_2)
            ->update([
                'verifikasi3' => $v3_2[1],
                'nilai' => $v3_2[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_3)
            ->update([
                'verifikasi3' => $v3_3[1],
                'nilai' => $v3_3[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_4)
            ->update([
                'verifikasi3' => $v3_4[1],
                'nilai' => $v3_4[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_5)
            ->update([
                'verifikasi3' => $v3_5[1],
                'nilai' => $v3_5[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_6)
            ->update([
                'verifikasi3' => $v3_6[1],
                'nilai' => $v3_6[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_7)
            ->update([
                'verifikasi3' => $v3_7[1],
                'nilai' => $v3_7[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_8)
            ->update([
                'verifikasi3' => $v3_8[1],
                'nilai' => $v3_8[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_9)
            ->update([
                'verifikasi3' => $v3_9[1],
                'nilai' => $v3_9[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_10)
            ->update([
                'verifikasi3' => $v3_10[1],
                'nilai' => $v3_10[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_11)
            ->update([
                'verifikasi3' => $v3_11[1],
                'nilai' => $v3_11[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_12)
            ->update([
                'verifikasi3' => $v3_12[1],
                'nilai' => $v3_12[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_13)
            ->update([
                'verifikasi3' => $v3_13[1],
                'nilai' => $v3_13[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_14)
            ->update([
                'verifikasi3' => $v3_14[1],
                'nilai' => $v3_14[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_15)
            ->update([
                'verifikasi3' => $v3_15[1],
                'nilai' => $v3_15[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_16)
            ->update([
                'verifikasi3' => $v3_16[1],
                'nilai' => $v3_16[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_17)
            ->update([
                'verifikasi3' => $v3_17[1],
                'nilai' => $v3_17[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_18)
            ->update([
                'verifikasi3' => $v3_18[1],
                'nilai' => $v3_18[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_19)
            ->update([
                'verifikasi3' => $v3_19[1],
                'nilai' => $v3_19[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_20)
            ->update([
                'verifikasi3' => $v3_20[1],
                'nilai' => $v3_20[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_21)
            ->update([
                'verifikasi3' => $v3_21[1],
                'nilai' => $v3_21[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_22)
            ->update([
                'verifikasi3' => $v3_22[1],
                'nilai' => $v3_22[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_23)
            ->update([
                'verifikasi3' => $v3_23[1],
                'nilai' => $v3_23[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_24)
            ->update([
                'verifikasi3' => $v3_24[1],
                'nilai' => $v3_24[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_25)
            ->update([
                'verifikasi3' => $v3_25[1],
                'nilai' => $v3_25[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_26)
            ->update([
                'verifikasi3' => $v3_26[1],
                'nilai' => $v3_26[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_27)
            ->update([
                'verifikasi3' => $v3_27[1],
                'nilai' => $v3_27[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_28)
            ->update([
                'verifikasi3' => $v3_28[1],
                'nilai' => $v3_28[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_29)
            ->update([
                'verifikasi3' => $v3_29[1],
                'nilai' => $v3_29[0]
            ]);
        
            Kategorisasi::where('id_trader', $id_trader)
            ->where('verifikasi2', $request -> v2_30)
            ->update([
                'verifikasi3' => $v3_30[1],
                'nilai' => $v3_30[0]
            ]);   
        }else{
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_1[0],
                'verifikasi1'=> $v1_1[1],
                'verifikasi2'=> $request -> v2_1,
                'verifikasi3'=> $v3_1[1],
                'nilai' => $v3_1[0]
            ]);

            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_1[0],
                'verifikasi1'=> $v1_1[1],
                'verifikasi2'=> $request -> v2_2,
                'verifikasi3'=> $v3_2[1],
                'nilai' => $v3_2[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_1[0],
                'verifikasi1'=> $v1_1[1],
                'verifikasi2'=> $request -> v2_3,
                'verifikasi3'=> $v3_3[1],
                'nilai' => $v3_3[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_1[0],
                'verifikasi1'=> $v1_1[1],
                'verifikasi2'=> $request -> v2_4,
                'verifikasi3'=> $v3_4[1],
                'nilai' => $v3_4[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_1[0],
                'verifikasi1'=> $v1_1[1],
                'verifikasi2'=> $request -> v2_5,
                'verifikasi3'=> $v3_5[1],
                'nilai' => $v3_5[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_1[0],
                'verifikasi1'=> $v1_1[1],
                'verifikasi2'=> $request -> v2_6,
                'verifikasi3'=> $v3_6[1],
                'nilai' => $v3_6[0]
            ]);

            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_1[0],
                'verifikasi1'=> $v1_1[1],
                'verifikasi2'=> $request -> v2_7,
                'verifikasi3'=> $v3_7[1],
                'nilai' => $v3_7[0]
            ]);
        
            // Verifikasi 2
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_2[0],
                'verifikasi1'=> $v1_2[1],
                'verifikasi2'=> $request -> v2_8,
                'verifikasi3'=> $v3_8[1],
                'nilai' => $v3_8[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_2[0],
                'verifikasi1'=> $v1_2[1],
                'verifikasi2'=> $request -> v2_9,
                'verifikasi3'=> $v3_9[1],
                'nilai' => $v3_9[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_2[0],
                'verifikasi1'=> $v1_2[1],
                'verifikasi2'=> $request -> v2_10,
                'verifikasi3'=> $v3_10[1],
                'nilai' => $v3_10[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_2[0],
                'verifikasi1'=> $v1_2[1],
                'verifikasi2'=> $request -> v2_11,
                'verifikasi3'=> $v3_11[1],
                'nilai' => $v3_11[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_2[0],
                'verifikasi1'=> $v1_2[1],
                'verifikasi2'=> $request -> v2_12,
                'verifikasi3'=> $v3_12[1],
                'nilai' => $v3_12[0]
            ]);
    
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_2[0],
                'verifikasi1'=> $v1_2[1],
                'verifikasi2'=> $request -> v2_13,
                'verifikasi3'=> $v3_13[1],
                'nilai' => $v3_13[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_2[0],
                'verifikasi1'=> $v1_2[1],
                'verifikasi2'=> $request -> v2_14,
                'verifikasi3'=> $v3_14[1],
                'nilai' => $v3_14[0]
            ]);
        
            //Verifikasi 3
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_3[0],
                'verifikasi1'=> $v1_3[1],
                'verifikasi2'=> $request -> v2_15,
                'verifikasi3'=> $v3_15[1],
                'nilai' => $v3_15[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_3[0],
                'verifikasi1'=> $v1_3[1],
                'verifikasi2'=> $request -> v2_16,
                'verifikasi3'=> $v3_16[1],
                'nilai' => $v3_16[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_3[0],
                'verifikasi1'=> $v1_3[1],
                'verifikasi2'=> $request -> v2_17,
                'verifikasi3'=> $v3_17[1],
                'nilai' => $v3_17[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_3[0],
                'verifikasi1'=> $v1_3[1],
                'verifikasi2'=> $request -> v2_18,
                'verifikasi3'=> $v3_18[1],
                'nilai' => $v3_18[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_3[0],
                'verifikasi1'=> $v1_3[1],
                'verifikasi2'=> $request -> v2_19,
                'verifikasi3'=> $v3_19[1],
                'nilai' => $v3_19[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_3[0],
                'verifikasi1'=> $v1_3[1],
                'verifikasi2'=> $request -> v2_20,
                'verifikasi3'=> $v3_20[1],
                'nilai' => $v3_20[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_3[0],
                'verifikasi1'=> $v1_3[1],
                'verifikasi2'=> $request -> v2_21,
                'verifikasi3'=> $v3_21[1],
                'nilai' => $v3_21[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_3[0],
                'verifikasi1'=> $v1_3[1],
                'verifikasi2'=> $request -> v2_22,
                'verifikasi3'=> $v3_22[1],
                'nilai' => $v3_22[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_3[0],
                'verifikasi1'=> $v1_3[1],
                'verifikasi2'=> $request -> v2_23,
                'verifikasi3'=> $v3_23[1],
                'nilai' => $v3_23[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_3[0],
                'verifikasi1'=> $v1_3[1],
                'verifikasi2'=> $request -> v2_24,
                'verifikasi3'=> $v3_24[1],
                'nilai' => $v3_24[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_3[0],
                'verifikasi1'=> $v1_3[1],
                'verifikasi2'=> $request -> v2_25,
                'verifikasi3'=> $v3_25[1],
                'nilai' => $v3_25[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_3[0],
                'verifikasi1'=> $v1_3[1],
                'verifikasi2'=> $request -> v2_26,
                'verifikasi3'=> $v3_26[1],
                'nilai' => $v3_26[0]
            ]);
        
            //Verifikasi 4
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_4[0],
                'verifikasi1'=> $v1_4[1],
                'verifikasi2'=> $request -> v2_27,
                'verifikasi3'=> $v3_27[1],
                'nilai' => $v3_27[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_4[0],
                'verifikasi1'=> $v1_4[1],
                'verifikasi2'=> $request -> v2_28,
                'verifikasi3'=> $v3_28[1],
                'nilai' => $v3_28[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_4[0],
                'verifikasi1'=> $v1_4[1],
                'verifikasi2'=> $request -> v2_29,
                'verifikasi3'=> $v3_29[1],
                'nilai' => $v3_29[0]
            ]);
        
            Kategorisasi::insert([
                'id_trader' => $id_trader,
                'kode'=> $v1_4[0],
                'verifikasi1'=> $v1_4[1],
                'verifikasi2'=> $request -> v2_30,
                'verifikasi3'=> $v3_30[1],
                'nilai' => $v3_30[0]
            ]);
        }
        return redirect('/') ; 
    }
}
