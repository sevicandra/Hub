@extends('layout.Reminder')

@section('headReminder')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        dl, ol, ul{
            margin:0
        }
    </style>
@endsection

@section('contentReminder')
<div class="container-fluid" style="height: 100%;">
    <div class="row" style="height: 100%; background-color:rgb(255, 255, 255); border-radius:0 0 10px 10px">
        <div class="position-relative" style="height: 100%; width:100%; padding:0">
            <div style="padding: 25px 0 50px 0; width:100%; min-height:fit-content; max-height:100%; overflow-y:auto">
                @php
                    $i=1
                @endphp
                @foreach ($reminder as $item)
                <div style="width: 100%; text-align:center; margin:0 ; padding:0; " class="row" >
                    <div class="position-relative" style="width: 5%; min-height:fit-content">
                        <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">{{ $i }}</p> 
                    </div>
                    <div class="position-relative" style="width: 15%; min-height:fit-content">
                        <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">{{ $item->pengirim->nama }}</p> 
                    </div>
                    <div class="position-relative" style="width: 15%; min-height:fit-content">
                        <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">{{ indonesiaDate($item->tanggal) }}</p> 
                    </div>
                    <div class="position-relative" style="width: 15%; min-height:fit-content">
                        <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">{{ $item->waktu }}</p> 
                    </div>
                    <div class="position-relative" style="width: 50%; min-height:fit-content">
                        <p style="width: 100%" class="position-relative top-50 start-50 translate-middle">{{ $item->pesan }}</p> 
                    </div>
                </div>
                @php
                    $i++
                @endphp
                @endforeach
            </div>
            <div class="position-absolute top-0 start-50 translate-middle-x" style="width: 100%; height:25px; border-bottom:solid 1px; background-color:#495C4F; color:white">
                <div style="width: 100%; text-align:center; margin:0;" class="row" >
                    <div style="width: 5%; height:fit-content">No</div>
                    <div style="width: 15%; height:fit-content">Pengirim</div>
                    <div style="width: 15%; height:fit-content">Tanggal</div>
                    <div style="width: 15%; height:fit-content">Waktu</div>
                    <div style="width: 50%; height:fit-content">Pesan</div>
                </div>
            </div>
            <div class="position-absolute bottom-0 start-50 translate-middle-x" style="width: 100%; height:50px; background-color:#495C4F">
                <div class="position-relative" style="height: 100%; width:100%">
                    <div class="position-absolute top-50 start-50 translate-middle" style="height: fit-content; width:fit-content">
                        {{ $reminder->links() }}
                    </div>
                    <div class="position-absolute top-50 end-0 translate-middle-y" style="margin: 0 10px; width:fit-content">
                        <button style="background-color: #4CC2B4; color:white" type="button" class="btn" data-bs-toggle="modal" data-bs-target="#inputReminder">
                            Input Reminder
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('modalsReminder')
{{-- Modals Input Reminder --}}
<div class="modal fade" id="inputReminder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/reminder" method="post">
                @csrf
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal" required value="{{ old('tanggal') }}">
                    <label for="tanggal">Tanggal</label>
                    @error('tanggal')
                    <div class="text-danger mt-1">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="time" class="form-control" id="waktu" name="waktu" placeholder="Waktu" required value="{{ old('waktu') }}">
                    <label for="waktu">Waktu</label>
                    @error('waktu')
                    <div class="text-danger mt-1">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" id="pesan" name="pesan" placeholder="Pesan" required value="{{ old('pesan') }}" cols="30" rows="10"></textarea>
                    <label for="pesan">Pesan</label>
                    @error('pesan')
                    <div class="text-danger mt-1">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <div class="form-control scrollable" placeholder="Tujuan" style="height: 200px; overflow-y:auto">
                        @foreach ($tujuan as $item)
                        <div class="input-group mb-2">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="tujuan[]" value="{{ $item->id }}">
                            </div>
                            <input disabled type="text" class="form-control" value="{{ $item->nama }}">
                        </div>
                        @endforeach
                    </div>
                    <label for="pesan">Tujuan</label>
                </div>
                @error('pesan')
                <div class="text-danger mt-1">
                    {{$message}}
                </div>
                @enderror
                <div class="row mt-2">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
{{-- Akhir Modals Input Reminder --}}

{{-- Modals View Reminder --}}
<div class="modal fade" id="viewReminder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="viewReminderContent">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">tanggal</span>
                    <input disabled type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    <span class="input-group-text" id="basic-addon2">waktu</span>
                    <input disabled type="time" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon2">
                </div>
                <div class="form-floating mb-3">
                    <textarea disabled type="email" class="form-control" id="floatingInput"></textarea>
                    <label for="floatingInput">Pesan</label>
                </div>
                <div class="form-floating mb-3">
                    <div class="form-control scrollable" placeholder="Tujuan" style="height: 200px; overflow-y:auto">
                        <div class="input-group mb-2">
                            <span class="input-group-text" id="basic-addon1">-</span>
                            <input disabled type="text" class="form-control" value="Nama">
                        </div>
                    </div>
                    <label for="pesan">Tujuan</label>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Modals View Reminder --}}
@endsection


@section('footReminder')
<script src="/js/reminder/index.js"></script>
@endsection