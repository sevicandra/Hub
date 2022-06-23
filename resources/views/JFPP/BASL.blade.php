@extends('layout.JFPP')

@section('headJFPP')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        dl, ol, ul{
            margin:0
        }
    </style>
@endsection

@section('contentJFPP')
            <div class="container-fluid" style="height: 100%;">
                <div class="row" style="height: 100%; background-color:rgb(255, 255, 255); border-radius:0 0 10px 10px">
                    <div class="position-relative" style="height: 100%; width:100%; padding:0">
                        <div style="padding: 25px 0 50px 0; width:100%; min-height:fit-content; max-height:100%; overflow-y:auto">
                            @php
                                $i=1;
                            @endphp
                            @foreach ($data as $item)
                            <div style="width: 100%; text-align:center; margin:0; @if ($i % 2 === 0) background-color:#74A885 ; color:white @else background-color:#A8977D ; color:white @endif ; padding:0; " class="row" >
                                <div class="position-relative" style="width: 5%; min-height:fit-content">
                                    <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">{{ $i }}</p> 
                                </div>
                                <div class="position-relative" style="width: 15%; min-height:fit-content">
                                    <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">{{ $item->nomor }}{{ $item->kode }}{{ $item->tahun }}</p> 
                                </div>
                                <div class="position-relative" style="width: 15%; min-height:fit-content">
                                    @foreach ($item->user as $team)
                                        <li>{{ $team->nama }}</li>
                                    @endforeach
                                </div>
                                <div class="position-relative" style="width: 15%; min-height:fit-content">
                                    <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">{{ $item->pemilik }}</p> 
                                </div>
                                <div class="position-relative" style="width: 15%; min-height:fit-content">
                                    <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">{{ indonesiaDate($item->tanggalSelesaiSurvei) }}</p> 
                                </div>
                                <div class="position-relative" style="width: 15%; min-height:fit-content">
                                    <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">
                                        @switch($item->tujuanPenilaian)
                                            @case(1)
                                                Pemindahtanganan
                                                @break
                                            @case(2)
                                                Pemanfaatan
                                                @break
                                            @case(3)
                                                LKPP
                                                @break
                                            @default
                                                
                                        @endswitch
                                    </p> 
                                </div>
                                <div class="position-relative" style="width: 15%; min-height:fit-content">
                                    <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">
                                        {{ $item->objek }}
                                    </p> 
                                </div>
                                <div class="position-relative" style="width: 5%; min-height:fit-content">
                                    <button class="btn btn-primary" onclick="cetakBASL('{{ $item->id }}')"><i class="bi bi-cloud-download-fill"></i></button>
                                    @if (!$item->laporan->first())
                                    <button class="btn btn-primary" onclick="updateBASL('{{ $item->id }}')"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-danger" onclick="hapusBASL('{{ $item->id }}')"><i class="bi bi-trash"></i></button>
                                    @endif
                                </div>
                            </div>
                            @php
                                $i++;
                            @endphp
                            @endforeach
                        </div>
                        <div class="position-absolute top-0 start-50 translate-middle-x" style="width: 100%; height:25px; border-bottom:solid 1px; background-color:#495C4F; color:white">
                            <div style="width: 100%; text-align:center; margin:0;" class="row" >
                                <div style="width: 5%; height:fit-content">No</div>
                                <div style="width: 15%; height:fit-content">Nomor</div>
                                <div style="width: 15%; height:fit-content">Tim Penilai</div>
                                <div style="width: 15%; height:fit-content">Pemilik Barang</div>
                                <div style="width: 15%; height:fit-content">Tanggal Survei</div>
                                <div style="width: 15%; height:fit-content">Tujuan Penilaian</div>
                                <div style="width: 15%; height:fit-content">Objek Penilaian</div>
                                <div style="width: 5%; height:fit-content">Action</div>
                            </div>
                        </div>
                        <div class="position-absolute bottom-0 start-50 translate-middle-x" style="width: 100%; height:50px; background-color:#495C4F">
                            <div class="position-relative" style="height: 100%; width:100%">
                                <div class="position-absolute top-50 start-50 translate-middle" style="height: fit-content; width:fit-content">
                                    {{ $data->links() }}
                                </div>
                                <div class="position-absolute top-50 end-0 translate-middle-y" style="margin: 0 10px; width:fit-content">
                                    <button style="background-color: #4CC2B4; color:white" type="button" class="btn" data-bs-toggle="modal" data-bs-target="#inputBASL">
                                        Input BASL
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@section('modalsJFPP')
{{-- Modals Input BASL --}}
<div class="modal fade" id="inputBASL" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/JFPP/BASL" method="post">
                @csrf
                <div id="anggota">
                    <div class="input-group mb-3" id="anggota1">
                        <button onclick="hapusTim(1)" type="button" class="input-group-text" style="background: red; color:white">X</button type="button">
                        <div class="form-floating col" >
                            <select class="form-select" name="anggotaTim[]" id="anggotaTim1" required placeholder="Anggota Tim">
                                <option disabled selected></option>
                                @foreach ($tim as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            <label for="anggotaTim">Anggota Tim</label>
                        </div>
                      </div>
                </div>
                <div class="form-floating mb-3"> 
                    <button onclick="tambahTim()" class="btn btn-success" type="button"><i class="bi bi-plus-square"></i></button>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="nomor" name="nomor" placeholder="Nomor Keputusan" required value="{{ old('nomor') }}">
                    <label for="nomor">Nomor</label>
                    @error('nomor')
                        <div class="text-danger mt-1">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="pemilik" name="pemilik" placeholder="Pemilik Barang" required value="{{ old('pemilik') }}">
                    <label for="pemilik">Pemilik Barang</label>
                    @error('pemilik')
                    <div class="text-danger mt-1">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="kode" id="kode" required placeholder="Kode Unit">
                        <option value="/KNL.1604/">/KNL.1604/</option>
                        <option value="/WKN.16/KNL.04/">/WKN.16/KNL.04/</option>
                    </select>
                    <label for="kode">Kode Unit</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="tujuanPenilaian" id="tujuanPenilaian" required placeholder="Tujuan Penilaian">
                        <option value="1">Pemindahtanganan</option>
                        <option value="2">Pemanfaatan</option>
                        <option value="3">LKPP</option>
                    </select>
                    <label for="tujuanPenilaian">Tujuan Penilaian</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="objek" name="objek" placeholder="objek Penilaian" required value="{{ old('objek') }}">
                    <label for="objek">objek Penilaian</label>
                    @error('objek')
                    <div class="text-danger mt-1">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="tanggalMulaiSurvei" name="tanggalMulaiSurvei" placeholder="Tanggal Mulai Survei" required value="{{ old('tanggalMulaiSurvei') }}">
                    <label for="tanggalMulaiSurvei">Tanggal Mulai Survei</label>
                    @error('tanggalMulaiSurvei')
                    <div class="text-danger mt-1">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="tanggalSelesaiSurvei" name="tanggalSelesaiSurvei" placeholder="Tanggal Selesai Survei" required value="{{ old('tanggalSelesaiSurvei') }}">
                    <label for="tanggalSelesaiSurvei">Tanggal Selesai Survei</label>
                    @error('tanggalSelesaiSurvei')
                    <div class="text-danger mt-1">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="row mt-2">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
{{-- Akhir Modals Input BASL --}}

{{-- Modals Edit BASL --}}
<div class="modal fade" id="updateBASL" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" id="editBASLHeader">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="updateBASLcontent">

        </div>
      </div>
    </div>
</div>
{{-- Akhir Modals BASL --}}

{{-- Modals Hapus BASL --}}
<div class="modal fade" id="hapusBASL" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="hapusBASLcontent" style="text-align: center">
            <h5>Anda Yakin Ingin Menghapus BASL</h5>
            <form action="/JFPP/BASL" method="post">
                @method('DELETE')
                @csrf
                <div class="row mt-2">
                    <button class="btn btn-primary" type="submit">Hapus</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
{{-- Akhir Modals Hapus BASL --}}

{{-- Modals Cetak BASL --}}
<div class="modal fade" id="cetakBASL" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="hapusBASLcontent" style="text-align: center">
              <h5>Anda Yakin Ingin Menghapus BASL</h5>
              <form action="/cetak" method="post">
                    @csrf
                    <input id="cetak_id" name="basl_id" type="text" hidden value="">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="nomorSuratTugas" name="nomorSuratTugas" placeholder="Nomor Surat Tugas" required>
                        <label for="nomorSuratTugas">Nomor</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="tanggalSuratTugas" name="tanggalSuratTugas" placeholder="Tanggal Surat Tugas" required>
                        <label for="tanggalSuratTugas">Tanggal Surat Tugas</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="jenisObjek" id="jenisObjek" required placeholder="Jenis Objek">
                            <option value="kendaraan">Kendaraan</option>
                            <option value="nonKendaraan">Selain Kendaraan</option>
                        </select>
                        <label for="Jenis Objek">Objek Penilaian</label>
                    </div>
                    <div class="row mt-2">
                        <button name="action" value="BASL" class="btn btn-primary" type="submit">Cetak</button>
                    </div>
              </form>
          </div>
        </div>
    </div>
</div>
{{-- AKhir Modals Cetak BASL --}}


@endsection


@section('footJFPP')
    @if($errors->any())
        <script>
            var myModal = new bootstrap.Modal(document.getElementById('inputBASL'), {
                keyboard: false
            })
            myModal.show()
        </script>
    @endif
    <script src="/js/JFPP/BASL.js"></script>
@endsection