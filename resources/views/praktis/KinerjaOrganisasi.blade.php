@extends('layout.praktis')

@section('contentpraktis')
            <div class="row" style="height:85%; padding: 0; background-color:aliceblue">
                <div class="container-fluid" style="height:100%">
                    <div class="row" style="height: 100%; border-radius:10px;">
                        <div class="table table-light table-responsive" style="padding: 0; height: 100%; background-color:aliceblue">
                            <table class="table" style="align-items: center; text-align:center">
                                    <tr style="box-shadow: 0px 6px 6px rgba(0, 0, 0, 0.37); border: 1px solid rgba(77, 89, 202, 0.76); height: 50px">
                                        <th style="width: 10%">Kode IKU</th>
                                        <th style="width: 35%;text-align:left">Nama IKU</th>
                                        <th style="width: 15%">Target</th>
                                        <th style="width: 15%">Realisasi</th>
                                        <th style="width: 10%">Capaian</th>
                                        <th style="width: 15%;">Aksi</th>
                                    </tr>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{$item->kodeIKU}}</td>
                                            <td style="; text-align:left">{{$item->namaIKU}}</td>
                                            <td>
                                                @if ($item->target->where('periode', 'Q4')->first())
                                                    @if ($item->target->where('periode', 'Q4')->first()->raw)
                                                    {{number_format($item->target->where('periode', 'Q4')->first()->raw, 0, ',', '.')}}    
                                                    @else
                                                        {{$item->target->where('periode', 'Q4')->first()->target}}
                                                    @endif
                                                @elseif ($item->target->where('periode', 'Q3')->first())
                                                    @if ($item->target->where('periode', 'Q3')->first()->raw)
                                                    {{number_format($item->target->where('periode', 'Q3')->first()->raw, 0, ',', '.')}}    
                                                    @else
                                                        {{$item->target->where('periode', 'Q3')->first()->target}}
                                                    @endif
                                                @elseif ($item->target->where('periode', 'Q2')->first())
                                                    @if ($item->target->where('periode', 'Q2')->first()->raw)
                                                        {{number_format($item->target->where('periode', 'Q2')->first()->raw, 0, ',', '.')}}   
                                                    @else
                                                        {{$item->target->where('periode', 'Q2')->first()->target}}
                                                    @endif
                                                @elseif ($item->target->where('periode', 'Q1')->first())
                                                    @if ($item->target->where('periode', 'Q1')->first()->raw)
                                                        {{number_format($item->target->where('periode', 'Q1')->first()->raw, 0, ',', '.')}}    
                                                    @else
                                                        {{$item->target->where('periode', 'Q1')->first()->target}}
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->konsolidasi = 'TKL')
                                                    @if (isset($item->capaian()->orderBy('bulan', 'DESC')->first()->raw))
                                                    {{number_format($item->capaian()->orderBy('bulan', 'DESC')->first()->raw, 0, ',', '.')}}    
                                                    @elseif(isset($item->capaian()->orderBy('bulan', 'DESC')->first()->capaian))
                                                        {{$item->capaian()->orderBy('bulan', 'DESC')->first()->capaian}}
                                                    @endif
                                                @elseif ($item->konsolidasi = 'AVG')
                                                    @if ($item->capaian()->orderBy('bulan', 'DESC')->first()->raw)
                                                        {{$item->capaian->avg('raw')}}    
                                                    @else
                                                        {{$item->capaian->avg('capaian')}}
                                                    @endif
                                                    
                                                @endif
                                            </td>
                                            <td>
                                                <?php
                                                    if ($item->target->where('periode', 'Q4')->first()){
                                                        if ($item->target->where('periode', 'Q4')->first()->raw){
                                                            $target = $item->target->where('periode', 'Q4')->first()->raw;
                                                        }else{
                                                            $target = $item->target->where('periode', 'Q4')->first()->target;
                                                        };
                                                    }elseif ($item->target->where('periode', 'Q3')->first()){
                                                        if ($item->target->where('periode', 'Q3')->first()->raw){
                                                            $target = $item->target->where('periode', 'Q3')->first()->raw;
                                                        }else{
                                                            $target = $item->target->where('periode', 'Q3')->first()->target;
                                                        };
                                                    }elseif ($item->target->where('periode', 'Q2')->first()){
                                                        if ($item->target->where('periode', 'Q2')->first()->raw){
                                                            $target = $item->target->where('periode', 'Q2')->first()->raw;
                                                        }else{
                                                            $target = $item->target->where('periode', 'Q2')->first()->target;
                                                        };
                                                    }elseif ($item->target->where('periode', 'Q1')->first()){
                                                        if ($item->target->where('periode', 'Q1')->first()->raw){
                                                            $target = $item->target->where('periode', 'Q1')->first()->raw;
                                                        }else{
                                                            $target = $item->target->where('periode', 'Q1')->first()->target;
                                                        };
                                                    }else{
                                                        $target=null;
                                                    }
                                                    if ($item->konsolidasi = 'TKL'){
                                                        if (isset($item->capaian()->orderBy('bulan', 'DESC')->first()->raw)){
                                                            $realisasi = $item->capaian()->orderBy('bulan', 'DESC')->first()->raw;    
                                                        }elseif(isset($item->capaian()->orderBy('bulan', 'DESC')->first()->capaian)){
                                                            $realisasi = $item->capaian()->orderBy('bulan', 'DESC')->first()->capaian;
                                                        }else{
                                                            $realisasi=0;
                                                        }
                                                    }elseif ($item->konsolidasi = 'AVG'){
                                                        if ($item->capaian()->orderBy('bulan', 'DESC')->first()->raw){
                                                            $realisasi = $item->capaian->avg('raw'); 
                                                        }else{
                                                            $realisasi = $item->capaian->avg('capaian');
                                                        }
                                                    }
                                                    if(isset($target)){
                                                        if(isset($realisasi)){
                                                            if($item->polarisasi === 'MAX'){
                                                                if(($realisasi/$target) > 1.2){
                                                                    echo '120 %';
                                                                }else{
                                                                    echo  number_format(($realisasi/$target)*100, 2,',', '.') . '%';
                                                                }
                                                            }elseif($item->polarisasi === 'MIN'){
                                                                if ((1+(1-($realisasi/$target))) > 1.2){
                                                                    echo '120 %';
                                                                }else{
                                                                    echo number_format((1+(1-($realisasi/$target)))*100,2, ',', '.') . '%';
                                                                }
                                                            };
                                                        };
                                                    };
                                                ?>
                                            </td>
                                            <td style="width: 10%">
                                                @if (isset($user))
                                                    @if ($user === auth()->user()->id)
                                                        <form action="kinerjaorganisasi/{{$item->id}}" class="d-inline">
                                                            <button class="btn"><i class="bi bi-pencil-square"></i></button>
                                                        </form>
                                                        <form action="/praktis/{{$item->id}}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn"><i class="bi bi-trash3-fill"></i></button>
                                                        </form>
                                                    @endif
                                                @else
                                                <form action="kinerjaorganisasi/{{$item->id}}" class="d-inline">
                                                    <button class="btn"><i class="bi bi-pencil-square"></i></button>
                                                </form>
                                                    <form action="/kinerjaorganisasi/{{$item->id}}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn"><i class="bi bi-trash3-fill"></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
@endsection
@section('footpraktis')
{{-- Input IKU --}}
        <div class="modal fade" id="inputIKU" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form action="/kinerjaorganisasi" method="POST">
                                @csrf
                                <div class="row" style="margin-bottom: 5px">
                                    <label for="KodeIKU" class="col-sm-4 col-form-label">Kode IKU</label>
                                    <div class="col-sm-8">
                                        <input name="KodeIKU" class="form-control" type="text" required>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 5px">
                                    <label for="namaIKU" class="col-sm-4 col-form-label">Nama IKU</label>
                                    <div class="col-sm-8">
                                        <input name="namaIKU" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 5px">
                                    <label for="konsolidasi" class="col-sm-4 col-form-label">Konsolidasi</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="form-check form-check-inline col-sm-6">
                                                <input class="form-check-input" type="radio" name="konsolidasi" id="konsolidasi1" value="TLK">
                                                <label class="form-check-label" for="konsolidasi1">Take Last Know</label>
                                            </div>
                                            <div class="form-check form-check-inline col-sm-4">
                                                <input class="form-check-input" type="radio" name="konsolidasi" id="konsolidasi2" value="AVG">
                                                <label class="form-check-label" for="konsolidasi2">Average</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 5px">
                                    <label for="polarisasi" class="col-sm-4 col-form-label">Polarisasi</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="form-check form-check-inline col-sm-6">
                                                <input class="form-check-input" type="radio" name="polarisasi" id="polarisas1" value="MAX">
                                                <label class="form-check-label" for="polarisas1">Maximaze</label>
                                            </div>
                                            <div class="form-check form-check-inline col-sm-4">
                                                <input class="form-check-input" type="radio" name="polarisasi" id="polarisas2" value="MIN">
                                                <label class="form-check-label" for="polarisas2">Minimaze</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{-- Akhir Input IKU --}}
@endsection