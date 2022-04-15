@extends('layout.main')
@section('content')
<div class="container-fluid" style="padding: 30px 37px 0px 37px; height:100%">
    <div class="container-fluid" style="border-radius: 10px; background-color:rgb(255, 255, 255); height:100%">
        <div class="row" style="padding-bottom: 10px">
            <div class="col-sm-1">
                <a href="/pindai">
                    <button class="btn translate-middle-y" style="background-color: #D8D4D4; color: #4d59ca"><i
                            class="bi bi-house-fill"></i></button>
                </a>
            </div>
            <div class="col-sm-2" style="width: fit-content">
                <div class="btn translate-middle-y" style="background-color:  #4d59ca; color:#D8D4D4">
                    {{ $data->tiket }}
                </div>
            </div>
        </div>
        <div class="row"
            style="width: 100; padding: 10px;background: rgba(239, 238, 238, 0.51); backdrop-filter: blur(1000px); border-radius: 10px; height:80px; margin: 10px; font-family:'TW CENT MT'">
            <div class="position-relative"
                style="width: 100%; height:initial; background-color:rgb(255, 255, 255); border-radius:10px">
                <div style="height: fit-content; width:fit-content">
                    @if ($data->jenis === 'PKN')
                        <h5 style="margin:0; padding:0">{{ $data->permohonans->satuanKerja->namaSatker }} <br> Operator : {{
                            $data->permohonans->satuanKerja->profil->namaOperator }} / {{
                            $data->permohonans->satuanKerja->profil->noTeleponOperator }}
                        </h5>
                    @elseif($data->jenis === 'LLG')
                        <h5 style="margin:0; padding:0">{{ $data->permohonanLelang->pemohonLelang->pemohon }} <br> PIC : {{
                            $data->permohonanLelang->pemohonLelang->PIC }} / {{
                            $data->permohonanLelang->pemohonLelang->kontakPemohon }}
                        </h5>
                    @endif
                </div>
            </div>
        </div>
        @if ($data->jenis === 'PKN')
            <div class="row tracking" style="margin: 10px;">
                <div
                    style="background: rgba(239, 238, 238, 0.5); border-radius: 10px; height:100%; width: 58%; margin-right:2%; padding:5px">
                    <div class="scrollable"
                        style="width: 100%; height:100%; background-color:white; border-radius:10px; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none; color:white; font-family:'TW CENT MT">
                        {{-- Permohonan Persetujuan --}}
                        @if (isset($data->permohonans))
                        <div onclick="detail('permohonanPersetujuan')"
                            style="width: 100%; height:fit-content;background: #5F6C8C; border-radius: 10px; padding:5px; margin-bottom:2px">
                            <div class="row">
                                <h6>Permohonan Persetujuan</h6>
                            </div>
                            <div class="row position-relative" style="height: 50px; margin: 5px">
                                <div class="progress position-absolute top-50 start-50 translate-middle">
                                    <div class="progress-bar" role="progressbar" style="width: 
                                    @if ($data->permohonans->permohonanPenilaian)
                                    100%
                                    @elseif($data->permohonans->barang->first())
                                    50%
                                    @elseif($data->permohonans)
                                    0%
                                    @endif
                                    
                                    ; background-color: #43D2F1" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                @if (isset($data->permohonans))
                                <div class="position-absolute top-50 start-0 translate-middle-y"
                                    style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white;">1
                                </div>
                                @else
                                <div class="position-absolute top-50 start-0 translate-middle-y"
                                    style="background: #C4C4C4; border-radius: 50px; height:50px;width:50px; color:white;">1
                                </div>
                                @endif
                                @if ($data->permohonans->barang->first())
                                <div class="progress position-absolute top-50 start-50 translate-middle"
                                    style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white">2
                                </div>
                                @else
                                <div class="progress position-absolute top-50 start-50 translate-middle"
                                    style="background: #C4C4C4; border-radius: 50px; height:50px;width:50px; color:white">2
                                </div>
                                @endif
                                @if ($data->permohonans->permohonanPenilaian)
                                <div class="position-absolute top-50 end-0 translate-middle-y"
                                    style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white">3
                                </div>
                                @else
                                <div class="position-absolute top-50 end-0 translate-middle-y"
                                    style="background: #C4C4C4; border-radius: 50px; height:50px;width:50px; color:white">3
                                </div>
                                @endif
                            </div>
                            <div>
                                <p>
                                    1. Permohonan Diterima <br>
                                    2. Input Barang <br>
                                    3. Permohonan Penilaian
                                </p>
                            </div>
                        </div>
                        {{-- Akhir Permohonan Persetujuan --}}
                        @if ($data->permohonans->permohonanPenilaian)
                        {{-- Penilaian --}}
                        <div onclick="detail('Penilaian')"
                            style="width: 100%; height:fit-content;background: #5F6C8C; border-radius: 10px; padding:5px; margin-bottom:2px">
                            <div class="row">
                                <h6>Penilaian</h6>
                            </div>
                            <div class="row position-relative" style="height: 50px; margin: 5px">
                                @if ($data->permohonans->permohonanPenilaian)
                                @if ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian)
                                @if ($data->permohonans->barang->count() ===
                                $data->permohonans->barang->where('laporan_penilaian_id', '!=', null)->count())
                                @if(isset($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan))
                                <div class="progress position-absolute top-50 start-50 translate-middle">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: 100%; background-color: #43D2F1" aria-valuenow="0" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @else
                                <div class="progress position-absolute top-50 start-50 translate-middle">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: 75%; background-color: #43D2F1" aria-valuenow="0" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @endif
                                @else
                                <div class="progress position-absolute top-50 start-50 translate-middle">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: 25%; background-color: #43D2F1" aria-valuenow="0" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @endif
                                @else
                                <div class="progress position-absolute top-50 start-50 translate-middle">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: 0%; background-color: #43D2F1" aria-valuenow="0" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @endif
                                @endif
                                @if ($data->permohonans->permohonanPenilaian)
                                <div class="position-absolute top-50 start-0 translate-middle-y"
                                    style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white;">1
                                </div>
                                @if ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian)
                                <div class="progress position-absolute top-50 translate-middle-y"
                                    style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white; left:25%">
                                    2</div>
                                @if ($data->permohonans->barang->count() === $data->permohonans->barang->where('laporan_penilaian_id', '!=', null)->count())
                                <div class="position-absolute top-50 translate-middle-y"
                                    style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white; right:25%">
                                    3</div>
                                @if(isset($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan))
                                <div class="position-absolute top-50 end-0 translate-middle-y"
                                    style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white">4
                                </div>
                                @else
                                <div class="position-absolute top-50 end-0 translate-middle-y"
                                    style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white">4
                                </div>
                                @endif
                                @else
                                <div class="position-absolute top-50 translate-middle-y"
                                    style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white; right:25%">
                                    3</div>
                                <div class="position-absolute top-50 end-0 translate-middle-y"
                                    style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white">4
                                </div>
                                @endif
                                @else
                                <div class="progress position-absolute top-50 translate-middle-y"
                                    style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white; left:25%">
                                    2</div>
                                <div class="position-absolute top-50 translate-middle-y"
                                    style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white; right:25%">
                                    3</div>
                                <div class="position-absolute top-50 end-0 translate-middle-y"
                                    style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white">4
                                </div>
                                @endif
                                @else
                                <div class="position-absolute top-50 start-0 translate-middle-y"
                                    style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white;">1
                                </div>
                                <div class="progress position-absolute top-50 translate-middle-y"
                                    style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white; left:25%">
                                    2</div>
                                <div class="position-absolute top-50 translate-middle-y"
                                    style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white; right:25%">
                                    3</div>
                                <div class="position-absolute top-50 end-0 translate-middle-y"
                                    style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white">4
                                </div>
                                @endif
                            </div>
                            <div>
                                <p>
                                    1. Permohonan Penilaian <br>
                                    2. Penyampaian Jadwal <br>
                                    3. Input Laporan <br>
                                    4. Penyampaian Laporan
                                </p>
                            </div>
                        </div>
                        {{-- Akhir Penilaian --}}
                        @if ($data->permohonans->permohonanPenilaian)
                        @if ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian)
                        @if ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan)
                        {{-- Persetujuan --}}
                        <div onclick="detail('Persetujuan')"
                            style="width: 100%; height:fit-content;background: #5F6C8C; border-radius: 10px; padding:5px; margin-bottom:2px">
                            <div class="row">
                                <h6>Persetujuan</h6>
                            </div>
                            <div class="row position-relative" style="height: 50px; margin: 5px">
                                <div class="progress position-absolute top-50 start-50 translate-middle">
                                    @if($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan->suratPersetujuan)
                                    <div class="progress-bar" style="width: 100%; background-color: #43D2F1"
                                        role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    @else
                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                    @endif
                                </div>
                                <div class="position-absolute top-50 start-0 translate-middle-y"
                                    style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white;">1
                                </div>

                                @if ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan->suratPersetujuan)
                                <div class="position-absolute top-50 end-0 translate-middle-y"
                                    style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white">2
                                </div>
                                @else
                                <div class="position-absolute top-50 end-0 translate-middle-y"
                                    style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white">2
                                </div>
                                @endif
                            </div>
                            <div>
                                <p>
                                    1. Penyampaian Laporan Penilaian <br>
                                    2. Persetujuan <br>
                                </p>
                            </div>
                        </div>
                        {{-- Akhir Persetujuan --}}
                        @if($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan->suratPersetujuan)
                        @if($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan->suratPersetujuan->permohonanLelang->first()
                        != null)
                        {{-- Lelang --}}
                        @foreach($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan->suratPersetujuan->permohonanLelang as $item)
                        <div onclick="detail('Lelang{{ $item->id }}')"
                            style="width: 100%; height:fit-content;background: #5F6C8C; border-radius: 10px; padding:5px; margin-bottom:2px">
                            <div class="row">
                                <h6>Lelang</h6>
                            </div>
                            <div class="row position-relative" style="height: 50px; margin: 5px">
                                <div class="progress position-absolute top-50 start-50 translate-middle">
                                    @if ($item->penetapanLelang)
                                    @if (count($item->penetapanLelang->permohonanLelang->barang) === count($item->penetapanLelang->barangLelang))
                                    @if ($item->penetapanLelang->status === 1)
                                    <div class="progress-bar" style="width: 100%;background: #43D2F1" role="progressbar"
                                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    @else
                                    <div class="progress-bar" style="width: 75%;background: #43D2F1" role="progressbar"
                                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    @endif
                                    @else
                                    <div class="progress-bar" style="width: 25%;background: #43D2F1" role="progressbar"
                                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    @endif
                                    @else
                                    <div class="progress-bar" style="width: 0%;background: #43D2F1" role="progressbar"
                                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    @endif

                                </div>
                                <div class="position-absolute top-50 start-0 translate-middle-y"
                                    style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white;">1
                                </div>
                                @if ($item->penetapanLelang)
                                <div class="progress position-absolute top-50 translate-middle-y"
                                    style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white; left:25%">
                                    2</div>
                                @if (count($item->penetapanLelang->permohonanLelang->barang) === count($item->penetapanLelang->barangLelang))
                                <div class="position-absolute top-50 translate-middle-y"
                                    style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white; right:25%">
                                    3</div>
                                @if ($item->penetapanLelang->status === 1)
                                <div class="position-absolute top-50 end-0 translate-middle-y"
                                    style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white">4
                                </div>
                                @else
                                <div class="position-absolute top-50 end-0 translate-middle-y"
                                    style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white">4
                                </div>
                                @endif
                                @else
                                <div class="position-absolute top-50 translate-middle-y"
                                    style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white; right:25%">
                                    3</div>
                                <div class="position-absolute top-50 end-0 translate-middle-y"
                                    style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white">4
                                </div>
                                @endif

                                @else
                                <div class="progress position-absolute top-50 translate-middle-y"
                                    style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white; left:25%">
                                    2</div>
                                <div class="position-absolute top-50 translate-middle-y"
                                    style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white; right:25%">
                                    3</div>
                                <div class="position-absolute top-50 end-0 translate-middle-y"
                                    style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white">4
                                </div>
                                @endif
                            </div>
                            <div>
                                <p>
                                    1. Permohonan Lelang <br>
                                    2. Penetapan Lelang <br>
                                    3. Input Risalah <br>
                                    4. Penyampaian Risalah
                                </p>
                            </div>
                        </div>
                        @endforeach
                        {{-- Akhir Lelang --}}
                        @endif
                        @endif
                        @endif
                        @endif
                        @endif
                        @endif
                        @endif
                    </div>
                </div>
                <div
                    style="background: rgba(239, 238, 238, 0.5); border-radius: 10px; height:100%; width: 40%; padding:5px">
                    <div id="permohonanPersetujuan" class="scrollable detailTracking"
                        style="display:none;width: 100%; height:100%; background-color:#5F6C8C; border-radius:10px; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none; color:white; font-family:'TW CENT MT">
                        @if (isset($data->permohonans))
                        <div class="row" style="width:100%; margin: 0">
                            <h5 style="text-align:center">Permohonan Persetujuan</h5>
                            <hr style="margin:8px 0">
                            <table style="width: 100%">
                                <tr>
                                    <td>Nomor Surat</td>
                                    <td>{{ $data->permohonans->nomorSurat }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Surat</td>
                                    <td>{{ indonesiaDate($data->permohonans->tanggalSurat) }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal di Terima</td>
                                    <td>{{ indonesiaDate($data->permohonans->tanggalDiTerima) }}</td>
                                </tr>
                            </table>
                            <hr style="margin:8px 0">
                        </div>
                        @if ($data->permohonans->barang->first())
                        <div class="row" style="width:100%; margin: 0">
                            <h5 style="text-align:center">Daftar Barang</h5>
                            <hr style="margin:8px 0">
                            <table style="width: 100%">
                                @php
                                $i=1;
                                @endphp
                                @foreach ($data->permohonans->barang as $item)
                                <tr>
                                    <td style="width: 30px; text-align:center">{{ $i }}</td>
                                    <td>
                                        {{ $item->kodeBarangs->namaBarang }}
                                        NUP {{ $item->NUP }}
                                    </td>
                                </tr>
                                @php
                                $i++;
                                @endphp
                                @endforeach
                            </table>
                            <hr style="margin:8px 0">
                        </div>
                        @endif
                        @if ($data->permohonans->permohonanPenilaian)
                        <div class="row" style="width:100%; margin: 0">
                            <h5 style="text-align:center">Permohonan Penilaian</h5>
                            <hr style="margin:8px 0">
                            <table style="width: 100%">
                                <tr>
                                    <td>Nomor Surat</td>
                                    <td>{{ $data->permohonans->permohonanPenilaian->nomorSurat }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Surat</td>
                                    <td>{{ indonesiaDate($data->permohonans->permohonanPenilaian->tanggalSurat) }}</td>
                                </tr>
                            </table>
                            <hr style="margin:8px 0">
                        </div>
                        @endif
                        @endif
                    </div>
                    @if ($data->permohonans->permohonanPenilaian)
                    <div id="Penilaian" class="scrollable detailTracking"
                        style="display:none;width: 100%; height:100%; background-color:#5F6C8C; border-radius:10px; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none; color:white; font-family:'TW CENT MT">
                        <div class="row" style="width:100%; margin: 0">
                            <h5 style="text-align:center">Permohonan Penilaian</h5>
                            <hr style="margin:8px 0">
                            <table style="width: 100%">
                                <tr>
                                    <td>Nomor Surat</td>
                                    <td>{{ $data->permohonans->permohonanPenilaian->nomorSurat }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Surat</td>
                                    <td>{{ indonesiaDate($data->permohonans->permohonanPenilaian->tanggalSurat) }}</td>
                                </tr>
                            </table>
                            <hr style="margin:8px 0">
                        </div>
                        @if ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian)
                        <div class="row" style="width:100%; margin: 0">
                            <h5 style="text-align:center">Pemberitahuan Penilaian</h5>
                            <hr style="margin:8px 0">
                            <table style="width: 100%">
                                <tr>
                                    <td>Nomor Surat</td>
                                    <td>{{ $data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->nomorSurat }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Surat</td>
                                    <td>{{ indonesiaDate($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->tanggalSurat) }}
                                    </td>
                                </tr>
                            </table>
                            <hr style="margin:8px 0">
                        </div>
                        @if ($data->permohonans->barang->count() ===
                        $data->permohonans->barang->where('laporan_penilaian_id', '!=', null)->count())
                        <div class="row" style="width:100%; margin: 0">
                            <h5 style="text-align:center">Laporan Penilaian</h5>
                            <hr style="margin:8px 0">
                            <table style="width: 100%">
                                @php
                                $i=1;
                                @endphp
                                @foreach ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->laporanPenilaian
                                as $item)
                                <tr>
                                    <td style="width: 10%; text-align:center">{{ $i }}</td>
                                    <td>{{ $item->nomorLaporan }}</td>
                                    <td>{{ indonesiaDate($item->tanggalLaporan) }}</td>
                                </tr>
                                @php
                                $i++
                                @endphp
                                @endforeach
                            </table>
                            <hr style="margin:8px 0">
                        </div>
                        @endif
                        @if (isset($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan))
                        <div class="row" style="width:100%; margin: 0">
                            <h5 style="text-align:center">Penyampaian Laporan</h5>
                            <hr style="margin:8px 0">
                            <table style="width: 100%">
                                <tr>
                                    <td>Nomor Surat</td>
                                    <td>{{
                                        $data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan->nomorSurat
                                        }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Surat</td>
                                    <td>{{
                                        indonesiaDate($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan->tanggalSurat)
                                        }}</td>
                                </tr>
                            </table>
                            <hr style="margin:8px 0">
                        </div>
                        @endif
                        @endif
                    </div>
                    @endif
                    @if ($data->permohonans->permohonanPenilaian)
                    @if ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian)
                    @if ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan)
                    <div id="Persetujuan" class="scrollable detailTracking"
                        style="display:none;width: 100%; height:100%; background-color:#5F6C8C; border-radius:10px; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none; color:white; font-family:'TW CENT MT">
                        <div class="row" style="width:100%; margin: 0">
                            <h5 style="text-align:center">Penyampaian Laporan</h5>
                            <hr style="margin:8px 0">
                            <table style="width: 100%">
                                <tr>
                                    <td>Nomor Surat</td>
                                    <td>{{
                                        $data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan->nomorSurat
                                        }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Surat</td>
                                    <td>{{
                                        indonesiaDate($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan->tanggalSurat)
                                        }}</td>
                                </tr>
                            </table>
                            <hr style="margin:8px 0">
                        </div>
                        @if($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan->suratPersetujuan)
                        <div class="row" style="width:100%; margin: 0">
                            <h5 style="text-align:center">Surat Persetujuan</h5>
                            <hr style="margin:8px 0">
                            <table style="width: 100%">
                                <tr>
                                    <td>Nomor Surat</td>
                                    <td>{{
                                        $data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan->suratPersetujuan->nomorSurat
                                        }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Surat</td>
                                    <td>{{
                                        indonesiaDate($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan->suratPersetujuan->tanggalSurat)
                                        }}</td>
                                </tr>
                            </table>
                            <hr style="margin:8px 0">
                        </div>
                        <div class="row" style="width:100%; margin: 0">
                            <h5 style="text-align:center">Detail Persetujuan</h5>
                            <hr style="margin:8px 0">
                            <div style="width: 100%; overflow:auto">
                                <table 
                                    style=" width:200%; color:white; font-family:'TW CENT MT'">
                                    <thead>
                                        <tr>
                                            <td style=" max-width: 5%">No</td>
                                            <td style="max-width: 19%">Kode Barang</td>
                                            <td style="max-width: 19%">Nama Barang</td>
                                            <td style="max-width: 19%">NUP</td>
                                            <td style="max-width: 19%">Nilai Wajar</td>
                                            <td style="max-width: 19%">Nilai Limit</td>
                                        </tr>
                                    </thead>
                                    <tbody id="listNilaiLimit">
                                        @php
                                        $i=1;
                                        @endphp
                                        @foreach ($data->permohonans->barang as $item)
                                        <tr>
                                            <td style="max-width: 5%">{{ $i }}</td>
                                            <td style="max-width: 19%">{{ $item->kodeBarang }}</td>
                                            <td style="max-width: 19%">{{ $item->kodeBarangs->namaBarang }}</td>
                                            <td style="max-width: 19%">{{ $item->NUP }}</td>
                                            <td style="max-width: 19%">Rp{{ number_format($item->nilaiWajar, 2, ',', '.') }}</td>
                                            <td style="max-width: 19%">Rp{{ number_format($item->nilaiLimit, 2, ',', '.') }}</td>
                                        </tr>
                                        @php
                                        $i++;
                                        @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr style="margin:8px 0">
                        </div>
                        @endif
                    </div>
                    @endif
                    @endif
                    @endif
                    @if ($data->permohonans->permohonanPenilaian)
                    @if ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian)
                    @if ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan)
                    @if ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan->suratPersetujuan)
                    @if ($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan->suratPersetujuan->permohonanLelang)
                    @foreach($data->permohonans->permohonanPenilaian->pemberitahuanPenilaian->penyampaianLaporan->suratPersetujuan->permohonanLelang
                    as $item)
                    <div id="Lelang{{ $item->id }}" class="scrollable detailTracking"
                        style="display:none;width: 100%; height:100%; background-color:#5F6C8C; border-radius:10px; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none; color:white; font-family:'TW CENT MT">
                        <div class="row" style="width:100%; margin: 0">
                            <h5 style="text-align:center">Permohonan Lelang</h5>
                            <hr style="margin:8px 0">
                            <table style="width: 100%">
                                <tr>
                                    <td>Nomor Surat</td>
                                    <td>{{ $item->nomorSurat }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Surat</td>
                                    <td>{{ indonesiaDate($item->tanggalSurat) }}</td>
                                </tr>
                            </table>
                            <hr style="margin:8px 0">
                        </div>
                        @if ($item->penetapanLelang)
                        <div class="row" style="width:100%; margin: 0">
                            <h5 style="text-align:center">Penetapan Lelang</h5>
                            <hr style="margin:8px 0">
                            <table style="width: 100%">
                                <tr>
                                    <td>Nomor Surat</td>
                                    <td>{{ $item->penetapanLelang->nomorSurat }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Surat</td>
                                    <td>{{ indonesiaDate($item->penetapanLelang->tanggalSurat) }}</td>
                                </tr>
                            </table>
                            <hr style="margin:8px 0">
                        </div>
                        @if ($item->penetapanLelang->risalah)
                        @foreach ($item->penetapanLelang->risalah as $item)
                        <div class="row" style="width:100%; margin: 0;">
                            <h5 style="text-align:center">Risalah Lelang Nomor {{ $item->nomor }}</h5>
                            <hr style="margin:8px 0">
                            <div style="width: 100%; overflow:auto">
                                <table style="width: 200%">
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>NUP</th>
                                        <th>Status</th>
                                    </tr>
                                    @php
                                    $i=1;
                                    @endphp
                                    @foreach ($item->barangLelang as $barang)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $barang->barang->kodeBarang }}</td>
                                        <td>{{ $barang->barang->kodeBarangs->namaBarang }}</td>
                                        <td>{{ $barang->barang->NUP }}</td>
                                        <td>
                                            @switch($barang->status)
                                            @case(1)
                                            Laku
                                            @break
                                            @case(2)
                                            Wanprestasi
                                            @break
                                            @case(3)
                                            TAP
                                            @break
                                            @default
                                            @endswitch
                                        </td>
                                    </tr>
                                    @php
                                    $i++;
                                    @endphp
                                    @endforeach
                                </table>

                            </div>
                            <hr style="margin:8px 0">
                        </div>
                        @endforeach
                        @endif
                        @endif
                    </div>
                    @endforeach
                    @endif
                    @endif
                    @endif
                    @endif
                    @endif
                </div>
            </div>
        @elseif($data->jenis === 'LLG')
            <div class="row tracking" style="margin: 10px;">
                <div style="background: rgba(239, 238, 238, 0.5); border-radius: 10px; height:100%; width: 58%; margin-right:2%; padding:5px">
                    <div class="scrollable"
                        style="width: 100%; height:100%; background-color:white; border-radius:10px; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none; color:white; font-family:'TW CENT MT">
                        {{-- Lelang --}}
                        <div  style="width: 100%; height:fit-content;background: #5F6C8C; border-radius: 10px; padding:5px; margin-bottom:2px">
                            <div class="row">
                                <h6>Lelang</h6>
                            </div>
                            <div class="row position-relative" style="height: 50px; margin: 5px">
                                <div class="progress position-absolute top-50 start-50 translate-middle">
                                    <div class="progress-bar" role="progressbar" style="width: 
                                        @if ($data->permohonanLelang->PenetapanLelang->status === 1)
                                        100%
                                        @elseif($data->permohonanLelang->PenetapanLelang->risalah->first())
                                        75%
                                        @elseif($data->permohonanLelang->PenetapanLelang)
                                        25%
                                        @endif
                                        
                                        ; background-color: #43D2F1" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <div class="position-absolute top-50 start-0 translate-middle-y" style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white;">1</div>
                                @if ($data->permohonanLelang->PenetapanLelang)
                                    <div class="position-absolute top-50 translate-middle-y" style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white; left:25%">2</div>
                                    @if ($data->permohonanLelang->PenetapanLelang->risalah->first())
                                        <div class="position-absolute top-50 translate-middle-y" style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white; left:75%">3</div>
                                        @if ($data->permohonanLelang->PenetapanLelang->status === 1)
                                            <div class="position-absolute top-50 end-0 translate-middle-y" style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white;">4</div>
                                        @else
                                            <div class="position-absolute top-50 end-0 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white;">4</div>
                                        @endif
                                    @else
                                        <div class="position-absolute top-50 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white; left:75%">3</div>
                                        <div class="position-absolute top-50 end-0 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white;">4</div>
                                    @endif
                                @else
                                    <div class="position-absolute top-50 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white; left:25%">2</div>
                                    <div class="position-absolute top-50 translate-middle-y" style="background: #43D2F1; border-radius: 50px; height:50px;width:50px; color:white; left:75%">3</div>
                                    <div class="position-absolute top-50 end-0 translate-middle-y" style="background: #c4c4c4; border-radius: 50px; height:50px;width:50px; color:white;">4</div>
                                @endif

                            </div>
                            <div>
                                <p>
                                    1. Permohonan Lelang <br>
                                    2. Penetapan Lelang <br>
                                    3. Input Risalah <br>
                                    4. Penyampaian Risalah
                                </p>
                            </div>
                        </div>

                        {{-- Akhir Lelang --}}
                    </div>
                </div>
                <div style="background: rgba(239, 238, 238, 0.5); border-radius: 10px; height:100%; width: 40%; padding:5px">
                    <div id="Lelang{{ $data->id }}" class="scrollable"
                        style=";width: 100%; height:100%; background-color:#5F6C8C; border-radius:10px; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none; color:white; font-family:'TW CENT MT">
                        <div class="row" style="width:100%; margin: 0">
                            <h5 style="text-align:center">Permohonan Lelang</h5>
                            <hr style="margin:8px 0">
                            <table style="width: 100%">
                                <tr>
                                    <td>Nomor Surat</td>
                                    <td>{{ $data->permohonanLelang->nomorSurat }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Surat</td>
                                    <td>{{ indonesiaDate($data->permohonanLelang->tanggalSurat) }}</td>
                                </tr>
                            </table>
                            <hr style="margin:8px 0">
                        </div>
                        @if ($data->permohonanLelang->penetapanLelang)
                        <div class="row" style="width:100%; margin: 0">
                            <h5 style="text-align:center">Penetapan Lelang</h5>
                            <hr style="margin:8px 0">
                            <table style="width: 100%">
                                <tr>
                                    <td>Nomor Surat</td>
                                    <td>{{ $data->permohonanLelang->penetapanLelang->nomorSurat }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Surat</td>
                                    <td>{{ indonesiaDate($data->permohonanLelang->penetapanLelang->tanggalSurat) }}</td>
                                </tr>
                            </table>
                            <hr style="margin:8px 0">
                        </div>
                        @if ($data->permohonanLelang->penetapanLelang->risalah)
                        @foreach ($data->permohonanLelang->penetapanLelang->risalah as $item)
                        <div class="row" style="width:100%; margin: 0;">
                            <h5 style="text-align:center">Risalah Lelang Nomor {{ $item->nomor }}</h5>
                            <hr style="margin:8px 0">
                            <div style="width: 100%;">
                                <table style="width: 100%">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lot</th>
                                        <th>Status</th>
                                    </tr>
                                    @php
                                    $i=1;
                                    @endphp
                                    @foreach ($item->risalahLotLelang as $barang)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $barang->lotLelang->namaLot }}</td>
                                        <td>
                                            @switch($barang->status)
                                            @case(1)
                                            Laku
                                            @break
                                            @case(2)
                                            Wanprestasi
                                            @break
                                            @case(3)
                                            TAP
                                            @break
                                            @default
                                            @endswitch
                                        </td>
                                    </tr>
                                    @php
                                    $i++;
                                    @endphp
                                    @endforeach
                                </table>

                            </div>
                            <hr style="margin:8px 0">
                        </div>
                        @endforeach
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@endsection
@section('foot')
@if ($data->jenis === 'PKN')
<script>
    function detail(params) {
        console.log(params);
        $('.detailTracking').css('display', 'none');
        $('#'+params).css('display', 'block')
    }
</script>
@elseif($data->jenis === 'LLG')

@endif
<script>
    $(window).on('load', function(){
        var newHeight = window.innerHeight-(200+(window.innerHeight*0.1)); 
        $(".tracking").css('height', newHeight)
    });
    window.addEventListener('resize', function(event){
        var newHeight = window.innerHeight-(200+(window.innerHeight*0.1)); 
        $(window).resize(function() {
            $(".tracking").css('height', newHeight)
        });
    });
</script>

@endsection