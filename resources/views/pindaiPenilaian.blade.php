
@extends('layout.main')
@section('content')
<div class="container-fluid" style="padding: 30px 37px 0px 37px; height:100%">
    <div class="container-fluid" style="border-radius: 10px; background-color:aliceblue; height:100%">
        <div class="row" style="padding: 0 10px; height:60px">
            <div class="col-sm-1">
                <a href="pindai">
                    <button class="btn btn-primary translate-middle-y"><i class="bi bi-caret-left-fill"></i></button>
                </a>
            </div>
            <div class="col-sm-2">
                <a href="/permohonan">
                    <button class="btn translate-middle-y" style="width: 100%; background-color:#ffffff">Surat Permohonan</button>
                </a>
            </div>
            <div class="col-sm-2" >
                <a href="/penilaian" >
                    <button class="btn translate-middle-y" style="width: 100%; background-color:#4D59CA">Penilaian</button>
                </a>
            </div>
            <div class="col-sm-2" >
                <a href="/permohonan" >
                    <button class="btn translate-middle-y" style="width: 100%; background-color:#ffffff">Surat Persetujuan</button>
                </a>
            </div>
            <div class="col"></div>
            <div class="col-sm-3" style="margin:auto">
            <form action="">
                <div class="row">
                    <div class="col-sm-8" style="margin:auto; margin-right:0; padding:0">
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-sm-3" style="margin:auto; margin-left:0; padding:0">
                        <div style="background: #4D59CA; border-radius: 0px 10px 10px 0px; height:34px;"> <p align="center">#Tiket</p></div>
                    </div>
                </div>
            </form>
            </div>
        </div>
        <div class="row" style="height:85%; padding: 0; background-color:aliceblue">
            <div class="container-fluid" style="height:100%">
                <div class="row" style="height: 100%; border-radius:10px;">
                    <div class="table table-light" style="padding: 0; height: 100%; background-color:aliceblue">
                        <table class="table table-hover table-responsive">
                            <tr style="box-shadow: 0px 6px 6px rgba(0, 0, 0, 0.37); border: 1px solid rgba(77, 89, 202, 0.76); height: 50px">
                                <th>No</th>
                                <th>Nomor Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Satuan Kerja</th>
                                <th>Pemberitahuan Penilaian</th>
                                <th>Tanggal Pemberitahuan</th>
                                <th>Aksi</th>
                            </tr>
                            <?php $i=1 ?>
                            @foreach ($data as $item)
                            <tr>
                                <td>{{$i}}</td  >
                                <td>{{$item->nomorSurat}}</td>
                                <td>{{$item->tanggalSurat}}</td>
                                <td>{{$item->permohonan->satuanKerja->namaSatker}}</td>
                                <td></td>
                                <td></td>
                                <td style="max-width: 100px">
                                    
                                </td>
                            </tr>
                            <?php $i++ ?>
                            @endforeach    
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row " style="margin: 10px 0 0 0;">
            <div class="d-flex justify-content-end" style="padding:0; height:100%">
                <button style="height:100%" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#permohonan">Tambah Permohonan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="permohonan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

<div class="modal fade" id="permohonanPenilaian" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form action="permohonanpenilaian" method="POST">
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
                            <div>
                                <button type="submit" class="btn btn-primary" id='permohonan_id' name='permohonan_id' value=''>Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('foot')

<script src="js/pindai/permohonanPenilaian.js"></script>

@endsection