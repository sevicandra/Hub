@extends('layout.main')

@section('content')
    <div class="container-fluid" style="padding: 30px 37px 9px 37px; height:100%">
        <div class="container-fluid" style="border-radius: 10px; background-color:rgba(240, 248, 255, 0.281); height:100%">
            <div class="row" style="padding: 0 10px; height:60px">
                <div class="col-sm-1">
                    <a href="pindai">
                        <button class="btn btn-primary translate-middle-y"><i class="bi bi-caret-left-fill"></i></button>
                    </a>
                </div>
                <div class="col-sm-2">
                    <a href="">
                        <button class="btn translate-middle-y" style="width: 100%; background-color:#4D59CA">Idikator Kinerja Utama</button>
                    </a>
                </div>
                <div class="col-sm-2" >
                    <a href="" >
                        <button class="btn translate-middle-y" style="width: 100%; background-color:#ffffff">Monitoring Bawahan</button>
                    </a>
                </div>
                <div class="col-sm-2" >
                    <a href="" >
                        <button class="btn translate-middle-y" style="width: 100%; background-color:#ffffff">Monitoring Capaian Kinerja</button>
                    </a>
                </div>
                <div class="col"></div>
                <div class="col-sm-2" style="margin:auto">
                    <button class="btn" style="background: #4D59CA; border-radius: 10px; width:100%" data-bs-toggle="modal" data-bs-target="#inputIKU">Tambah IKU</button>
                </div>
            </div>
            <div class="row" style="height:85%; padding: 0; background-color:aliceblue">
                <div class="container-fluid" style="height:100%">
                    <div class="row" style="height: 100%; border-radius:10px;">
                        <div class="table table-light" style="padding: 0; height: 100%; background-color:aliceblue">
                            <table class="table table-hover table-responsive">
                                <tr style="box-shadow: 0px 6px 6px rgba(0, 0, 0, 0.37); border: 1px solid rgba(77, 89, 202, 0.76); height: 50px">
                                    <th>Kode IKU</th>
                                    <th>Nama IKU</th>
                                    <th>Target</th>
                                    <th>Realisasi</th>
                                    <th>Aksi</th>
                                </tr>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item->kodeIKU}}</td>
                                        <td>{{$item->namaIKU}}</td>
                                        <td>
                                            @if ($item->target->where('periode', 'Q4')->first())
                                                @if ($item->target->where('periode', 'Q4')->first()->raw)
                                                    {{$item->target->where('periode', 'Q4')->first()->raw}}    
                                                @else
                                                    {{$item->target->where('periode', 'Q4')->first()->target}}
                                                @endif
                                            @elseif ($item->target->where('periode', 'Q3')->first())
                                                @if ($item->target->where('periode', 'Q3')->first()->raw)
                                                    {{$item->target->where('periode', 'Q3')->first()->raw}}    
                                                @else
                                                    {{$item->target->where('periode', 'Q3')->first()->target}}
                                                @endif
                                            @elseif ($item->target->where('periode', 'Q2')->first())
                                                @if ($item->target->where('periode', 'Q2')->first()->raw)
                                                    {{$item->target->where('periode', 'Q2')->first()->raw}}    
                                                @else
                                                    {{$item->target->where('periode', 'Q2')->first()->target}}
                                                @endif
                                            @elseif ($item->target->where('periode', 'Q1')->first())
                                                @if ($item->target->where('periode', 'Q1')->first()->raw)
                                                    {{$item->target->where('periode', 'Q1')->first()->raw}}    
                                                @else
                                                    {{$item->target->where('periode', 'Q1')->first()->target}}
                                                @endif
                                            @endif
                                        </td>
                                        <td></td>
                                        <td style="width: 10%">
                                            <a href="praktis/{{$item->id}}" >
                                                <button class="btn"><i class="bi bi-pencil-square"></i></button>
                                            </a>
                                            <button class="btn"><i class="bi bi-trash3-fill"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Input IKU --}}
        <div class="modal fade" id="inputIKU" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form action="/praktis" method="POST">
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