@extends('layout.main')
@section('head')

<link rel="stylesheet" href="/css/praktis/styles.css">

@endsection
@section('content')
    <div class="container-fluid" style="padding: 30px 37px 9px 37px; height:100%">
        <div class="container-fluid" style="border-radius: 10px; background-color:rgba(240, 248, 255, 0.281); height:100%">
            <div class="row" style="padding: 0 10px; height:60px">
                <div class="col-sm-1">
                    <a href="/praktis">
                        <button class="btn btn-primary translate-middle-y"><i class="bi bi-caret-left-fill"></i></button>
                    </a>
                </div>
                <div class="col-sm-2">
                    <a href="">
                        <button class="btn translate-middle-y" style="width: 100%; background-color:#ffffff">{{$data->kodeIKU}} {{$data->namaIKU}}</button>
                    </a>
                </div>
            </div>
            <div class="row" style="height:90%;">
                <div class="col-sm-6" style="height: 100%; padding: 0px 10px 0px 20px;"> 
                    <div style="height: 100%; background-color:#ffffff; padding:0 10px 0 10px; border-radius:10px">
                        @if (isset($data->target) && isset($data->targetRaw))
                        <form class="row" action="/updateTarget" method="POST" style="height: 100%">
                            <input name="target_persentase_id" type="text" hidden required value="{{$data->target->id}}">
                            <input name="target_raw_id" type="text" hidden required value="{{$data->targetRaw->id}}">
                        @else
                        <form class="row" action="/inputTarget" method="POST" style="height: 100%">
                        <input name="idikator_kinerja_utama_id" type="text" hidden required value="{{$data->id}}">
                        @endif
                            @csrf
                            <div style="height: 90%; overflow-y:hidden">
                                <div class="row" style="padding-top: 10px">
                                    <div class="col-sm-6">
                                       <p class="judul-table">{{$data->konsolidasi}}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="judul-table">{{$data->polarisasi}}</p>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px">
                                    <div class="col-sm-12">
                                        <p class="sub-judul-table">Persentase / Indeks</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="content">Triwulan 1</p>
                                    </div>
                                    <div class="col-sm-8"><input name="targetQ1" type="text" class="form-control" value="{{$data->target->targetQ1}}"></div>
                                    <div class="col-sm-4">
                                        <p class="content">Triwulan 2</p>
                                    </div>
                                    <div class="col-sm-8"><input name="targetQ2" type="text" class="form-control" value="{{$data->target->targetQ2}}"></div>
                                    <div class="col-sm-4">
                                        <p class="content">Triwulan 3</p>
                                    </div>
                                    <div class="col-sm-8"><input name="targetQ3" type="text" class="form-control" value="{{$data->target->targetQ3}}"></div>
                                    <div class="col-sm-4">
                                        <p class="content">Triwulan 4</p>
                                    </div>
                                    <div class="col-sm-8"><input name="targetQ4" type="text" class="form-control" value="{{$data->target->targetQ4}}"></div>
                                </div>
                                <div class="row" style="margin-top:10px">
                                    <div class="col-sm-12">
                                        <p class="sub-judul-table">Raw Data</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="content">Triwulan 1</p>
                                    </div>
                                    <div class="col-sm-8"><input name="targetRawQ1" type="text" class="form-control" value="{{$data->targetRaw->targetRawQ1}}"></div>
                                    <div class="col-sm-4">
                                        <p class="content">Triwulan 2</p>
                                    </div>
                                    <div class="col-sm-8"><input name="targetRawQ2" type="text" class="form-control" value="{{$data->targetRaw->targetRawQ2}}"></div>
                                    <div class="col-sm-4">
                                        <p class="content">Triwulan 3</p>
                                    </div>
                                    <div class="col-sm-8"><input name="targetRawQ3" type="text" class="form-control" value="{{$data->targetRaw->targetRawQ3}}"></div>
                                    <div class="col-sm-4">
                                        <p class="content">Triwulan 4</p>
                                    </div>
                                    <div class="col-sm-8"><input name="targetRawQ4" type="text" class="form-control" value="{{$data->targetRaw->targetRawQ4}}"></div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary">
                                    @if (isset($data->target) && isset($data->targetRaw))
                                    Update
                                    @else
                                    Simpan
                                    @endif
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6" style="height: 100%; padding: 0px 20px 0px 10px;"> 
                    <div style="height: 100%; background-color:#ffffff; padding:0 10px 0 10px; border-radius:10px">
                        <form class="row" action="" style="height: 100%">
                            <div style="height: 90%; overflow-y:hidden">
                                <div class="row" style="padding-top: 10px">
                                    <table class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th style="width: 10%"></th>
                                                <th>Bulan</th>
                                                <th>Raw</th>
                                                <th>Persentase</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td></td>
                                            <td>Bulan</td>
                                            <td>Raw</td>
                                            <td>Persentase</td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @if (isset($data->target) && isset($data->targetRaw))
                                <div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inputCapaian">Input Capaian</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (isset($data->target) && isset($data->targetRaw))
        {{-- Input Capaian --}}
            <div class="modal fade" id="inputCapaian" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <form action="/inputCapaian" method="POST">
                                    <input name="target_persentase_id" type="text" hidden required value="{{$data->target->id}}">
                                    <input name="target_raw_id" type="text" hidden required value="{{$data->targetRaw->id}}">
                                    @csrf
                                    <div class="row" style="margin-bottom: 5px">
                                        <label for="bulan" class="col-sm-4 col-form-label">Bulan</label>
                                        <div class="col-sm-8">
                                            <select name="bulan" class="form-control">
                                                <option value="1" class="form-control">Januari</option>
                                                <option value="2" class="form-control">Februari</option>
                                                <option value="3" class="form-control">Maret</option>
                                                <option value="4" class="form-control">April</option>
                                                <option value="5" class="form-control">Mei</option>
                                                <option value="6" class="form-control">Juni</option>
                                                <option value="7" class="form-control">Juli</option>
                                                <option value="8" class="form-control">Agustus</option>
                                                <option value="9" class="form-control">September</option>
                                                <option value="10" class="form-control">Oktober</option>
                                                <option value="11" class="form-control">November</option>
                                                <option value="12" class="form-control">Desember</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px">
                                        <label for="raw" class="col-sm-4 col-form-label">Raw</label>
                                        <div class="col-sm-8">
                                            <input name="raw" type="number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px">
                                        <label for="persentase" class="col-sm-4 col-form-label">Persentase / Indeks</label>
                                        <div class="col-sm-8">
                                            <input name="persentase" type="number" class="form-control" required>
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
        {{-- Akhir Input Capaian --}}
    @endif



@endsection