
@extends('layout.pindai')
    @section('contentpindai')
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2 border rounded-top text-center" style="border: beige">
                            Permohonan
                        </div>
                        <div class="col-sm-2 border rounded-top text-center">
                            Penilaian
                        </div>
                        <div class="col-sm-2 border rounded-top text-center">
                            Persetujuan
                        </div>
                        <div class="col-sm-2 border rounded-top text-center">
                            Lelang
                        </div>
                        <div class="col-sm-2 border rounded-top text-center">
                            BMN Laku Sebagian
                        </div>
                        <div class="col-sm-2 border rounded-top text-center">
                            Selesai Lelang
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2 border rounded-bottom scrollable" style="height: 78vh; padding:5px; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                            @foreach ($permohonan as $item)
                                <a href="/pindai/{{ $item->id }}" class="text-center btn" style="background-color: blue; width:100%; margin-top:2px">
                                    <p style="color: aliceblue; margin:auto">
                                        {{$item->tiket}}
                                    </p>
                                </a>    
                            @endforeach
                        </div>
                        <div class="col-sm-2 border rounded-bottom scrollable" style="height: 78vh; padding:5px; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                            @foreach ($penilaian as $item)
                                <a href="/pindai/{{ $item->id }}" class="text-center btn" style="background-color: blue; width:100%; margin-top:2px">
                                    <p style="color: aliceblue; margin:auto">
                                        {{$item->tiket}}
                                    </p>
                                </a>    
                            @endforeach
                        </div>
                        <div class="col-sm-2 border rounded-bottom scrollable" style="height: 78vh; padding:5px; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                            @foreach ($persetujuan as $item)
                                <a href="/pindai/{{ $item->id }}" class="text-center btn" style="background-color: blue; width:100%; margin-top:2px">
                                    <p style="color: aliceblue; margin:auto">
                                        {{$item->tiket}}
                                    </p>
                                </a>    
                            @endforeach
                        </div>
                        <div class="col-sm-2 border rounded-bottom scrollable" style="height: 78vh; padding:5px; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                            @foreach ($lelang as $item)
                                <a href="/pindai/{{ $item->id }}" class="text-center btn" style="background-color: blue; width:100%; margin-top:2px">
                                    <p style="color: aliceblue; margin:auto">
                                        {{$item->tiket}}
                                    </p>
                                </a>    
                            @endforeach
                        </div>
                        <div class="col-sm-2 border rounded-bottom scrollable" style="height: 78vh; padding:5px; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                            @foreach ($selesaiLelang as $item)
                                @if ($item->permohonans)
                                    @if ($item->permohonans->barang->avg('status')<2)
                                        <a href="/pindai/{{ $item->id }}" class="text-center btn" style="background-color: blue; width:100%; margin-top:2px">
                                            <p style="color: aliceblue; margin:auto">
                                                {{$item->tiket}}
                                            </p>
                                        </a>
                                    @endif   
                                @endif
                            @endforeach
                        </div>
                        <div class="col-sm-2 border rounded-bottom scrollable" style="height: 78vh; padding:5px; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                            @foreach ($selesaiLelang as $item)
                                @if ($item->jenis === 'PKN')
                                    @if ($item->permohonans)
                                        @if ($item->permohonans->barang->avg('status') === 2)
                                            <a href="/pindai/{{ $item->id }}" class="text-center btn" style="background-color: blue; width:100%; margin-top:2px">
                                                <p style="color: aliceblue; margin:auto">
                                                    {{$item->tiket}}
                                                </p>
                                            </a>
                                        @endif
                                    @endif
                                @elseif($item->jenis === 'LLG')
                                    @if ($item->permohonanLelang)
                                        <a href="/pindai/{{ $item->id }}" class="text-center btn" style="background-color: blue; width:100%; margin-top:2px">
                                            <p style="color: aliceblue; margin:auto">
                                                {{$item->tiket}}
                                            </p>
                                        </a>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    @endsection

