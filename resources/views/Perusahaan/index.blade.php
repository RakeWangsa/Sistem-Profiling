@extends('layouts.main')

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Data Perusahaan</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Perusahaan</li>
            </ol>
            <!-- <div class="row justify-content-between mt-4 mb-4">
                <h4>Data Pengguna</h4>
                <a href="{{ route('register') }}" class="btn btn-primary">+ Tambah data</a>
            </div> -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Data Perusahaan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama Perusahaan</th>
                                    <th>Id Negara</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($perusahaan as $p)
                                <tr>
                                    <td>{{$p->nm_trader}}</td>
                                    <td>{{$p->kd_negara}}</td>
                                    <td>{{$p->al_trader}}</td>
                                    <td>
                                        <!-- <a href="pelanggaran/{{$p->id_trader}}">detail...</a> -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="perusahaan/{{$p->id_trader}}">Detail</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="/catat/{{$p->id_trader}}">Catat Pelanggaran</a>
                                                <a class="dropdown-item" href="/perusahaan/{{$p->id_trader}}/pelanggaran">Pelanggaran dan Laporan</a>
                                                <a class="dropdown-item" href="./kategorisasi/{{$p->id_trader}}">Kategorisasi Resiko</a>
                                                {{-- <a class="dropdown-item" href="./bobot/{{$p->id_trader}}">Input Bobot</a> --}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
</main>
@endsection