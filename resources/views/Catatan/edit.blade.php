@extends('layouts.main')

@section('content')
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<div id="layoutAuthentication_content">
    <main>
        <br><br><br>
        <div class="container">
            @if(session()->has('success'))
            <div class="p-3 mt-2 mb-2 bg-success text-white">{{ session()->get('success') }}</div>
            @endif
            @if(session()->has('error'))
            <div class="p-3 mt-2 mb-2 bg-danger text-white">{{ session()->get('error') }}</div>
            @endif
            @if(session()->has('delete'))
            <div class="p-3 mt-2 mb-2 bg-danger text-white">{{ session()->get('delete') }} atau <a href="/catat/{{$id}}/delete">klik disini untuk menghapus</a></div>
            @endif
            <div class="row justify-content-center">
                <div class="col">
                    <div class="card rounded-lg mt-5">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">Edit Pelanggaran</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/catat/{{ $id }}/edit">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="pelanggaran" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Kriteria</th>
                                                <th>Pelanggaran</th>
                                                <th>Acuan</th>
                                                <th>Aksi</th>
                                                <th class="w-25">keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                            @foreach ($data as $p)
                                            <tr>
                                                <td>{{ $p->kriteria }}</td>
                                                <td>{{ $p->pelanggaran }}</td>
                                                <td>{{ $p->acuan }}</td>
                                                <?php if ($p->id == $prev[$i]->pelanggaran_id) { ?>
                                                    <td>
                                                        <input type="checkbox" name="data[]" id="{{ $p->id }}" value="{{ $p->id }} data-value = {{ $p->kriteria }}" checked>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" id="{{ $p->id }}ket" name="keterangan[]" value="{{ $prev[$i]->keterangan }}">
                                                    </td>
                                                    <?php if ($i < count($prev) - 1) {
                                                        $i = $i + 1;
                                                    } ?>
                                                <?php } else { ?>
                                                    <td>
                                                        <input type="checkbox" name="data[]" id="{{ $p->id }}" value="{{ $p->id }} data-value = {{ $p->kriteria }}">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" disabled id="{{ $p->id }}ket" name="keterangan[]">
                                                    </td>
                                                <?php } ?>
                                                <script>
                                                    $(document).ready(function() {
                                                        $("#{{ $p->id }}").click(function() {
                                                            var checked_status = this.checked;
                                                            if (checked_status == true) {
                                                                $("#{{ $p->id }}ket").removeAttr("disabled");
                                                            } else {
                                                                $("#{{ $p->id }}ket").attr("value", "");
                                                                $("#{{ $p->id }}ket").attr("disabled", "disabled");
                                                            }
                                                        });

                                                    });
                                                </script>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                    <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#modal">Edit</button>
                                    <div class="modal fade " id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit data catatan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin mengubah data ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-warning">Edit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
</div>
</div>
</main>
</div>
</div>
</body>

</html>