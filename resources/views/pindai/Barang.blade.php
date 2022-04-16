
@extends('layout.main')
@section('content')
<div class="container-fluid" style="padding: 30px 37px 9px 37px; height:100%">
    <div class="container-fluid" style="border-radius: 10px; background-color:darkgrey; height:100% ">
        <div class="row" style="padding-bottom: 10px">
            <div class="col-sm-1">
                <a href="/permohonan">
                    <button class="btn btn-primary translate-middle-y"><i class="bi bi-caret-left-fill"></i></button>
                </a>
            </div>
            <div class="col-sm-2">
                <div class="btn btn-primary translate-middle-y" style="width: 100%">Daftar Barang</div>
            </div>
        </div>
        <div class="row" style="height:85%; padding: 0 40px 0px 40px">
            <div class="container-fluid" style="height: 100%;">
                <div class="row" style="height: 100%; background-color:aliceblue; border-radius:10px;">
                    <div class="scrollable" style="max-height: 100%; min-height:fit-content; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                        <table class="table table-hover" style="max-height: 100%; min-height:fit-content">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">NUP</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Merk/Type</th>
                                    <th scope="col">Nomor Polisi</th>
                                    <th scope="col">Nomor Rangka</th>
                                    <th scope="col">Nomor Mesin</th>
                                    <th scope="col">Tahun Perolehan</th>
                                    <th scope="col">Nilai Perolehan</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1 ?>
                                @foreach ($data->barang()->orderBy('created_at', 'desc')->get() as $item)    
                                <tr>
                                    <td scope="col">{{$i}}</td>
                                    <td scope="col">{{$item->kodeBarang}}</td>
                                    <td scope="col">{{$item->NUP}}</td>
                                    <td scope="col">{{$item->kodeBarangs->namaBarang}}</td>
                                    <td scope="col">{{$item->merkType}}</td>
                                    <td scope="col">{{$item->nomorPolisi}}</td>
                                    <td scope="col">{{$item->nomorRangka}}</td>
                                    <td scope="col">{{$item->nomorMesin}}</td>
                                    <td scope="col">{{$item->tahunPerolehan}}</td>
                                    <td scope="col">{{$item->nilaiPerolehan}}</td>
                                    <td scope="col">{{$item->keterangan}}</td>
                                    <td>
                                        @if ($data->tiket->permohonan === 1)
                                        <form class="d-inline" action="/barang/{{$item->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn" style="color: red"><i class="bi bi-trash-fill"></i></button>    
                                        </form>
                                        @endif
                                    </td>
                                <?php $i++ ?>
                                </tr>
                                @endforeach

                                
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
        @if ($data->tiket->permohonan === 1)
        <div class="row " style="margin: 10px 0 0 0; padding: 0 40px 0px 40px">
            <div class=" d-flex justify-content-end" style="padding:0">
                <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#staticBackdrop">Tambah Barang</button>
            </div>
        </div>
        @endif

    </div>
</div>
{{-- Modals Input Barang --}}
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form action="/barang" method="POST">
                        @csrf
                        <div class="row">
                            <label for="kodeBarang" class="col-sm-4 col-form-label">Kode Barang</label>
                            <div class="col-sm-8">
                                <input name="kodeBarang" class="form-control" type="number" required>
                                @error('kodeBarang')
                                    <div class="text-danger mt-1">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <label for="NUP" class="col-sm-4 col-form-label">NUP</label>
                            <div class="col-sm-8">
                                <input name="NUP" type="number" class="form-control" required>
                                @error('NUP')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="row">
                            <label for="pemohon" class="col-sm-4 col-form-label">Merk/Type</label>
                            <div class="col-sm-8">
                                <input name="merkType" type="text" class="form-control" required>
                                @error('merkType')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="row">
                            <label for="nomorPolisi" class="col-sm-4 col-form-label">Nomor Polisi</label>
                            <div class="col-sm-8">
                                <input name="nomorPolisi" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <label for="nomorRangka" class="col-sm-4 col-form-label">Nomor Rangka</label>
                            <div class="col-sm-8">
                                <input name="nomorRangka" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <label for="nomorMesin" class="col-sm-4 col-form-label">Nomor Mesin</label>
                            <div class="col-sm-8">
                                <input name="nomorMesin" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <label for="tahunPerolehan" class="col-sm-4 col-form-label">Tahun Perolehan</label>
                            <div class="col-sm-8">
                                <input name="tahunPerolehan" type="number" class="form-control" required>
                                @error('tahunPerolehan')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="row">
                            <label for="nilaiPerolehan" class="col-sm-4 col-form-label">Nilai Perolehan</label>
                            <div class="col-sm-8">
                                <input name="nilaiPerolehan" type="number" class="form-control" required>
                                @error('nilaiPerolehan')
                                <div class="text-danger mt-1">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="row">
                            <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
                            <div class="col-sm-8">
                                <input name="keterangan" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <button type="submit" class="btn btn-primary" name="permohonan_id" value="{{$data->id}}">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Modals Input Barang --}}
@endsection

@section('foot')
    @error('kodeBarang')
        <script>
            var inputBarang = new bootstrap.Modal(document.getElementById('staticBackdrop'), {
                keyboard: false
            });
            inputBarang.show()  
        </script>
    @enderror
@endsection