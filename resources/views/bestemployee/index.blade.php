@extends('layout.bestemployee')

@section('headbestemployee')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('contentbestemployee')
<div class="row" style="text-align: center; min-height: 10%;max-height:fit-content; font-size:100%; color:#4d59cac2">
    <h2 style="font-size:2vw">Hasil Survei Best Employee</h2>
    <hr style="margin:0">
</div>
<div class="row " style="height: 90%; padding: 0 10px 1% 10px">
    <div class="col-sm-3" style="height: 100%; padding:0">
        <div class="scrollable"
            style="border-radius: 10px 10px 0 0;height: 90%; max-height:100%; padding: 0; margin:0; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none; background: linear-gradient(90deg, #92929286 99%, #ffffff 99%)">
            @foreach ($data as $item)
            <div class="periodePemilihan" onclick="detailPemilihan('{{ $item->id }}')" id="{{ $item->id }}"
                style="color:#ffffff;background-color: #142542; border-radius:11px; min-height:10%;max-height:fit-content; width:99%; margin-bottom:0.5%; font-size:5vh; padding:0 10px">
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
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#pemilihanBestEmployee">Tamban
                    Periode Survei</button>
            </div>
        </div>
    </div>
    <div class="col-sm-9" style="height: 100%; background-color:#4A81E0; border-radius:10px; padding: 0">
        <div style="height: 90%; padding: 0 10px">
            <table style="height: fit-content;max-height:100%; width: 100%; color:white; text-align:center; margin: 10px 0">
                <thead style="min-height: fit-content">
                    <tr>
                        <th style="width: 10%">No</th>
                        <th style="width: 40%">Nama</th>
                        <th style="width: 10%">Produktifitas Kerja</th>
                        <th style="width: 10%">Kedisiplinan</th>
                        <th style="width: 10%">Sikap Kerja</th>
                        <th style="width: 10%">Rata-Rata Nilai</th>
                        @if ( auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan === '11' )
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody id="daftarNominasi">

                </tbody>
            </table>
        </div>
        <div style="height: 10%"  @if (auth()->user()->jabatan === '02' || auth()->user()->jabatan === '11') @else hidden @endif> 
            <div id="buttonSurvei" style="margin: auto; width:fit-content">
            </div>
        </div>
    </div>
</div>

@endsection

@section('footbestemployee')
@if (auth()->user()->jabatan === '02' || auth()->user()->jabatan === '11') 
{{-- Modal Input Pemilihan Best Employee --}}
<div class="modal fade" id="pemilihanBestEmployee" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border: none; border-radius:10px">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form action="best_employee" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="bulan">Bulan</span>
                            <select name="bulan" id="" aria-describedby="bulan" class="form-select" required>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="tahun">Tahun</span>
                            <select name="tahun" id="" aria-describedby="tahun" class="form-select" required>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                            </select>
                        </div>
                        <div>
                            <div style="margin:auto; width:fit-content">
                                <button class="btn">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Akhir Modal Input Pemilihan Best Employee --}}
{{-- Modal Input Pemilihan Best Employee --}}
<div class="modal bd-example-modal-xl" id="pemilihanNominasi" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content " style="border: none; border-radius:10px">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form id="formNominasi" action="" method="POST">
                        @csrf
                        @method('PATCH')
                        <table style="width: 100%">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col"></th>
                                <th scope="col">Nama</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Pangkat / Golongan</th>
                            </tr>
                            @php
                            $i=1;
                            @endphp
                            @foreach ($nominasi as $item)
                            <tr>
                                <td>{{$i}}</td>
                                <td><input name="nominasi[]" type="checkbox" value="{{$item->id}}"></td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->NIP}}</td>
                                <td>{{$item->pangkatGolongan}}</td>
                            </tr>
                            <?php $i++ ?>
                            @endforeach
                        </table>
                        <div>
                            <div style="margin:auto; width:fit-content">
                                <button name="action" value="nominasi" type="submit" class="btn">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Akhir Modal Input Pemilihan Best Employee --}}
@endif
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
<script src="best employee/js/main.js"></script>
<script src="best employee/js/detailPemilihan.js"></script>
@endsection

