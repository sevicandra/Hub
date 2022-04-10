@extends('layout.main')
@section('content')
<div class="container-fluid" style="padding: 30px 37px 0px 37px; height:100%">
    <div class="container-fluid" style="border-radius: 10px; background-color:rgb(255, 255, 255); height:100%">
        <div class="row" style="padding-bottom: 10px">
            <div class="col-sm-1">
                <a href="/pindai">
                    <button class="btn translate-middle-y" style="background-color: #D8D4D4; color: #4d59ca"><i class="bi bi-house-fill"></i></button>
                </a>
            </div>
            <div class="col-sm-2" style="width: fit-content">
                <div class="btn translate-middle-y" style="background-color:  #4d59ca; color:#D8D4D4">
                {{ $data->tiket }}
                </div>
            </div>
        </div>
        <div class="row" style="width: 100; padding: 10px;background: rgba(239, 238, 238, 0.51); backdrop-filter: blur(1000px); border-radius: 10px; height:80px; margin: 10px; font-family:'TW CENT MT'">
            <div class="position-relative" style="width: 100%; height:initial; background-color:rgb(255, 255, 255); border-radius:10px">
                <div style="height: fit-content; width:fit-content">
                    <h5 style="margin:0; padding:0">{{ $data->permohonans->satuanKerja->namaSatker }} <br> Operator : {{ $data->permohonans->satuanKerja->profil->namaOperator }} / {{ $data->permohonans->satuanKerja->profil->noTeleponOperator }}</h5>
                </div>
            </div>
        </div>
        <div class="row tracking" style="height:400px; margin: 10px;">
            <div  style="background: rgba(239, 238, 238, 0.5); border-radius: 10px; height:100%; width: 58%; margin-right:2%; padding:5px">
                <div class="scrollable" style="width: 100%; height:100%; background-color:white; border-radius:10px; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none; color:white; font-family:'TW CENT MT">
                    {{-- Permohonan Persetujuan --}}
                    @if (isset($data->permohonans))
                    <div style="width: 100%; height:fit-content;background: #5F6C8C; border-radius: 10px; padding:5px; margin-bottom:2px">
                        <div class="row">
                            <h6>Permohonan Persetujuan</h6>
                        </div>
                        <div class="row position-relative" style="height: 50px; margin: 5px">
                            <div class="progress position-absolute top-50 start-50 translate-middle">
                                <div class="progress-bar" role="progressbar" style="width: 
                                @if ($data->permohonans->permohonanPenilaian)
                                100%
                                @elseif($data->permohonans->barang->first())
                                50%
                                @elseif($data->permohonans)
                                0%
                                @endif
                                
                                ; background-color: #43D2F1" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            @if (isset($data->permohonans))
                            <div class="position-absolute top-50 start-0 translate-middle-y" style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white;">1</div>
                            @else
                            <div class="position-absolute top-50 start-0 translate-middle-y" style="background: #C4C4C4; border-radius: 50px; height:50px;width:50px; color:white;">1</div> 
                            @endif
                            @if ($data->permohonans->barang->first())
                                <div class="progress position-absolute top-50 start-50 translate-middle" style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white">2</div>
                            @else
                                <div class="progress position-absolute top-50 start-50 translate-middle" style="background: #C4C4C4; border-radius: 50px; height:50px;width:50px; color:white">2</div>    
                            @endif
                            @if ($data->permohonans->permohonanPenilaian)  
                                <div class="position-absolute top-50 end-0 translate-middle-y" style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white">3</div>
                            @else
                                <div class="position-absolute top-50 end-0 translate-middle-y" style="background: #C4C4C4; border-radius: 50px; height:50px;width:50px; color:white">3</div>
                            @endif
                        </div>
                        <div>
                            <p>
                                1. Permohonan Diterima <br>
                                2. Input Barang <br>
                                3. Permohonan Penilaian
                            </p>
                        </div>
                    </div>
                    {{-- Akhir Permohonan Persetujuan --}}
                    @if ($data->permohonans->permohonanPenilaian)
                    {{-- Penilaian --}}
                    <div style="width: 100%; height:fit-content;background: #5F6C8C; border-radius: 10px; padding:5px; margin-bottom:2px">
                        <div class="row">
                            <h6>Penilaian</h6>
                        </div>
                        <div class="row position-relative" style="height: 50px; margin: 5px">
                                @if ($data->permohonans->permohonanPenilaian)
                                    @if ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian)
                                        @if ($data->permohonans->barang->count() === $data->permohonans->barang->where('laporan_penilaian_id', '!=', null)->count())
                                            @if (isset($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan))
                                            <div class="progress position-absolute top-50 start-50 translate-middle">
                                                <div class="progress-bar" role="progressbar" style="width: 100%; background-color: #43D2F1" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            @else
                                            <div class="progress position-absolute top-50 start-50 translate-middle">
                                                <div class="progress-bar" role="progressbar" style="width: 75%; background-color: #43D2F1" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            @endif
                                        @else
                                        <div class="progress position-absolute top-50 start-50 translate-middle">
                                            <div class="progress-bar" role="progressbar" style="width: 25%; background-color: #43D2F1" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        @endif
                                    @else
                                        <div class="progress position-absolute top-50 start-50 translate-middle">
                                            <div class="progress-bar" role="progressbar" style="width: 0%; background-color: #43D2F1" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    @endif
                                @endif

                            @if ($data->permohonans->permohonanPenilaian)
                                <div class="position-absolute top-50 start-0 translate-middle-y" style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white;">1</div>
                                @if ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian)
                                    <div class="progress position-absolute top-50 translate-middle-y" style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white; left:25%">2</div>
                                    @if ($data->permohonans->barang->count() === $data->permohonans->barang->where('laporan_penilaian_id', '!=', null)->count())
                                        <div class="position-absolute top-50 translate-middle-y" style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white; right:25%">3</div>
                                        @if (isset($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan))
                                            <div class="position-absolute top-50 end-0 translate-middle-y" style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white">4</div>
                                        @else
                                            <div class="position-absolute top-50 end-0 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white">4</div>
                                        @endif
                                    @else
                                        <div class="position-absolute top-50 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white; right:25%">3</div>
                                        <div class="position-absolute top-50 end-0 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white">4</div>
                                    @endif
                                @else
                                    <div class="progress position-absolute top-50 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white; left:25%">2</div>
                                    <div class="position-absolute top-50 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white; right:25%">3</div>
                                    <div class="position-absolute top-50 end-0 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white">4</div>
                                @endif
                            @else
                                <div class="position-absolute top-50 start-0 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white;">1</div>
                                <div class="progress position-absolute top-50 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white; left:25%">2</div>
                                <div class="position-absolute top-50 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white; right:25%">3</div>
                                <div class="position-absolute top-50 end-0 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white">4</div>
                            @endif
                        </div>
                        <div>
                            <p>
                                1. Permohonan Penilaian <br>
                                2. Penyampaian Jadwal <br>
                                3. Input Laporan <br>
                                4. Penyampaian Laporan
                            </p>
                        </div>
                    </div>
                    {{-- Akhir Penilaian --}}
                    @if ($data->permohonans->permohonanPenilaian)
                    @if ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian)
                    @if ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan)
                    {{-- Persetujuan --}}
                    <div style="width: 100%; height:fit-content;background: #5F6C8C; border-radius: 10px; padding:5px; margin-bottom:2px">
                        <div class="row">
                            <h6>Persetujuan</h6>
                        </div>
                        <div class="row position-relative" style="height: 50px; margin: 5px">
                            <div class="progress position-absolute top-50 start-50 translate-middle">
                            @if ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan->suratPersetujuan)
                                <div class="progress-bar" style="width: 100%; background-color: #43D2F1" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            @else
                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            @endif
                            </div>
                            <div class="position-absolute top-50 start-0 translate-middle-y" style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white;">1</div>
                            
                            @if ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan->suratPersetujuan)
                                <div class="position-absolute top-50 end-0 translate-middle-y" style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white">2</div>
                            @else
                                <div class="position-absolute top-50 end-0 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white">2</div>
                            @endif
                        </div>
                        <div>
                            <p>
                                1. Penyampaian Laporan Penilaian <br>
                                2. Persetujuan <br>
                            </p>
                        </div>
                    </div>
                    {{-- Akhir Persetujuan --}}
                    @if ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan->suratPersetujuan)
                    @if ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan->suratPersetujuan->permohonanLelang->first() != null)                        
                    {{-- Lelang --}}
                    @foreach ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan->suratPersetujuan->permohonanLelang as $item)
                    <div style="width: 100%; height:fit-content;background: #5F6C8C; border-radius: 10px; padding:5px; margin-bottom:2px">
                        <div class="row">
                            <h6>Lelang</h6>
                        </div>
                        <div class="row position-relative" style="height: 50px; margin: 5px">
                            <div class="progress position-absolute top-50 start-50 translate-middle">
                                @if ($item->penetapanLelang)
                                    @if (count($item->penetapanLelang->permohonanLelang->barang) === count($item->penetapanLelang->barangLelang))
                                        @if ($item->penetapanLelang->status === 1)
                                        <div class="progress-bar" style="width: 100%;background: #43D2F1" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        @else
                                        <div class="progress-bar" style="width: 75%;background: #43D2F1" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        @endif
                                    @else
                                    <div class="progress-bar" style="width: 25%;background: #43D2F1" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    @endif
                                @else
                                <div class="progress-bar" style="width: 0%;background: #43D2F1" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                @endif

                            </div>
                            <div class="position-absolute top-50 start-0 translate-middle-y" style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white;">1</div>
                            @if ($item->penetapanLelang)
                                <div class="progress position-absolute top-50 translate-middle-y" style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white; left:25%">2</div>
                                @if (count($item->penetapanLelang->permohonanLelang->barang) === count($item->penetapanLelang->barangLelang))
                                    <div class="position-absolute top-50 translate-middle-y" style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white; right:25%">3</div>
                                    @if ($item->penetapanLelang->status === 1)
                                    <div class="position-absolute top-50 end-0 translate-middle-y" style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white">4</div>
                                    @else
                                    <div class="position-absolute top-50 end-0 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white">4</div>
                                    @endif
                                @else
                                    <div class="position-absolute top-50 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white; right:25%">3</div>
                                    <div class="position-absolute top-50 end-0 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white">4</div>
                                @endif
                            
                            @else
                            <div class="progress position-absolute top-50 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white; left:25%">2</div>
                            <div class="position-absolute top-50 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white; right:25%">3</div>
                            <div class="position-absolute top-50 end-0 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white">4</div>
                            @endif
                        </div>
                        <div>
                            <p>
                                1. Permohonan Lelang <br>
                                2. Penetapan Lelang <br>
                                3. Input Risalah <br>
                                4. Penyampaian Risalah
                            </p>
                        </div>
                    </div>
                    @endforeach
                    {{-- Akhir Lelang --}}
                    @endif
                    @endif
                    @endif
                    @endif
                    @endif
                    @endif
                    @endif
                </div>
            </div>
            <div  style="background: rgba(239, 238, 238, 0.5); border-radius: 10px; height:100%; width: 40%; padding:2px">
            
            </div>
        </div>
    </div>
</div>

@endsection
@section('foot')
    
<script>
    $(window).on('load', function(){
        var newHeight = window.innerHeight-(200+(window.innerHeight*0.1)); 
        $(".tracking").css('height', newHeight)
    });
    window.addEventListener('resize', function(event){
        var newHeight = window.innerHeight-(200+(window.innerHeight*0.1)); 
        $(window).resize(function() {
            $(".tracking").css('height', newHeight)
        });
    });
</script>
@endsection