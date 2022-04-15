
@extends('layout.pindai')
@section('contentpindai')

            <div class="row" style="height:85%; padding: 0; background-color:aliceblue">
                <div class="container-fluid" style="height:100%">
                    <div class="row scrollable" style="height: 100%; border-radius:10px; min-height:fit-content; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                        <div class="table table-light" style="padding: 0; height: 100%; background-color:aliceblue">
                            <table class="table table-hover table-responsive">
                                <tr style="box-shadow: 0px 6px 6px rgba(0, 0, 0, 0.37); border: 1px solid rgba(77, 89, 202, 0.76); height: 50px">
                                    <th>No</th>
                                    <th>Surat Persetujuan</th>
                                    <th>Tanggal Surat</th>
                                    <th>Satuan Kerja</th>
                                    <th>Nilai Persetujuan</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php $i=1 ?>
                                @foreach ($data as $item)
                                    <tr @if ($item->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->tiket->persetujuan === 0)  
                                            @if ($item->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->barang->avg('status')<2)
                                                style="background-color:yellow"
                                            @elseif($item->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->barang->avg('status')===2)
                                                style="background-color:green; color:white"
                                            @endif
                                        @endif>
                                        <td>{{$i}}</td>
                                        <td>{{$item->nomorSurat}}</td>
                                        <td>{{indonesiaDate($item->tanggalSurat)}}</td>
                                        <td>{{$item->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker}}</td>
                                        <td>
                                            Rp{{number_format($item->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->barang->sum('nilaiLimit'), 2, ',', '.')}}  
                                        </td>
                                        <td style="max-width: 100px">
                                            <form action="/cetak" method="POST" class="d-inline">
                                                @csrf
                                                <input type="text" value="{{ $item->id }}" required hidden name="surat_persetujuan_id">
                                                <button type="submit" class="btn" name="action" value="potensiLelang"><i class="bi bi-cloud-download"></i></button>
                                            </form>
                                            <form class="d-inline" action="potensi_lelang/{{$item->id}}" method="get">
                                                <button type="submit" class="btn " style="color: green"><i class="bi bi-plus-square"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php $i++ ?>
                                @endforeach    
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row " style="margin: 10px 0 0 0;">
            </div>

@endsection

@section('footpindai')

    <script src="/js/pindai/nomorTiket.js"></script>

@endsection