@extends('layouts.main')

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            @if(session()->has('success'))
            <div class="p-3 mt-2 mb-2 bg-success text-white">{{ session()->get('success') }}</div>
            @endif
            @if(session()->has('error'))
            <div class="p-3 mt-2 mb-2 bg-danger text-white">{{ session()->get('error') }}</div>
            @endif
            <div class="row justify-content-between ml-1 mr-1">
                <h1 class="mt-4">Pelanggaran</h1>
                <a href="/pelanggaran/tambah" class="btn btn-primary mt-4 mb-4">+ Tambah data</a>
            </div>
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
                    Data Pelanggaran
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Checklist</th>
                                    <th>Kriteria</th>
                                    <th>Pelanggaran</th>
                                    <th>Acuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pelanggaran as $p)
                                <tr>
                                    <td>{{$p->checklist}}</td>
                                    <td>{{$p->kriteria}}</td>
                                    <td>{{$p->pelanggaran}}</td>
                                    <td>{{$p->acuan}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a type="button" class="btn btn-warning" href="pelanggaran/edit/{{$p->id}}">Edit</a>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal{{$p->id}}">Hapus</button>
                                        </div>
                                        <div class="modal fade" id="modal{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
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
                                                        <a type="button" class="btn btn-danger" href="pelanggaran/hapus/{{$p->id}}">Hapus</a>
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
            </div>
        </div>
</div>
</main>
@endsection