
@extends('layout.main')
@section('content')
    
{{--  Dashboard  --}}
<div class="row" style="padding: 10px 37px 9px 37px">
    <div class="col-sm-9">
        {{--  Kepuasan Pengguna Layanan dan Capaian Kinerja Organisasi  --}}
        <div class="row">
            {{--  Kepuasan Pengguna Layanan  --}}
            <div class="col-sm-4" style="; padding-right:5px">
                <div style=" background-color: #ffff; margin-bottom: 10px; border-radius: 10px;height: 445px" >
                    <canvas id="kepuasanPelanggan" ></canvas>
                </div>
            </div>
            {{--  Akhir Kepuasan Pengguna Layanan  --}}
            {{--  Capaian Kinerja Organisasi  --}}
            <div class="col-sm-8" style="; padding-left:5px">
                <div style="height: 445px; background-color: #ffff; border-radius: 10px">
                    <canvas id="capaianKinerja" height="100%"></canvas>
                </div>
            </div>
            {{--  Akhir Capaian Kinerja Organisasi  --}}
        </div>
        {{--  AKhir Kepuasan Pengguna Layanan dan Capaian Kinerja Organisasi  --}}
        {{--  PNBP dan Jumlah Pengunjung  --}}
        <div class="row">
            {{--  PNBP  --}}
            <div class="col-sm-8" style="; padding-right:5px">
                <div class="row" style="height: 400px; background-color: #ffff; border-radius: 10px; padding:0px; margin:0">
                    <div>
                        <h1>PNBP KPKNL Ternate</h1>
                    </div>
                    <div class="col-sm-4">
                        <div id="PNBP1"></div>
                    </div>
                    <div class="col-sm-4">
                        <div id="PNBP2"></div>
                    </div>
                    <div class="col-sm-4">
                        <div id="PNBP3"></div>
                    </div>
                </div>
            </div>
            {{--  Akhir PNBP  --}}
            {{--  Jumlah Pengunjung  --}}
            <div class="col-sm-4" style="; padding-left:5px">
                <div style="height: 400px; background-color: #ffff; border-radius: 10px">
                    <div style="padding: 5px 0px 0px 10px">
                        <h1>Jumlah Pengunjung</h1>
                        <div class="row">
                            <div class="col-sm-6">
                                <h2>Tanggal</h2>
                            </div>
                            <div class="col-sm-6">
                                <h2>Rata-Rata</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  Akhir Jumlah Pengunjung  --}}
        </div>
    </div>
    {{--  Agenda  --}}
    <div class="col-sm-3" style=" padding-left: 4px">
        <div class="agenda" style="height: 800px; background-color: #ffffff4f; border-radius: 10px; padding: 0px 0 0 0px; max-height: 820px; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
            <nav class="navbar navbar-light bg-light sticky-top" style="margin: 0px 0px 7px 0px; border-radius: 10px;">
                <div class="container-fluid"> 
                    <input class="form-control" id="tanggalagenda" type="date">
                </div>
            </nav>
            <div id='agenda'></div>
        </div>
        <nav class="navbar navbar-light bg-light sticky-bottom" style="margin: 0px 0px 7px 0px; border-radius: 10px;">
            <div class="container-fluid"> 
                <button class="btn btn-primary container-fluid">Tambah Agenda</button>
            </div>
        </nav>
    </div>
    {{--  Akhir Agenda  --}}
</div>
{{--  Akhir Dashboard  --}}
@endsection
       