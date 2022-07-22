@extends('layout.main')

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
{{-- Dashboard --}}
<div class="row scrollable" style="padding: 0px 37px 0px 37px; height:100%">
    <div class="col-sm-9" style="max-height: 100%; height:100%">
        {{-- Kepuasan Pengguna Layanan dan Capaian Kinerja Organisasi --}}
        <div class="row" style="max-height: 55%;height: 55%; margin-bottom:0.5vh">
            {{-- Kepuasan Pengguna Layanan --}}
            <div class="col-sm-4" style="padding-right:5px; max-height: 100%; height: 100%">
                <div style="background-color: #FBF8F1; border-radius: 10px; height:100%">
                    <div style="height: 10%; text-align: center">
                        <h6><b><a style="text-decoration: none; font-size:1vw; color: #7A7A7A; font-family:'TW CENT MT'" href="/survei/monitoring">KEPUASAN PENGGUNA LAYANAN</a></b></h6>
                    </div>
                    <div style="height:80%">
                        <div class="chart-container" style="height: 100%">
                            <canvas id="kepuasanPelanggan"></canvas>
                        </div>
                    </div>
                    <div class="row" style="width: 100%; margin:0; height:10%; padding:0 5px">
                        <select id="kepuasanTusi" class="form-control"
                            style=";color: #7A7A7A; background-color: #FBF8F1;height: 90%; font-size:0.8vw; padding-top:0; padding-bottom:0; border:solid 1px #ffffff">
                            <option style="background-color: #FBF8F1;text-align: center; padding:0"
                                value="ALL"> <b>Kantor Pelayanan Kekayaan Negara
                                    dan Lelang Ternate</b> </option>
                            <option style="text-align: center; padding:0" value="PKN"> <b>Pengelolaan Kekayaan Negara</b> 
                            </option>
                            <option style="background-color: #FBF8F1;text-align: center; padding:0"
                                value="PEN"> <b>Pelayanan Penilaian</b> </option>
                            <option style="background-color: #FBF8F1;text-align: center; padding:0"
                                value="LLG"> <b>Pelayanan Lelang</b> </option>
                            <option style="background-color: #FBF8F1;text-align: center; padding:0"
                                value="PPN"> <b>Pengurusan Piutang Negara</b> </option>
                            <option style="background-color: #FBF8F1;text-align: center; padding:0"
                                value="LLN"> <b>Lain-lain</b> </option>
                        </select>
                    </div>
                </div>
            </div>
            {{-- Akhir Kepuasan Pengguna Layanan --}}
            {{-- Capaian Kinerja Organisasi --}}
            <div class="col-sm-8" style="padding-left:5px; max-height: 100%; height: 100%">
                <div style="background-color: #FBF8F1; border-radius: 10px; height: 100%; font-size:1vw; color: #7A7A7A; font-family:'TW CENT MT'; overflow:hidden">
                    <div style="height: 10%; text-align: center">
                        <h6><b>CAPAIAN KINERJA KPKNL TERNATE TAHUN {{ session()->get('tahun') }}</b></h6>
                    </div>
                    <div style="height: 10%; text-align: center">
                        <select id="CKO" class="form-select"
                            style="background-color: #FBF8F1;color: #7A7A7A; border:solid 1px #7A7A7A">
                            <option style="background-color: #FBF8F1;" value="Q1">Q1</option>
                            <option style="background-color: #FBF8F1;" value="Q2">Q2</option>
                            <option style="background-color: #FBF8F1;" value="Q3">Q3</option>
                            <option style="background-color: #FBF8F1;" value="Q4" selected>Q4</option>
                        </select>
                    </div>
                    <div style="height: 5%;padding: 0 5px; display:flex">
                        <div style="width: 45%">Nama IKU</div>
                        <div style="width: 20%; text-align:center">Target</div>
                        <div style="width: 20%; text-align:center">Capaian</div>
                        <div style="width: 15%; text-align:center">Realisasi</div>
                        <hr style="margin: 0; padding:0">
                    </div>
                    <div class="scrollable"
                        style="height: 75%; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none; padding: 10px 5px 0 5px">
                        <div id="capaianKinerja" style="width: 100%; height:fit-content">
                        </div>

                        {{-- <div class="chart-container" style="max-height: 400%;">
                            <canvas id="capaianKinerja"></canvas>
                        </div> --}}
                    </div>
                </div>
            </div>
            {{-- Akhir Capaian Kinerja Organisasi --}}
        </div>
        {{-- AKhir Kepuasan Pengguna Layanan dan Capaian Kinerja Organisasi --}}
        {{-- PNBP dan Potensi Lelang BMN --}}  
        <div class="row" style="max-height: 44%;height: 44%;">
            {{-- PNBP --}}
            <div class="col-sm-8 scrollable"
                style="min-height:fit-content ;padding-right:5px; max-height: 100%; color: #ffffff; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none; border-radius:10px; font-family: 'Tw Cen MT';">
                {{-- PNBP PKN --}}
                <div class="row"
                    style="max-height: fit-content; min-height: 32%; background: linear-gradient(90deg, #FFBD93 -1.04%, #FF8A93 100%) ; border-radius: 10px; padding:0px 12px; margin:0; cursor: pointer;"
                    data-bs-toggle="modal" data-bs-target="#PNBPPKN">
                    <div style="padding: 0"> <b>PNBP Pengelolaan Kekayaan Negara</b> </div>
                    <div style="padding: 0">
                        @if ($capaianPKN)
                        <b>Rp{{ number_format($capaianPKN->sum('capaian'), 2, ',', '.') }}</b>
                        @else
                        <b>Rp0,00</b>
                        @endif
                        /
                        @if ($PNBPPKN)
                        <b>Rp{{ number_format($PNBPPKN->target, 2, ',', '.') }}</b>
                        @else
                        <b>Rp0,00</b>
                        @endif
                    </div>
                    <div class="progress" style="padding: 0; margin-bottom:1%">
                        <div class="progress-bar" role="progressbar"
                            style="color:#7A7A7A;
                                background-color:
                                    @if ($PNBPPKN && $capaianPKN) 
                                        @if((($capaianPKN->sum('capaian') / $PNBPPKN->target)*100 ) < 80)
                                            #FF9E9E
                                        @elseif((($capaianPKN->sum('capaian') / $PNBPPKN->target)*100 ) < 100)
                                            #FFF48B
                                        @else
                                            #90FF96
                                        @endif
                                    @else 
                                        #ffffff
                                    @endif
                                ;width: 
                                    @if ($PNBPPKN && $capaianPKN)
                                        {{ ($capaianPKN->sum('capaian') / $PNBPPKN->target) * 100 }}% 
                                    @else 
                                        0% 
                                    @endif;"
                            aria-valuenow="
                                @if ($PNBPPKN && $capaianPKN) 
                                    {{ ($capaianPKN->sum('capaian') / $PNBPPKN->target) * 100 }}% 
                                @else
                                    0%    
                                @endif"
                            aria-valuemin="0" 
                            aria-valuemax="100">
                                @if ($PNBPPKN && $capaianPKN)
                                    <b>{{($capaianPKN->sum('capaian') / $PNBPPKN->target) * 100 }}%</b>  
                                @else 
                                    <b>0%</b>  
                                @endif
                        </div>
                    </div>
                </div>
                {{-- AKHIR PNBP PKN --}}
                <div class="row" style="height: 2%; margin:0">
                </div>
                {{-- PNBP LELANG --}}
                
                @php
                    
                @endphp
                <div class="row"
                    style="max-height: fit-content; min-height: 32%; background: linear-gradient(90deg, #8CC8FA -1.04%, #3497E6 100%); border-radius: 10px; padding:0px 12px; margin:0; cursor: pointer;"
                    data-bs-toggle="modal" data-bs-target="#PNBPLLG">
                    <div style="padding: 0"> <b>PNBP Lelang</b></div>
                    <div style="padding: 0">
                        @if ($capaianLLG)
                        Rp{{ number_format($capaianLLG->sum('capaian'), 2, ',', '.') }}
                        @else
                        Rp0,00
                        @endif
                        /
                        @if ($PNBPLLG)
                        Rp{{ number_format($PNBPLLG->target, 2, ',', '.') }}
                        @else
                        Rp0,00
                        @endif
                    </div>
                    <div class="progress" style="padding: 0; margin-bottom:1%">
                        <div class="progress-bar" role="progressbar"
                            style="color:#7A7A7A;
                                background-color:
                                    @if ($PNBPLLG && $capaianLLG) 
                                        @if((($capaianLLG->sum('capaian') / $PNBPLLG->target)*100 ) < 80)
                                            #FF9E9E
                                        @elseif((($capaianLLG->sum('capaian') / $PNBPLLG->target)*100 ) < 100)
                                            #FFF48B
                                        @else
                                            #90FF96
                                        @endif
                                    @else 
                                        #ffffff
                                    @endif
                                ;width: 
                                    @if ($PNBPLLG && $capaianLLG)
                                        {{ ($capaianLLG->sum('capaian') / $PNBPLLG->target) * 100 }}% 
                                    @else 
                                        0% 
                                    @endif;"
                            aria-valuenow="
                                @if ($PNBPLLG && $capaianLLG) 
                                    {{ ($capaianLLG->sum('capaian') / $PNBPLLG->target) * 100 }}% 
                                @else
                                    0%    
                                @endif"
                            aria-valuemin="0" 
                            aria-valuemax="100">
                                @if ($PNBPLLG && $capaianLLG)
                                    <b>{{($capaianLLG->sum('capaian') / $PNBPLLG->target) * 100 }}%</b>  
                                @else 
                                    <b>0%</b>  
                                @endif
                        </div>
                    </div>
                </div>
                {{-- AKHIR PNBP LELANG --}}
                <div class="row" style="height: 2%; margin:0">
                </div>
                {{-- PNBP PIUTANG NEGARA --}}
                <div class="row"
                    style="max-height: fit-content; min-height: 32%; background: linear-gradient(90deg, #72E8E1 -1.04%, #36CFBA 100%); border-radius: 10px; padding:0px 12px; margin:0; cursor: pointer;"
                    data-bs-toggle="modal" data-bs-target="#PNBPPPN">
                    <div style="padding: 0"> <b>PNBP Pengurusan Piutang Negara</b></div>
                    <div style="padding: 0">
                        @if ($capaianPPN)
                        Rp{{ number_format($capaianPPN->sum('capaian'), 2, ',', '.') }}
                        @else
                        Rp0,00
                        @endif
                        /
                        @if ($PNBPPPN)
                        Rp{{ number_format($PNBPPPN->target, 2, ',', '.') }}
                        @else
                        Rp0,00
                        @endif
                    </div>
                    <div class="progress" style="padding: 0; margin-bottom:1%">
                        <div class="progress-bar" role="progressbar"
                            style="color:#7A7A7A;
                                background-color:
                                    @if ($PNBPPPN && $capaianPPN) 
                                        @if((($capaianPPN->sum('capaian') / $PNBPPPN->target)*100 ) < 80)
                                            #FF9E9E
                                        @elseif((($capaianPPN->sum('capaian') / $PNBPPPN->target)*100 ) < 100)
                                            #FFF48B
                                        @else
                                            #90FF96
                                        @endif
                                    @else 
                                        #ffffff
                                    @endif
                                ;width: 
                                    @if ($PNBPPPN && $capaianPPN)
                                        {{ ($capaianPPN->sum('capaian') / $PNBPPPN->target) * 100 }}% 
                                    @else 
                                        0% 
                                    @endif;"
                            aria-valuenow="
                                @if ($PNBPPPN && $capaianPPN) 
                                    {{ ($capaianPPN->sum('capaian') / $PNBPPPN->target) * 100 }}% 
                                @else
                                    0%    
                                @endif"
                            aria-valuemin="0" 
                            aria-valuemax="100">
                                @if ($PNBPPPN && $capaianPPN)
                                    <b>{{($capaianPPN->sum('capaian') / $PNBPPPN->target) * 100 }}%</b>  
                                @else 
                                    <b>0%</b>  
                                @endif
                        </div>
                    </div>
                </div>
                {{-- AKHIR PNBP PIUTANG NEGARA --}}
            </div>
            {{-- Akhir PNBP --}}
            {{-- Potensi Lelang BMN --}}
            <div class="col-sm-4" style="; padding-left: 5px; max-height: 100%; height:100%; cursor:pointer" data-bs-toggle="modal" data-bs-target="#potensiLelang">
                <div style="height: 100%;  border-radius: 10px">
                    <div style="height: 15%;margin: 0px" class="row position-relative">
                        <div class="col-sm-12 position-absolute top-0 start-0"
                            style="text-align: center;border-radius: 10px 10px 0 0; background-color: #FFF89A; height:100%; border: 1px solid #7A7A7A">
                            <h2 class="NKO" style="color: #7A7A7A; font-family:'TW CENT MT'"> <b>POTENSI LELANG</b> </h2>
                        </div>
                    </div>
                    <div style="height: 85%;margin: 0px;" class="row position-relative">
                        <div class="col-sm-12 position-absolute top-0 start-0"
                            style="text-align: center;border-radius: 0 0 10px 10px ; background-color: #FFF89A; height:100%; border: 1px solid #7A7A7A">
                            <div style="height: 25%">
                                <div style="margin:auto; text-align: center">
                                    <p style="color: #7A7A7A;font-size:1.5vw; margin:0;line-height: normal; font-family:'TW CENT MT'">
                                        Surat Persetujuan 
                                    </p>
                                </div>
                            </div>
                            <hr style="margin:0">
                            <div style="height: 45%; ">
                                <div style="width:100%; text-align: center">
                                    <p style="color: #7A7A7A;font-size: 5vw; margin:0;line-height: normal; font-family:'TW CENT MT'">
                                        {{ count($persetujuan) }}
                                    </p>
                                </div>
                            </div>
                            <hr style="margin:0">
                            <div style="height: 15%">
                                <div style="margin:auto; text-align: center">
                                    <p style="color: #7A7A7A;font-size:1.5vw; margin:0;line-height: normal; font-family:'TW CENT MT'">
                                        Nilai Limit
                                    </p>
                                </div>
                            </div>
                            <hr style="margin:0">
                            <div style="height: 15%; ">
                                <div style="margin:auto; text-align: center">
                                    <p style="color: #7A7A7A;font-size: 1vw; margin:0;line-height: normal; font-family:'TW CENT MT'">
                                        Rp{{ number_format(array_sum($limit), 2, ',', '.') }}
                                        {{-- {{ $potensiLelang['limit'] }} --}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Akhir Potensi Lelang BMN --}}
        </div>
        {{-- AKHIR PNBP dan Potensi Lelang BMN --}}
    </div>
    {{-- Agenda --}}
    <div class="col-sm-3" style=" padding-left:4px; max-height: 100%;height: 100%">
        <div class="position-relative bottom-0 start-50 translate-middle-x"
            style="height: 99%; background-color: #7d95b380; border-radius: 10px; padding: 0; max-height: fit-content">
            <div class="position-absolute top-0 start-50 translate-middle-x" style="width: 100%">
                <nav class="navbar sticky-top" style="margin: 0; border-radius: 10px; background-color: #f4f1d6">
                    <div class="container-fluid">
                        <input class="form-control" id="tanggalagenda" type="date" style="background-color: #f4f1d6; border: solid 1px #ffffff">
                    </div>
                </nav>
            </div>
            <div class="scrollable container-fluid" style="height: 100%;padding: 55px 10px 55px 10px ; font-family:'TW CENT MT'; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;" id='agenda'>
                @if (1)
                @else
                <div style="background-color:#A6B36B; color: #ffffff; border-radius:10px;margin-top:10px">
                    <div class="row">
                        <div class="d-flex">
                            <div class="p-2">09:00</div>
                            <div class="vr"></div>
                            <div class="p-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque nam illo voluptate!</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-flex">
                            <div class="p-2">Lokasi :</div>
                            <div class="p-2">Meeting Room</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-flex" style="text-align: center">
                            <div style="width: 50%">Meeting Id</div>
                            <div style="width: 50%">Password</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-flex" style="text-align: center">
                            <div style="width: 50%">Meeting Id</div>
                            <div style="width: 50%">Password</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-flex">
                            <div style="width: 50%">
                                <form action="" style="width:100%; height:100%">
                                    <button class="btn" style="color:#FAFFE5; border:solid 1px #FAFFE5; background-color:#BCBFAC; height:100%;width:100%">Masuk Room Zoom</button>
                                </form>
                            </div>
                            <div style="width: 50%">
                                <form action="" style="width:100%; height:100%">
                                    <button class="btn" style="color:#FAFFE5; border:solid 1px #FAFFE5; background-color:#BCBFAC; height:100%;width:100%">Presensi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row"><div><form action=""><button type="submit" class="btn" style="color:red; width:100%; border:solid 1px #ff6961; background-color:#ff6961; color:#ffffff">Hapus Agenda</i></button></form></div></div>
                </div>
                @endif
            </div>
            <div class="position-absolute bottom-0 start-50 translate-middle-x" style="width: 100%">
                <nav class="navbar sticky-top"
                    style="margin: 0;width:100%; border-radius: 10px; min-height:fit-content; max-height:fit-content; background-color:#f4f1d6">
                    <div class="container-fluid" style="min-height: 100%;max-height:fit-content">
                        <button class="btn container-fluid" data-bs-toggle="modal" data-bs-target="#inputAgenda"
                            style="height: 30px; padding: 1px; font-family:'TW CENT MT'; color:#7A7A7A; background-color:#BFE2F5" >Tambah Agenda</button>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    {{-- Akhir Agenda --}}
</div>
{{-- Akhir Dashboard --}}

{{-- Modals Input Agenda --}}
<div class="modal fade" id="inputAgenda" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 30px 30px 20px 20px; border:none">
            <div class="modal-header"
                style="background: linear-gradient(270.44deg, #4D59CA 0%, #696486 66.03%, #585881 100%); border-radius: 20px 20px 0 0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form action="/agenda" method="POST">
                        @csrf
                        <div class="row">
                            <label for="agenda" class="col-sm-4 col-form-label">Nama Agenda <p class="d-inline" style="color: red">*</p></label>
                            <div class="col-sm-8">
                                <input name="agenda" class="form-control" type="text" value="{{ old('agenda') }}" required>
                                @error('agenda')
                                    <div class="text-danger mt-1">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <label for="tanggal" class="col-sm-4 col-form-label">Tanggal <p class="d-inline" style="color: red">*</p></label>
                            <div class="col-sm-8">
                                <input name="tanggal" type="date" class="form-control" value="{{ old('tanggal') }}" required>
                                @error('tanggal')
                                    <div class="text-danger mt-1">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <label for="waktu" class="col-sm-4 col-form-label">Jam <p class="d-inline" style="color: red">*</p></label>
                            <div class="col-sm-8">
                                <input name="waktu" type="time" class="form-control" value="{{ old('waktu') }}" required>
                                @error('tanggal')
                                    <div class="text-danger mt-1">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <label for="tempat" class="col-sm-4 col-form-label">Tempat <p class="d-inline" style="color: red">*</p></label>
                            <div class="col-sm-8">
                                <input name="tempat" class="form-control" type="text" value="{{ old('tempat') }}" required>
                                @error('tempat')
                                    <div class="text-danger mt-1">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <label for="meetingId" class="col-sm-4 col-form-label">Meeting Id</label>
                            <div class="col-sm-8">
                                <input name="meetingId" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <label for="meetingPassword" class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <input name="meetingPassword" class="form-control" type="text">

                            </div>
                        </div>
                        <div class="row">
                            <label for="linkRapat" class="col-sm-4 col-form-label">Link Rapat</label>
                            <div class="col-sm-8">
                                <input name="linkRapat" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <label for="linkAbsensi" class="col-sm-4 col-form-label">Link Absensi</label>
                            <div class="col-sm-8">
                                <input name="linkAbsensi" class="form-control" type="text">
                            </div>
                        </div>
                        <div style="margin-top:10px">
                            <div style="width: fit-content;margin: auto">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Akhir Modals Input Agenda --}}

{{-- Modals Input PNBP PKN --}}
<div style="height: 100vh" class="modal fade bd-example-modal-xl" id="PNBPPKN" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div style="height: 90%" class="modal-dialog modal-xl">
        <div class="modal-content " style="border-radius: 30px 30px 30px 30px; border:none; height:100%">
            <div class="modal-header"
                style="background: linear-gradient(270.44deg, #4D59CA 0%, #696486 66.03%, #585881 100%); border-radius: 20px 20px 0 0; height:5%">
                <p style="color:#ffff;font-size:1.5vw; margin:0;line-height: normal">
                    PENGELOLAAN KEKAYAAN NEGARA
                </p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 90%">
                <div class="container-fluid" style="height: 100%">
                    @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '03' || auth()->user()->jabatan
                    === '12')
                    <div class="row" style="height: 8%">
                        <div class="col-sm-6"
                            style="border-bottom: 1px solid #000000; border-right: 1px solid #000000 ;padding-bottom:5px">
                            @if ($PNBPPKN)
                            <div class="row">
                                <form action="/capaianPnbp" method="POST">
                                    @csrf
                                    <div class="row">
                                        <input type="text" name="pnbp_id" value="{{ $PNBPPKN->id }}" hidden>
                                        <label for="" class="col-sm-2 col-form-label">Bulan</label>
                                        <div class="col-sm-3">
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
                                        <label for="" class="col-sm-2 col-form-label">Capaian</label>
                                        <div class="col-sm-3">
                                            <input name="capaian" type="number" class="form-control">
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="bi bi-check2-square"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endif
                        </div>
                        <div class="col-sm-6"
                            style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; padding-bottom:5px">
                            @if ($PNBPPKN)
                            <form action="/pnbp/{{ $PNBPPKN->id }}" method="POST">
                                @method('PATCH')
                                @csrf
                                <div class="row">
                                    <label for="" class="col-sm-3 col-form-label">Target PNBP</label>
                                    <div class="col-sm-4">
                                        <input name='target' type="number" class="form-control"
                                            value="{{ $PNBPPKN->target }}">
                                    </div>
                                    <div class="col"></div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="bi bi-check2-square"></i></button>
                                    </div>
                                </div>
                            </form>
                            @else
                            <form action="/pnbp" method="POST">
                                @csrf
                                <div class="row">
                                    <label for="" class="col-sm-3 col-form-label">Target PNBP</label>
                                    <div class="col-sm-4">
                                        <input name='target' type="number" class="form-control">
                                        <input name='jenis' type="text" class="form-control" hidden value="PKN">
                                    </div>
                                    <div class="col"></div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="bi bi-check2-square"></i></button>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                    @endif
                    <div class="row" style="height: 92%;">
                        <div class="col-sm-6"
                            style="border-bottom: 1px solid #000000; border-right: 1px solid #000000 ;padding-bottom:5px; padding: 12px; height:100%">
                            @foreach ($capaianPKN as $item)
                            <div class="row">
                                <label for="" class="col-sm-4 col-form-label">
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
                                </label>
                                <div class="col-sm-6">
                                    <div class="form-control" style="background-color: #4d4c52; text-align: right; color:white">
                                        {{ number_format($item->capaian, 2, ',', '.') }}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '03' ||
                                    auth()->user()->jabatan === '12')
                                    <form action="capaianPnbp/{{ $item->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" style="color:red"><i
                                                class="bi bi-x-square"></i></button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-sm-6"
                            style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; padding-bottom:5px; padding: 12px; height:100%">
                            <div class="row" style="height: 50%; padding: 12px">
                                <div class="chart-container" style="height: 100%;max-height: 100%;">
                                    <canvas id="linechartPNBPPKN"></canvas>
                                </div>
                            </div>
                            <div class="row" style="height: 50%; padding: 12px">
                                <div class="chart-container" style="height: 100%;max-height: 100%;">
                                    <canvas id="barchartPNBPPKN"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-header"
                style="background: linear-gradient(270.44deg, #4D59CA 0%, #696486 66.03%, #585881 100%); border-radius: 0 0 20px 20px; height:5%; border:none">

            </div>
        </div>
    </div>
</div>
{{-- Akhir Modals Input PNBP PKN --}}

{{-- Modals Input PNBP LLG --}}
<div style="height: 100vh" class="modal fade bd-example-modal-xl" id="PNBPLLG" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div style="height: 90%" class="modal-dialog modal-xl">
        <div class="modal-content " style="border-radius: 30px 30px 30px 30px; border:none; height:100%">
            <div class="modal-header"
                style="background: linear-gradient(270.44deg, #4D59CA 0%, #696486 66.03%, #585881 100%); border-radius: 20px 20px 0 0; height:5%">
                <p style="color:#ffff;font-size:1.5vw; margin:0;line-height: normal">
                    LELANG
                </p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 90%">
                <div class="container-fluid" style="height: 100%">
                    @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan
                    === '07' || auth()->user()->jabatan === '09' || auth()->user()->jabatan === '11')
                    <div class="row" style="height: 8%">
                        <div class="col-sm-6"
                            style="border-bottom: 1px solid #000000; border-right: 1px solid #000000 ;padding-bottom:5px">
                            @if ($PNBPLLG)
                            <div class="row">
                                <form action="/capaianPnbp" method="POST">
                                    @csrf
                                    <div class="row">
                                        <input type="text" name="pnbp_id" value="{{ $PNBPLLG->id }}" hidden>
                                        <label for="" class="col-sm-2 col-form-label">Bulan</label>
                                        <div class="col-sm-3">
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
                                        <label for="" class="col-sm-2 col-form-label">Capaian</label>
                                        <div class="col-sm-3">
                                            <input name="capaian" type="number" class="form-control">
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="bi bi-check2-square"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endif
                        </div>
                        <div class="col-sm-6"
                            style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; padding-bottom:5px">
                            @if ($PNBPLLG)
                            <form action="/pnbp/{{ $PNBPLLG->id }}" method="POST">
                                @method('PATCH')
                                @csrf
                                <div class="row">
                                    <label for="" class="col-sm-3 col-form-label">Target PNBP</label>
                                    <div class="col-sm-4">
                                        <input name='target' type="number" class="form-control"
                                            value="{{ $PNBPLLG->target }}">
                                    </div>
                                    <div class="col"></div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="bi bi-check2-square"></i></button>
                                    </div>
                                </div>
                            </form>
                            @else
                            <form action="/pnbp" method="POST">
                                @csrf
                                <div class="row">
                                    <label for="" class="col-sm-3 col-form-label">Target PNBP</label>
                                    <div class="col-sm-4">
                                        <input name='target' type="number" class="form-control">
                                        <input name='jenis' type="text" class="form-control" hidden value="LLG">
                                    </div>
                                    <div class="col"></div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="bi bi-check2-square"></i></button>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                    @endif
                    <div class="row" style="height: 92%;">
                        <div class="col-sm-6"
                            style="border-bottom: 1px solid #000000; border-right: 1px solid #000000 ;padding-bottom:5px; padding: 12px; height:100%">
                            @foreach ($capaianLLG as $item)
                            <div class="row">
                                <label for="" class="col-sm-4 col-form-label">
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
                                </label>
                                <div class="col-sm-6">
                                    <div class="form-control" style="background-color: #4d4c52; text-align: right; color:white">
                                        {{ number_format($item->capaian, 2, ',', '.') }}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' ||
                                    auth()->user()->jabatan === '07' || auth()->user()->jabatan === '09' ||
                                    auth()->user()->jabatan === '11')
                                    <form action="capaianPnbp/{{ $item->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" style="color:red"><i
                                                class="bi bi-x-square"></i></button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-sm-6"
                            style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; padding-bottom:5px; padding: 12px; height:100%">
                            <div class="row" style="height: 50%; padding: 12px">
                                <div class="chart-container" style="height: 100%;max-height: 100%;">
                                    <canvas id="linechartPNBPLLG"></canvas>
                                </div>
                            </div>
                            <div class="row" style="height: 50%; padding: 12px">
                                <div class="chart-container" style="height: 100%;max-height: 100%;">
                                    <canvas id="barchartPNBPLLG"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-header"
                style="background: linear-gradient(270.44deg, #4D59CA 0%, #696486 66.03%, #585881 100%); border-radius: 0 0 20px 20px; height:5%; border:none">

            </div>
        </div>
    </div>
</div>
{{-- Akhir Modals Input PNBP LLG --}}

{{-- Modals Input PNBP PPN --}}
<div style="height: 100vh" class="modal fade bd-example-modal-xl" id="PNBPPPN" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div style="height: 90%" class="modal-dialog modal-xl">
        <div class="modal-content " style="border-radius: 30px 30px 30px 30px; border:none; height:100%">
            <div class="modal-header"
                style="background: linear-gradient(270.44deg, #4D59CA 0%, #696486 66.03%, #585881 100%); border-radius: 20px 20px 0 0; height:5%">
                <p style="color:#ffff;font-size:1.5vw; margin:0;line-height: normal">
                    PENGURUSAN PIUTANG NEGARA
                </p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 90%">
                <div class="container-fluid" style="height: 100%">
                    @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '04' || auth()->user()->jabatan
                    === '05' || auth()->user()->jabatan === '13' || auth()->user()->jabatan === '14')
                    <div class="row" style="height: 8%">
                        <div class="col-sm-6"
                            style="border-bottom: 1px solid #000000; border-right: 1px solid #000000 ;padding-bottom:5px">
                            @if ($PNBPPPN)
                            <div class="row">
                                <form action="/capaianPnbp" method="POST">
                                    @csrf
                                    <div class="row">
                                        <input type="text" name="pnbp_id" value="{{ $PNBPPPN->id }}" hidden>
                                        <label for="" class="col-sm-2 col-form-label">Bulan</label>
                                        <div class="col-sm-3">
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
                                        <label for="" class="col-sm-2 col-form-label">Capaian</label>
                                        <div class="col-sm-3">
                                            <input name="capaian" type="number" class="form-control">
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="bi bi-check2-square"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endif
                        </div>
                        <div class="col-sm-6"
                            style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; padding-bottom:5px">
                            @if ($PNBPPPN)
                            <form action="/pnbp/{{ $PNBPPPN->id }}" method="POST">
                                @method('PATCH')
                                @csrf
                                <div class="row">
                                    <label for="" class="col-sm-3 col-form-label">Target PNBP</label>
                                    <div class="col-sm-4">
                                        <input name='target' type="number" class="form-control"
                                            value="{{ $PNBPPPN->target }}">
                                    </div>
                                    <div class="col"></div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="bi bi-check2-square"></i></button>
                                    </div>
                                </div>
                            </form>
                            @else
                            <form action="/pnbp" method="POST">
                                @csrf
                                <div class="row">
                                    <label for="" class="col-sm-3 col-form-label">Target PNBP</label>
                                    <div class="col-sm-4">
                                        <input name='target' type="number" class="form-control">
                                        <input name='jenis' type="text" class="form-control" hidden value="PPN">
                                    </div>
                                    <div class="col"></div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="bi bi-check2-square"></i></button>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                    @endif
                    <div class="row" style="height: 92%;">
                        <div class="col-sm-6"
                            style="border-bottom: 1px solid #000000; border-right: 1px solid #000000 ;padding-bottom:5px; padding: 12px; height:100%">
                            @foreach ($capaianPPN as $item)
                            <div class="row">
                                <label for="" class="col-sm-4 col-form-label">
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
                                </label>
                                <div class="col-sm-6">
                                    <div class="form-control" style="background-color: #4d4c52; text-align: right; color:white">
                                        {{ number_format($item->capaian, 2, ',', '.') }}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '04' ||
                                    auth()->user()->jabatan === '05' || auth()->user()->jabatan === '13' ||
                                    auth()->user()->jabatan === '14')
                                    <form action="capaianPnbp/{{ $item->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" style="color:red"><i
                                                class="bi bi-x-square"></i></button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-sm-6"
                            style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; padding-bottom:5px; padding: 12px; height:100%">
                            <div class="row" style="height: 50%; padding: 12px">
                                <div class="chart-container" style="height: 100%;max-height: 100%;">
                                    <canvas id="linechartPNBPPPN"></canvas>
                                </div>
                            </div>
                            <div class="row" style="height: 50%; padding: 12px">
                                <div class="chart-container" style="height: 100%;max-height: 100%;">
                                    <canvas id="barchartPNBPPPN"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-header"
                style="background: linear-gradient(270.44deg, #4D59CA 0%, #696486 66.03%, #585881 100%); border-radius: 0 0 20px 20px; height:5%; border:none">

            </div>
        </div>
    </div>
</div>
{{-- Akhir Modals Input PNBP PPN --}}

{{-- Modals Update Agenda --}}
<div class="modal fade" id="updateAgendaModals" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 30px 30px 20px 20px; border:none">
            <div class="modal-header"
                style="background: linear-gradient(270.44deg, #4D59CA 0%, #696486 66.03%, #585881 100%); border-radius: 20px 20px 0 0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form id="formUpdateAgenda" action="/agenda/" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <label for="agenda" class="col-sm-4 col-form-label">Nama Agenda <p class="d-inline" style="color: red">*</p></label>
                            <div class="col-sm-8">
                                <input id="updateAgenda" name="agenda" class="form-control" type="text" value="{{ old('agenda') }}" required>
                                @error('agenda')
                                    <div class="text-danger mt-1">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <label for="tanggal" class="col-sm-4 col-form-label">Tanggal <p class="d-inline" style="color: red">*</p></label>
                            <div class="col-sm-8">
                                <input id="updateTanggal" name="tanggal" type="date" class="form-control" value="{{ old('tanggal') }}" required>
                                @error('tanggal')
                                    <div class="text-danger mt-1">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <label for="waktu" class="col-sm-4 col-form-label">Jam <p class="d-inline" style="color: red">*</p></label>
                            <div class="col-sm-8">
                                <input id="updateWaktu" name="waktu" type="time" class="form-control" value="{{ old('waktu') }}" required>
                                @error('tanggal')
                                    <div class="text-danger mt-1">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <label for="tempat" class="col-sm-4 col-form-label">Tempat <p class="d-inline" style="color: red">*</p></label>
                            <div class="col-sm-8">
                                <input id="updateTempat" name="tempat" class="form-control" type="text" value="{{ old('tempat') }}" required>
                                @error('tempat')
                                    <div class="text-danger mt-1">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <label for="meetingId" class="col-sm-4 col-form-label">Meeting Id</label>
                            <div class="col-sm-8">
                                <input id="updateMeetingId" name="meetingId" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <label for="meetingPassword" class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <input id="updateMeetingPassword" name="meetingPassword" class="form-control" type="text">

                            </div>
                        </div>
                        <div class="row">
                            <label for="linkRapat" class="col-sm-4 col-form-label">Link Rapat</label>
                            <div class="col-sm-8">
                                <input id="updateLinkRapat" name="linkRapat" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <label for="linkAbsensi" class="col-sm-4 col-form-label">Link Absensi</label>
                            <div class="col-sm-8">
                                <input id="updateLinkAbsensi" name="linkAbsensi" class="form-control" type="text">
                            </div>
                        </div>
                        <div style="margin-top:10px">
                            <div style="width: fit-content;margin: auto">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Akhir Modals Update Agenda --}}

{{-- Modals Potensi Lelang --}}
<div style="height: 100vh" class="modal fade bd-example-modal-xl" id="potensiLelang" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div style="height: 90%" class="modal-dialog modal-xl">
        <div class="modal-content " style="border-radius: 30px 30px 30px 30px; border:none; height:100%">
            <div class="modal-header"
                style="background: linear-gradient(270.44deg, #4D59CA 0%, #696486 66.03%, #585881 100%); border-radius: 20px 20px 0 0; height:5%">
                <p style="color:#ffff;font-size:1.5vw; margin:0;line-height: normal">
                    Potensi Lelang
                </p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 90%">
                <div style="height: 100%; display:flex; flex-direction: column; overflow-x:hidden; font-family:'TW CENT MT'">
                    <div class="row sticky-top" style="border: 1px solid; background-color:white">
                        <div style="width: 30%; align-self: center">Nomor Surat Persetujuan</div>
                        <div style="width: 30%; align-self: center">Satuan Kerja</div>
                        <div style="width: 40%; display:flex; flex-direction: column; align-self: center">
                            <div style="display: flex">
                                <div style="margin:1px; width:35%">Nama Barang</div>
                                <div style="margin:1px; width:35%">Merk/Type</div>
                                <div style="margin:1px; width:30%">Nilai Limit</div>
                            </div>
                        </div>
                    </div>
                    @foreach ($persetujuan as $item)
                    <div class="row" style="border-bottom: 1px solid ;margin-bottom: 5px">
                        <div style="width: 30%; align-self: center">{{ $item->nomorSurat }}</div>
                        <div style="width: 30%; align-self: center">{{ $item->penyampaianLaporan->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker }}</div>
                        <div style="width: 40%; display:flex; flex-direction: column; align-self: center">
                            @foreach ($item->penyampaianLaporan->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->barang as $barang)
                                @if ($barang->status != 2)
                                <div style="display: flex; border-bottom: 1px solid; margin-bottom:2px">
                                    <div style="margin:1px; width:35%; align-self: center">{{ $barang->kodeBarangs->namaBarang }}</div>
                                    <div style="margin:1px; width:35%; align-self: center">{{ $barang->merkType }}</div>
                                    <div style="margin:1px; width:30%; align-self: center"> Rp{{ number_format($barang->nilaiLimit, 2, ',', '.') }} </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-header"
                style="background: linear-gradient(270.44deg, #4D59CA 0%, #696486 66.03%, #585881 100%); border-radius: 0 0 20px 20px; height:5%; border:none">

            </div>
        </div>
    </div>
</div>
{{-- Akhir Modals Potensi Lelang --}}






@endsection

@section('foot')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/js/chart.js"></script>
<script src="/js/dashboard/agenda.js" type="text/javascript"></script>
<script src="/js/dashboard/pnbp.js" type="text/javascript"></script>
<script type="text/javascript">
    window.onload = function() {
            praktis('{{ session()->get('tahun') }}');
        };


        $('#CKO').change(function(){
            var val=$(this).val()
            var data =[{{ session()->get('tahun') }}, val];
            praktisTW(data);
            
        })
</script>
@error('agenda')
<script>
    var inputAgenda = new bootstrap.Modal(document.getElementById('inputAgenda'), {
        keyboard: false
    });
    inputAgenda.show()
</script>

@enderror
@endsection