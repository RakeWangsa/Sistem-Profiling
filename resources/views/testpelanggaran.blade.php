@extends('layouts.main')

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <br><br>
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
                                    <th>Kriteria</th>
                                    <th>No</th>
                                    <th>Pelanggaran</th>
                                    <th>Acuan</th>
                                    <th>Aksi</th>
                                    <th>keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $p)
                                <tr>
                                <tr>
                                    <td>{{ $p->kriteria }}</td>
                                    <td>{{$p->nomor }}</td>
                                    <td>{{$p->pelanggaran }}</td>
                                    <td>{{$p->acuan }}</td>
                                    <td>
                                        <input type="checkbox" name="data[]" id="aksi" value="'. $p->id .'">
                                    </td>
                                    <td>
                                        <input class="form-control" disabled name="keterangan[]">
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

<script>
    $(document).ready(function() {
        $("#aksi").click(function() {
            var checked_status = this.checked;
            if (checked_status == true) {
                $('input[name="keterangan[]"').removeAttr("disabled");
            } else {
                $('input[name="keterangan[]"').attr("value", "");
                $('input[name="keterangan[]"').attr("disabled", "disabled");
            }
        });

    });
</script>

</main>
@endsection