@extends('layouts.main')

@section('content')
<div id="layoutAuthentication_content">
    <main>
        <br><br><br>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card rounded-lg mt-5">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">Edit Pelanggaran</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/pelanggaran/edit/{{$pelanggaran->id}}">
                                @csrf
                                <div class="form-group">
                                    <label class="small mb-1" for="checklist">Checklist</label>
                                    <select class="form-control" id="checklist" name="checklist">
                                        @foreach($checklist as $c)
                                        @if ($c->id == $pelanggaran->checklist_id)
                                        <option selected value="{{$c->id}}">{{$c->checklist}}</option>
                                        @else
                                        <option value="{{$c->id}}">{{$c->checklist}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="kriteria">Kriteria</label>
                                    <select class="form-control" id="kriteria" name="kriteria" required>                                                                              
                                            <option value="ADMINISTRASI" {{ $pelanggaran->kriteria == 'ADMINISTRASI'  ? 'selected' : ''}} >ADMINISTRASI</option>                                        
                                            <option value="TEKNIS" {{ $pelanggaran->kriteria == 'TEKNIS'  ? 'selected' : ''}} >TEKNIS</option>                                  
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="small mb-1" for="pelanggaran">Pelanggaran</label>
                                        <textarea rows="3" class="form-control" id="pelanggaran" name="pelanggaran" required type="text">{{$pelanggaran->pelanggaran}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="small mb-1" for="acuan">Acuan</label>
                                        <textarea rows="2" class="form-control" id="acuan" name="acuan" required type="text">{{$pelanggaran->acuan}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="small mb-1" for="keterangan">Keterangan</label>
                                        <textarea rows="2" class="form-control" id="keterangan" name="keterangan" required type="text">{{$pelanggaran->keterangan}}</textarea>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#modal">Edit</button>
                                <div class="modal fade " id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit data pelanggaran</h5>
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
                            </form>

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