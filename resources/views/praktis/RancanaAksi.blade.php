@extends('layout.main')

@section('content')
    <div class="container-fluid" style="padding: 30px 37px 9px 37px; height:100%">
        <div class="container-fluid" style="border-radius: 10px; background-color:rgba(240, 248, 255, 0.281); height:100%">
            <div class="row" style="padding: 0 10px; height:40px">
                <div class="col-sm-1">
                    <a href="{{$back}}">
                        <button class="btn btn-primary translate-middle-y"><i class="bi bi-caret-left-fill"></i></button>
                    </a>
                </div>
                <div style="width: fit-content">
                    <a href="">
                        <button class="btn translate-middle-y" style="width: 100%; background-color:#ffffff">{{$data->kodeIKU}} {{$data->namaIKU}}</button>
                    </a>
                </div>
            </div>
            <div class="row" style="height:85%; padding: 0; background-color:aliceblue">
                <div class="container-fluid scrollable " style="max-height:100%; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                    <div class="row" style="height: fit-content; border-radius:10px">
                        <div style="width: 5%">No</div>
                        <div style="width: 15%">Tanggal Input</div>
                        <div style="width: 15%">Tanggal Mulai</div>
                        <div style="width: 15%">Tanggal Selesai</div>
                        <div style="width: 40%">Rencana Aksi</div>
                        <div style="width: 10%"></div>
                    </div>
                    <hr>
                    @php
                        $i=1;
                    @endphp
                    @foreach ($data->rencanaAksi as $item)
                    <div class="row" style="height: fit-content; border-radius:10px @if ($item->status === '1');text-decoration: line-through;@endif">
                        <div style="width: 5%">{{ $i }}</div>
                        <div style="width: 15%">{{ $item->created_at }}</div>
                        <div style="width: 15%">{{ $item->tanggalMulai }}</div>
                        <div style="width: 15%">{{ $item->tanggalSelesai }}</div>
                        <div style="width: 40%">{{ $item->rencanaAksi }}</div>
                        <div style="width: 10%">
                        @if ($data->user_id === auth()->user()->id)
                        @if ($item->status === '0')
                            <form action="/rencana_aksi/{{ $item->id }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-primary" type="submit" name="button" value="Done"><i class="bi bi-check2-circle"></i></button>
                            </form>
                        @elseif($item->status === '1')
                            <form action="/rencana_aksi/{{ $item->id }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-danger" type="submit" name="button" value="Undone"><i class="bi bi-dash-circle"></i></button>
                            </form>
                        @endif  
                        @endif
                        
                        </div>
                    </div>
                    @php
                        $i++;
                    @endphp
                    @endforeach
                </div>
            </div>
            <div class="row" >
                <div class="position-relative">
                    <button class="position-absolute top-50 end-0 btn btn-success" data-bs-toggle="modal" data-bs-target="#inputRencanaAksi">Input Rencana Aksi</button>
                </div>
            </div>
        </div>
    </div>

    {{-- RENCANA AKSI --}}
        <div class="modal fade" id="inputRencanaAksi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form action="/rencana_aksi" method="POST">
                                @csrf
                                <div class="row" style="margin-bottom: 5px">
                                    <label for="rencanaAksi" class="col-sm-4 col-form-label">Rencana Aksi</label>
                                    <div class="col-sm-8">
                                        <input name="rencanaAksi" class="form-control" type="text" required>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 5px">
                                    <label for="tanggalMulai" class="col-sm-4 col-form-label">tanggal Mulai</label>
                                    <div class="col-sm-8">
                                        <input name="tanggalMulai" type="date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 5px">
                                    <label for="tanggalSelesai" class="col-sm-4 col-form-label">tanggal Selesai</label>
                                    <div class="col-sm-8">
                                        <input name="tanggalSelesai" type="date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div>
                                        <button name="idikator_kinerja_utama_id" type="text" value="{{ $data->id }}" type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- Akhir RENCANA AKSI --}}

@endsection