
@extends('layout.main')
@section('content')
    <div class="container-fluid" style="padding: 30px 37px 9px 37px; height:100%">
        <div class="container-fluid" style="border-radius: 10px; background-color:darkgrey; height:100% ">
            <div class="row" style="padding-bottom: 10px">
                <div class="col-sm-1">
                    <a href="/penetapan_lelang">
                        <button class="btn btn-primary translate-middle-y"><i class="bi bi-caret-left-fill"></i></button>
                    </a>
                </div>
                <div class="col-sm-2">
                    <div class="btn btn-primary translate-middle-y" style="width: 100%">Risalah Lelang</div>
                </div>
            </div>
            <div class="row" style="height:90%; padding: 0 40px 0px 40px">
                <div class="container-fluid" style="height: 100%;">
                    <div class="row" style="height: 100%;">
                        <div class="col-sm-8" style="height: 100%;">
                            <div style="height: 100%; background-color:aliceblue; border-radius:10px;">
                                <div style="height: 95%">
                                    <table class="table table-hover" style="max-height: 95%">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nomor Risalah</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Nilai Pokok</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        <?php $i=1; ?>
                                        @foreach ($data->Risalah as $item)
                                            <tr onclick="barangLelang('{{$item->id}}')">
                                                <td>{{$i}}</td>
                                                <td>{{$item->nomor}}</td>
                                                <td>{{$item->tanggal}}</td>
                                                <td>{{$item->nilaiPokok}}</td>
                                                <td style="max-width: 50px">
                                                    @if (count($data->permohonanLelang->barang) != count($data->barangLelang))
                                                        <button class="btn" onclick="inputBarangLelang('{{$item->id}}')" data-bs-toggle="modal" data-bs-target="#inputBarang"><i class="bi bi-plus-square-dotted"></i></button>
                                                    @endif
                                                    @if (!$item->barangLelang->first())
                                                        <form action="/risalah/{{$item->id}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn" style="color: red"><i class="bi bi-trash3"></i></button>
                                                        </form>
                                                    @endif
                                                </td>
                                                <?php $i++; ?>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div>
                                    @if (count($data->permohonanLelang->barang) != count($data->barangLelang))
                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#risalah">Tambah Risalah</button>
                                    @endif
                                </div> 
                            </div>
                        </div>
                        <div class="col-sm-4" style="height: 100%;">
                            <div style="height: 100%; position: relative; background-color:aliceblue; border-radius:10px;">
                                <div id="loading" style="z-index:10; height:100%; width:100%;" hidden>
                                    <div class="position-absolute top-50 start-50 translate-middle">
                                        <div class="spinner-border text-primary" role="status" style="height:200px;width:200px">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                <div style="height: 95%; width:100%; position: absolute; top:0; left:0">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Barang</th>
                                                <th scope="col">NUP</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Aksi</th>
                                            </tr>                        
                                        </thead>
                                        <tbody id="listBarang">
                                                
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--  Modals Risalah  --}}
        <div class="modal fade" id="risalah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form action="/risalah" method="POST">
                                @csrf
                                <div class="row">
                                    <label for="nomor" class="col-sm-4 col-form-label">Nomor Risalah</label>
                                    <div class="col-sm-8">
                                        <input name="nomor" class="form-control" type="text" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="tanggal" class="col-sm-4 col-form-label">Tanggal</label>
                                    <div class="col-sm-8">
                                        <input name="tanggal" type="date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="nilaiPokok" class="col-sm-4 col-form-label">Nilai Pokok</label>
                                    <div class="col-sm-8">
                                        <input name="nilaiPokok" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div>
                                        <button value="{{$data->id}}" type="submit" class="btn btn-primary" name="penetapan_lelang_id">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- Akhir Modals Risalah  --}}
    {{--  Modals Input Barang  --}}
        <div class="modal fade bd-example-modal-xl" id="inputBarang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" >
                        <form action="/barang_lelang" method="POST">
                            @csrf
                            <div>
                                <table class="table table-hover" style="max-height: 95%">       
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col">Kode Barang</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">NUP</th>
                                    </tr>
                                    <?php $i=1 ?>
                                    @foreach ($data->permohonanLelang->barang as $item)
                                        @if (!$item->barangLelang->where('status', '1')->first())
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td><input name="barang[]" type="checkbox" value="{{$item->id}}"></td>
                                                <td>
                                                    <select name="status[]" class="{{$item->id}}" name="" id="" disabled="disabled">
                                                        <option hidden></option>
                                                        <option value="1">Laku</option>
                                                        <option value="2">TAP</option>
                                                        <option value="3">Wanprestasi</option>
                                                    </select>
                                                </td>
                                                <td>{{$item->kodeBarang}}</td>
                                                <td>{{$item->kodeBarangs->namaBarang}}</td>
                                                <td>{{$item->NUP}}</td>
                                            </tr> 
                                            <?php $i++ ?>  
                                        @endif
                                    @endforeach
                                </table>
                            </div>
                            <div>
                                <button name="risalah_id" id="risalah_id" type="submit" value="">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    {{-- Akhir Modals Input Barang  --}}
@endsection

@section('foot')
    <script src="/js/pindai/lelang.js"></script>
@endsection