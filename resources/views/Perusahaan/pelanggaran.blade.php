@extends('layouts.main')

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
            @if(session()->has('error'))
            <div class="alert alert-danger">{{ session()->get('error') }}</div>
            @endif
            <div class="d-flex justify-content-between">
                <h1 class="mt-4">Pelanggaran Perusahaan</h1>
                <a type="button" class="btn btn-primary mt-4 mb-4" href="/catat/ {{$perusahaan->id_trader}}">Catat Pelanggaran</a>

            </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/perusahaan">Perusahaan</a></li>
                <li class="breadcrumb-item "><a href="/perusahaan/{{$perusahaan->id_trader}}"> {{$perusahaan->nm_trader}} </a></li>
                <li class="breadcrumb-item active">Pelanggaran</li>
            </ol>
            <!-- <div class="row justify-content-between mt-4 mb-4">
                <h4>Data Pengguna</h4>
                <a href="{{ route('register') }}" class="btn btn-primary">+ Tambah data</a>
            </div> -->
            <div class="row justify-content-between mt-4 mb-4 mr-3 ml-1 ">
                <h4>{{$perusahaan->nm_trader}}</h4>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">Cetak Laporan</button>
                </div>
                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Cetak Laporan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="/catat/{{$perusahaan->id_trader}}/cetak">
                                @csrf
                                <div class="modal-body">

                                    <div class="form-group row">
                                        <label for="ppk" class="col-md-2 col-form-label">{{ __('PPK') }}</label>
                                        <div class="col">
                                            <select class="form-control" id="ppk" name="ppk" required>
                                                <option value="">Pilih No.PPk</option>
                                                @foreach($catatan as $pel)
                                                <option value="{{ $pel->id }}">{{$pel->no_ppk}} ({{Carbon\Carbon::parse($pel->tanggal_pelanggaran)->format('d-m-Y')}})</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">
                                        Cetak
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Riwayat Penilaian
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomor PPK</th>
                            <th>Tanggal</th>
                            <th>Kepatuhan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($catatan as $n)
                        <tr>
                            <td>{{$n->no_ppk}}</td>
                            <td>{{Carbon\Carbon::parse($n->tanggal_pelanggaran)->format('d-M-Y')}}</td>
                            <td>{{$n->level_kepatuhan}} ({{$n->tingkat_kepatuhan}})</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a type="button" class="btn btn-warning" href="/catat/{{$n->id}}/edit">Edit</a>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal{{$n->id}}">Hapus</button>
                                </div>
                                <div class="modal fade" id="modal{{$n->id}}" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Hapus data pelanggaran</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menhapus data ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <a type="button" class="btn btn-danger" href="/catat/{{$n->id}}/delete">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Data Pelanggaran
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabel2" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Checklist</th>
                                <th>Kriteria</th>
                                <th>Pelanggaran</th>
                                <th>Acuan</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pelanggaran as $p)
                            <tr>
                                <td>{{$p->checklist}}</td>
                                <td>{{$p->kriteria}}</td>
                                <td>{{$p->pelanggaran}}</td>
                                <td>{{$p->acuan}}</td>
                                <td>{{$p->keterangan}}</td>
                                <td>{{ Carbon\Carbon::parse($p->tanggal_pelanggaran)->format('d-M-Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
</div>
<script>
    $(document).ready(function() {
        $('#tabel2').DataTable();
    });
    $('#tanggal_m').on('change', function() {
        let id = $(this).val();
        $('#tanggal_s').val(id);
    });
</script>
</main>
@endsection