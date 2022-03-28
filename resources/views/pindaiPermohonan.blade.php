
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
                    <button class="btn translate-middle-y" style="width: 100%; background-color:#4D59CA">Surat Permohonan</button>
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
                    <button class="btn translate-middle-y" style="width: 100%; background-color:#ffffff">Potensi Lelang</button>
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
                                <th>Nomor Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Pemohon</th>
                                <th>Tanggal Di Terima</th>
                                <th>Aksi</th>
                            </tr>
                            <?php $i=1 ?>
                            @foreach ($data as $item)
                                <tr onmouseover="bigImg('{{$item->tiket->tiket}}')" @if ($item->tiket->permohonan === 0) style="background-color:green; color:white" @endif>
                                    <td>{{$i}}</td>
                                    <td>{{$item->nomorSurat}}</td>
                                    <td>{{$item->tanggalSurat}}</td>
                                    <td>{{$item->satuanKerja->namaSatker}}</td>
                                    <td>{{$item->tanggalDiTerima}}</td>
                                    <td style="max-width: 100px">
                                        <form class="d-inline" action="/permohonan/{{$item->id}}" action="get">
                                            <button class="btn" type="submit" style="color: green;"><i class="bi bi-eye-fill"></i></button>
                                        </form>
                                        @if ($item->tiket->permohonan === 1)
                                            <form class="d-inline" action="permohonan/{{$item->id}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn" style="color: red"><i class="bi bi-trash-fill"></i></button>    
                                            </form>
                                        @endif
                                        @if ($item->tiket->permohonan === 1 && isset($item->barang[0]))
                                            <form action="/cetak" method="POST" class="d-inline">
                                                @csrf
                                                <input type="text" value="{{ $item->id }}" required hidden name="permohonan_id">
                                                <button type="submit" class="btn" name="action" value="permohonanPenilaian"><i class="bi bi-cloud-download"></i></button>
                                            </form>
                                            <button onClick="permohonanPenilaian('{{$item->id}}')" type="button" class="btn d-inline" data-bs-toggle="modal" data-bs-target="#permohonanPenilaian"><i class="bi bi-send-fill"></i></button>
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
            <div class="d-flex justify-content-end" style="padding:0; height:100%">
                <button style="height:100%" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#permohonan">Tambah Permohonan</button>
            </div>
        </div>
    </div>
</div>
{{--  Modals Permohonan  --}}
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
                                <input name="nomorSurat" class="form-control" type="text" required value="{{old('nomorSurat')}}">
                            </div>
                        </div>
                        <div class="row">
                            <label for="hal" class="col-sm-4 col-form-label">hal</label>
                            <div class="col-sm-8">
                                <input name="hal" class="form-control" type="text" required value="{{old('hal')}}">
                            </div>
                        </div>
                        @error('nomorSurat')
                            <div class="text-danger mt-1">
                                {{$message}}
                            </div>
                        @enderror
                        <div class="row">
                            <label for="tanggalSurat" class="col-sm-4 col-form-label">Tanggal</label>
                            <div class="col-sm-8">
                                <input name="tanggalSurat" type="date" class="form-control" required value="{{old('tanggalSurat')}}">
                            </div>
                        </div>
                        @error('tanggalSurat')
                            <div class="text-danger mt-1">
                                {{$message}}
                            </div>
                        @enderror
                        <div class="row">
                            <label for="pemohon" class="col-sm-4 col-form-label" >Pemohon</label>
                            <div class="col-sm-8">
                                <input name="pemohon" type="text" class="form-control" required placeholder="6 Digit Kode Satker" value="{{old('pemohon')}}">
                            </div>
                        </div>
                        @error('pemohon')
                            <div class="text-danger mt-1">
                                {{$message}}
                            </div>
                        @enderror
                        <div class="row">
                            <label for="" class="col-sm-4 col-form-label">Tanggal Di Terima</label>
                            <div class="col-sm-8">
                                <input name="tanggalDiTerima" class="form-control" type="date" required value="{{old('tanggalDiTerima')}}">
                            </div>
                        </div>
                        @error('tanggalDiTerima')
                            <div class="text-danger mt-1">
                                {{$message}}
                            </div>
                        @enderror
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
{{--  End Of Modals Permohonan  --}}

{{--  Modals Permohonan Penilaian  --}}
<div class="modal fade" id="permohonanPenilaian" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form action="penilaian" method="POST">
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
{{--  End Of Modals Permohonan Penilaian  --}}

@endsection

@section('foot')

    <script src="/js/pindai/permohonanPenilaian.js"></script>
    <script src="/js/pindai/nomorTiket.js"></script>

@endsection