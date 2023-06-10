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
            <div class="row justify-content-between mt-4 mb-4 ml-1 mr-1">
                <h1>Data Pengguna</h1>
                <a href="{{ route('register') }}" class="btn btn-primary mb-2 mt-3">+ Tambah data</a>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    DataTable Example
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit{{$user->id}}">Edit</button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal{{$user->id}}">Hapus</button>
                                        </div>
                                        <div class="modal fade" id="modal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Hapus data Pengguna</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin ingin menhapus data ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <a type="button" class="btn btn-danger" href="user/hapus/{{$user->id}}">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="edit{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit nama pengguna</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="/user/edit">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <input class="form-control" type="hidden" name="id" id="id" value="{{$user->id}}">
                                                                <label for="nama">Nama</label>
                                                                <input class="form-control" id="nama" name="nama" value="{{ $user->name }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-warning">Edit</button>
                                                        </div>
                                                    </form>
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