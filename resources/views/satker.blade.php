@extends('layout.main')

@section('head')
    <style>
        tbody tr:hover {
            background-color: aqua;
            cursor: pointer
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid" style="padding: 10px 37px 9px 37px; height:100%">
        <div class="container-fluid" style="height:100%">
            <div class="row" style="height: 100%">
                <div class="col-sm-8 scrollable" style="height: 100%; background-color:#f0f8ff; border-radius:10px;overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                    <table style="height: 90%; width: 100%">
                        <thead style="height: 6.25%">
                            <tr>
                                <th style="width:45%" scope="col">Kementerian/Lembaga</th>
                                <th style="width:45%" scope="col">Satuan Kerja</th>
                                <th style="width:10%" scope="col">Kode Satker</th>
                            </tr>
                        </thead>
                        <tbody style="height: 93.75%">
                            @foreach ($data as $item)
                                <tr style="height: 6.6666667%" onclick="profil('{{ $item->id }}')">
                                    <td>{{ $item->kementerian->namaKementerian }}</td>
                                    <td>{{ $item->namaSatker }}</td>
                                    <td>{{ $item->kodeSatker }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div style="height: 10%" class="d-flex justify-content-center mt-2">
                        {{ $data->links() }}
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
                                <div class="col-sm-12" style="text-align: center; color:white">
                                    <h2 style="font-size: 1.7vw">Profil Satuan Kerja Kantor Pelayanan Kekayaan negara dan Lelang Ternate</h2>
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
@endsection

@section('foot')
    <script src="/js/pindai/satker.js"></script>
@endsection
