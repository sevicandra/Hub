@extends('layout.main')

@section('head')
    
    @section('headdigital-knowledge-management')
        
    @show
@endsection


@section('content')
<div class="container-fluid" style="padding: 30px 37px 9px 37px; height:100%">
    <div class="container-fluid" style="border-radius: 10px; background-color:darkgrey; height:100%">
        <div class="row" style="padding-bottom: 10px; height:38px">
            <div class="col-sm-1">
                <a href="/digital-knowledge-management">
                    <button class="btn translate-middle-y" style="@if (isset($fileStorage)) background-color: rgb(13, 110, 253); color:white @else background-color: white @endif"><i class="bi bi-house-fill"></i></button>
                </a>
            </div>
            <div class="col-sm-11 translate-middle-y"style="overflow-x:auto ">
                <div class="row" style="width: 1000px">
                    <div style="min-width: 195px; max-width:fit-content" >
                        <a href="/digital-knowledge-management/keputusan">
                            <button class="btn" style="min-width: 195px; @if (isset($keputusan)) background-color: rgb(13, 110, 253); color:white @else background-color: white @endif">Keputusan</button>
                        </a>
                    </div>
                    <div style="min-width: 195px; max-width:fit-content" >
                        <a href="/digital-knowledge-management/presentasi">
                            <button class="btn" style="min-width: 195px; @if (isset($presentasi)) background-color: rgb(13, 110, 253); color:white @else background-color: white @endif">Presentasi</button>
                        </a>
                    </div>
                    {{-- <div style="min-width: 195px; max-width:fit-content" >
                        <a href="/digital-knowledge-management/laporan-pelaksanaan-tugas">
                            <button class="btn" style="min-width: 195px; @if (isset($laporanpelaksanaantugas)) background-color: rgb(13, 110, 253); color:white @else background-color: white @endif">Laporan Pelaskanaan Tugas</button>
                        </a>
                    </div> --}}
                    <div style="min-width: 195px; max-width:fit-content" >
                        <a href="/digital-knowledge-management/notula">
                            <button class="btn" style="min-width: 195px; @if (isset($notula)) background-color: rgb(13, 110, 253); color:white @else background-color: white @endif">Notula</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="contentBox" class="row" style="padding: 0; border-radius:0 0 10px 10px; overflow:hidden">
            <div class="container-fluid" style="height: 100%;">
                <div class="row" style="height: 100%; background-color:#f0f8ff; border-radius:10px">
                   @yield('contentdigital-knowledge-management') 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
    @section('modalsdigital-knowledge-management')
        
    @show
    
@endsection



@section('foot')
    <script>
        $(window).on('load', function(){
            var newHeight = (window.innerHeight*0.89-77); 
            $("#contentBox").css('height', newHeight)
        });
        window.addEventListener('resize', function(event){
            var newHeight = (window.innerHeight*0.89-77);
            $(window).resize(function() {
                $("#contentBox").css('height', newHeight)
            });
        });
    </script>
    @section('footdigital-knowledge-management')
        
    @show
@endsection