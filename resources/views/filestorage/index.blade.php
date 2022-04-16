@extends('layout.main')

@section('content')
<div class="container-fluid" style="padding: 30px 37px 9px 37px; height:100%">
    <div class="container-fluid" style="border-radius: 10px; background-color:darkgrey; height:100%">
        <div class="row" style="padding-bottom: 10px; height:38px">
            <div class="col-sm-1">
                <a href="/filestorage">
                    <button class="btn translate-middle-y" style="@if (isset($fileStorage)) background-color: rgb(13, 110, 253); color:white @else background-color: white @endif"><i class="bi bi-house-fill"></i></button>
                </a>
            </div>
            <div class="col-sm-2" >
                <a href="/filestorage/keputusan">
                    <button class="btn translate-middle-y" style="width: 100%; @if (isset($keputusan)) background-color: rgb(13, 110, 253); color:white @else background-color: white @endif">Keputusan</button>
                </a>
            </div>
        </div>
        <div id="contentBox" class="row" style="padding: 0; border-radius:0 0 10px 10px; overflow:hidden">
            <div class="container-fluid" style="height: 100%;">
                <div class="row" style="height: 100%; background-color:aliceblue; border-radius:10px">
                    
                </div>
            </div>
        </div>
    </div>
</div>
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
@endsection