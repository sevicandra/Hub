
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
                        <button class="btn translate-middle-y" style="width: 100%; background-color:#ffffff">Surat Persetujuan</button>
                    </a>
                </div>
                <div class="col-sm-2" >
                    <a href="/potensi_lelang" >
                        <button class="btn translate-middle-y" style="width: 100%; background-color:#4D59CA">Potensi Lelang</button>
                    </a>
                </div>
                <div class="col-sm-2" >
                    <a href="/penetapan_lelang" >
                        <button class="btn translate-middle-y" style="width: 100%; background-color:#ffffff">Penetapan Lelang</button>
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
                                    <th>Surat Persetujuan</th>
                                    <th>Tanggal Surat</th>
                                    <th>Satuan Kerja</th>
                                    <th>Nilai Persetujuan</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php $i=1 ?>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$item->nomorSurat}}</td>
                                        <td>{{$item->tanggalSurat}}</td>
                                        <td>{{$item->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker}}</td>
                                        <td>
                                            Rp{{number_format($item->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->barang->sum('nilaiLimit'), 2, ',', '.')}}  
                                        </td>
                                        <td style="max-width: 100px">
                                            <form action="potensi_lelang/{{$item->id}}" method="get">
                                                <button type="submit" class="btn " style="color: green"><i class="bi bi-plus-square"></i></button>
                                            </form>
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
@endsection

@section('foot')

    <script src="/js/pindai/nomorTiket.js"></script>

@endsection