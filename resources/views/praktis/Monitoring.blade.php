@extends('layout.praktis')

@section('contentpraktis')
            <div class="row" style="height:85%; padding: 0; background-color:aliceblue">
                <div class="container-fluid" style="height:100%">
                    <div class="row" style="height: 100%; border-radius:10px;">
                        <div class="table table-light table-responsive" style="padding: 0; height: 100%; background-color:aliceblue">
                            <table class="table">
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
                                            @foreach ($item->IKU->where('tahun', session()->get('tahun')) as $items)
                                                {{-- @if ($items->targetlast)
                                                    @php
                                                        $target=$items->targetlast->target
                                                    @endphp
                                                @else
                                                    @php
                                                        $target = null
                                                    @endphp
                                                @endif

                                                @if ($items->capaianlast)
                                                    @php
                                                        $capaian = $items->capaianlast->capaian
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
                                                @else
                                                    @php
                                                        $realisasi[]=0
                                                    @endphp
                                                @endif --}}
                                            @endforeach
                                            @if (isset($realisasi))
                                                {{-- {{array_sum($realisasi)/count($realisasi)}}% --}}
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
@endsection