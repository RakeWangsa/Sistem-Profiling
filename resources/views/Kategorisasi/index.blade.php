@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="row justify-content-between ml-1 mr-1">
                <h1 class="mt-4">Kategorisasi Resiko</h1>
                <a class="btn btn-secondary mt-4 mb-4 text-white" href="/bobot/{{$id_trader}}">Input Bobot</a>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label ">Nama Perusahaan</label>
                                <div class="col-sm-10">
                                    @if (isset($header))
                                    <h6> {{ $header[0]->nm_trader }} </h6>
                                  @else
                                    <h6></h6>
                                    @endif
                                </div>

                                <label for="inputPassword" class="col-sm-2 col-form-label mb-4">Nama Pemilik</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" >
                                </div>

                                <label for="inputPassword" class="col-sm-2 col-form-label ">Alamat Kantor Pusat</label>
                                <div class="col-sm-10 ">
                                    @if (isset($header))
                                    <h6> {{ $header[0]->al_trader }} </h6>
                                  @else
                                    <h6></h6>
                                    @endif
                                </div>

                                <label for="inputPassword" class="col-sm-2 col-form-label ">Alamat Instalasi</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" >
                                </div>

                                <label for="inputPassword" class="col-sm-2 col-form-label mb-4">Komoditas</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" >
                                </div>

                            
                                <label for="inputPassword" class="col-sm-2 col-form-label mb-4">Jenis Kegiatan</label>
                                <select  class="form-select col-sm-10 mb-4">
                                    <option>Importasi Ikan Hias (UPI)</option>
                                    <option>Distributor</option>
                                </select>
                                

                                <label for="inputPassword" class="col-sm-2 col-form-label mb-4">UPT BKIPM</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <form class="row g-3 mt-3" method="GET" action="{{route('SubmitKategorisasi',['id_trader'=> $id_trader])}}">
                            <!-- Verifikasi 1 -->
                            <div class="card-header col-sm-11 ml-3">
                                <input name="v1_1" type="text" class="form-control col-sm-10"  value="A:STATUS KEPEMILIKAN PERUSAHAAN" style="border: none; background-color: transparent;" readonly>
                            </div>

                            <div class="card-body">
                                <div class="mb-2 row">
                                    <input name="v2_1" type="text" class="form-control col-sm-10 ml-2"  value="Kepemilikan Perusahaan" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_1" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Perusahaan milik sendiri dan atas nama sendiri">Perusahaan milik sendiri dan atas nama sendiri</option>
                                        <option value="3:Perusahaan milik sendiri tetapi atas nama orang lain">Perusahaan milik sendiri tetapi atas nama orang lain</option>
                                        <option value="1:Perusahaan atas nama orang lain">Perusahaan atas nama orang lain</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_2"type="text" class="form-control col-sm-10 ml-2"  value="Status Tempat Usaha" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_2" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Milik sendiri">Milik sendiri</option>
                                        <option value="3:Gedung sewa tetapi fasilitas milik sendiri">Gedung sewa tetapi fasilitas milik sendiri</option>
                                        <option value="1:Gedung beserta fasilitasnya sewa/tidak punya kantor sendiri">Gedung beserta fasilitasnya sewa/tidak punya kantor sendiri</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_3"type="text" class="form-control col-sm-10 ml-2"  value="Lama Usaha" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_3" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:> 5 tahun">> 5 tahun</option>
                                        <option value="3:Antara 1-5 tahun">Antara 1-5 tahun</option>
                                        <option value="1:< 1 tahun">< 1 tahun</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_4" type="text" class="form-control col-sm-10 ml-2"  value="Jenis Usaha" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_4" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Produsen">Produsen</option>
                                        <option value="3:Produsen dan distributor/trader">Produsen dan distributor/trader</option>
                                        <option value="1:Distributor/trader">Distributor/trader</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_5" type="text" class="form-control col-sm-10 ml-2"  value="Skala Usaha" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_5" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Besar (Aset di atas 10 M)">Besar (Aset di atas 10 M)</option>
                                        <option value="3:Menengah (Aset 500 juta s/d 10 M)">Menengah (Aset 500 juta s/d 10 M)</option>
                                        <option value="1:Kecil (Aset di bawah 500 juta)">Kecil (Aset di bawah 500 juta)</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_6" type="text" class="form-control col-sm-10 ml-2"  value="Bidang Usaha" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_6" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Bergerak hanya di satu bidang usaha saja">Bergerak hanya di satu bidang usaha saja</option>
                                        <option value="3:Bergerak di lebih dari satu bidang usaha namun masih dalam bidang perikanan">Bergerak di lebih dari satu bidang usaha namun masih dalam bidang perikanan</option>
                                        <option value="1:Bergerak juga di bidang di luar perikanan">Bergerak juga di bidang di luar perikanan</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_7" type="text" class="form-control col-sm-10 ml-2"  value="Legalitas Perusahaan" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_7" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Dokumen legalitas perusahaan lengkap dan masih berlaku">Dokumen legalitas perusahaan lengkap dan masih berlaku</option>
                                        <option value="3:Dokumen legalitas perusahaan lengkap tetapi ada yang sudah tidak berlaku">Dokumen legalitas perusahaan lengkap tetapi ada yang sudah tidak berlaku</option>
                                        <option value="1:Dokumen legalitas perusahaan tidak lengkap dan ada yang sudah tidak berlaku">Dokumen legalitas perusahaan tidak lengkap dan ada yang sudah tidak berlaku</option>
                                    </select>
                                </div>
                            </div>
                            
                            
                            <!-- Verifikasi 2 -->
                            <div class="card-header col-sm-11 ml-3">
                                <input name="v1_2" type="text" class="form-control col-sm-10"  value="B:SARANA DAN PRASARANA" style="border: none; background-color: transparent;" readonly>
                            </div>

                            <div class="card-body">
                                <div class="mb-2 row">
                                    <input name="v2_8" type="text" class="form-control col-sm-10 ml-2"  value="Kelengkapan Sarana dan Prasarana" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_8"  class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Memadai">Memadai</option>
                                        <option value="3:Cukup">Cukup</option>
                                        <option value="1:Tidak Memadai">Tidak Memadai</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_9" type="text" class="form-control col-sm-10 ml-2"  value="Kepemilikan Sarana dan Prasarana Kantor" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_9" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Milik sendiri">Milik sendiri</option>
                                        <option value="3:Sewa dalam jangka waktu yang panjang (lebih 5 tahun)">Sewa dalam jangka waktu yang panjang (lebih 5 tahun)</option>
                                        <option value="1:Sewa dalam jangka waktu pendek (temporal)">Sewa dalam jangka waktu pendek (temporal)</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_10" type="text" class="form-control col-sm-10 ml-2"  value="Kondisi Sanitasi/Higienis (Biosecurity)" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_10" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Baik dan terawat sesuai fungsi">Baik dan terawat sesuai fungsi</option>
                                        <option value="3:Kurang Baik dan tidak terawat sesuai fungsi">Kurang Baik dan tidak terawat sesuai fungsi</option>
                                        <option value="1:Tidak baik dan tidak terawat tidak sesuai fungsi">Tidak baik dan tidak terawat tidak sesuai fungsi</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_11" type="text" class="form-control col-sm-10 ml-2"  value="Alamat Kantor dan IKI" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_11" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Alamat jelas (alamat kantor dan alamat IKI jadi satu)">Alamat jelas (alamat kantor dan alamat IKI jadi satu)</option>
                                        <option value="3:Alamat kantor dan alamat IKI berbeda">Alamat kantor dan alamat IKI berbeda</option>
                                        <option value="1:Alamat kantor dan IKI tidak jelas (fiktif)">Alamat kantor dan IKI tidak jelas (fiktif)</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_12" type="text" class="form-control col-sm-10 ml-2"  value="Grade IKI" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_12" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Sangat baik (A)">Sangat baik (A)</option>
                                        <option value="3:Baik (B)">Baik (B)</option>
                                        <option value="1:Kurang baik (C) atau belum punya IKI">Kurang baik (C) atau belum punya IKI</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_13" type="text" class="form-control col-sm-10 ml-2"  value="Status Kepemilikan dan Penggunaan IKI" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_13" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Milik sendiri dan digunakan sendiri">Milik sendiri dan digunakan sendiri</option>
                                        <option value="3:Sewa dipakai sendiri">Sewa dipakai sendiri</option>
                                        <option value="1:Milik sendiri atau sewa dan dipakai bersama dengan orang lain">Milik sendiri atau sewa dan dipakai bersama dengan orang lain</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_14" type="text" class="form-control col-sm-10 ml-2"  value="Frekuensi Kegiatan Importasi" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_14" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Sering ( > 4 kali/ bulan  ada Impor)">Sering ( > 4 kali/ bulan  ada Impor)</option>
                                        <option value="3:Jarang ( 2-4 kali/bulan ada impor)">Jarang ( 2-4 kali/bulan ada impor)</option>
                                        <option value="1:Jarang sekali  maksimal sekali sebulan ada impor">Jarang sekali  maksimal sekali sebulan ada impor</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Verifikasi 3 -->
                            <div class="card-header col-sm-11 ml-3">
                                <input name="v1_3" type="text" class="form-control col-sm-11"  value="C:KETAATAN PADA PROSEDUR TINDAKAN KARANTINA IKAN, MUTU DAN KKP" style="border: none; background-color: transparent;" readonly>
                            </div>

                            <div class="card-body">
                                <div class="mb-2 row">
                                    <input name="v2_15" type="text" class="form-control col-sm-10 ml-2"  value="Pelaporan PPK" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_15"  class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:2 hari sebelum barang tiba dipelabuhan">2 hari sebelum barang tiba dipelabuhan</option>
                                        <option value="3:1 Hari  sebelum barang tiba dipelabuhan">1 Hari  sebelum barang tiba dipelabuhan</option>
                                        <option value="1:Setelah barang tiba dipelabuhan">Setelah barang tiba dipelabuhan</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_16" type="text" class="form-control col-sm-10 ml-2"  value="Kelengkapan Dokumen Permohonan Impor " style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_16" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Dokumen selalu lengkap dan sah">Dokumen selalu lengkap dan sah </option>
                                        <option value="3:Dokumen kadang-kadang kurang lengkap dan tidak sah">Dokumen kadang-kadang kurang lengkap dan tidak sah</option>
                                        <option value="1:Sering tidak lengkap">Sering tidak lengkap</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_17" type="text" class="form-control col-sm-10 ml-2"  value="Konsistensi data  PPK dan PIB" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_17" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Selalu sama satu tahun terakhir">Selalu sama satu tahun terakhir</option>
                                        <option value="3:Kadang ada selisih">Kadang ada selisih</option>
                                        <option value="1:Sering tidak lengkap">Sering tidak lengkap</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_18" type="text" class="form-control col-sm-10 ml-2"  value="Kecepatan Pengeluaran dari Area Pabean" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_18" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Pengeluaran komoditi dari pelabuhan langsung setelah persetujuan BC">Pengeluaran komoditi dari pelabuhan langsung setelah persetujuan BC</option>
                                        <option value="3:Pengeluaran komoditi satu  sampai dua hari setelah setelah persetujuan BC">Pengeluaran komoditi satu  sampai dua hari setelah setelah persetujuan BC</option>
                                        <option value="1:Pengeluaran komoditi lebih dari tiga hari setelah Persetujuan BC">Pengeluaran komoditi lebih dari tiga hari setelah Persetujuan BC</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_19" type="text" class="form-control col-sm-10 ml-2"  value="Kepatuhan Dalam Membuka Segel" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_19" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Segel  dibuka atas seijin petugas KIPM">Segel  dibuka atas seijin petugas KIPM</option>
                                        <option value="3:Segel dibuka tidak seijin petugas  namun MPHP belum dibongkar">Segel dibuka tidak seijin petugas  namun MPHP belum dibongkar </option>
                                        <option value="1:Segel dalam kondisi rusak dan MPHP sudah dibongkar">Segel dalam kondisi rusak dan MPHP sudah dibongkar </option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_20" type="text" class="form-control col-sm-10 ml-2"  value="Kesesuaian Jenis dan Jumlah Media Pembawa" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_20" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Selalu sesuai dengan dokumen">Selalu sesuai dengan dokumen</option>
                                        <option value="3:Kadang  sesuai">Kadang  sesuai </option>
                                        <option value="1:Sering tidak sesuai">Sering tidak sesuai</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_21" type="text" class="form-control col-sm-10 ml-2"  value="Kesesuain Realisasi Impor Dengan Jumlah Kuota dan Masa Berlaku Ijin" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_21" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Selalu Sesuai">Selalu Sesuai</option>
                                        <option value="3:Kadang tidak sesuai">Kadang tidak sesuai </option>
                                        <option value="1:Selalu tidak sesuai">Selalu tidak sesuai</option>
                                    </select>
                                </div>

                                <div class="mb-2 row">
                                    <input name="v2_22" type="text" class="form-control col-sm-10 ml-2"  value="Variasi Jenis Media Pembawa HP" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_22"  class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Hanya satu jenis">Hanya satu jenis</option>
                                        <option value="3:Lebih dari satu jenis namun masih dalam bentuk yang sama">Lebih dari satu jenis namun masih dalam bentuk yang sama</option>
                                        <option value="1:Bervariasi bercampur dengan barang lain yang bukan komoditi perikanan (LCL)">Bervariasi bercampur dengan barang lain yang bukan komoditi perikanan (LCL)</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_23" type="text" class="form-control col-sm-10 ml-2"  value="Pengurusan Dokumen Impor" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_23" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Importir mengurus langsung tidak melalui PPJK">Importir mengurus langsung tidak melalui PPJK</option>
                                        <option value="3:Hanya menggunakan jasa pengurusan dokumen dengan satu PPJK saja">Hanya menggunakan jasa pengurusan dokumen dengan satu PPJK saja</option>
                                        <option value="1:Pengurusan dokumen dilakukan oleh lebih dari satu PPJK">Pengurusan dokumen dilakukan oleh lebih dari satu PPJK</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_24" type="text" class="form-control col-sm-10 ml-2"  value="Surat Kuasa Dari Pemilik Kepada Pengurus PPJK" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_24" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Surat Kuasa diberikan per shipment dan bermaterai atau diurus sendiri">Surat Kuasa diberikan per shipment dan bermaterai atau diurus sendiri</option>
                                        <option value="5:Surat Kuasa diberikan dalam jangka waktu tertentu maksimal 1 bulan dan bermaterai">Surat Kuasa diberikan dalam jangka waktu tertentu maksimal 1 bulan dan bermaterai</option>
                                        <option value="5:Surat Kuasa diberikan tanpa jangka waktu">Surat Kuasa diberikan tanpa jangka waktu </option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_25" type="text" class="form-control col-sm-10 ml-2"  value="Laporan Penggunaan IKI" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_25" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Tertib dan Lengkap dalam pembuatan laporan penggunaan IKI">Tertib dan Lengkap dalam pembuatan laporan penggunaan IKI</option>
                                        <option value="3:Tertib dalam pembuatan laporan penggunaan IKI namun tidak lengkap">Tertib dalam pembuatan laporan penggunaan IKI namun tidak lengkap</option>
                                        <option value="1:Tidak tertib dalam pembuatan laporan penggunaan IKI">Tidak tertib dalam pembuatan laporan penggunaan IKI</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_26" type="text" class="form-control col-sm-10 ml-2"  value="Kepatuhan penerapan SJMKHP" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_26" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Memiliki Sertifikat HACCP">Memiliki Sertifikat HACCP </option>
                                        <option value="3:Sedang mengurus Sertifikat HACCP">Sedang mengurus Sertifikat HACCP</option>
                                        <option value="1:Tidak memiliki sertifikat HACCP">Tidak memiliki sertifikat HACCP </option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Verifikasi 4 -->
                            <div class="card-header col-sm-11 ml-3">
                                <input name="v1_4" type="text" class="form-control col-sm-10"  value="D:KASUS PELANGGARAN " style="border: none; background-color: transparent;" readonly>
                            </div>

                            <div class="card-body">
                                <div class="mb-2 row">
                                    <input name="v2_27" type="text" class="form-control col-sm-10 ml-2"  value="Pelanggaran Pidana Terkait Importasi MPHP" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_27"  class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Milik sendiri dan digunakan sendiri">Belum pernah melakukan pelanggaran Pidana importasi MPHP</option>
                                        <option value="3:Milik sendiri dan digunakan sendiri">Pernah melakukan pelanggaran Pidana  satu kali dalam 2 tahun terakhir</option>
                                        <option value="1:Milik sendiri dan digunakan sendiri">Pernah melakukan pelanggaran Pidana  lebih satu kali dalam 2 tahun terakhir</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_28" type="text" class="form-control col-sm-10 ml-2"  value="Pelanggaran Pemakaian dan Penggunaan IKI" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_28" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Milik sendiri dan digunakan sendiri">Selalu dimasukan di IKI yang telah ditetapkan sesuai dengan nama pemiliknya</option>
                                        <option value="3:Milik sendiri dan digunakan sendiri">Pernah memasukan ke IKI milik orang lain</option>
                                        <option value="1:Milik sendiri dan digunakan sendiri">Sebagian besar memasukan ke IKI milik orang lain</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_29" type="text" class="form-control col-sm-10 ml-2"  value="Pelanggaran Tindakan Karantina Ikan Pengendalian Mutu dan Keamanan Hasil Perikanan" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_29" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Milik sendiri dan digunakan sendiri">Tidak pernah dilakukan tindakan KIPM penolakan dan/atau pemusnahan</option>
                                        <option value="3:Milik sendiri dan digunakan sendiri">Pernah dilakukan tindakan KIPM penolakan dan /atau pemusnahan ( satu kali)</option>
                                        <option value="1:Milik sendiri dan digunakan sendiri">Pernah dilakukan tindakan KIPM penolakan dan /atau pemusnahan ( lebih satu kali)</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 row">
                                    <input name="v2_30" type="text" class="form-control col-sm-10 ml-2"  value="Pelanggaran Administrasi terkait Importasi MPHP" style="border: none; background-color: transparent;" readonly>
                                    <select name="v3_30" class="form-select col-sm-11 ml-4" required>
                                        <option value="">-- Pilih salah satu --</option>
                                        <option value="5:Milik sendiri dan digunakan sendiri">Belum pernah melakukan pelanggaran administrasi </option>
                                        <option value="3:Milik sendiri dan digunakan sendiri">Pernah melakukan pelanggaran administrasi satu kali dalam satu tahun terakhir (mis pembekuan IKI, HACCP)</option>
                                        <option value="1:Milik sendiri dan digunakan sendiri">Melakukan pelanggaran administrasi lebih dari satu kali dalam satu tahun terakhir</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center ml-4 mb-5 mt-4"> <button type="submit" class="btn btn-primary">Submit</button> <button type="reset" class="btn btn-secondary">Reset</button></div>
                            </form>
                            

                        


                        
                    </div>
                </div>
            </div>
        </div>
    </main>


@endsection