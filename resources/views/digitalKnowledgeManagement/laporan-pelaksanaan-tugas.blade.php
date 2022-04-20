@extends('layout.digital-knowledge-management')

@section('headdigital-knowledge-management')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        dl, ol, ul{
            margin:0
        }
    </style>
@endsection

@section('contentdigital-knowledge-management')
            <div class="container-fluid" style="height: 100%;">
                <div class="row" style="height: 100%; background-color:rgb(255, 255, 255); border-radius:0 0 10px 10px">
                    <div class="position-relative" style="height: 100%; width:100%; padding:0">
                        <div style="padding: 25px 0 50px 0; width:100%; min-height:fit-content; max-height:100%; overflow-y:auto">
                            @php
                                $i=1;
                            @endphp
                            @foreach ($data as $item)
                            <div style="width: 100%; text-align:center; margin:0; @if ($i % 2 === 0) background-color:#74A885 ; color:white @else background-color:#A8977D ; color:white @endif ; padding:0; " class="row" >
                                <div class="col position-relative" style="width: 40%; min-height:fit-content">
                                    <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">{{ $item->kodeUnit }}</p> 
                                </div>
                                <div class="col position-relative" style="width: 10%; min-height:fit-content">
                                    <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">{{ indonesiaDate($item->tanggal) }}</p>
                                </div>
                                <div class="col position-relative" style="width: 45%; min-height:fit-content">
                                    <p class="position-relative top-50 start-50 translate-middle" style="width: 100%; min-height:fit-content">{{ Str::limit($item->hal, 100) }}</p>
                                </div>
                                <div class="col position-relative" style="width: 5%; min-height:fit-content">
                                    <div class="position-relative top-50 start-50 translate-middle" style="height: fit-content">
                                        <button style="color:green" class="btn" onclick="preview('{{ $item->id }}')"><i class="bi bi-eye-fill"></i></button>
                                        
                                        @if ($item->created_at->diff(Illuminate\Support\Carbon::now())->days > 0)
                                        @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02')
                                        <button style="color:blue" class="btn" onclick="updateLPT('{{ $item->id }}')"><i class="bi bi-pencil-square"></i></button>
                                        <button style="color:red" class="btn" onclick="hapusLPT('{{ $item->id }}')"><i class="bi bi-file-earmark-x-fill"></i></button>
                                        @endif
                                        @else
                                        @if ($item->user_id === auth()->user()->id || auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02')
                                        <button style="color:blue" class="btn" onclick="updateLPT('{{ $item->id }}')"><i class="bi bi-pencil-square"></i></button>
                                        <button style="color:red" class="btn" onclick="hapusLPT('{{ $item->id }}')"><i class="bi bi-file-earmark-x-fill"></i></button>
                                        @endif
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                            @php
                                $i++;
                            @endphp
                            @endforeach
                        </div>
                        <div class="position-absolute top-0 start-50 translate-middle-x" style="width: 100%; height:25px; border-bottom:solid 1px; background-color:#495C4F; color:white">
                            <div style="width: 100%; text-align:center; margin:0;" class="row" >
                                <div class="col" style="width: 40%; height:fit-content">Nomor</div>
                                <div class="col" style="width: 10%; height:fit-content">Tanggal</div>
                                <div class="col" style="width: 45%; height:fit-content">Hal</div>
                                <div class="col" style="width: 5%; height:fit-content">Action</div>
                            </div>
                        </div>
                        <div class="position-absolute bottom-0 start-50 translate-middle-x" style="width: 100%; height:50px; background-color:#495C4F">
                            <div class="position-relative" style="height: 100%; width:100%">
                                <div class="position-absolute top-50 start-50 translate-middle" style="height: fit-content; width:fit-content">
                                    {{ $data->links() }}
                                </div>
                                <div class="position-absolute top-50 end-0 translate-middle-y" style="margin: 0 10px; width:fit-content">
                                    <button style="background-color: #4CC2B4; color:white" type="button" class="btn" data-bs-toggle="modal" data-bs-target="#inputlaporan-pelaksanaan-tugas">
                                        Input Laporan Pelaksanaan Tugas
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@section('modalsdigital-knowledge-management')
{{-- Modals Input laporan-pelaksanaan-tugas --}}
<div class="modal fade" id="inputlaporan-pelaksanaan-tugas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/digital-knowledge-management/laporan_pelaksanaan_tugas" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="nomor" name="nomor" placeholder="Nomor Laporan Pelaksanaan Tugas" required value="{{ old('nomor') }}">
                    <label for="nomor">Nomor Laporan Pelaksanaan Tugas</label>
                    @error('nomor')
                        <div class="text-danger mt-1">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="kodeUnit" id="kodeUnit" required placeholder="Kode Unit">
                        <option value="/KNL.1604/">/KNL.1604/</option>
                        <option value="/WKN.16/KNL.04/">/WKN.16/KNL.04/</option>
                    </select>
                    <label for="kodeUnit">Kode Unit</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="tanggal Laporan Pelaksanaan Tugas" required value="{{ old('tanggal') }}">
                    <label for="tanggal">Tanggal Laporan Pelaksanaan Tugas</label>
                    @error('tanggal')
                    <div class="text-danger mt-1">
                        {{$message}}
                    </div>
                @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="hal" name="hal" placeholder="hal Laporan Pelaksanaan Tugas" required value="{{ old('hal') }}">
                    <label for="hal">Hal Laporan Pelaksanaan Tugas</label>
                    @error('hal')
                    <div class="text-danger mt-1">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <input type="file" class="form-control" required name="fileUpload">
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
{{-- Akhir Modals Input laporan-pelaksanaan-tugas --}}

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
                src="{{ asset('storage/laporan-pelaksanaan-tugas/eWrsmdQCDnxcLyKQQWLGn5O0znL2DUeBpXKn69Mu.pdf') }}"
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

{{-- Modals Edit laporan-pelaksanaan-tugas --}}
<div class="modal fade" id="updatelaporan-pelaksanaan-tugas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" id="editlaporan-pelaksanaan-tugasHeader">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="updatelaporan-pelaksanaan-tugascontent">
            <form action="/digital-knowledge-management/laporan_pelaksanaan_tugas" method="post" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <input type="text" hidden value="" name="oldfile">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="nomor" name="nomor" placeholder="Nomor Laporan Pelaksanaan Tugas" required value="{{ old('nomor') }}">
                    <label for="nomor">Nomor Laporan Pelaksanaan Tugas</label>
                    @error('nomor')
                        <div class="text-danger mt-1">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="tanggal Laporan Pelaksanaan Tugas" required value="{{ old('tanggal') }}">
                    <label for="tanggal">Tanggal Laporan Pelaksanaan Tugas</label>
                    @error('tanggal')
                    <div class="text-danger mt-1">
                        {{$message}}
                    </div>
                @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="hal" name="hal" placeholder="hal Laporan Pelaksanaan Tugas" required value="{{ old('hal') }}">
                    <label for="hal">Hal Laporan Pelaksanaan Tugas</label>
                    @error('hal')
                    <div class="text-danger mt-1">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <input type="file" class="form-control" required name="fileUpload">
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
{{-- Akhir Modals laporan-pelaksanaan-tugas --}}

{{-- Modals Hapus laporan-pelaksanaan-tugas --}}
<div class="modal fade" id="hapuslaporan-pelaksanaan-tugas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="hapuslaporan-pelaksanaan-tugascontent" style="text-align: center">
            <h5>Anda Yakin Ingin Menghapus Laporan Pelaksanaan Tugas Nomor</h5>
            <form action="/digital-knowledge-management/laporan_pelaksanaan_tugas" method="post" enctype="multipart/form-data">
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
{{-- Akhir Modals Hapus laporan-pelaksanaan-tugas --}}

@endsection


@section('footdigital-knowledge-management')
    @if($errors->any())
        <script>
            var myModal = new bootstrap.Modal(document.getElementById('inputlaporan-pelaksanaan-tugas'), {
                keyboard: false
            })
            myModal.show()
        </script>
    @endif
    <script src="/js/digital-knowledge-management/laporan-pelaksanaan-tugas.js"></script>
@endsection