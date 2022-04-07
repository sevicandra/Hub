@extends('layout.main')

@section('head')
    <style>
        .tablecontent:hover {
            background-color: aqua;
            cursor: pointer
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid" style="padding: 10px 37px 9px 37px; height:100%">
        <div class="container-fluid" style="height:100%">
            <div class="row" style="height: 100%">
                <div class="col-sm-8" style="height: 100%; background-color:#f0f8ff; border-radius:10px">
                    <div class="" style="height: 90%; width:100%">
                        <div class="row" style="height: 45px;text-align:center; width:100%">
                            <div style="width: 45%">Kementerian/Lembaga</div>
                            <div style="width: 45%">Satuan Kerja</div>
                            <div style="width: 10%">Kode Satker</div>
                        </div>
                        <div class="scrollable" style="height:90%; width:100%;overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;" >
                            @foreach ($data as $item)
                            <div class="row tablecontent" style="min-height: 45px;max-height:fit-content; width:100%" onclick="profil('{{ $item->id }}')">
                                <div style="width: 45%">{{ $item->kementerian->namaKementerian }}</div>
                                <div style="width: 45%">{{ $item->namaSatker }}</div>
                                <div style="width: 10%">{{ $item->kodeSatker }}</div>
                           </div>
                           @endforeach
                        </div>
                    </div>
                    <div style="height: 10%" class="row ">
                        <div class="col-sm-8" style="height: 100%">
                            {{ $data->links() }}
                        </div>
                        <div class="col-sm-4 d-flex justify-content-end">
                            <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#inputSatker" style="font-size: 0.75vw;height:fit-content">Tambah Satuan Kerja</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4" style="border-radius: 10px; background-color:#f0f8ff48; height:100%">
                    <div style="height: 100%; position: relative">
                        <div id="loading" style="z-index:10; height:100%; width:100%;" hidden>
                            <div class="position-absolute top-50 start-50 translate-middle">
                                <div class="spinner-border text-primary" role="status" style="height:200px;width:200px">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <div  id="dataloaded" style="height: 100%">
                            <div class="row" style="height: 10%">
                                <div class="col-sm-12" style="text-align: center; color:white;padding-top:10px">
                                    <h2 style="font-size: 3vw">Profil Satuan Kerja</h2>
                                </div>
                            </div>
                            <hr style="height: 1%">
                            <form method="POST" action="" id="updateProfilSatker" style="margin: 10px; height:75%">
                                @csrf
                                @method('PATCH')
                                <div  class="row scrollable" style="height: 90%; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                                    <label for="kementerian" class="col-form-label">Kementerian</label>
                                    <select id="kementerian" class="form-select" name="kementerian_id">
                                        @foreach ($kementerian as $item)
                                            <option id="kementerian{{ $item->id }}" class="kementerian"
                                                value="{{ $item->id }}">{{ $item->namaKementerian }}</option>
                                        @endforeach
                                    </select>
                                    <label for="namaSatker" class="col-form-label">Nama Satuan Kerja</label>
                                    <input class="form-control" id="namaSatker" name="namaSatker" type="text" value="">
                                    <label for="alamat" class="col-form-label">Alamat Satuan Kerja</label>
                                    <textarea class="form-control" id="alamat" name="alamat"></textarea>
                                    <label for="namaKepalaSatker" class="col-form-label">Nama Kepala Satuan Kerja</label>
                                    <input class="form-control" id="namaKepalaSatker" name="namaKepalaSatker" type="text"
                                        value="">
                                    <label for="noTeleponKepalaSatker" class="col-form-label">Nomor HP Kepala Satuan Kerja</label>
                                    <input class="form-control" id="noTeleponKepalaSatker" name="noTeleponKepalaSatker"
                                        type="text" value="">
                                    <label for="namaOperatorSatker" class="col-form-label">Nama Operator Satuan Kerja</label>
                                    <input class="form-control" id="namaOperatorSatker" name="namaOperatorSatker" type="text"
                                        value="">
                                    <label for="noTeleponOperatorSatker" class="col-form-label">Nomor HP Operator Satuan
                                        Kerja</label>
                                    <input class="form-control" id="noTeleponOperatorSatker" name="noTeleponOperatorSatker"
                                        type="text" value="">
                                </div>
                                <div class="row" style="height: 5%">

                                </div>
                                <div class="row" style="height: 5%">
                                    <div>
                                        <button class="btn btn-success">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- Modals Input Satuan Kerja --}}
<div class="modal" id="inputSatker" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content " style="border: none; border-radius:10px">
            <div class="modal-header" style="background-color: ">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form action="/satker" method="POST">
                        @csrf
                        <select class="form-select" name="kementerian_id">
                            <option selected hidden>Nama Kementerian</option>
                            @foreach ($kementerian as $item)
                            <option value="{{ $item->id }}">{{ $item->namaKementerian }}</option>
                            @endforeach
                        </select>
                        <input name="namaSatker" type="text" class="form-control" placeholder="nama Satuan Kerja">
                        <input name="kodeSatker" type="text" class="form-control" placeholder="6 Digit Kode Satker">
                        <input name="kodeSatkerFull" type="text" class="form-control" placeholder="Kode Satker">
                        <div>
                            <div style="margin:auto; width:fit-content">
                                <button type="submit" class="btn">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Akhir Modals Input Satuan Kerja --}}


@endsection

@section('foot')
    <script src="/js/pindai/satker.js"></script>
@endsection
