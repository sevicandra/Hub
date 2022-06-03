@extends('layout.pindai')
@section('contentpindai')

<div id="contentTable" class="row" style=" padding: 0; background-color:aliceblue">
    <div class="container-fluid" style="height:100%">
        <div class="row" style="height: 100%; border-radius:10px;">
            <div class="table table-light scrollable" style="padding: 0; height: 100%; background-color:aliceblue; min-height:fit-content; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                <table class="table table-hover table-responsive">
                    <tr
                        style="box-shadow: 0px 6px 6px rgba(0, 0, 0, 0.37); border: 1px solid rgba(77, 89, 202, 0.76); height: 50px">
                        <th>No</th>
                        <th>Nomor Surat</th>
                        <th>hal</th>
                        <th>Tanggal Surat</th>
                        <th>Satuan Kerja</th>
                        <th>Pemberitahuan Penilaian</th>
                        <th>Tanggal Pemberitahuan</th>
                        <th>Aksi</th>
                    </tr>
                    <?php $i = 1; ?>
                    @foreach ($data as $item)
                    <tr @if ($item->permohonan->tiket->penilaian === 0) style="background-color:green; color:white"
                        @endif>
                        <td>{{ $i }}</td>
                        <td>{{ $item->nomorSurat }}</td>
                        <td>{{ $item->hal }}</td>
                        <td>{{ indonesiaDate($item->tanggalSurat) }}</td>
                        <td>{{ $item->permohonan->satuanKerja->namaSatker }}</td>
                        @if (isset($item->pemberitahuanPenilaian))
                        <td>{{ $item->pemberitahuanPenilaian->nomorSurat }}</td>
                        <td>{{ indonesiaDate($item->pemberitahuanPenilaian->tanggalSurat) }}</td>
                        @else
                        <td></td>
                        <td></td>
                        @endif
                        <td style="max-width: 100px">
                            @if (isset($item->pemberitahuanPenilaian))
                            <form class="d-inline" action="penilaian/{{ $item->id }}">
                                <button type="submit" class="btn"><i class="bi bi-eye-fill"></i></button>
                            </form>
                            @endif
                            @if (!isset($item->pemberitahuanPenilaian))
                            <button onClick="dowloadusulanSKST('{{ $item->id }}')" type="button" class="btn d-inline"
                                data-bs-toggle="modal" data-bs-target="#dowloadusulanSKST"><i
                                    class="bi bi-download"></i></button>
                            @endif
                            @if (!isset($item->pemberitahuanPenilaian))
                            <button onClick="pemberitahuan('{{ $item->id }}')" type="button" class="btn d-inline"
                                data-bs-toggle="modal" data-bs-target="#pemberitahuanPenilaian"><i
                                    class="bi bi-send-fill"></i></i></button>
                            @endif
                            @if (!isset($item->pemberitahuanPenilaian->penyampaianLaporan))
                            @if ($item->permohonan->barang->count() ===
                            $item->permohonan->barang->where('laporan_penilaian_id', '!=', null)->count())
                            <button onClick="penyampaianLaporan('{{ $item->pemberitahuanPenilaian->id }}')"
                                class="btn d-inline" data-bs-toggle="modal" data-bs-target="#kirimLaporan"><i
                                    class="bi bi-send-check-fill"></i></button>
                            @endif
                            @endif
                            @if (isset($item->pemberitahuanPenilaian->penyampaianLaporan))
                            <form action="/cetak" method="POST" class="d-inline">
                                @csrf
                                <input type="text" value="{{ $item->pemberitahuanPenilaian->id }}" required hidden
                                    name="pemberitahuan_penilaian_id">
                                <button type="submit" class="btn" name="action" value="kajiulang"><i
                                        class="bi bi-cloud-download"></i></button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    <?php $i++; ?>
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
{{-- Modals Kirim Pemberitahuan Penilaian --}}
<div class="modal fade" id="pemberitahuanPenilaian" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form action="pemberitahuanpenilaian" method="POST">
                        @csrf
                        <div class="row">
                            <label for="nomorSurat" class="col-sm-4 col-form-label">Nomor Surat</label>
                            <div class="col-sm-8">
                                <input name="nomorSurat" class="form-control" type="text" required>
                            </div>
                        </div>
                        <div class="row">
                            <label for="tanggalSurat" class="col-sm-4 col-form-label">Tanggal</label>
                            <div class="col-sm-8">
                                <input name="tanggalSurat" type="date" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <label for="tanggalMulaiSurvei" class="col-sm-4 col-form-label">Tanggal Mulai Survei</label>
                            <div class="col-sm-8">
                                <input name="tanggalMulaiSurvei" class="form-control" type="date" required>
                            </div>
                        </div>
                        <div class="row">
                            <label for="tanggalSelesaiSurvei" class="col-sm-4 col-form-label">Tanggal Selesai
                                Survei</label>
                            <div class="col-sm-8">
                                <input name="tanggalSelesaiSurvei" class="form-control" type="date" required>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="col-sm-4" aria-label="Text with checkbox">Kirim Notifikasi?</label>
                            <div class="input-group-text" style="background: none; border:none">
                                <input name="kirimNotifikasi" class="form-check-input mt-0" type="checkbox">
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <button id="permohonan_penilaian_id" name="permohonan_penilaian_id" type="submit"
                                    class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Modals Kirim Pemberitahuan Penilaian --}}

{{-- Modals Download Usulan SK & ST --}}
<div class="modal fade" id="dowloadusulanSKST" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="row">
                        <div class="col-sm-12">ANGGOTA TIM</div>
                        <div id='anggotaTim'>

                        </div>
                    </div>
                    <form action="cetak" method="POST">
                        @csrf
                        <div class="row" id="namaTim">
                        </div>
                        <button id="tambahTim" class="btn" type="button"><i class="bi bi-plus-square"></i></i></button>
                        <div class="row">
                            <label for="lokasi" class="col-sm-4 col-form-label">lokasi</label>
                            <div class="col-sm-8">
                                <input name="lokasi" class="form-control" type="text" required>
                            </div>
                        </div>
                        <div class="row">
                            <label for="tanggalMulaiSurvei" class="col-sm-4 col-form-label">tanggal Mulai</label>
                            <div class="col-sm-8">
                                <input name="tanggalMulaiSurvei" class="form-control" type="date" required>
                            </div>
                        </div>
                        <div class="row">
                            <label for="tanggalSelesaiSurvei" class="col-sm-4 col-form-label">tanggal Selesai</label>
                            <div class="col-sm-8">
                                <input name="tanggalSelesaiSurvei" class="form-control" type="date" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8" hidden>
                                <input id='permohonan_id' name='permohonan_id' type="text" required>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary" name="action" value="SKST">Download Usulan
                                    SK & ST</button>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary" name="action" value="Jadwal">Penyampaian
                                    Jadwal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Akhir Modals Download Usulan SK & ST --}}

{{-- Modals Kirim Laporan Penilaian --}}
<div class="modal fade" id="kirimLaporan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form action="/penyampaianlaporan" method="POST">
                        @csrf
                        <div class="row">
                            <label for="nomorSurat" class="col-sm-4 col-form-label">Nomor Surat</label>
                            <div class="col-sm-8">
                                <input name="nomorSurat" class="form-control" type="text" required>
                            </div>
                        </div>
                        <div class="row">
                            <label for="tanggalSurat" class="col-sm-4 col-form-label">Tanggal</label>
                            <div class="col-sm-8">
                                <input name="tanggalSurat" type="date" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <button id="pemberitahuan_penilaian_id" name="pemberitahuan_penilaian_id" type="submit"
                                    class="btn btn-primary" value="">Simpan</button>
                            </div>
                        </div>
                    </form>
                    <div class="col-sm-6">
                        <form action="/cetak" method="post">
                            @csrf
                            <div hidden>
                                <input type="text" id="pemberitahuan_penilaian_id2" name="pemberitahuan_penilaian_id"
                                    required>
                            </div>
                            <button class="btn" name="action" value="penyampaianLaporan">download</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Akhir Modals Kirim Laporan Penilaian --}}

@endsection
@section('footpindai')
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
<script src="/js/pindai/permohonanPenilaian.js"></script>
@endsection