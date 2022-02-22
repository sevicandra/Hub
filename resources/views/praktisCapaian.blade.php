@extends('layout.main')
@section('head')

<link rel="stylesheet" href="/css/praktis/styles.css">

@endsection
@section('content')
    <div class="container-fluid" style="padding: 30px 37px 9px 37px; height:100%">
        <div class="container-fluid" style="border-radius: 10px; background-color:rgba(240, 248, 255, 0.281); height:100%">
            <div class="row" style="padding: 0 10px; height:60px">
                <div class="col-sm-1">
                    <a href="/{{$back}}">
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
                        <form class="row" action="@if ($data->target->first()) /updateTarget @else /inputTarget @endif" method="POST" style="height: 100%">
                            <input name="idikator_kinerja_utama_id" type="text" hidden required value="{{$data->id}}">
                            <input name="jenisKinerja" type="text" hidden required value="{{$jenisKinerja}}">
                            @csrf
                            <div style="height: 90%; overflow-y:hidden">
                                <div class="row" style="padding-top: 10px; height:10%">
                                    <div class="col-sm-6">
                                       <p class="judul-table">{{$data->konsolidasi}}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="judul-table">{{$data->polarisasi}}</p>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px; height: 80%">
                                    <div class="col-sm-12" style="height: 5%">
                                        <p class="sub-judul-table d-inline">Triwulan 1</p>
                                        <input name="periode[]" type="checkbox" class="d-inline" value="Q1">
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="content">Persentase/Indeks</p>
                                    </div>
                                    <div class="col-sm-8"><input name="target[]" type="number" class="form-control Q1" disabled @if ($data->target->where('periode', 'Q1')->first())value="{{$data->target->where('periode', 'Q1')->first()->target}}"@endif></div>
                                    <div class="col-sm-4">
                                        <p class="content">Raw</p>
                                    </div>
                                    <div class="col-sm-8"><input name="raw[]" type="number" class="form-control Q1" disabled @if ($data->target->where('periode', 'Q1')->first())value="{{$data->target->where('periode', 'Q1')->first()->raw}}"@endif></div>
                                    <div class="col-sm-12" style="height: 5%">
                                        <p class="sub-judul-table d-inline">Triwulan 2</p>
                                        <input name="periode[]" type="checkbox" class="d-inline" value="Q2">
                                    </div>
                                    <div class="col-sm-4" style="height: 10%">
                                        <p class="content">Persentase/Indeks</p>
                                    </div>
                                    <div class="col-sm-8" style="height: 10%"><input name="target[]" type="number" class="form-control Q2" disabled @if ($data->target->where('periode', 'Q2')->first())value="{{$data->target->where('periode', 'Q2')->first()->target}}"@endif></div>
                                    <div class="col-sm-4" style="height: 10%">
                                        <p class="content">Raw</p>
                                    </div>
                                    <div class="col-sm-8" style="height: 10%"><input name="raw[]" type="number" class="form-control Q2" disabled @if ($data->target->where('periode', 'Q2')->first())value="{{$data->target->where('periode', 'Q2')->first()->raw}}"@endif></div>
                                    <div class="col-sm-12" style="height: 5%">
                                        <p class="sub-judul-table d-inline">Triwulan 3</p>
                                        <input name="periode[]" type="checkbox" class="d-inline" value="Q3">
                                    </div>
                                    <div class="col-sm-4" style="height: 10%">
                                        <p class="content">Persentase/Indeks</p>
                                    </div>
                                    <div class="col-sm-8" style="height: 10%"><input name="target[]" type="number" class="form-control Q3" disabled @if ($data->target->where('periode', 'Q3')->first())value="{{$data->target->where('periode', 'Q3')->first()->target}}"@endif></div>
                                    <div class="col-sm-4" style="height: 10%">
                                        <p class="content">Raw</p>
                                    </div>
                                    <div class="col-sm-8" style="height: 10%"><input name="raw[]" type="number" class="form-control Q3" disabled @if ($data->target->where('periode', 'Q3')->first())value="{{$data->target->where('periode', 'Q3')->first()->raw}}"@endif></div>
                                    <div class="col-sm-12" style="height: 5%">
                                        <p class="sub-judul-table d-inline">Triwulan 4</p>
                                        <input name="periode[]" type="checkbox" class="d-inline" value="Q4">
                                    </div>
                                    <div class="col-sm-4" style="height: 10%">
                                        <p class="content">Persentase/Indeks</p>
                                    </div>
                                    <div class="col-sm-8" style="height: 10%"><input name="target[]" type="number" class="form-control Q4" disabled @if ($data->target->where('periode', 'Q4')->first())value="{{$data->target->where('periode', 'Q4')->first()->target}}"@endif></div>
                                    <div class="col-sm-4" style="height: 10%">
                                        <p class="content">Raw</p>
                                    </div>
                                    <div class="col-sm-8" style="height: 10%"><input name="raw[]" type="number" class="form-control Q4" disabled @if ($data->target->where('periode', 'Q4')->first())value="{{$data->target->where('periode', 'Q4')->first()->raw}}"@endif></div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary">@if ($data->target->first()) Update @else Simpan @endif</button>
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
                                                <th>Persentase/Indeks</th>
                                                <th>Raw</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->capaian as $item)
                                                <tr>
                                                    <td>
                                                        <form action="" method="post"></form>
                                                        <form action="/capkin/{{$item->id}}" method="POST">
                                                            @csrf
                                                            
                                                            <button class="btn" type="submit" style="color: red"><i class="bi bi-x-lg"></i></button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        @switch($item->bulan)
                                                            @case(1)
                                                                Januari    
                                                                @break
                                                            @case(2)
                                                                Februari
                                                                @break
                                                            @case(3)
                                                                Maret
                                                                @break
                                                            @case(4)
                                                                April
                                                                @break
                                                            @case(5)
                                                                Mei
                                                                @break
                                                            @case(6)
                                                                Juni
                                                                @break
                                                            @case(7)
                                                                Juli
                                                                @break
                                                            @case(8)
                                                                Agustus
                                                                @break
                                                            @case(9)
                                                                September
                                                                @break
                                                            @case(10)
                                                                Oktober
                                                                @break
                                                            @case(11)
                                                                November
                                                                @break
                                                            @case(12)
                                                                Desember
                                                                @break
                                                                
                                                        @endswitch
                                                    </td>
                                                    <td>{{$item->capaian}}</td>
                                                    <td>{{number_format($item->raw, 0, ',', '.')}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @if (isset($data->target))
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

    @if (isset($data->target))
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
                                    <input name="idikator_kinerja_utama_id" type="text" hidden required value="{{$data->id}}">
                                    <input name="jeniskinerja" type="text" hidden required value="{{$jenisKinerja}}">
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
                                        <label for="capaian" class="col-sm-4 col-form-label">Persentase / Indeks</label>
                                        <div class="col-sm-8">
                                            <input name="capaian" type="number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 5px">
                                        <label for="raw" class="col-sm-4 col-form-label">Raw</label>
                                        <div class="col-sm-8">
                                            <input name="raw" type="number" class="form-control">
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

    @section('foot')
        @if (Session::has('message'))
        <script>
            alert("Target Berhasil Di Update")
        </script>
        @endif

        <script src="/js/praktis/index.js"></script>

    @endsection

@endsection