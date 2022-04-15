@extends('layout.pindai')

@section('headpindai')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('contentpindai')
<div class="row" style="height:85%; padding: 0; background-color:aliceblue">
    <div class="container-fluid" style="height:100%">
        <div class="row" style="height: 100%; border-radius:10px;">
            <div class="table table-light scrollable" style="padding: 0; height: 100%; background-color:aliceblue; min-height:fit-content; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                <table class="table table-hover" style="max-height: 95%">
                    <tr style="box-shadow: 0px 6px 6px rgba(0, 0, 0, 0.37); border: 1px solid rgba(77, 89, 202, 0.76); height: 50px">
                        <th scope="col">No</th>
                        <th scope="col">Pemohon</th>
                        <th scope="col">Nomor Surat Permohonan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Tanggal Di Terima</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    <?php $i=1; ?>
                    @foreach ($data as $item)
                    <tr onClick="detailpermohonan('{{$item->id}}')">
                        <td>{{$i}}</td>
                        <td>
                            @if ($item->jenis === 'App\Models\tiket')
                            {{$item->pemohonLelang->pemohon}}
                            @elseif($item->jenis === 'App\Models\suratPersetujuan')
                            {{$item->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->Permohonan->satuanKerja->namaSatker}}
                            @endif
                        </td>

                        <td>{{$item->nomorSurat}}</td>
                        <td>{{indonesiaDate($item->tanggalSurat)}}</td>
                        <td>{{indonesiaDate($item->tanggalDiTerima)}}</td>
                        <td style="max-width: 200px">
                            @if ($item->jenis === 'App\Models\tiket')
                                @if (!$item->penetapanLelang)
                                <button onclick="inputLot('{{ $item->id }}')" class="btn btn-success d-inline" data-bs-toggle="modal" data-bs-target="#inputBarang">
                                    <i class="bi bi-plus-square"></i>
                                </button>
                                <button onclick="downloadPenetapanInput('{{$item->id}}')" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#downloadPenetapan">
                                    <i class="bi bi-cloud-download-fill"></i>
                                </button>
                                @if ($item->lotLelang->first())
                                    <button onClick="penetapan('{{$item->id}}')" class="btn btn-primary d-inline" data-bs-toggle="modal" data-bs-target="#penetapan">
                                        <i class="bi bi-send-check"></i>
                                    </button>
                                @endif
                                <form class="d-inline" action="/permohonanlelang/{{$item->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                                @endif
                            @endif
                        </td>
                        <?php $i++; ?>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row " style="margin: 10px 0 0 0; height:fit-content">
    <div class="d-flex justify-content-end" style="padding:0; height:fit-content">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#permohonan">Tambah
            Permohonan
        </button>
    </div>
</div>

@endsection

@section('modalpindai')
{{-- Modals permohonan --}}
<div class="modal fade" id="permohonan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form action="/permohonanlelang" method="POST">
                        @csrf
                        <div class="row">
                            <label for="nomorSurat" class="col-sm-4 col-form-label">Nomor Surat</label>
                            <div class="col-sm-8">
                                <input name="nomorSurat" class="form-control" type="text" required>
                            </div>
                        </div>
                        <div class="row">
                            <label for="Pemohon" class="col-sm-4 col-form-label">Pemohon</label>
                            <div class="col-sm-8">
                                <input name="pemohon" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <label for="PIC" class="col-sm-4 col-form-label">Nama PIC</label>
                            <div class="col-sm-8">
                                <input name="PIC" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <label for="kontakPemohon" class="col-sm-4 col-form-label">Kontak PIC</label>
                            <div class="col-sm-8">
                                <input name="kontakPemohon" type="text" class="form-control"
                                    placeholder="ext. 081xxxxxxx" required>
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
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Akhir Modals permohonan --}}

{{-- Modals penetapan --}}
<div class="modal fade" id="penetapan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                        <div>
                            <button type="submit" class="btn btn-primary" id="penetapanButton"
                                name="permohonan_lelang_id">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Akhir Modals penetapan --}}

{{-- Modals Download Penetapan --}}
<div class="modal fade" id="downloadPenetapan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
{{-- End Of Modals Download Penetapan --}}
@endsection

{{-- Modals Input Barang --}}
<div class="modal fade bd-example-modal-lg" id="inputBarang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content" style="max-height: 90vh; overflow-y:auto">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body" >
                <div id='listLotLelang'>

                </div>
                <form action="/inputLot" method="POST">
                    @csrf
                    <div id="lotLelang">
                        <div class="input-group mb-3" id="lot1">
                            <span class="input-group-text" id="namaLot">Nama Lot</span>
                            <input id="inputNamaLot1" name='lot[]' type="text" class="form-control" aria-label="namaLot" aria-describedby="namaLot" required>
                            <span class="input-group-text" id="nilaiLimit">Nilai Limit</span>
                            <input id="inputNilaiLot1" name='nilai[]' type="text" class="form-control" aria-label="nilaiLimit" aria-describedby="nilaiLimit" required>
                            <span onclick="deleteLot(1)" class="input-group-text btn" style="color: red"><i class="bi bi-folder-minus"></i></span>
                        </div>
                    </div>

                    <div class="possition-relative" style="height: 20px">
                        <div id="tambahLot" class="btn position-absolute end-0"><i class="bi bi-plus-square" width="32" height="32"></i></div>
                    </div>
                    <div>
                        <button name="permohonan_lelang_id" id="permohonan_lelang_id" type="submit" value="">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Akhir Modals Input Barang --}}

@section('footpindai')
<script src="/js/pindai/lelang.js"></script>
<script src="/js/pindai/permohonanLelang.js"></script>
@endsection