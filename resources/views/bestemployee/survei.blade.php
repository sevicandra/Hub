@extends('layout.bestemployee')

@section('headbestemployee')
<style>
    .input[type="radio"] {
        display: none;
    }
</style>
@endsection

@section('contentbestemployee')

<div class="row" style="text-align: center; min-height: 10%;max-height:fit-content; font-size:100%; color:#4d59cac2">
    <h2 style="font-size:2vw">
        @if (isset($data->listnominasi))
            PEMILIHAN BEST EMPLOYEE BULAN 
            @switch( $data->bulan)
                @case('01')
                    JANUARI
                    @break
                @case('02')
                    FEBRUARI
                    @break
                @case('03')
                    MARET
                    @break
                @case('04')
                    APRIL
                    @break
                @case('05')
                    MEI
                    @break
                @case('06')
                    JUNI
                    @break
                @case('07')
                    JULI
                    @break
                @case('08')
                    AGUSTUS
                    @break
                @case('09')
                    SEPTEMBER
                    @break
                @case('10')
                    OKTOBER
                    @break
                @case('11')
                    NOVEMBER
                    @break
                @case('12')
                    DESEMBER
                    @break
            @endswitch
            TAHUN {{ $data->tahun }}
        @else
            &nbsp       
        @endif
    </h2>
    <hr style="margin:0">
</div>
<div class="row" style="height: 90%;">
    <form action="pilih_best_employee" method='POST' style="height: 100%">
        <div class="scrollable" style="height: 90%; max-height: 90%; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
            @csrf
            @php
                $i=0
            @endphp
            @if (isset($data->listnominasi))
            @foreach ($data->listnominasi as $item)
            @if ($item->user->id != auth()->user()->id)
            @if (!$item->hasilPemilihan->where('user_id', auth()->user()->id)->first())
            <div
                style="color:#ffffff;background-color: #4A81E0; border-radius:10px; height:fit-content; padding-right: 10px; padding-left: 10px">
                <h3 style=" text-align:center">{{ $item->user->nama }}</h3>
                <input name="nominasi[]" type="text" value="{{ $item->id }}" hidden>
                <hr>
                <div>
                    <h4>Produktifitas Kerja</h4>
                    <hr>
                    @for ($i = 1; $i <= 10; $i++) <input required class="input" id="produktifitasKerja-{{ $item->id }}-{{ $i }}"
                        type="radio" name="produktifitasKerja[{{ $item->id }}]" value="{{ $i }}.{{ $item->id }}">
                        <label style="width: 10%; max-width:50px" for="produktifitasKerja-{{ $item->id }}-{{ $i }}">
                            <img style="width:100%" id="produktifitasKerja-{{ $item->id }}-{{ $i }}-ico"
                                src="best employee/img/ico/{{ $i }}.svg">
                        </label>
                        @endfor
                        <hr>
                </div>
                <div>
                    <h4>Kedisiplinan</h4>
                    <hr>
                    @for ($i = 1; $i <= 10; $i++) <input required class="input" id="kedisiplinan-{{ $item->id }}-{{ $i }}"
                        type="radio" name="kedisiplinan[{{ $item->id }}]" value="{{ $i }}.{{ $item->id }}">
                        <label style="width: 10%; max-width:50px" for="kedisiplinan-{{ $item->id }}-{{ $i }}">
                            <img style="width:100%" id="kedisiplinan-{{ $item->id }}-{{ $i }}-ico"
                                src="best employee/img/ico/{{ $i }}.svg">
                        </label>
                        @endfor
                        <hr>
                </div>
                <div>
                    <h4>Sikap Kerja</h4>
                    <hr>
                    @for ($i = 1; $i <= 10; $i++) <input required class="input" id="sikapKerja-{{ $item->id }}-{{ $i }}" type="radio"
                        name="sikapKerja[{{ $item->id }}]" value="{{ $i }}.{{ $item->id }}">
                        <label style="width: 10%; max-width:50px" for="sikapKerja-{{ $item->id }}-{{ $i }}">
                            <img style="width:100%" id="sikapKerja-{{ $item->id }}-{{ $i }}-ico"
                                src="best employee/img/ico/{{ $i }}.svg">
                        </label>
                        @endfor
                        <hr>
                </div>
            </div>
                @php
                    $i++
                @endphp
            @endif
            @endif
            @endforeach
            @endif
        </div>
        <div>
            @if ($i!=0)
            <div style="width: fit-content; margin:auto">
                <button type="submit" class="btn">Simpan</button>
            </div>
            @endif
        </div>
    </form>
</div>



@endsection