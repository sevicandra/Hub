@extends('layout.filestorage')

@section('headfilestorage')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        dl, ol, ul{
            margin:0
        }
    </style>
@endsection

@section('contentfilestorage')
            <div class="container-fluid" style="height: 100%;">
                <div class="row" style="height: 100%; background-color:rgb(255, 255, 255); border-radius:0 0 10px 10px">
                    <div class="position-relative" style="height: 100%; width:100%; padding:0">
                        <div style="padding: 25px 0 50px 0; width:100%; min-height:fit-content; max-height:100%; overflow-y:auto">
                            @php
                                $i=1;
                            @endphp
                            @foreach ($data as $item)
                            <div style="width: 100%; text-align:center; margin:0; @if ($i % 2 === 0) background-color:#74A885 ; color:white @else background-color:#A8977D ; color:white @endif ; padding:0; color:white" class="row" >
                                <div class="col position-relative" style="width: 10%; min-height:fit-content">
                                    <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">{{ indonesiaDate($item->tanggal) }}</p>
                                </div>
                                <div class="col position-relative" style="width: 95%; min-height:fit-content">
                                    <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">{{ Str::limit($item->judul, 100) }}</p>
                                </div>
                                <div class="col position-relative" style="width: 5%; min-height:fit-content">
                                    <div style="height: fit-content" class="position-relative top-50 start-50 translate-middle">
                                        <button style="color:green" class="btn" data-bs-toggle="modal" data-bs-target="#preview" onclick="preview('{{ $item->id }}')"><i class="bi bi-eye-fill"></i></button>
                                        @if ($item->created_at->diff(Illuminate\Support\Carbon::now())->days > 0)
                                        @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02')
                                        <button style="color:blue" class="btn" data-bs-toggle="modal" data-bs-target="#updatePresentasi" onclick="updatePresentasi('{{ $item->id }}')"><i class="bi bi-pencil-square"></i></button>
                                        <button style="color:red" class="btn" data-bs-toggle="modal" data-bs-target="#hapusPresentasi" onclick="hapusPresentasi('{{ $item->id }}')"><i class="bi bi-file-earmark-x-fill"></i></button>
                                        @endif
                                        @else
                                        @if ($item->user_id === auth()->user()->id || auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02')
                                        <button style="color:blue" class="btn" data-bs-toggle="modal" data-bs-target="#updatePresentasi" onclick="updatePresentasi('{{ $item->id }}')"><i class="bi bi-pencil-square"></i></button>
                                        <button style="color:red" class="btn" data-bs-toggle="modal" data-bs-target="#hapusPresentasi" onclick="hapusPresentasi('{{ $item->id }}')"><i class="bi bi-file-earmark-x-fill"></i></button>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @php
                                $i++
                            @endphp
                            @endforeach
                        </div>
                        <div class="position-absolute top-0 start-50 translate-middle-x" style="width: 100%; height:25px; border-bottom:solid 1px; background-color:#495C4F; color:white">
                            <div style="width: 100%; text-align:center; margin:0;" class="row" >
                                <div class="col" style="width: 10%; height:fit-content">Tanggal</div>
                                <div class="col" style="width: 95%; height:fit-content">Judul</div>
                                <div class="col" style="width: 5%; height:fit-content">Action</div>
                            </div>
                        </div>
                        <div class="position-absolute bottom-0 start-50 translate-middle-x" style="width: 100%; height:50px; background-color:#495C4F">
                            <div class="position-relative" style="height: 100%; width:100%">
                                <div class="position-absolute top-50 start-50 translate-middle" style="height: fit-content; width:fit-content">
                                    {{ $data->links() }}
                                </div>
                                <div class="position-absolute top-50 end-0 translate-middle-y" style="margin: 0 10px; width:fit-content">
                                    <button style="background-color: #4CC2B4; color:white" type="button" class="btn" data-bs-toggle="modal" data-bs-target="#inputPresentasi">
                                        Input Presentasi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection

@section('modalsfilestorage')
{{-- Modals Input Presentasi --}}
<div class="modal fade" id="inputPresentasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/filestorage/presentasi" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="tanggal Presentasi" required value="{{ old('tanggal') }}">
                    <label for="tanggal">Tanggal Presentasi</label>
                    @error('tanggal')
                    <div class="text-danger mt-1">
                        {{$message}}
                    </div>
                @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="judul" name="judul" placeholder="judul Presentasi" required value="{{ old('judul') }}">
                    <label for="judul">Judul Presentasi</label>
                    @error('judul')
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
{{-- Akhir Modals Input Presentasi --}}

{{-- Modals Preview --}}
<div class="modal fade" id="preview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header" id="previewHeader">
          <h5 class="modal-title" id="staticBackdropLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="height: 80vh" id="previewFrame">
            {{-- <iframe
                src="{{ asset('storage/Presentasi/eWrsmdQCDnxcLyKQQWLGn5O0znL2DUeBpXKn69Mu.pdf') }}"
                frameBorder="0"
                scrolling="auto"
                height="100%"
                width="100%"
            >
            </iframe> --}}
            <embed src="" >
        </div>
      </div>
    </div>
</div>
{{-- Akhir Modals Preview --}}

{{-- Modals Edit Presentasi --}}
<div class="modal fade" id="updatePresentasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" id="updatePresentasiHeader">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="updatePresentasicontent">
            <form action="/filestorage/presentasi" method="post" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <input type="text" hidden value="" name="oldfile">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="nomor" name="nomor" placeholder="Nomor Presentasi" required value="{{ old('nomor') }}">
                    <label for="nomor">Nomor Presentasi</label>
                    @error('nomor')
                        <div class="text-danger mt-1">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="tanggal Presentasi" required value="{{ old('tanggal') }}">
                    <label for="tanggal">Tanggal Presentasi</label>
                    @error('tanggal')
                    <div class="text-danger mt-1">
                        {{$message}}
                    </div>
                @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="hal" name="hal" placeholder="hal Presentasi" required value="{{ old('hal') }}">
                    <label for="hal">Judul Presentasi</label>
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
{{-- Akhir Modals Presentasi --}}

{{-- Modals Edit Presentasi --}}
<div class="modal fade" id="hapusPresentasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="hapusPresentasicontent" style="text-align: center">
            <h5>Anda Yakin Ingin Menghapus Presentasi Nomor</h5>
            <form action="/filestorage/presentasi" method="post" enctype="multipart/form-data">
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
{{-- Akhir Modals Presentasi --}}

@endsection

@section('footfilestorage')
    @if($errors->any())
        <script>
            var myModal = new bootstrap.Modal(document.getElementById('inputPresentasi'), {
                keyboard: false
            })
            myModal.show()
        </script>
    @endif
    <script src="/js/fileStorage/presentasi.js"></script>
@endsection