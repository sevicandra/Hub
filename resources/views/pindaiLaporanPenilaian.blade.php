
@extends('layout.main')
@section('content')
    <div class="container-fluid" style="padding: 30px 37px 9px 37px; height:100%">
        <div class="container-fluid" style="border-radius: 10px; background-color:darkgrey; height:100% ">
            <div class="row" style="padding-bottom: 10px">
                <div class="col-sm-1">
                    <a href="/penilaian">
                        <button class="btn btn-primary translate-middle-y"><i class="bi bi-caret-left-fill"></i></button>
                    </a>
                </div>
                <div class="col-sm-2">
                    <div class="btn btn-primary translate-middle-y" style="width: 100%">Laporan Penilaian</div>
                </div>
            </div>
            <div class="row" style="height:90%; padding: 0 40px 0px 40px">
                <div class="container-fluid" style="height: 100%;">
                    <div class="row" style="height: 100%;">
                        <div class="col-sm-8" style="height: 100%;">
                            <div style="height: 100%; background-color:aliceblue; border-radius:10px;">
                                <div style="height: 95%">
                                    <table class="table table-hover" style="max-height: 95%">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nomor Laporan</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        <?php $i=1; ?>
                                        @foreach ($data->laporanPenilaian as $item)
                                            <tr onClick="detailLaporan('{{$item->id}}')">
                                                <td>{{$i}}</td>
                                                <td>{{$item->nomorLaporan}}</td>
                                                <td>{{$item->tanggalLaporan}}</td>
                                                <td style="max-width: 50px">
                                                    @if ($data->permohonanPenilaian->Permohonan->barang->count() != $data->permohonanPenilaian->Permohonan->barang->where('laporan_penilaian_id', '!=', null)->count())
                                                        <button onClick="updateBarang('{{$item->id}}')" class="btn d-inline" data-bs-toggle="modal" data-bs-target="#inputBarang"><i class="bi bi-plus-square"></i></button>
                                                    @endif
                                                    @if (!isset($item->barang[0]))
                                                        <form class="d-inline" action="/laporanpenilaian/{{$item->id}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn"><i class="bi bi-trash-fill"></i></button>
                                                        </form>
                                                    @endif
                                                </td>
                                                <?php $i++; ?>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                @if ($data->permohonanPenilaian->Permohonan->barang->count() != $data->permohonanPenilaian->Permohonan->barang->where('laporan_penilaian_id', '!=', null)->count())
                                    <div>
                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#LaporanPenilaian">Tambah Laporan</button>
                                    </div> 
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4" style="height: 100%;">
                            <div style="height: 100%; position: relative; background-color:aliceblue; border-radius:10px;">
                                <div id="loading" style="z-index:10; height:100%; width:100%;" hidden>
                                    <div class="position-absolute top-50 start-50 translate-middle">
                                        <div class="spinner-border text-primary" role="status" style="height:200px;width:200px">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                <div style="height: 95%; width:100%; position: absolute; top:0; left:0">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Barang</th>
                                                <th scope="col">NUP</th>
                                                <th scope="col">Nilai Limit</th>
                                                <th scope="col">Aksi</th>
                                            </tr>                        
                                        </thead>
                                        <tbody id="listBarang">
                                                
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--  Modals Laporan Penilaian  --}}
        <div class="modal fade" id="LaporanPenilaian" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form action="/laporanpenilaian" method="POST">
                                @csrf
                                <div class="row">
                                    <label for="nomorLaporan" class="col-sm-4 col-form-label">Nomor Laporan</label>
                                    <div class="col-sm-8">
                                        <input name="nomorLaporan" class="form-control" type="text" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="tanggalLaporan" class="col-sm-4 col-form-label">Tanggal</label>
                                    <div class="col-sm-8">
                                        <input name="tanggalLaporan" type="date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div>
                                        <button value="{{$data->id}}" type="submit" class="btn btn-primary" name="pemberitahuan_penilaian_id">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- Akhir Modals Laporan Penilaian  --}}
    {{--  Modals Input Barang  --}}
        <div class="modal fade bd-example-modal-xl" id="inputBarang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" >
                        <form action="/permohonan/{{$data->permohonanPenilaian->Permohonan->id}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div>
                                <table class="table table-hover" style="max-height: 95%">       
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col"></th>
                                        <th scope="col">Kode Barang</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">NUP</th>
                                        <th scope="col">Nilai Wajar</th>
                                    </tr>
                                    <?php $i=1 ?>
                                    @foreach ($data->permohonanPenilaian->Permohonan->barang as $item)
                                        @if (!isset($item->laporan_penilaian_id))
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td><input name="barang[]" type="checkbox" value="{{$item->id}}"></td>
                                                <td>{{$item->kodeBarang}}</td>
                                                <td>{{$item->kodeBarangs->namaBarang}}</td>
                                                <td>{{$item->NUP}}</td>
                                                <td><input id="{{$item->id}}" type="text" name="value[]" disabled></td>
                                            </tr> 
                                            <?php $i++ ?>  
                                        @endif
                                    @endforeach
                                </table>
                            </div>
                            <div>
                                <button name="laporan_penilaian_id" id="laporan_penilaian_id" type="submit" value="">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    {{-- Akhir Modals Input Barang  --}}
@endsection

@section('foot')

    <script src="/js/pindai/permohonanPenilaian.js"></script>
    @if (session('loadData'))
    <script Language="JavaScript">
        window.onload=detailLaporan('{{session("loadData")}}'); 
    </script>
    @endif
@endsection