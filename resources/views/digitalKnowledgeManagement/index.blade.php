@extends('layout.digital-knowledge-management')

@section('contentdigital-knowledge-management')
    <div class="col card" style="height: 90%; background-color:#C4C4C4; margin: 2.5% 5px; border-radius:10px; overflow:hidden; border:none">
        <div id="suratKeputusanCard" class="row cardHeader" style="text-align: center;  height: fit-content">
            <h4 id="suratKeputusanTitle" class="cardTitle">Surat Keputusan</h4>
        </div>
        <div id="suratKeputusanContent" class="row scrollable" style="background-color: #90A9A6; color:white; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
            <div class="container-fluid">
                <div class="row">
                    <h5 style="text-align: center; height:fit-content">Terakhir Di Tambahkan</h5>
                </div>
                <hr style="margin: 2px">
                <div class="row" style="height: fit-content; padding: 5px 5px">
                    @if ($suratKeputusan->count() === 0)
                        -
                    @else
                        @if ($suratKeputusan->count() >=5)
                            @for ($i = 0; $i < 5; $i++)
                            <h6>
                                {{ $suratKeputusan[$i]->kodeUnit }}
                            </h6>
                            @endfor
                        @elseif($suratKeputusan->count() < 5)
                            @for ($i = 0; $i < $suratKeputusan->count(); $i++)
                            <h6>
                                {{ $suratKeputusan[$i]->kodeUnit }}
                            </h6>
                            @endfor
                        @endif
                    
                    @endif
                </div>
                <hr style="margin: 2px">
                <div class="row">
                    <h5 style="text-align:center; height:fit-content">Jumlah Dokumen</h5>
                </div>
                <hr style="margin: 2px">
                    <h1 style="text-align:center; height:fit-content">{{ $suratKeputusan->count() }}</h1>
                <hr style="margin: 2px">
                <div class="row">
                    <h5 style="text-align:center; height:fit-content">Jumlah Dokumen Ditambahkan Bulan ini</h5>
                </div>
                <hr style="margin: 2px">
                <h1 style="text-align:center; height:fit-content">{{ $suratKeputusanThisMonth->count() }}</h1>
                <hr style="margin: 2px">
                <div class="row">
                    <h5 style="text-align:center; height:fit-content">Jumlah Dokumen Ditambahkan Bulan lalu</h5>
                </div>
                <hr style="margin: 2px">
                <h1 style="text-align:center; height:fit-content">{{ $suratKeputusanLastMonth->count() }}</h1>
            </div>
        </div>
    </div>
    <div class="col card" style="height: 90%; background-color:#C4C4C4; margin: 2.5% 5px; border-radius:10px; overflow:hidden; border:none">
        <div id="presentasiCard" class="row cardHeader" style="text-align: center; height: fit-content">
            <h4 id="presentasiTitle" class="cardTitle">Presentasi</h4>
        </div>
        <div id="presentasiContent" class="row scrollable" style="background-color: #90A9A6; color:white; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
            <div class="container-fluid">
                <div class="row">
                    <h5 style="text-align: center; height:fit-content">Terakhir Di Tambahkan</h5>
                </div>
                <hr style="margin: 2px">
                <div class="row" style="height: fit-content; padding: 5px 5px">
                    @if ($presentasi->count() === 0)
                        -
                    @else
                        @if ($presentasi->count() >=5)
                            @for ($i = 0; $i < 5; $i++)
                            <h6>
                                {{ $presentasi[$i]->kodeUnit }}
                            </h6>
                            @endfor
                        @elseif($presentasi->count() < 5)
                            @for ($i = 0; $i < $presentasi->count(); $i++)
                            <h6>
                                {{ $presentasi[$i]->kodeUnit }}
                            </h6>
                            @endfor
                        @endif
                    
                    @endif
                </div>
                <hr style="margin: 2px">
                <div class="row">
                    <h5 style="text-align:center; height:fit-content">Jumlah Dokumen</h5>
                </div>
                <hr style="margin: 2px">
                    <h1 style="text-align:center; height:fit-content">{{ $presentasi->count() }}</h1>
                <hr style="margin: 2px">
                <div class="row">
                    <h5 style="text-align:center; height:fit-content">Jumlah Dokumen Ditambahkan Bulan ini</h5>
                </div>
                <hr style="margin: 2px">
                <h1 style="text-align:center; height:fit-content">{{ $presentasiThisMonth->count() }}</h1>
                <hr style="margin: 2px">
                <div class="row">
                    <h5 style="text-align:center; height:fit-content">Jumlah Dokumen Ditambahkan Bulan lalu</h5>
                </div>
                <hr style="margin: 2px">
                <h1 style="text-align:center; height:fit-content">{{ $presentasiLastMonth->count() }}</h1>
            </div>
        </div>
    </div>
    <div class="col card" style="height: 90%; background-color:#C4C4C4; margin: 2.5% 5px; border-radius:10px; overflow:hidden; border:none">
        <div id="laporanPelaksanaanTugasCard" class="row cardHeader" style="text-align: center; height: fit-content">
            <h4 id="laporanPelaksanaanTugasTitle" class="cardTitle">Laporan Pelaksanaan Tugas</h4>
        </div>
        <div id="laporanPelaksanaanTugasContent" class="row scrollable" style="background-color: #90A9A6; color:white; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
            <div class="container-fluid">
                <div class="row">
                    <h5 style="text-align: center; height:fit-content">Terakhir Di Tambahkan</h5>
                </div>
                <hr style="margin: 2px">
                <div class="row" style="height: fit-content; padding: 5px 5px">
                    @if ($laporanPelaksanaanTugas->count() === 0)
                        -
                    @else
                        @if ($laporanPelaksanaanTugas->count() >=5)
                            @for ($i = 0; $i < 5; $i++)
                            <h6>
                                {{ $laporanPelaksanaanTugas[$i]->kodeUnit }}
                            </h6>
                            @endfor
                        @elseif($laporanPelaksanaanTugas->count() < 5)
                            @for ($i = 0; $i < $laporanPelaksanaanTugas->count(); $i++)
                            <h6>
                                {{ $laporanPelaksanaanTugas[$i]->kodeUnit }}
                            </h6>
                            @endfor
                        @endif
                    
                    @endif
                </div>
                <hr style="margin: 2px">
                <div class="row">
                    <h5 style="text-align:center; height:fit-content">Jumlah Dokumen</h5>
                </div>
                <hr style="margin: 2px">
                    <h1 style="text-align:center; height:fit-content">{{ $laporanPelaksanaanTugas->count() }}</h1>
                <hr style="margin: 2px">
                <div class="row">
                    <h5 style="text-align:center; height:fit-content">Jumlah Dokumen Ditambahkan Bulan ini</h5>
                </div>
                <hr style="margin: 2px">
                <h1 style="text-align:center; height:fit-content">{{ $laporanPelaksanaanTugasThisMonth->count() }}</h1>
                <hr style="margin: 2px">
                <div class="row">
                    <h5 style="text-align:center; height:fit-content">Jumlah Dokumen Ditambahkan Bulan lalu</h5>
                </div>
                <hr style="margin: 2px">
                <h1 style="text-align:center; height:fit-content">{{ $laporanPelaksanaanTugasLastMonth->count() }}</h1>
            </div>
        </div>
    </div>
    <div class="col card" style="height: 90%; background-color:#C4C4C4; margin: 2.5% 5px; border-radius:10px; overflow:hidden; border:none">
        <div id="notulaCard" class="row cardHeader" style="text-align: center; height: fit-content">
            <h4 id="notulaTitle" class="cardTitle">Notula</h4>
        </div>
        <div id="notulaContent" class="row scrollable" style="background-color: #90A9A6; color:white; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
            <div class="container-fluid">
                <div class="row">
                    <h5 style="text-align: center; height:fit-content">Terakhir Di Tambahkan</h5>
                </div>
                <hr style="margin: 2px">
                <div class="row" style="height: fit-content; padding: 5px 5px">
                    @if ($notula->count() === 0)
                        -
                    @else
                        @if ($notula->count() >=5)
                            @for ($i = 0; $i < 5; $i++)
                            <h6>
                                {{ $notula[$i]->kodeUnit }}
                            </h6>
                            @endfor
                        @elseif($notula->count() < 5)
                            @for ($i = 0; $i < $notula->count(); $i++)
                            <h6>
                                {{ $notula[$i]->kodeUnit }}
                            </h6>
                            @endfor
                        @endif          
                    @endif
                </div>
                <hr style="margin: 2px">
                <div class="row">
                    <h5 style="text-align:center; height:fit-content">Jumlah Dokumen</h5>
                </div>
                <hr style="margin: 2px">
                    <h1 style="text-align:center; height:fit-content">{{ $notula->count() }}</h1>
                <hr style="margin: 2px">
                <div class="row">
                    <h5 style="text-align:center; height:fit-content">Jumlah Dokumen Ditambahkan Bulan ini</h5>
                </div>
                <hr style="margin: 2px">
                <h1 style="text-align:center; height:fit-content">{{ $notulaThisMonth->count() }}</h1>
                <hr style="margin: 2px">
                <div class="row">
                    <h5 style="text-align:center; height:fit-content">Jumlah Dokumen Ditambahkan Bulan lalu</h5>
                </div>
                <hr style="margin: 2px">
                <h1 style="text-align:center; height:fit-content">{{ $notulaLastMonth->count() }}</h1>
            </div>
        </div>
    </div>
    
@endsection

@section('footdigital-knowledge-management')
    <script>
        window.addEventListener('load', function(event){
            var suratKeputusanHeight = $('#suratKeputusanTitle').height()
            var presentasiHeight = $('#presentasiTitle').height()
            var laporanPelaksanaanTugasHeight = $('#laporanPelaksanaanTugasTitle').height()
            var notulaHeight = $('#notulaTitle').height()
            var height= [suratKeputusanHeight, presentasiHeight,laporanPelaksanaanTugasHeight,notulaHeight]
            console.log(height);
            var cardHeight = $('.card').height()
            $('.cardHeader').css('height', Math.max(...height))
            $("#suratKeputusanContent").css('height', cardHeight-Math.max(...height))
            $("#presentasiContent").css('height', cardHeight-Math.max(...height))
            $("#laporanPelaksanaanTugasContent").css('height', cardHeight-Math.max(...height))
            $("#notulaContent").css('height', cardHeight-Math.max(...height))

        });

        window.addEventListener('resize', function(event){
            var newSuratKeputusanHeight = $('#suratKeputusanTitle').height()
            var newPresentasiHeight = $('#presentasiTitle').height()
            var newLaporanPelaksanaanTugasHeight = $('#laporanPelaksanaanTugasTitle').height()
            var newNotulaHeight = $('#notulaTitle').height()
            var newHeight= [newSuratKeputusanHeight, newPresentasiHeight,newLaporanPelaksanaanTugasHeight,newNotulaHeight]
            console.log(newHeight);
            var newCardHeight = $('.card').height()
            $('.cardHeader').css('height', Math.max(...newHeight))
            $("#suratKeputusanContent").css('height', newCardHeight-Math.max(...newHeight))
            $("#presentasiContent").css('height', newCardHeight-Math.max(...newHeight))
            $("#laporanPelaksanaanTugasContent").css('height', newCardHeight-Math.max(...newHeight))
            $("#notulaContent").css('height', newCardHeight-Math.max(...newHeight))
        });
    </script>
@endsection