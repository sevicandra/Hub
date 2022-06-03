
@extends('layout.pindai')
@section('contentpindai')

        <div id="contentTable" class="row" style=" padding: 0; background-color:aliceblue">
            <div class="container-fluid" style="height:100%">
                <div class="row" style="height: 100%; border-radius:10px;">
                    <div class="table table-light scrollable" style="padding: 0; height: 100%; background-color:aliceblue; min-height:fit-content; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                        <table class="table table-hover table-responsive">
                            <tr style="box-shadow: 0px 6px 6px rgba(0, 0, 0, 0.37); border: 1px solid rgba(77, 89, 202, 0.76); height: 50px">
                                <th>No</th>
                                <th>Nomor Penetapan</th>
                                <th>Tanggal Penetapan</th>
                                <th>Tanggal Lelang</th>
                                <th>Pemohon</th>
                                <th>Aksi</th>
                            </tr>
                            <?php $i=1 ?>
                            @foreach ($data as $item)
                                <tr @if ($item->status === 1) style="background-color:green; color:white" @endif>
                                    <td>{{$i}}</td>
                                    <td>{{$item->nomorSurat}}</td>
                                    <td>{{indonesiaDate($item->tanggalSurat)}}</td>
                                    <td>{{indonesiaDate($item->tanggalLelang)}}</td>
                                    @if ($item->permohonanLelang->jenis === 'App\Models\suratPersetujuan')
                                    <td>{{$item->permohonanLelang->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker}}</td>
                                    @elseif($item->permohonanLelang->jenis === 'App\Models\tiket')
                                    <td>{{ $item->permohonanLelang->pemohonLelang->pemohon }}</td>
                                    @endif
                                    <td style="max-width: 100px">
                                        <form action="/cetak" method="POST" class="d-inline">
                                            @csrf
                                            <input type="text" value="{{ $item->id }}" required hidden name="penetapan_lelang_id">
                                            <button type="submit" class="btn" name="action" value="salinanRisalah"><i class="bi bi-cloud-download"></i></button>
                                        </form>
                                        <form action="/penetapan_lelang/{{$item->id}}" method="GET">
                                            <button type="submit" class="btn" style="color:green"><i class="bi bi-eye-fill"></i></button>
                                        </form>
                                        @if ($item->permohonanLelang->jenis === 'App\Models\suratPersetujuan')
                                            @if (count($item->permohonanLelang->barang) === count($item->barangLelang))
                                                @if ($item->status != 1)
                                                <button onclick="kirimRisalah('{{$item->id}}')" class="btn" style="color:blue" data-bs-toggle="modal" data-bs-target="#kirimRisalah"><i class="bi bi-send-fill"></i></button>
                                                @endif   
                                            @endif
                                        @elseif($item->permohonanLelang->jenis === 'App\Models\tiket')
                                            @if (count($item->permohonanLelang->lotLelang) === count($item->risalahLotLelang))
                                                @if ($item->status != 1)
                                                    <button onclick="kirimRisalah('{{$item->id}}')" class="btn" style="color:blue" data-bs-toggle="modal" data-bs-target="#kirimRisalah"><i class="bi bi-send-fill"></i></button>
                                                @endif   
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <?php $i++ ?>
                            @endforeach    
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row position-relative" style="margin: 10px 0 0 0; height: 40px; width: 100%">
            <div class="position-absolute top-50 start-0 translate-middle-y" style="; width:fit-content">
                {{ $data->links() }}
            </div>
        </div>

@endsection
@section('modalpindai')
{{--  Modals Kirim Risalah  --}}
<div class="modal fade" id="kirimRisalah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <h1>Apa Anda Yakin Akan Mengirimkan Risalah ?</h1>
                    <form id="formKirimRisalah" action="" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{--  End of Modals Kirim Risalah  --}}
    
@endsection

@section('footpindai')
    <script src="/js/pindai/lelang.js"></script>
    <script>
        $(window).on('load', function(){
            var newHeight = window.innerHeight-(150+(window.innerHeight*0.1)); 
            $("#contentTable").css('height', newHeight)
        });
        window.addEventListener('resize', function(event){
            var newHeight = window.innerHeight-(150+(window.innerHeight*0.1));
            $(window).resize(function() {
                $("#contentTable").css('height', newHeight)
            });
        });
    </script>
@endsection