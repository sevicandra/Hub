@extends('layout.main')

@section('head')
    
@endsection

@section('content')
<div style="padding: 9px 37px 9px 37px; height:100%">
    <div style="border-radius: 10px; background-color:#a9a9a9; height:100%; display:flex; flex-direction: column">
        <div style="flex-grow: 1; display:flex; flex-direction: column; overflow:auto">
            @foreach ($datas as $data)
            <div style="display: flex; background-color:#86B386; border-radius:10px; margin-top:5px; color:#001C3B">
                <div style="display: flex; flex-direction:column; flex-grow: 1">
                    <div style="display: flex; align-content:space-around">
                        <div style="margin: 0 10px">
                            <h4>{{ $data->nomor }}{{ $data->kodeSurat }}{{ year($data->tanggal) }}</h4>
                        </div>
                        <div style="margin: 0 10px">
                            <h4>{{ indonesiaDate($data->tanggal) }}</h4>
                        </div>
                    </div>
                    <div style="margin: 0 10px">
                        <h4>{{ $data->satuanKerja->namaSatker }}</h4>
                    </div>
                </div>
                <div style="max-width: 100px; align-items:center; margin: 0 5px; justify-content:center; display:flex">
                    <div style=" margin: 0 5px; color:green">
                        <i onclick="preview('{{ $data->id }}')" class="bi bi-eye-fill" style="cursor: pointer"></i>
                    </div>
                    <div style=" margin: 0 5px; ">
                        @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '03' || auth()->user()->jabatan === '12')
                        <form action="/status-penggunaan/{{ $data->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn deleteButton" type="button" style="color:red">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
        <hr style="margin:0">
        <div style="height: 50px; display:flex; align-items:center; padding: 5px 50px">
            <div style="flex-grow: 1">
                {{ $datas->links() }}
            </div>
            <div>
                @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '03' || auth()->user()->jabatan === '12')
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#input">Input PSP</button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
@if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '03' || auth()->user()->jabatan === '12')
<div class="modal fade" id="input" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form action="/status-penggunaan" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <label for="nomor" class="col-sm-4 col-form-label">Nomor </label>
                            <div class="col-sm-8">
                                <input name="nomor" class="form-control" type="number" required>
                            </div>
                        </div>
                        <div class="row">
                            <label for="hal" class="col-sm-4 col-form-label">Kode Surat</label>
                            <div class="col-sm-8">
                                <select class="form-select" name="kodeSurat" id="kodeSurat" required placeholder="Kode Surat">
                                    <option value="/MK.6/KNL.1604/">/MK.6/KNL.1604/</option>
                                    <option value="/MK.6//WKN.16/KNL.04/">/MK.6/WKN.16/KNL.04/</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label for="tanggal" class="col-sm-4 col-form-label">Tanggal</label>
                            <div class="col-sm-8">
                                <input name="tanggal" type="date" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <label for="tanggal" class="col-sm-4 col-form-label">Kode Satker</label>
                            <div class="col-sm-8">
                                <input name="kodeSatker" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <label for="fileUpload" class="col-sm-4 col-form-label">file</label>
                            <div class="col-sm-8">
                                <input name="fileUpload" type="file" class="form-control" required>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="col-sm-4" aria-label="Text with checkbox">Kirim Notifikasi?</label>
                            <div class="input-group-text" style="background: none; border:none">
                                <input name="kirimNotifikasi" class="form-check-input mt-0" type="checkbox">
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif


<div class="modal fade" id="preview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header" id="previewHeader">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="height: 80vh" id="previewFrame">

        </div>
      </div>
    </div>
</div>
    
@endsection

@section('foot')
<script src="js/status-penggunaan/index.js"></script>

@endsection