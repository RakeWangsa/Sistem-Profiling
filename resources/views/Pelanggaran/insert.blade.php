@extends('layouts.main')

@section('content')
<div id="layoutAuthentication_content">
    <main>
        <br><br><br>
        <div class="container">
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
            @if(session()->has('error'))
            <div class="alert alert-danger">{{ session()->get('error') }}</div>
            @endif
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card rounded-lg mt-5">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">Tambah Pelanggaran</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/pelanggaran/tambah">
                                @csrf
                                <div class="form-group">
                                    <label class="small mb-1" for="checklist">Checklist</label>
                                    <select class="form-control" id="checklist" name="checklist_id" required>
                                        @foreach($checklist as $c)
                                        <option value="{{$c->id}}">{{$c->checklist}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="kriteria">Kriteria</label>
                                    <select class="form-control" id="kriteria" name="kriteria" required>
                                        <option value="ADMINISTRASI">ADMINISTRASI</option>
                                        <option value="TEKNIS">TEKNIS</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="small mb-1" for="pelanggaran">Pelanggaran</label>
                                        <textarea rows="3" class="form-control" id="pelanggaran" name="pelanggaran" type="text" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="small mb-1" for="acuan">Acuan</label>
                                        <textarea rows="2" class="form-control" id="acuan" name="acuan" type="text" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="small mb-1" for="acuan">Keterangan</label>
                                        <textarea rows="2" class="form-control" id="keterangan" name="keterangan" type="text" required></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">+ Tambah data</button>

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