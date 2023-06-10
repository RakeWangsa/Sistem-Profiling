@extends('layouts.main')

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mb-4 mt-4">Tambah Pelanggaran</h4>
            @if(session()->has('success'))
            <div class="card bg-success text-white mb-4">
                <div class="card-footer">{{ session()->get('success') }}</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('admin.user') }}">Lihat</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            {{ $perusahaan->nm_trader }}
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/storepelanggaran/{{ $perusahaan->id_trader }}">
                                @csrf
                                <!-- <div class="form-group row"> -->
                                    <label for="checklist" class="col-md-4 col-form-label text-md-right">{{ __('Checklist') }}</label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="checklist" name="checklist" required>
                                        <option value="">Pilih Checklist</option>
                                            @foreach($checklist as $pel)
                                            <option value="{{ $pel->id }}">{{$pel->checklist}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                <!-- </div> -->
                                <!-- <div class="form-group row"> -->
                                    <label for="kriteria" class="col-md-4 col-form-label text-md-right">{{ __('Kriteria') }}</label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="kriteria" name="kriteria">
                                            <option value="">Pilih Kriteria</option>
                                        </select>
                                    </div>
                                <!-- </div> -->
                                <!-- <div class="form-group row"> -->
                                    <label for="pelanggaran" class="col-md-4 col-form-label text-md-right">{{ __('Pelanggaran') }}</label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="pelanggaran" name="pelanggaran" required>
                                        <option value="">Pilih Pelanggaran</option>
                                        </select>
                                    </div>
                                <!-- </div> -->
                                <!-- <div class="form-group row"> -->
                                    <div class="col-md-12" id="deskripsi" name="deskripsi">

                                    </div>
                                <!-- </div> -->
                                <!-- <div class="form-group row mb-0"> -->
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            + Tambah
                                        </button>
                                    </div>
                                <!-- </div> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<script>
    $(document).ready(function(){
        $('#checklist').on('change', function(){
            let id = $(this).val();
            $('#kriteria').empty();
            $('#kriteria').append(`<option value=""> memuat...</option>`);
            $.ajax({
                type: 'GET',
                url: 'kategoripelanggaran/' + id,
                success: function(response){
                    $('#kriteria').html(response);
                }
            });

        });

        $('#kriteria').on('change', function(){
            let kriteria = $(this).val();
            $('#pelanggaran').empty();
            $('#pelanggaran').append(`<option value=""> memuat...</option>`);
            $.ajax({
                type: 'GET',
                url: 'kriteriapelanggaran/' + kriteria,
                success: function(response){
                    $('#pelanggaran').html(response);
                }
            });

        });
        
        $('#pelanggaran').on('change', function(){
            let id = $(this).val();
            $('#deskripsi').empty();
            $('#deskripsi').append(`<p> memuat...</p>`);
            $.ajax({
                type: 'GET',
                url: 'deskripsipelanggaran/' + id,
                success: function(response){
                    $('#deskripsi').html(response);
                }
            });

        });
        
    });
</script>
</main>


@endsection