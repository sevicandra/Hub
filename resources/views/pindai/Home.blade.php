
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
                            Laku Sebagian
                        </div>
                        <div class="col-sm-2 border rounded-top text-center">
                            Laku
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2 border rounded-bottom" style="height: 78vh; padding:5px">
                            @foreach ($permohonan as $item)
                                <div class="text-center btn" style="background-color: blue; width:100%">
                                    <p style="color: aliceblue; margin:auto">
                                        {{$item->tiket}}
                                    </p>
                                </div>    
                            @endforeach
                        </div>
                        <div class="col-sm-2 border rounded-bottom" style="height: 78vh; padding:5px">
                            @foreach ($penilaian as $item)
                                <div class="text-center btn" style="background-color: blue; width:100%">
                                    <p style="color: aliceblue; margin:auto">
                                        {{$item->tiket}}
                                    </p>
                                </div>    
                            @endforeach
                        </div>
                        <div class="col-sm-2 border rounded-bottom" style="height: 78vh; padding:5px">
                            @foreach ($persetujuan as $item)
                                <div class="text-center btn" style="background-color: blue; width:100%">
                                    <p style="color: aliceblue; margin:auto">
                                        {{$item->tiket}}
                                    </p>
                                </div>    
                            @endforeach
                        </div>
                        <div class="col-sm-2 border rounded-bottom" style="height: 78vh; padding:5px">
                            @foreach ($lelang as $item)
                                <div class="text-center btn" style="background-color: blue; width:100%">
                                    <p style="color: aliceblue; margin:auto">
                                        {{$item->tiket}}
                                    </p>
                                </div>    
                            @endforeach
                        </div>
                        <div class="col-sm-2 border rounded-bottom" style="height: 78vh">
                            @foreach ($selesaiLelang as $item)
                                @if ($item->permohonans->barang->avg('status')<2)
                                    <div class="text-center btn" style="background-color: blue; width:100%">
                                        <p style="color: aliceblue; margin:auto">
                                            {{$item->tiket}}
                                        </p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="col-sm-2 border rounded-bottom" style="height: 78vh">
                            @foreach ($selesaiLelang as $item)
                                @if ($item->permohonans->barang->avg('status') === 2)
                                    <div class="text-center btn" style="background-color: blue; width:100%">
                                        <p style="color: aliceblue; margin:auto">
                                            {{$item->tiket}}
                                        </p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
   
    @endsection
