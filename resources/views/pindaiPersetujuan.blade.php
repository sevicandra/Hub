
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
                        <button class="btn translate-middle-y" style="width: 100%; background-color:#ffffff">Penilaian</button>
                    </a>
                </div>
                <div class="col-sm-2" >
                    <a href="/persetujuan" >
                        <button class="btn translate-middle-y" style="width: 100%; background-color:#4D59CA">Surat Persetujuan</button>
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
                                <div id="nomorTiket" style="background: #4D59CA; border-radius: 0px 10px 10px 0px; height:34px;"> <p align="center">#Tiket</p></div>
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
                                    <th>Penyampaian Laporan</th>
                                    <th>Tanggal Surat</th>
                                    <th>Satuan Kerja</th>
                                    <th>Surat Persetujuan</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php $i=1 ?>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$item->nomorSurat}}</td>
                                        <td>{{$item->tanggalSurat}}</td>
                                        <td>{{$item->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker}}</td>
                                        <td> 
                                            @if (isset($item->suratPersetujuan))
                                                {{$item->suratPersetujuan->nomorSurat}}    
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($item->suratPersetujuan))
                                                {{$item->suratPersetujuan->tanggalSurat}}   
                                            @endif
                                        </td>
                                        <td style="max-width: 100px">
                                            <button type="button" onClick="nilaiLimit('{{$item->id}}')" class="btn d-inline" data-bs-toggle="modal" data-bs-target="#penetapanNilai"><i class="bi bi-activity"></i></button>
                                            @if ($item->pemberitahuanPenilaian->permohonanPenilaian->permohonan->barang->where('nilaiLimit', null)->count() === 0 && !isset($item->suratPersetujuan))
                                                <form action="/cetak" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="text" value="{{$item->pemberitahuanPenilaian->permohonanPenilaian->permohonan->id}}" required hidden name="permohonan_id">
                                                    <button class="btn" name="action" value="suratpersetujuan"><i class="bi bi-cloud-download-fill"></i></button>
                                                </form>
                                                <button onClick="suratPersetujuan('{{$item->id}}')" class="btn d-inline" data-bs-toggle="modal" data-bs-target="#persetujuan"><i class="bi bi-send-check-fill"></i></button>
                                            @endif
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
            </div>
        </div>
    </div>
    {{--  Penetapan Nilai  --}}
        <div class="modal fade bd-example-modal-xl" id="penetapanNilai" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/penetapanLimit" method="POST">
                            @csrf
                            <div>
                                <table class="table table-hover table-responsive">
                                    <thead>
                                        <tr>
                                            <td style="max-width: 5%">No</td>
                                            <td style="max-width: 19%">Kode Barang</td>
                                            <td style="max-width: 19%">Nama Barang</td>
                                            <td style="max-width: 19%">NUP</td>
                                            <td style="max-width: 19%">Nilai Wajar</td>
                                            <td style="max-width: 19%">Nilai Limit</td>
                                        </tr>
                                    </thead>
                                    <tbody id="listNilaiLimit">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <button class="btn">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    {{--  Akhir Penetapan Nilai  --}}

    {{--  Surat Persetujuan  --}}
        <div class="modal fade" id="persetujuan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form action="/persetujuan" method="POST">
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
                                        <button type="submit" class="btn btn-primary" id='penyampaian_laporan_id' name='penyampaian_laporan_id' value=''>Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{--  Akhir Surat Persetujuan  --}}
@endsection

@section('foot')

    <script src="/js/pindai/permohonanPenilaian.js"></script>
    <script src="/js/pindai/nomorTiket.js"></script>

@endsection