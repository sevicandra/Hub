@extends('layout.main')
@section('content')
<div class="container-fluid" style="padding: 30px 37px 0px 37px; height:100%">
    <div class="container-fluid" style="border-radius: 10px; background-color:aliceblue; height:100%">
        <div class="row" style="padding-bottom: 10px">
            <div class="col-sm-1">
                <a href="pindai">
                    <button class="btn btn-primary translate-middle-y"><i class="bi bi-house-fill"></i></button>
                </a>
            </div>
            @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '03' || auth()->user()->jabatan ===
            '12')
            <div class="col-sm-2">
                <a href="/permohonan">
                    @if (isset($permohonanview))
                    <button class="btn translate-middle-y" style="width: 100%; background-color:  #4d59ca">Surat
                        Permohonan</button>
                    @else
                    <button class="btn translate-middle-y" style="width: 100%; background-color:  #ffffff">Surat
                        Permohonan</button>
                    @endif
                </a>
            </div>
            @endif
            @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan ===
            '09' || auth()->user()->jabatan === '10' || auth()->user()->jabatan === '11')
            <div class="col-sm-2">
                <a href="/penilaian">
                    @if (isset($penilaianview))
                    <button class="btn translate-middle-y"
                        style="width: 100%; background-color:#4d59ca">Penilaian</button>
                    @else
                    <button class="btn translate-middle-y"
                        style="width: 100%; background-color:#ffffff">Penilaian</button>
                    @endif
                </a>
            </div>
            @endif
            @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '03' || auth()->user()->jabatan ===
            '12')
            <div class="col-sm-2">
                <a href="/persetujuan">
                    @if (isset($persetujuanview))
                    <button class="btn translate-middle-y" style="width: 100%; background-color:#4d59ca">Surat
                        Persetujuan</button>
                    @else
                    <button class="btn translate-middle-y" style="width: 100%; background-color:#ffffff">Surat
                        Persetujuan</button>
                    @endif
                </a>
            </div>
            @endif
            @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan ===
            '07' || auth()->user()->jabatan === '08' || auth()->user()->jabatan === '11')
            <div class="col-sm-2">
                <a href="/potensi_lelang">
                    @if (isset($potensiLelangview))
                    <button class="btn translate-middle-y" style="width: 100%; background-color:#4d59ca">Potensi
                        Lelang</button>
                    @else
                    <button class="btn translate-middle-y" style="width: 100%; background-color:#ffffff">Potensi
                        Lelang</button>
                    @endif

                </a>
            </div>
            @endif
            @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan ===
            '07' || auth()->user()->jabatan === '08' || auth()->user()->jabatan === '11')
            <div class="col-sm-2">
                <a href="/penetapan_lelang">
                    @if (isset($penetapanLelangview))
                    <button class="btn translate-middle-y" style="width: 100%; background-color:#4d59ca">Penetapan
                        Lelang</button>
                    @else
                    <button class="btn translate-middle-y" style="width: 100%; background-color:#ffffff">Penetapan
                        Lelang</button>
                    @endif
                </a>
            </div>
            @endif
        </div>
        @yield('contentpindai')
    </div>
</div>
@section('modalpindai')

@show
@endsection