@extends('layout.bestemployee')

@section('headbestemployee')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('contentbestemployee')
<div class="row" style="text-align: center; min-height: 10%;max-height:fit-content; font-size:100%; color:#4d59cac2">
    <h2 style="font-size:2vw">Responden Survei Best Employee</h2>
    <hr style="margin:0">
</div>
<div class="row " style="height: 90%; padding: 0 10px 1% 10px">
    <div class="col-sm-3" style="height: 100%; padding:0">
        <div class="scrollable"
            style="border-radius: 11px 0 0 0;height: 90%; max-height:100%; padding: 0; margin:0; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none; background: linear-gradient(90deg, #92929286 99%, #ffffff 99%)">
            @foreach ($data as $item)
            <div class="periodePemilihan" onclick="detailResponden('{{ $item->id }}')" id="{{ $item->id }}"
                style="color:#ffffff;background-color: #142542; border-radius:11px 0 0 11px; min-height:10%;max-height:fit-content; width:99%; margin-bottom:0.5%; font-size:5vh; padding:0 10px">
                @switch($item->bulan)
                    @case('01')
                        Januari
                        @break
                    @case('02')
                        Februari
                        @break
                    @case('03')
                        Maret
                        @break
                    @case('04')
                        April
                        @break
                    @case('05')
                        Mei
                        @break
                    @case('06')
                        Juni
                        @break
                    @case('07')
                        Juli
                        @break
                    @case('08')
                        Agustus
                        @break
                    @case('09')
                        September
                        @break
                    @case('10')
                        Oktober
                        @break
                    @case('11')
                        November
                        @break
                    @case('12')
                        Desember
                        @break
                @endswitch
                {{ $item->tahun }}
            </div>
            @endforeach
        </div>
        <div style="height: 10%; border: solid 1px; width: 99%; padding-top: 5px; border-radius: 0 0 10px 10px">
            <div style="margin: auto; width:fit-content">
                
            </div>
        </div>
    </div>
    <div class="col-sm-9" style="height: 100%; background-color:#4A81E0; border-radius:0 10px 10px 0; padding: 0">
        <div class="scrollable" style="height: 90%; padding: 0 10px ; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
            <table style="min-height: fit-content;max-height:100%; width: 100%; color:white; text-align:center; margin: 10px 0">
                <thead style="min-height: fit-content">
                    <tr>
                        <th style="width: 10%">No</th>
                        <th style="width: 30%">Nama</th>
                    </tr>
                </thead>
                <tbody id="daftarResponden">

                </tbody>
            </table>
        </div>
        <div style="height: 10%"  @if (auth()->user()->jabatan === '01' ||auth()->user()->jabatan === '02' || auth()->user()->jabatan === '11') @else hidden @endif> 
            <div id="buttonSurvei" style="margin: auto; width:fit-content">
            </div>
        </div>
    </div>
</div>

@endsection

@section('footbestemployee')

<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
<script src="best employee/js/main.js"></script>
<script src="best employee/js/detailResponden.js"></script>
@endsection

