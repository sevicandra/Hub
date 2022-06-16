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
                                <div class="position-relative" style="width: 20%; min-height:fit-content">
                                    <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">{{ $item->nomor }}/{{ $item->kode }}/{{ $item->tahun }}</p> 
                                </div>
                                <div class="position-relative" style="width: 10%; min-height:fit-content">
                                    <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">{{ indonesiaDate($item->tanggal) }}</p> 
                                </div>
                                <div class="position-relative" style="width: 15%; min-height:fit-content">
                                    <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">{{ $item->pemohon }}</p> 
                                </div>
                                <div class="position-relative" style="width: 25%; min-height:fit-content">
                                    @foreach ($item->basl as $survei)
                                    <li>{{ $survei->objek }}</li>
                                    @endforeach
                                </div>
                                <div class="position-relative" style="width: 15%; min-height:fit-content">
                                    <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">
                                        Rp{{ number_format($item->nilaiWajar, 2, ',', '.') }}
                                    </p> 
                                </div>
                                <div class="position-relative" style="width: 10%; min-height:fit-content">
                                    @if ($item->file)
                                    <button style="color:white" class="btn btn-warning" onclick="preview('{{ $item->id }}')"><i class="bi bi-eye-fill"></i></button>
                                    @endif
                                    <button class="btn btn-primary" onclick="updatelaporan('{{ $item->id }}')"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-danger" onclick="hapuslaporan('{{ $item->id }}')"><i class="bi bi-trash"></i></button>
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
                                <div style="width: 20%; height:fit-content">Nomor Laporan</div>
                                <div style="width: 10%; height:fit-content">Tanggal</div>
                                <div style="width: 15%; height:fit-content">Pemohon</div>
                                <div style="width: 25%; height:fit-content">Objek Penilaian</div>
                                <div style="width: 15%; height:fit-content">Nilai Wajar</div>
                                <div style="width: 10%; height:fit-content">Action</div>
                            </div>
                        </div>
                        <div class="position-absolute bottom-0 start-50 translate-middle-x" style="width: 100%; height:50px; background-color:#495C4F">
                            <div class="position-relative" style="height: 100%; width:100%">
                                <div class="position-absolute top-50 start-50 translate-middle" style="height: fit-content; width:fit-content">
                                    {{ $data->links() }}
                                </div>
                                <div class="position-absolute top-50 end-0 translate-middle-y" style="margin: 0 10px; width:fit-content">
                                    <button style="background-color: #4CC2B4; color:white" type="button" class="btn" data-bs-toggle="modal" data-bs-target="#inputLaporan">
                                        Input Laporan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@section('modalsJFPP')
{{-- Modals Input Laporan --}}
<div class="modal fade" id="inputLaporan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/JFPP/LaporanPenilaian" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3" style="height: 100px">
                    <div style="height: inherit;overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;" class="form-control scrollable">
                        @foreach ($basl as $item)
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input name="basl[]" class="form-check-input mt-0" type="checkbox" value="{{ $item->id }}">
                            </div>
                            <label class="form-control" for="">{{ $item->nomor }}{{ $item->kode }}{{ $item->tahun }}</label>
                          </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="nomor" name="nomor" placeholder="Nomor Laporan" required value="{{ old('nomor') }}">
                    <label for="nomor">Nomor Laporan</label>
                    @error('nomor')
                        <div class="text-danger mt-1">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode Laporan" required value="{{ old('kode') }}">
                    <label for="kode">Kode Laporan</label>
                    @error('kode')
                    <div class="text-danger mt-1">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="pemohon" name="pemohon" placeholder="Pemohon" required value="{{ old('pemohon') }}">
                    <label for="pemohon">Pemohon</label>
                    @error('pemohon')
                    <div class="text-danger mt-1">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="tanggal Laporan" required value="{{ old('tanggal') }}">
                    <label for="tanggal">Tanggal Laporan</label>
                    @error('tanggal')
                    <div class="text-danger mt-1">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="nilaiWajar" name="nilaiWajar" placeholder="Nilai Wajar" required value="{{ old('nilaiWajar') }}">
                    <label for="nilaiWajar">Nilai Wajar</label>
                    @error('nilaiWajar')
                        <div class="text-danger mt-1">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <input type="file" class="form-control" name="fileUpload">
                @error('fileUpload')
                    <div class="text-danger mt-1">
                        {{$message}}
                    </div>
                @enderror
                <div class="row mt-2">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
{{-- Akhir Modals Input Laporan --}}

{{-- Modals Preview --}}
<div class="modal fade" id="preview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header" id="previewHeader">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="height: 80vh" id="previewFrame">
            {{-- <iframe
                src="{{ asset('storage/keputusan/eWrsmdQCDnxcLyKQQWLGn5O0znL2DUeBpXKn69Mu.pdf') }}"
                frameBorder="0"
                scrolling="auto"
                height="100%"
                width="100%"
            >
            </iframe> --}}
        </div>
      </div>
    </div>
</div>
{{-- Akhir Modals Preview --}}

{{-- Modals Edit Laporan --}}
<div class="modal fade" id="updateLaporan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" id="editLaporanHeader">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" >
            <form id="updatelaporanform" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div id="baslUpdate" class="mb-3">
                
                
                </div>
                <div class="mb-3" style="height: 100px">
                    <div style="height: inherit;overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;" class="form-control scrollable">
                        @foreach ($basl as $item)
                        <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input name="basl[]" class="form-check-input mt-0" type="checkbox" value="{{ $item->id }}">
                            </div>
                            <label class="form-control" for="">{{ $item->nomor }}{{ $item->kode }}{{ $item->tahun }}</label>
                          </div>
                        @endforeach
                    </div>
                </div>
                <div id="updatelaporancontent">
                    
                </div>
                <div class="row mt-2">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
{{-- Akhir Modals Laporan --}}

{{-- Modals Hapus Laporan --}}
<div class="modal fade" id="hapuslaporan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="hapuslaporancontent" style="text-align: center">
            <h5>Anda Yakin Ingin Menghapus Laporan Nomor</h5>
            <form action="/laporanPenilaian/Laporan" method="post" enctype="multipart/form-data">
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
{{-- Akhir Modals Hapus Laporan --}}

@endsection





@section('footJFPP')
    @if($errors->any())
        <script>
            var myModal = new bootstrap.Modal(document.getElementById('inputLaporan'), {
                keyboard: false
            })
            myModal.show()
        </script>
    @endif
    <script src="/js/JFPP/laporan.js"></script>
@endsection