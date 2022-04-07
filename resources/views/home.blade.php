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
                    <div style="background-color: #ffff; border-radius: 10px; height:100%">
                        <div style="height: 10%; text-align: center">
                            <h2 class="kepuasan" style="color: #855CF8;">Kepuasan Pengguna Layanan</h2>
                        </div>
                        <div style="height:80%">
                            <div class="chart-container" style="height: 100%">
                                <canvas id="kepuasanPelanggan"></canvas>
                            </div>
                        </div>
                        <div class="row" style="width: 100%; margin:0; height:10%; padding:0 5px">
                            <select id="kepuasanTusi" class="form-control" style="height: 90%; font-size:0.8vw; padding-top:0; padding-bottom:0">
                                <option style="text-align: center; padding:0" value="ALL">Kantor Pelayanan Kekayaan Negara
                                    dan Lelang Ternate</option>
                                <option style="text-align: center; padding:0" value="PKN">Pengelolaan Kekayaan Negara
                                </option>
                                <option style="text-align: center; padding:0" value="PEN">Pelayanan Penilaian</option>
                                <option style="text-align: center; padding:0" value="LLG">Pelayanan Lelang</option>
                                <option style="text-align: center; padding:0" value="PPN">Pengurusan Piutang Negara</option>
                                <option style="text-align: center; padding:0" value="LLN">Lain-lain</option>
                            </select>
                        </div>
                    </div>
                </div>
                {{-- Akhir Kepuasan Pengguna Layanan --}}
                {{-- Capaian Kinerja Organisasi --}}
                <div class="col-sm-8" style="padding-left:5px; max-height: 100%; height: 100%">
                    <div style="background-color: #ffff; border-radius: 10px; height: 100%">
                        <div style="height: 10%; text-align: center">
                            <h2 class="NKO" style="color: #855CF8;" class="d-inline">
                                Capaian Kinerja KPKNL Ternate Tahun {{ session()->get('tahun') }}
                            </h2>                        
                        </div>
                        <div style="height: 10%; text-align: center">
                            <select id="CKO" class="form-select">
                                <option value="Q1">Q1</option>
                                <option value="Q2">Q2</option>
                                <option value="Q3">Q3</option>
                                <option value="Q4" selected>Q4</option>
                            </select>   
                        </div>
                        <div class="scrollable"
                            style="height: 80%; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                            <div class="chart-container" style="max-height: 400%;">
                                <canvas id="capaianKinerja"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Akhir Capaian Kinerja Organisasi --}}
            </div>
            {{-- AKhir Kepuasan Pengguna Layanan dan Capaian Kinerja Organisasi --}}
            {{-- PNBP dan Jumlah Pengunjung --}}
            <div class="row" style="max-height: 44%;height: 44%">
                {{-- PNBP --}}
                <div class="col-sm-8" style="padding-right:5px; max-height: 100%; height:100%">
                    <div class="row" style="height: 100%; ; border-radius: 10px; padding:0px; margin:0">
                        <div class="container-fluid">
                            <div style="height: 15%;margin-bottom:px" class="row position-relative">
                                <div class="col-sm-12 position-absolute top-0 start-0"
                                    style="text-align: center;border-radius: 10px 10px 0 0; background-color:#3DA4B8; height:100%; border: 1px solid #ffff">
                                    <h2 class="NKO" style="color:#ffff;">PNBP KPKNL Ternate Tahun 2022</h2>
                                </div>
                            </div>
                            <div class="row" style="height: 85%">
                                <div class="col-sm-4" style="height: 100%; padding:0;cursor: pointer;"
                                    data-bs-toggle="modal" data-bs-target="#PNBPPKN">
                                    <div
                                        style="height: 100%; border: 1px solid #ffff; background-color:#6EE4FA; border-radius: 0px 0 0 20px">
                                        <div style="height: 25%">
                                            <div style="margin:auto; text-align: center">
                                                <p style="color:#ffff;font-size:1.5vw; margin:0;line-height: normal">
                                                    Pengelolaan Kekayaan Negara
                                                </p>
                                            </div>
                                        </div>
                                        <hr style="margin:0 0 10px 0">
                                        <div style="height: 50%; ">
                                            <div style="margin:auto; text-align: center">
                                                <p style="color:#ffff;font-size: 5vw; margin:0;line-height: normal">
                                                    @if ($PNBPPKN)
                                                        @if ($capaianPKN)
                                                            {{ number_format(($capaianPKN->sum('capaian') / $PNBPPKN->target) * 100, 2) }}%
                                                        @else
                                                            0%
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <hr style="margin:0">
                                        <div style="height: 20%;">
                                            <div style="color:#ffff; text-align: center;line-height: normal; height:100%">
                                                <p class="d-inline" style="position: relative; top:25%">
                                                    @if ($capaianPKN)
                                                        Rp{{ number_format($capaianPKN->sum('capaian'), 2, ',', '.') }}
                                                    @else
                                                        Rp0,00
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="height: 100%; padding:0;cursor: pointer; "
                                    data-bs-toggle="modal" data-bs-target="#PNBPLLG">
                                    <div style="height: 100%; border: 1px solid #ffff; background-color:#6EE4FA; ">
                                        <div style="height: 25%">
                                            <div style="margin:auto; text-align: center">
                                                <p style="color:#ffff;font-size:1.5vw; margin:0;line-height: normal">
                                                    Lelang
                                                </p>
                                            </div>
                                        </div>
                                        <hr style="margin:0 0 10px 0">
                                        <div style="height: 50%; ">
                                            <div style="margin:auto; text-align: center">
                                                <p style="color:#ffff;font-size: 5vw; margin:0;line-height: normal">
                                                    @if ($PNBPLLG)
                                                        @if ($capaianLLG)
                                                            {{ number_format(($capaianLLG->sum('capaian') / $PNBPLLG->target) * 100, 2) }}%
                                                        @else
                                                            0%
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <hr style="margin:0">
                                        <div style="height: 20%;">
                                            <div style="color:#ffff; text-align: center;line-height: normal; height:100%">
                                                <p class="d-inline" style="position: relative; top:25%">
                                                    @if ($capaianLLG)
                                                        Rp{{ number_format($capaianLLG->sum('capaian'), 2, ',', '.') }}
                                                    @else
                                                        Rp0,00
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="height: 100%; padding:0;cursor: pointer; "
                                    data-bs-toggle="modal" data-bs-target="#PNBPPPN">
                                    <div
                                        style="height: 100%; border: 1px solid #ffff; background-color:#6EE4FA; border-radius: 0 0px 20px 0">
                                        <div style="height: 25%">
                                            <div style="margin:auto; text-align: center">
                                                <p style="color:#ffff;font-size:1.5vw; margin:0;line-height: normal">
                                                    Pengurusan Piutang Negara
                                                </p>
                                            </div>
                                        </div>
                                        <hr style="margin:0 0 10px 0">
                                        <div style="height: 50%; ">
                                            <div style="margin:auto; text-align: center">
                                                <p style="color:#ffff;font-size: 5vw; margin:0;line-height: normal">
                                                    @if ($PNBPPPN)
                                                        @if ($capaianPPN)
                                                            {{ number_format(($capaianPPN->sum('capaian') / $PNBPPPN->target) * 100, 2) }}%
                                                        @else
                                                            0%
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <hr style="margin:0">
                                        <div style="height: 20%;">
                                            <div style="color:#ffff; text-align: center;line-height: normal; height:100%">
                                                <p class="d-inline" style="position: relative; top:25%">
                                                    @if ($capaianPPN)
                                                        Rp{{ number_format($capaianPPN->sum('capaian'), 2, ',', '.') }}
                                                    @else
                                                        Rp0,00
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                {{-- Akhir PNBP --}}
                {{-- Potensi Lelang BMN --}}
                <div class="col-sm-4" style="; padding-left: 5px; max-height: 100%; height:100%">
                    <div style="height: 100%;  border-radius: 10px">
                        <div style="height: 15%;margin: 0px" class="row position-relative">
                            <div class="col-sm-12 position-absolute top-0 start-0"
                                style="text-align: center;border-radius: 10px 10px 0 0; background-color:#3DA4B8; height:100%; border: 1px solid #ffff">
                                <h2 class="NKO" style="color:#ffff;">Potensi Lelang</h2>
                            </div>
                        </div>
                        <div style="height: 85%;margin: 0px;" class="row position-relative">
                            <div class="col-sm-12 position-absolute top-0 start-0"
                                style="text-align: center;border-radius: 0 0 10px 10px ; background-color: #6EE4FA;; height:100%; border: 1px solid #ffff">
                                <div style="height: 25%">
                                    <div style="margin:auto; text-align: center">
                                        <p style="color:#ffff;font-size:1.5vw; margin:0;line-height: normal">
                                            Surat Persetujuan
                                        </p>
                                    </div>
                                </div>
                                <hr style="margin:0">
                                <div style="height: 45%; ">
                                    <div style="width:100%; text-align: center">
                                        <p style="color:#ffff;font-size: 5vw; margin:0;line-height: normal">
                                            {{ count($persetujuan) }}
                                        </p>
                                    </div>
                                </div>
                                <hr style="margin:0">
                                <div style="height: 15%">
                                    <div style="margin:auto; text-align: center">
                                        <p style="color:#ffff;font-size:1.5vw; margin:0;line-height: normal">
                                            Nilai Limit
                                        </p>
                                    </div>
                                </div>
                                <hr style="margin:0">
                                <div style="height: 15%; ">
                                    <div style="margin:auto; text-align: center">
                                        <p style="color:#ffff;font-size: 1vw; margin:0;line-height: normal">
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
            <div class="scrollable"
                style="height: 93%; background-color: #ffffff4f; border-radius: 10px; padding: 0px 0 0 0px; max-height: fit-content; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                <nav class="navbar navbar-light bg-light sticky-top" style="margin: 0; border-radius: 10px;">
                    <div class="container-fluid">
                        <input class="form-control" id="tanggalagenda" type="date">
                    </div>
                </nav>
                <div class="container-fluid" style="padding: 5px 20px 0 20px" id='agenda'>
                </div>
            </div>
            <nav class="navbar navbar-light bg-light sticky-bottom" style="margin: 0; border-radius: 10px; min-height:fit-content; max-height:fit-content">
                <div class="container-fluid" style="min-height: 100%;max-height:fit-content">
                    <button class="btn btn-primary container-fluid" data-bs-toggle="modal" data-bs-target="#inputAgenda"
                        style="height: 100%; padding: 1px">Tambah Agenda</button>
                </div>
            </nav>
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
                                <label for="agenda" class="col-sm-4 col-form-label">Nama Agenda</label>
                                <div class="col-sm-8">
                                    <input name="agenda" class="form-control" type="text" required>
                                </div>
                            </div>
                            <div class="row">
                                <label for="tanggal" class="col-sm-4 col-form-label">Tanggal</label>
                                <div class="col-sm-8">
                                    <input name="tanggal" type="date" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <label for="waktu" class="col-sm-4 col-form-label">Jam</label>
                                <div class="col-sm-8">
                                    <input name="waktu" type="time" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <label for="tempat" class="col-sm-4 col-form-label">Tempat</label>
                                <div class="col-sm-8">
                                    <input name="tempat" class="form-control" type="text" required>
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
                        @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '03' || auth()->user()->jabatan === '12')
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
                                                    <input name='jenis' type="text" class="form-control" hidden
                                                        value="PKN">
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
                                            <div class="form-control"
                                                style="background-color: #4d4c52; text-align: right">
                                                {{ number_format($item->capaian, 2, ',', '.') }}
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '03' || auth()->user()->jabatan === '12')
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
                        @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan === '07' || auth()->user()->jabatan === '09' || auth()->user()->jabatan === '11')
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
                                                    <input name='jenis' type="text" class="form-control" hidden
                                                        value="LLG">
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
                                            <div class="form-control"
                                                style="background-color: #4d4c52; text-align: right">
                                                {{ number_format($item->capaian, 2, ',', '.') }}
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan === '07' || auth()->user()->jabatan === '09' || auth()->user()->jabatan === '11')
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
                        @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '04' || auth()->user()->jabatan === '05' || auth()->user()->jabatan === '13' || auth()->user()->jabatan === '14')
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
                                                    <input name='jenis' type="text" class="form-control" hidden
                                                        value="PPN">
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
                                            <div class="form-control"
                                                style="background-color: #4d4c52; text-align: right">
                                                {{ number_format($item->capaian, 2, ',', '.') }}
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '04' || auth()->user()->jabatan === '05' || auth()->user()->jabatan === '13' || auth()->user()->jabatan === '14')
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

@endsection

@section('foot')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
@endsection
