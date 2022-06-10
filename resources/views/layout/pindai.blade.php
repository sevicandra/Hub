@extends('layout.main')
@section('head')
    @section('headpindai')
        
    @show
@endsection


@section('content')
<div class="container-fluid" style="padding: 30px 37px 0px 37px; height:100%">
    <div class="container-fluid" style="border-radius: 10px; background-color:aliceblue; height:100%">
        <div class="row" style="padding-bottom: 10px;overflow-y:visible">
            <div style="width: 100px">
                @if (isset($tiket))
                <a style="text-decoration: none" href="pindai">
                    <button class="btn translate-middle-y" style="background-color:#4d59ca; color:#ffffff"><i class="bi bi-house-fill"></i></button>
                </a>
                @else
                <a style="text-decoration: none" href="pindai">
                    <button class="btn translate-middle-y" style="background-color: #ffffff; color: #4d59ca"><i class="bi bi-house-fill"></i></button>
                </a>
                @endif
            </div>
            <div id="nav-head" style="overflow-x:auto " class="translate-middle-y">
                <div class="row " style="width:1500px">
                    @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '03' || auth()->user()->jabatan ===
                    '12')
                    <div style="width: 200px;margin-right:10px">
                        <a style="text-decoration: none" href="/permohonan">
                            @if (isset($permohonanview))
                            <button class="btn" style="width: 200px; background-color:  #4d59ca; color:#ffffff">Surat
                                Permohonan</button>
                            @else
                            <button class="btn" style="width: 200px; background-color:  #ffffff; color:#4d59ca">Surat
                                Permohonan</button>
                            @endif
                        </a>
                    </div>
                    @endif
                    @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan ===
                    '09' || auth()->user()->jabatan === '10' || auth()->user()->jabatan === '11')
                    <div style="width: 200px;margin-right:10px">
                        <a style="text-decoration: none" href="/penilaian">
                            @if (isset($penilaianview))
                            <button class="btn"
                                style="width: 200px; background-color:#4d59ca; color:#ffffff">Penilaian</button>
                            @else
                            <button class="btn"
                                style="width: 200px; background-color:#ffffff; color:#4d59ca">Penilaian</button>
                            @endif
                        </a>
                    </div>
                    @endif
                    @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '03' || auth()->user()->jabatan ===
                    '12')
                    <div style="width: 200px;margin-right:10px">
                        <a style="text-decoration: none" href="/persetujuan">
                            @if (isset($persetujuanview))
                            <button class="btn" style="width: 200px; background-color:#4d59ca; color:#ffffff">Surat
                                Persetujuan</button>
                            @else
                            <button class="btn" style="width: 200px; background-color:#ffffff; color:#4d59ca">Surat
                                Persetujuan</button>
                            @endif
                        </a>
                    </div>
                    @endif
                    @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan ===
                    '07' || auth()->user()->jabatan === '08' || auth()->user()->jabatan === '11')
                    <div style="width: 200px;margin-right:10px">
                        <a style="text-decoration: none" href="/potensi_lelang">
                            @if (isset($potensiLelangview))
                            <button class="btn" style="width: 200px; background-color:#4d59ca; color:#ffffff">Potensi
                                Lelang</button>
                            @else
                            <button class="btn" style="width: 200px; background-color:#ffffff; color:#4d59ca">Potensi
                                Lelang</button>
                            @endif
        
                        </a>
                    </div>
                    @endif

                    @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan ===
                    '07' || auth()->user()->jabatan === '08' || auth()->user()->jabatan === '11')
                    <div style="width: 200px;margin-right:10px">
                        <a style="text-decoration: none" href="/permohonanlelang">
                            @if (isset($permohonanLelangview))
                            <button class="btn" style="width: 200px; background-color:#4d59ca; color:#ffffff">Permohonan Lelang</button>
                            @else
                            <button class="btn" style="width: 200px; background-color:#ffffff; color:#4d59ca">Permohonan Lelang</button>
                            @endif
                        </a>
                    </div>
                    @endif

                    @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan ===
                    '07' || auth()->user()->jabatan === '08' || auth()->user()->jabatan === '11')
                    <div style="width: 200px">
                        <a style="text-decoration: none" href="/penetapan_lelang">
                            @if (isset($penetapanLelangview))
                            <button class="btn" style="width: 200px; background-color:#4d59ca; color:#ffffff">Penetapan
                                Lelang</button>
                            @else
                            <button class="btn" style="width: 200px; background-color:#ffffff; color:#4d59ca">Penetapan
                                Lelang</button>
                            @endif
                        </a>
                    </div>
                    @endif
                </div>
            </div>
                <div class="btn translate-middle-y" id="nomorTiket" style="width: 200px; background-color:  #4d59ca; color:#ffffff">
                   <a href="" style="text-decoration: none; color:#ffffff"></a> 
                </div>
        </div>
        @yield('contentpindai')
    </div>
</div>

@section('modalpindai')

@show
@endsection

@section('foot')
<script>
    $(window).on('load', function(){
        var newWidth = window.innerWidth-422; 
        $("#nav-head").css('width', newWidth)
    });
    window.addEventListener('resize', function(event){
        var newWidth = window.innerWidth-422; 
        $(window).resize(function() {
            $("#nav-head").css('width', newWidth)
        });
    });
</script>
<script src="/js/pindai/nomorTiket.js"></script>
    @section('footpindai')
        
    @show

@endsection