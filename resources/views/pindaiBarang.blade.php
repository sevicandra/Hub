
@extends('layout.main')
@section('content')
<div class="container-fluid" style="padding: 30px 37px 9px 37px">
    <div class="container-fluid" style="border-radius: 10px; background-color:darkgrey; ">
        <div class="row" style="padding-bottom: 10px">
            <div class="col-sm-2">
                <div class="btn btn-primary translate-middle-y" style="width: 100%">Daftar Barang</div>
            </div>
        </div>
        <div class="row" style="height:80vh; padding: 0 40px 0px 40px">
            <div class="container-fluid">
                <div class="row" style="height: 74vh; background-color:aliceblue; border-radius:10px;">
                    <div>
                        <table class="table table-hover">
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
                                    <td><a href="" style="color: red"><i class="bi bi-trash-fill"></i></a></td>
                                <?php $i++ ?>
                                </tr>
                                @endforeach

                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row " style="margin: 10px 0 0 0 ">
                    <div class=" d-flex justify-content-end" style="padding:0">
                        <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#staticBackdrop">Tambah Barang</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                                <input name="kodeBarang" class="form-control" type="text" required>
                            </div>
                        </div>
                        <div class="row">
                            <label for="NUP" class="col-sm-4 col-form-label">NUP</label>
                            <div class="col-sm-8">
                                <input name="NUP" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <label for="pemohon" class="col-sm-4 col-form-label">Merk/Type</label>
                            <div class="col-sm-8">
                                <input name="merkType" type="text" class="form-control" required>
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
                                <input name="tahunPerolehan" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <label for="nilaiPerolehan" class="col-sm-4 col-form-label">Nilai Perolehan</label>
                            <div class="col-sm-8">
                                <input name="nilaiPerolehan" type="text" class="form-control" required>
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
@endsection
