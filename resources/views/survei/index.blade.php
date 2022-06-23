@extends('layout.main')

@section('head')
    
@endsection

@section('content')
<div class="container-fluid" style="padding: 9px 37px 9px 37px; height:100%">
    <div id="surveiMainContent" class="container-fluid" style="border-radius: 10px; background-color:darkgrey; height:100%; padding:0; box-sizing: border-box">
        <form action="">
            <div id="mainHeader" class="d-flex flex-row-reverse" style="border-bottom: 1px solid white; box-sizing: border-box; height: 60px">
                <div class="p-2"><button type="submit" class="btn btn-primary">Filter</button></div>
                <div class="p-2"><input required name="end" type="date" class="form-control"></div>
                <div class="p-2"><h4 style="color: white">s.d.</h4></div>
                <div class="p-2"><input required name="start" type="date" class="form-control"></div>
                <div style="display:clear"></div>
            </div>
        </form>
        <div class="position-relative" id="contentBox" style="background-color: white; border-radius: 0 0 10px 10px">
            <div class="scrollable" style="padding: 25px 0 60px 0; width:100%; min-height:fit-content; max-height:100%; ; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                @php
                    $i=1;
                @endphp
                @foreach ($data as $item)
                <div style="width: 100%; text-align:center; margin:0 ; padding:0; " class="row" >
                    <div class="position-relative" style="width: 5%; min-height:fit-content">
                        <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">
                            {{ $i }}
                        </p> 
                    </div>
                    <div class="position-relative" style="width: 20%; min-height:fit-content">
                        <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">
                            {{ indonesiaDate($item->created_at) }}
                        </p> 
                    </div>
                    <div class="position-relative" style="width: 25%; min-height:fit-content">
                        <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">
                            @switch($item->layanan)
                                @case('PKN')
                                    Pengelolaan Kekayaan Negara
                                    @break
                                @case('LLG')
                                    Lelang
                                    @break
                                @case('PEN')
                                    Penilaian
                                    @break
                                @case('LLN')
                                    Lain-Lain
                                    @break
                            @endswitch
                        </p> 
                    </div>
                    <div class="position-relative" style="width: 10%; min-height:fit-content">
                        <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">
                            {{ $item->tangibles }}
                        </p> 
                    </div>
                    <div class="position-relative" style="width: 10%; min-height:fit-content">
                        <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">
                            {{ $item->reliability }}
                        </p> 
                    </div>
                    <div class="position-relative" style="width: 10%; min-height:fit-content">
                        <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">
                            {{ $item->responsiveness }}
                        </p> 
                    </div>
                    <div class="position-relative" style="width: 10%; min-height:fit-content">
                        <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">
                            {{ $item->assurance }}
                        </p> 
                    </div>
                    <div class="position-relative" style="width: 10%; min-height:fit-content">
                        <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">
                            {{ $item->empathy }}
                        </p> 
                    </div>
                </div>
                @php
                    $i++;
                @endphp
                @endforeach

                <div class="position-absolute top-0 start-50 translate-middle-x" style="width: 100%; height:25px; border-bottom:solid 1px; background-color:#495C4F; color:white; box-sizing: border-box">
                    <div style="width: 100%; text-align:center; margin:0;; box-sizing: border-box" class="row" >
                        <div style="width: 5%; height:fit-content; ">No</div>
                        <div style="width: 20%; height:fit-content">Tanggal</div>
                        <div style="width: 25%; height:fit-content">Jenis  Layanan</div>
                        <div style="width: 10%; height:fit-content">tangibles</div>
                        <div style="width: 10%; height:fit-content">Reliability</div>
                        <div style="width: 10%; height:fit-content">Responsiveness</div>
                        <div style="width: 10%; height:fit-content">Assurance</div>
                        <div style="width: 10%; height:fit-content">Empathy</div>
                    </div>
                </div>

                <div class="position-absolute bottom-0 start-50 translate-middle-x" style="width: 100%; height:60px; background-color:#495C4F; border-radius: 0 0 10px 10px">
                    <div class="position-relative" style="height: 100%; width:100%">
                        <div class="position-absolute top-50 start-50 translate-middle" style="height: fit-content; width:fit-content">
                            {{ $data->links() }}
                        </div>
                        <div class="position-absolute top-50 end-0 translate-middle-y" style="margin: 0 10px; width:fit-content">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('modals')
    
    
@endsection

@section('foot')
    <script>
        var newSuratKeputusanHeight = $('#surveiMainContent').height()
        console.log(newSuratKeputusanHeight)
        var newHeight = window.innerHeight-(window.innerHeight*0.05)-(window.innerHeight*0.005)-9-60-9-(window.innerHeight*0.005)-(window.innerHeight*0.05)
        $('#contentBox').css('height', newHeight)

        window.addEventListener('resize', function(event){
            var newHeight = window.innerHeight-(window.innerHeight*0.05)-(window.innerHeight*0.005)-9-60-9-(window.innerHeight*0.005)-(window.innerHeight*0.05)
            $("#contentBox").css('height', newHeight)    
        });
    </script>
@endsection