
@extends('layout.main')

@section('head')
<style>
    h1{
        font-family: istokweb;
        font-weight: bold
    }
    .scrollable::-webkit-scrollbar {
        display: none;
    }     
    /* Hide scrollbar for IE, Edge and Firefox */
    .scrollable {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
</style>
<link href='https://fonts.googleapis.com/css?family=Biryani' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Istok Web' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
@endsection


@section('content')
    
{{--  Dashboard  --}}
<div class="row scrollable" style="padding: 0px 37px 0px 37px; height:100%">
    <div class="col-sm-9" style="max-height: 100%; height:100%">
        {{--  Kepuasan Pengguna Layanan dan Capaian Kinerja Organisasi  --}}
        <div class="row" style="max-height: 55%;height: 55%; margin-bottom:0.5vh">
            {{--  Kepuasan Pengguna Layanan  --}}
            <div class="col-sm-4" style="; padding-right:5px; max-height: 100%; height: 100%">
                <div class="chart-container"  style="background-color: #ffff; border-radius: 10px;height: 100%" >
                    <canvas id="kepuasanPelanggan"></canvas>
                </div>
            </div>
            {{--  Akhir Kepuasan Pengguna Layanan  --}}
            {{--  Capaian Kinerja Organisasi  --}}
            <div class="col-sm-8" style="padding-left:5px; max-height: 100%; height: 100%">
                <div class="chart-container" style="background-color: #ffff; border-radius: 10px; height: 100%">
                    <canvas id="capaianKinerja"></canvas>
                </div>
            </div>
            {{--  Akhir Capaian Kinerja Organisasi  --}}
        </div>
        {{--  AKhir Kepuasan Pengguna Layanan dan Capaian Kinerja Organisasi  --}}
        {{--  PNBP dan Jumlah Pengunjung  --}}
        <div class="row" style="max-height: 44%;height: 44%">
            {{--  PNBP  --}}
            <div class="col-sm-8" style="; padding-right:5px; max-height: 100%; height:100%">
                <div class="row" style="height: 100%; background-color: #ffff; border-radius: 10px; padding:0px; margin:0">
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
            <div class="col-sm-4" style="; padding-left: 5px; max-height: 100%; height:100%">
                <div style="height: 100%; background-color: #ffff; border-radius: 10px">
                    <div style="padding: 0">
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
    <div class="col-sm-3" style=" padding-left:4px; max-height: 100%;height: 100%">
        <div class="scrollable" style="height: 93%; background-color: #ffffff4f; border-radius: 10px; padding: 0px 0 0 0px; max-height: 820px; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
            <nav class="navbar navbar-light bg-light sticky-top" style="margin: 0; border-radius: 10px;">
                <div class="container-fluid"> 
                    <input class="form-control" id="tanggalagenda" type="date">
                </div>
            </nav>
            <div id='agenda'></div>
        </div>
        <nav class="navbar navbar-light bg-light sticky-bottom" style="margin: 0; border-radius: 10px; height:7%">
            <div class="container-fluid"> 
                <button class="btn btn-primary container-fluid">Tambah Agenda</button>
            </div>
        </nav>
    </div>
    {{--  Akhir Agenda  --}}
</div>
{{--  Akhir Dashboard  --}}

@endsection

@section('foot')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/js/apexchart.js"></script>
<script src="/js/chart.js"></script>
<script src="{{asset('agenda/js/index.js')}}" type="text/javascript"></script>
@endsection