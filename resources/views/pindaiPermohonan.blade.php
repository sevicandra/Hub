
@extends('layout.main')
@section('content')
<div class="container-fluid" style="padding: 30px 37px 9px 37px">
    <div class="container-fluid" style="border-radius: 10px; background-color:darkgrey; ">
        <div class="row" style="padding-bottom: 10px">
            <div class="col-sm-2">
                <a href="pindai/permohonan">
                    <button class="btn btn-primary translate-middle-y" style="width: 100%" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Surat Permohonan</button>
                </a>
            </div>
            <div class="col-sm-2">
                <a href="pindai/permohonan">
                    <button class="btn btn-primary translate-middle-y" style="width: 100%">Surat Persetujuan</button>
                </a>
            </div>
        </div>
        <div class="row" style="height:80vh; padding: 0 40px 0px 40px">
            <div class="container-fluid">
                <div class="row" style="height: 74vh; background-color:aliceblue; border-radius:10px;">
                    <div>
                        <table class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nomor Surat</th>
                                <th scope="col">Tanggal Surat</th>
                                <th scope="col">Pemohon</th>
                                <th scope="col">Tanggal Di Terima</th>
                                <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1 ?>
                                @foreach ($data as $item)
                                <tr>
                                    <th scope="row">{{$i}}</th>
                                    <td>{{$item->nomorSurat}}</td>
                                    <td>{{$item->tanggalSurat}}</td>
                                    <td>{{$item->pemohon}}</td>
                                    <td>{{$item->tanggalDiTerima}}</td>
                                    <td><a href=""><i class="bi bi-eye"></i></a></td>
                                </tr>
                                <?php $i++ ?>
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
                <div class="row " style="margin: 10px 0 0 0 ">
                    <div class=" d-flex justify-content-end" style="padding:0">
                        <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#staticBackdrop">Tambah Permohonan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form action="permohonan" method="POST">
                        @csrf
                        <div class="row">
                            <label for="nomorSurat" class="col-sm-4 col-form-label">Nomor Surat</label>
                            <div class="col-sm-8">
                                <input name="nomorSurat" class="form-control" type="text" required>
                            </div>
                        </div>
                        <div class="row">
                            <label for="tanggalSurat" class="col-sm-4 col-form-label">Tanggal</label>
                            <div class="col-sm-8">
                                <input name="tanggalSurat" type="date" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <label for="pemohon" class="col-sm-4 col-form-label">Pemohon</label>
                            <div class="col-sm-8">
                                <input name="pemohon" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Tanggal Di Terima</label>
                            <div class="col-sm-8">
                                <input name="tanggalDiTerima" class="form-control" type="date" required>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
