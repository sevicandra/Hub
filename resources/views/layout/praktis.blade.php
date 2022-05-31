@extends('layout.main')
@section('head')
    @section('headpraktis')
        
    @show
@endsection


@section('content')
<div class="container-fluid" style="padding: 30px 37px 9px 37px; height:100%">
    <div class="container-fluid" style="border-radius: 10px; background-color:rgba(240, 248, 255, 0.281); height:100%">
        <div class="row" style="padding: 0 10px; height:60px">
            <div class="col-sm-1">
                <a href="{{$back}}">
                    <button class="btn btn-primary translate-middle-y"><i class="bi bi-caret-left-fill"></i></button>
                </a>
            </div>
            @if (!isset($monitoring))
                <div style="width:fit-content">
                    <a href="praktis">
                        <button class="btn translate-middle-y" style="width: 100%; background-color:  @if (isset($home)) #4D59CA @else #ffffff @endif">Idikator Kinerja Utama</button>
                    </a>
                </div>
                @if (auth()->user()->jabatan === '01'||auth()->user()->jabatan === '02'||auth()->user()->jabatan === '03'||auth()->user()->jabatan === '04'||auth()->user()->jabatan === '05'||auth()->user()->jabatan === '06')
                <div style="width:fit-content" >
                    <a href="/monitoring-bawahan" >
                        <button class="btn translate-middle-y" style="width: 100%; background-color:@if (isset($monitoringBawahan)) #4D59CA @else #ffffff @endif">Monitoring Bawahan</button>
                    </a>
                </div>
                @endif
                @if (auth()->user()->jabatan === '01'||auth()->user()->jabatan === '06'||auth()->user()->jabatan === '15')
                <div style="width:fit-content" >
                    <a href="/monitoring" >
                        <button class="btn translate-middle-y" style="width: 100%; background-color:@if (isset($monitoringMKO)) #4D59CA @else #ffffff @endif">Monitoring Capaian Kinerja</button>
                    </a>
                </div>
                @endif
                @if (auth()->user()->jabatan === '01'||auth()->user()->jabatan === '06'||auth()->user()->jabatan === '15')
                <div style="width:fit-content" >
                    <a href="/kinerjaorganisasi" >
                        <button class="btn translate-middle-y" style="width: 100%; background-color:@if (isset($kinerjaOrganisasi)) #4D59CA @else #ffffff @endif">Kinerja Organisasi</button>
                    </a>
                </div>
                @endif
                <div class="col"></div>
                @if (isset($user))
                    @if ($user === auth()->user()->id)
                    <div class="col-sm-2" style="margin:auto">
                        <button class="btn" style="background: #4D59CA; border-radius: 10px; width:100%" data-bs-toggle="modal" data-bs-target="#inputIKU">Tambah IKU</button>
                    </div>
                    @endif
                @else
                    <div class="col-sm-2" style="margin:auto">
                        <button class="btn" style="background: #4D59CA; border-radius: 10px; width:100%" data-bs-toggle="modal" data-bs-target="#inputIKU">Tambah IKU</button>
                    </div>
                @endif
            @else
            <div style="width:fit-content" >
                    <div class="btn translate-middle-y" style="width: 100%; background-color:#4D59CA; color:white">{{ $user->nama }}</div>
            </div>
            @endif
        </div>
        @yield('contentpraktis')
    </div>
</div>
@section('modalpraktis')

@show
@endsection

@section('foot')

    @section('footpraktis')
        
    @show

@endsection