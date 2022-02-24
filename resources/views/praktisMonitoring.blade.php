@extends('layout.main')

@section('content')
    <div class="container-fluid" style="padding: 30px 37px 9px 37px; height:100%">
        <div class="container-fluid" style="border-radius: 10px; background-color:rgba(240, 248, 255, 0.281); height:100%">
            <div class="row" style="padding: 0 10px; height:60px">
                <div class="col-sm-1">
                    <a href="login">
                        <button class="btn btn-primary translate-middle-y"><i class="bi bi-caret-left-fill"></i></button>
                    </a>
                </div>
                <div class="col-sm-2">
                    <a href="praktis">
                        <button class="btn translate-middle-y" style="width: 100%; background-color:#ffffff">Idikator Kinerja Utama</button>
                    </a>
                </div>
                @if (1)
                    
                @else
                <div class="col-sm-2" >
                    <a href="" >
                        <button class="btn translate-middle-y" style="width: 100%; background-color:#ffffff">Monitoring Bawahan</button>
                    </a>
                </div>
                @endif
                @if (auth()->user()->jabatan === '01'||auth()->user()->jabatan === '06'||auth()->user()->jabatan === '15')
                <div class="col-sm-2" >
                    <a href="/monitoring" >
                        <button class="btn translate-middle-y" style="width: 100%;background-color:#4D59CA ">Monitoring Capaian Kinerja</button>
                    </a>
                </div>
                @endif
                @if (auth()->user()->jabatan === '01'||auth()->user()->jabatan === '06'||auth()->user()->jabatan === '15')
                <div class="col-sm-2">
                    <a href="/kinerjaorganisasi">
                        <button class="btn translate-middle-y" style="width: 100%; background-color:#ffffff">Kinerja Organisasi</button>
                    </a>
                </div>
                @endif
                <div class="col"></div>
            </div>
            <div class="row" style="height:85%; padding: 0; background-color:aliceblue">
                <div class="container-fluid" style="height:100%">
                    <div class="row" style="height: 100%; border-radius:10px;">
                        <div class="table table-light" style="padding: 0; height: 100%; background-color:aliceblue">
                            <table class="table table-hover table-responsive">
                                <tr style="box-shadow: 0px 6px 6px rgba(0, 0, 0, 0.37); border: 1px solid rgba(77, 89, 202, 0.76); height: 50px">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Jabatan</th>
                                    <th>CKP</th>
                                </tr>
                                <?php $i=1; ?>
                                @foreach ($data as $item)
                                    <tr onclick="window.location = 'monitoring/{{$item->id}}'">
                                        <td>{{$i}}</td>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$item->NIP}}</td>
                                        <td>{{$item->jabatans->namaJabatan}}</td>
                                        <td>
                                            @foreach ($item->IKU->where('tahun', session()->get('tahun')) as $item)
                                                @if ($item->targetlast)
                                                    @php
                                                        $target=$item->targetlast->target
                                                    @endphp
                                                @else
                                                    @php
                                                        $target = null
                                                    @endphp
                                                @endif

                                                @if ($item->capaianlast)
                                                    @php
                                                        $capaian = $item->capaianlast->capaian
                                                    @endphp
                                                @else
                                                    @php
                                                        $capaian = null
                                                    @endphp
                                                @endif
                                                @if ($capaian != null && $target != null)
                                                    @php
                                                        $realisasi[]= ($capaian/$target)*100
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if (isset($realisasi))
                                                {{array_sum($realisasi)/count($realisasi)}}%
                                            @endif
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection