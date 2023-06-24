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
            @if(session()->has('success'))
            <div class="p-3 mt-2 mb-2 bg-success text-white">{{ session()->get('success') }}</div>
            @endif
            @if(session()->has('error'))
            <div class="p-3 mt-2 mb-2 bg-danger text-white">{{ session()->get('error') }}</div>
            @endif
            <h4 class="mb-4 mt-4">Catat Pelanggaran</h4><br>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            {{ $perusahaan->nm_trader }}
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/catat/{{$perusahaan->id_trader}}">
                                @csrf
                                <div class="form-group row">
                                    <label for="checklist" class="col-md-2 col-form-label">{{ __('Checklist') }}</label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="checklist" name="checklist" required>
                                            <option value="">Pilih Checklist</option>
                                            @foreach($checklist as $pel)
                                            <option value="{{ intval($pel->id) }}">{{$pel->checklist}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ppk" class="col-md-2 col-form-label">{{ __('Nomor PPK') }}</label>
                                    <div class="col-md-6">
                                        <select class="form-control ppk" id="ppk" name="ppk" required>
                                            @foreach($ppk as $p)
                                            <option value="{{ $p->id_ppk }}">{{$p->no_ppk}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <script>
                                        $('.ppk').select2();
                                    </script>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal" class="col-md-2 col-form-label">{{ __('Tanggal') }}</label>
                                    <div class="col-md-6">
                                        <input class="date form-control" name="tanggal" type="text" required>
                                        <script type="text/javascript">
                                            $('.date').datepicker({
                                                format: 'dd-mm-yyyy'
                                            });
                                        </script>
                                    </div>
                                </div>
                                <div id="kriteria" name="kriteria">

                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            + Tambah
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<script>
    $(document).ready(function() {
        $('#checklist').on('change', function() {
            let id = $(this).val();
            $('#kriteria').empty();
            $('#kriteria').append(`<option value=""> memuat...</option>`);
            $.ajax({
                type: 'GET',
                url: 'getpelanggaran/' + id,
                success: function(response) {
                    $('#kriteria').html(response);
                }
            });

        });



    });
</script>
</main>


@endsection