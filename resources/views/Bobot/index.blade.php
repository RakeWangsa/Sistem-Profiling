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
            <div class="row justify-content-center ml-1 mr-1">
                <h1 class="mt-4">Input Bobot</h1>
            </div>
            @if(session('gagal'))
                    <div class="alert alert-danger">
                        {{ session('gagal') }}
                    </div>
                @endif
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <form class="row g-3 mt-3" method="GET" action="{{route('SubmitBobot',['id_trader'=> $id_trader])}}">
                            <!-- Verifikasi 1 -->
                            <div class="card-header col-sm-11 ml-3">
                                <input name="kategori_1" type="text" class="form-control col-sm-10"  value="A:STATUS KEPEMILIKAN PERUSAHAAN" style="border: none; background-color: transparent;" readonly>
                            </div>

                            <div class="card-body">
                                <div class="card-body">
                                    <label for="inputPassword" class="col-sm-4 col-form-label ">Bobot</label>
                                    <div class="col-sm-10">
                                        <input name="bobot_1" type="number" step="1" min="0" max="100" @if(isset($bobot)) value="{{ $bobot[0]->bobot }}" @endif class="form-control" required>
                                        <p>( Input dalam persen )</p>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <!-- Verifikasi 2 -->
                            <div class="card-header col-sm-11 ml-3">
                                <input name="kategori_2" type="text" class="form-control col-sm-10"  value="B:SARANA DAN PRASARANA" style="border: none; background-color: transparent;" readonly>
                            </div>

                            <div class="card-body">
                                <div class="card-body">
                                    <label for="inputPassword" class="col-sm-4 col-form-label ">Bobot</label>
                                    <div class="col-sm-10">
                                      <input name="bobot_2" type="number" step="1" min="0" max="100" @if(isset($bobot)) value="{{ $bobot[1]->bobot }}" @endif class="form-control" required>
                                      <p>( Input dalam persen )</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Verifikasi 3 -->
                            <div class="card-header col-sm-11 ml-3">
                                <input name="kategori_3" type="text" class="form-control col-sm-11"  value="C:KETAATAN PADA PROSEDUR TINDAKAN KARANTINA IKAN, MUTU DAN KKP" style="border: none; background-color: transparent;" readonly>
                            </div>

                            <div class="card-body">
                                <div class="card-body">
                                    <label for="inputPassword" class="col-sm-4 col-form-label ">Bobot</label>
                                    <div class="col-sm-10">
                                      <input name="bobot_3" type="number" step="1" min="0" max="100" @if(isset($bobot)) value="{{ $bobot[2]->bobot }}" @endif class="form-control" required>
                                      <p>( Input dalam persen )</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Verifikasi 4 -->
                            <div class="card-header col-sm-11 ml-3">
                                <input name="kategori_4" type="text" class="form-control col-sm-10"  value="D:KASUS PELANGGARAN " style="border: none; background-color: transparent;" readonly>
                            </div>

                            <div class="card-body">
                                <div class="card-body">
                                    <label for="inputPassword" class="col-sm-4 col-form-label ">Bobot</label>
                                    <div class="col-sm-10">
                                      <input name="bobot_4" type="number" step="1" min="0" max="100" @if(isset($bobot)) value="{{ $bobot[3]->bobot }}" @endif class="form-control" required>
                                      <p>( Input dalam persen )</p>
                                    </div>
                                </div>
                                <div class="text-center ml-4 mb-5 mt-4"> <button type="submit" class="btn btn-primary">Submit</button> <button type="reset" class="btn btn-secondary">Reset</button></div>
                            </div>
                            
                        </form>
                            

                        


                        
                    </div>
                </div>
            </div>
        </div>
    </main>


@endsection