@extends('layout.main')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        dl, ol, ul{
            margin:0
        }
    </style>
@endsection

@section('content')
<div class="container-fluid" style="padding: 30px 37px 9px 37px; height:100%">
    <div class="container-fluid" style="border-radius: 10px; background-color:darkgrey; height:100%">
        <div class="row position-relative" style="padding-bottom: 10px; height:38px">
            <div class="row" style="padding-bottom: 10px; height:38px">
                <div class="col-sm-1">
                    <a href="/filestorage">
                        <button class="btn translate-middle-y" style="@if (isset($fileStorage)) background-color: rgb(13, 110, 253); color:white @else background-color: white @endif"><i class="bi bi-house-fill"></i></button>
                    </a>
                </div>
                <div class="col-sm-2" >
                    <a href="/filestorage/keputusan">
                        <button class="btn translate-middle-y" style="width: 100%; @if (isset($keputusan)) background-color: rgb(13, 110, 253); color:white @else background-color: white @endif">Keputusan</button>
                    </a>
                </div>
            </div>
            <div class="position-absolute top-50 end-0 translate-middle-y" style="margin: 0 10px; width:fit-content">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inputKeputusan">
                    Input Keputusan
                </button>
            </div>
        </div>
        <div id="contentBox" class="row" style="padding: 0; border-radius:0 0 10px 10px; overflow:hidden">
            <div class="container-fluid" style="height: 100%;">
                <div class="row" style="height: 100%; background-color:aliceblue; border-radius:0 0 10px 10px">
                    <div class="position-relative" style="height: 100%; width:100%">
                        <div class="position-absolute top-0 start-50 translate-middle-x" style="width: 100%; height:25px; border-bottom:solid 1px">
                            <div style="width: 100%; text-align:center; margin:0;" class="row" >
                                <div class="col" style="width: 35%; height:fit-content">Nomor</div>
                                <div class="col" style="width: 20%; height:fit-content">tanggal</div>
                                <div class="col" style="width: 40%; height:fit-content">hal</div>
                                <div class="col" style="width: 5%; height:fit-content">Action</div>
                            </div>
                        </div>
                        <div style="padding: 25px 5px 50px 5px; width:100%; min-height:fit-content; max-height:100%; overflow-y:auto">
                            @foreach ($data as $item)
                            <div style="width: 100%; text-align:center; margin:0;" class="row" >
                                <div class="col" style="width: 35%; height:fit-content">{{ $item->kodeUnit }}</div>
                                <div class="col" style="width: 20%; height:fit-content">{{ indonesiaDate($item->tanggal) }}</div>
                                <div class="col" style="width: 40%; height:fit-content">{{ $item->hal }}</div>
                                <div class="col" style="width: 5%; height:fit-content">
                                    <button style="color:green" class="btn" data-bs-toggle="modal" data-bs-target="#preview" onclick="preview('{{ $item->id }}')"><i class="bi bi-eye-fill"></i></button>
                                    @if ($item->user_id === auth()->user()->id || auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02')
                                    <button style="color:blue" class="btn" data-bs-toggle="modal" data-bs-target="#updateKeputusan" onclick="updateKeputusan('{{ $item->id }}')"><i class="bi bi-pencil-square"></i></button>
                                    <button style="color:red" class="btn" data-bs-toggle="modal" data-bs-target="#hapusKeputusan" onclick="hapusKeputusan('{{ $item->id }}')"><i class="bi bi-file-earmark-x-fill"></i></button>
                                    @endif
                                </div>
                            </div>   
                            @endforeach
                        </div>
                        <div class="position-absolute bottom-0 start-50 translate-middle-x" style="width: 100%; height:50px">
                            <div class="position-relative" style="height: 100%; width:100%">
                                <div class="position-absolute top-50 start-50 translate-middle" style="height: fit-content; width:fit-content">
                                    {{ $data->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
{{-- Modals Input Keputusan --}}
<div class="modal fade" id="inputKeputusan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/filestorage/keputusan" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="nomor" name="nomor" placeholder="Nomor Keputusan" required value="{{ old('nomor') }}">
                    <label for="nomor">Nomor Keputusan</label>
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
                    <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="tanggal Keputusan" required value="{{ old('tanggal') }}">
                    <label for="tanggal">Tanggal Keputusan</label>
                    @error('tanggal')
                    <div class="text-danger mt-1">
                        {{$message}}
                    </div>
                @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="hal" name="hal" placeholder="hal Keputusan" required value="{{ old('hal') }}">
                    <label for="hal">Hal Keputusan</label>
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
{{-- Akhir Modals Input Keputusan --}}

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

{{-- Modals Edit Keputusan --}}
<div class="modal fade" id="updateKeputusan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="updateKeputusancontent">
            <form action="/filestorage/keputusan" method="post" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <input type="text" hidden value="" name="oldfile">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="nomor" name="nomor" placeholder="Nomor Keputusan" required value="{{ old('nomor') }}">
                    <label for="nomor">Nomor Keputusan</label>
                    @error('nomor')
                        <div class="text-danger mt-1">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="tanggal Keputusan" required value="{{ old('tanggal') }}">
                    <label for="tanggal">Tanggal Keputusan</label>
                    @error('tanggal')
                    <div class="text-danger mt-1">
                        {{$message}}
                    </div>
                @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="hal" name="hal" placeholder="hal Keputusan" required value="{{ old('hal') }}">
                    <label for="hal">Hal Keputusan</label>
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
{{-- Akhir Modals Keputusan --}}

{{-- Modals Edit Keputusan --}}
<div class="modal fade" id="hapusKeputusan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="hapusKeputusancontent" style="text-align: center">
            <h5>Anda Yakin Ingin Menghapus Keputusan Nomor</h5>
            <form action="/filestorage/keputusan" method="post" enctype="multipart/form-data">
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
{{-- Akhir Modals Keputusan --}}

@endsection





@section('foot')
    <script>
        $(window).on('load', function(){
            var newHeight = (window.innerHeight*0.89-77);
            console.log(newHeight); 
            $("#contentBox").css('height', newHeight)
        });
        window.addEventListener('resize', function(event){
            var newHeight = (window.innerHeight*0.89-77);
            console.log(newHeight);
            $(window).resize(function() {
                $("#contentBox").css('height', newHeight)
            });
        });
    </script>
    @if($errors->any())
        <script>
            var myModal = new bootstrap.Modal(document.getElementById('inputKeputusan'), {
                keyboard: false
            })
            myModal.show()
        </script>
    @endif
    <script src="/js/fileStorage/keputusan.js"></script>
@endsection