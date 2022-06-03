
@extends('layout.main')
@section('content')

    <div class="container-fluid" style="padding: 30px 37px 9px 37px; height:100%">
        <div class="container-fluid" style="border-radius: 10px; background-color:darkgrey; height:100% ">
            <div class="row" style="padding-bottom: 10px">
                <div class="col-sm-1">
                    <a href="/potensi_lelang">
                        <button class="btn btn-primary translate-middle-y"><i class="bi bi-caret-left-fill"></i></button>
                    </a>
                </div>
                <div class="col-sm-2">
                    <div class="btn btn-primary translate-middle-y" style="width: 100%">Permohonan Lelang</div>
                </div>
            </div>
            <div class="row" style="height:90%; padding: 0 40px 0px 40px">
                <div class="container-fluid" style="height: 100%;">
                    <div class="row" style="height: 100%;">
                        <div class="col-sm-8" style="height: 100%;">
                            <div style="height: 100%; background-color:aliceblue; border-radius:10px;">
                                <div class="scrollable" style="height: 95%; min-height:fit-content; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                                    <table class="table table-hover" style="max-height: 95%">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nomor Surat Permohonan</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Tanggal Di Terima</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        <?php $i=1; ?>
                                        @foreach ($data->permohonanLelang as $item)
                                            <tr onClick="detailpermohonan('{{$item->id}}')">
                                                <td>{{$i}}</td>
                                                <td>{{$item->nomorSurat}}</td>
                                                <td>{{indonesiaDate($item->tanggalSurat)}}</td>
                                                <td>{{$item->tanggalDiTerima}}</td>
                                                <td style="max-width: 200px">
                                                    @if (!$item->penetapanLelang)
                                                        <button  onClick="updateBarang('{{$item->id}}')" class="btn btn-success d-inline" data-bs-toggle="modal" data-bs-target="#inputBarang"><i class="bi bi-plus-square"></i></button>
                                                        @if ($item->barang->first())
                                                            <button onclick="downloadPenetapanInput('{{$item->id}}')" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#downloadPenetapan"><i class="bi bi-cloud-download-fill"></i></button>
                                                            <button onClick="penetapan('{{$item->id}}')" class="btn btn-primary d-inline" data-bs-toggle="modal" data-bs-target="#penetapan"><i class="bi bi-send-check"></i></i></button>
                                                        @else
                                                            <form class="d-inline" action="/permohonan_lelang/{{$item->id}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger" ><i class="bi bi-trash"></i></button>
                                                            </form>
                                                        @endif
                                                    @endif
                                                </td>
                                                <?php $i++; ?>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#permohonan">Tambah Permohonan</button>
                                </div> 
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

    {{--  Modals permohonan  --}}
        <div class="modal fade" id="permohonan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form action="/permohonan_lelang" method="POST">
                                @csrf
                                <div class="row">
                                    <label for="nomorSurat" class="col-sm-4 col-form-label">Nomor Surat</label>
                                    <div class="col-sm-8">
                                        <input name="nomorSurat" class="form-control" type="text" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="hal" class="col-sm-4 col-form-label">Hal</label>
                                    <div class="col-sm-8">
                                        <input name="hal" class="form-control" type="text" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="tanggalSurat" class="col-sm-4 col-form-label">Tanggal</label>
                                    <div class="col-sm-8">
                                        <input name="tanggalSurat" type="date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="tanggalDiTerima" class="col-sm-4 col-form-label">Tanggal di Terima</label>
                                    <div class="col-sm-8">
                                        <input name="tanggalDiTerima" type="date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div>
                                        <button value="{{$data->id}}" type="submit" class="btn btn-primary" name="surat_persetujuan_id">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- Akhir Modals permohonan  --}}
    {{--  Modals Input Barang  --}}
        <div class="modal fade bd-example-modal-xl" id="inputBarang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" >
                        <form action="" method="POST" id="pilihbarang">
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
                                    </tr>
                                    <?php $i=1 ?>
                                    @foreach ($data->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->Permohonan->barang as $item)
                                        @if ($item->status === 0)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td><input name="barang[]" type="checkbox" value="{{$item->id}}"></td>
                                                <td>{{$item->kodeBarang}}</td>
                                                <td>{{$item->kodeBarangs->namaBarang}}</td>
                                                <td>{{$item->NUP}}</td>
                                            </tr> 
                                            <?php $i++ ?>  
                                        @endif
                                    @endforeach
                                </table>
                            </div>
                            <div>
                                <button name="permohonan_lelang_id" id="permohonan_lelang_id" type="submit" value="">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    {{-- Akhir Modals Input Barang  --}}
    {{--  Modals penetapan  --}}
        <div class="modal fade" id="penetapan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form action="/penetapan_lelang" method="POST">
                                @csrf
                                <div class="row">
                                    <label for="nomorSurat" class="col-sm-4 col-form-label">Nomor Surat Penetapan</label>
                                    <div class="col-sm-8">
                                        <input name="nomorSurat" class="form-control" type="text" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="tanggalSurat" class="col-sm-4 col-form-label">Tanggal Surat</label>
                                    <div class="col-sm-8">
                                        <input name="tanggalSurat" type="date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="tanggalLelang" class="col-sm-4 col-form-label">Tanggal Lelang</label>
                                    <div class="col-sm-8">
                                        <input name="tanggalLelang" type="date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <label class="col-sm-4" aria-label="Text with checkbox">Kirim Notifikasi?</label>
                                    <div class="input-group-text" style="background: none; border:none">
                                        <input name="kirimNotifikasi" class="form-check-input mt-0" type="checkbox">
                                    </div>
                                </div>
                                <div>
                                    <button value="{{$data->id}}" type="submit" class="btn btn-primary" id="penetapanButton" name="permohonan_lelang_id">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- Akhir Modals penetapan  --}}
    {{--  Modals Download Penetapan  --}}
        <div class="modal fade" id="downloadPenetapan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="jenisLelang" class="col-sm-4 col-form-label">Jenis Lelang</label>
                            <select id="jenisLelang" class="form-control">
                                <option hidden></option>
                                <option value="OB">Open Bidding</option>
                                <option value="CB">Closed Bidding</option>
                            </select>
                            <form action="/cetak" method="POST">
                                @csrf
                                <input name="permohonan_lelang_id" id="downloadPenetapanInput" type="text" value="" hidden>
                                <div id="downloadPenetapanContainer">
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{--  End Of Modals Download Penetapan  --}}
@endsection

@section('foot')
    <script src="/js/pindai/lelang.js"></script>
@endsection