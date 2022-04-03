@extends('layout.main')

@section('content')
<div class="container-fluid" style="padding: 0px 37px 0px 37px; height:100%">
    <div class="container-fluid" style="border-radius: 10px; height:100%">
    <div class="row" style="height: 100%">
        <div class="col-sm-8" style="height: 100%; background-color:#6EE4FA; border: solid #ffffff;border-radius:10px">
            <div class="row" style="background-color: #3DA4B8; min-height: fit-content; max-height:fit-content; font-size:1vw; text-align:center; color:white; border-radius:10px 10px 0 0; border-bottom: solid #ffffff 2px">
                <h1>Daftar Pengguna Aplikasi</h1>
            </div>
            @foreach ($data as $item)
            <div onclick="userProfil('{{ $item->id }}')" class="row" style="min-height: 60px max-height:inherit; background-color:#6394FD; margin-top:5px; border-radius:10px; padding: 5px 0">
                <div class="col-sm-9" style="font-size: 1vw; color:white">
                    <h4>{{ $item->nama }} / {{ $item->NIP }}</h4>
                </div>
                <div class="col-sm-3 d-flex justify-content-end">
                    <form action="/user_management/{{ $item->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="height: fit-content">Nonaktifkan User</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-sm-4" style="height: 100%; background-color:#6EE4FA; border: solid #ffffff;border-radius:10px">
            <div class="row" style="background-color: #3DA4B8; min-height: fit-content; max-height:fit-content; font-size:1vw; text-align:center; color:white; border-radius:10px 10px 0 0; border-bottom: solid #ffffff 2px">
                <h1>Profil</h1>
            </div>
            <form id="updateProfil" action="" style="color: white; height:initial" method="POST">
                @method('PATCH')
                @csrf
                <div class="row scrollable" style="max-height: inherit">
                    <div class="mb-3" >
                        <label for="formGroupNama" class="form-label">
                            <h4 style="margin:0">Nama</h4>
                        </label>
                        <input name="Nama" type="text" class="form-control" id="formGroupNama">
                    </div>
                    <div class="mb-3">
                        <label for="formGroupNIP" class="form-label">
                            <h4 style="margin:0">NIP</h4>
                        </label>
                        <input name="NIP" type="text" class="form-control" id="formGroupNIP">
                    </div>
                    <div class="mb-3">
                        <label for="formGroupPangkatGolongan" class="form-label">
                            <h4 style="margin:0">Pangkat / Golongan</h4>
                        </label>
                        <select name="pangkatGolongan" id="formGroupPangkatGolongan" class="form-select">
                            <option selected hidden></option>
                            <option value="Pembina Tk.I / IV.b">Pembina Tk.I/ IV.b</option>
                            <option value="Pembina / IV.a">Pembina / IV.a</option>
                            <option value="Penata Tk.I / III.d">Penata Tk.I / III.d</option>
                            <option value="Penata / III.c">Penata / III.c</option>
                            <option value="Penata Muda Tk.I / III.b">Penata Muda Tk.I / III.b</option>
                            <option value="Penata Muda / III.a">Penata Muda / III.a</option>
                            <option value="Pengatur Tk.I / II.d">Pengatur Tk.I / II.d</option>
                            <option value="Pengatur / II.c">Pengatur / II.c</option>
                            <option value="Pengatur Muda Tk.I / II.b">Pengatur Muda Tk.I / II.b</option>
                            <option value="Pengatur Muda / II.a">Pengatur Muda / II.a</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formGroupJabatan" class="form-label">
                            <h4 style="margin:0">Jabatan</h4>
                        </label>
                        <select name="jabatan" id="formGroupJabatan" class="form-select" >
                            <option selected hidden></option>
                            <option value="01">Kepala Kantor</option>
                            <option value="02">Kepala Subbagian Umum</option>
                            <option value="03">Kepala Seksi Pengelolaan Kekayaan Negara</option>
                            <option value="04">Kepala Seksi Piutang Negara</option>
                            <option value="05">Kepala Seksi Hukum dan Informasi</option>
                            <option value="06">Kepala Seksi Kepatuhan Internal</option>
                            <option value="07">Fungsional Pelelang Ahli Muda</option>
                            <option value="08">Fungsional Penilai Pemerintah Ahli Muda</option>
                            <option value="09">Fungsional Pelelang Ahli Pertama</option>
                            <option value="10">Fungsional Penilai Pemerintah Ahli Pertama</option>
                            <option value="11">Pelaksana Subbagian Umum</option>
                            <option value="12">Pelaksana Seksi Pengelolaan Kekayaan Negara</option>
                            <option value="13">Pelaksana Seksi Piutang Negara</option>
                            <option value="14">Pelaksana Seksi Hukum dan Informasi</option>
                            <option value="15">Pelaskana Seksi Kepatuhan Internal</option>
                        </select>
                    </div>
                </div>
                <div style="height: fit-content" class="d-flex justify-content-center">
                    <button class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
@endsection

@section('foot')
    <script src="/usermanagement/js/index.js"></script>
@endsection