<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <title>TERNATE HUB || REGISTER</title>
    <link rel="icon" type="image/x-icon" href="/img/ico/ternate hub.png">
</head>
<body style="background-image: url('img/login.png'); background-repeat: no-repeat; max-height:100vh; height:100vh;background-size: cover" >
    <div class="container-fluid sticky-top">
        <div class="row" style="padding: 0px 49px 0px 49px">
            <div class="col-sm-12" style="border-radius: 0 0 10px 10px; padding-top: 5px; padding-bottom: 5px; background-color: rgba(240, 248, 255, 0.308)">
                <div>
                    <button class="btn border-light bg-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row" style="max-height: 90vh; height:90vh;">
            <div class="col-sm-6 position-relative" style="height: 100%">
                <div class="position-absolute top-50 start-50 translate-middle">
                    <img class="img-fluid" src="/img/ico/front image.png" alt="" >
                </div>
            </div>
            <div class="col-sm-6 position-relative" style="height: 100%">
                <div class="form-control shadow-lg border-0 position-absolute top-50 start-50 translate-middle" style="background-color:rgba(246, 245, 252, 0.25);background-position: top right; max-width:fit-content; max-height:fit-content;border-radius:10px; min-height:50vh">
                    <div class="input-group mb-3" style="background: none; border:none">
                        <span class="input-group-text" id="basic-addon1" style="background: none; border:none; width:50px; padding-left:0; padding-right:0"><img src="/img/ico/ternate hub.png" style="max-width: 50px;height: auto;"></span>
                        <span class="input-group-text" id="basic-addon2" style="background: none; border:none; text-align:center; color:white; font-size:2vw; width:auto; margin-bottom:0">KPKNL TERNATE HUB</span>
                    </div>
                    <form action="/register" method="POST">
                        @csrf
                        <input type="text" value="{{old('Nama')}}" placeholder="Nama" class="form-control"  required name="Nama">
                        @error('Nama')
                            <div class="text-danger mt-1">
                                {{$message}}
                            </div>
                        @enderror
                        <input type="email" value="{{old('email')}}" placeholder="E-Mail" class="form-control" style="margin-top: 12px" required name="email">
                        @error('email')
                            <div class="text-danger mt-1">
                                {{$message}}
                            </div>
                        @enderror
                        <input type="text" value="{{old('NIP')}}" placeholder="NIP" class="form-control" style="margin-top: 12px" required name="NIP">
                        @error('NIP')
                            <div class="text-danger mt-1">
                                {{$message}}
                            </div>
                        @enderror
                        <select name="jabatan" class="form-control" placeholder="Jabatan" style="margin-top: 12px" required>
                            <option hidden selected>Jabatan</option>
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
                        @error('jabatan')
                            <div class="text-danger mt-1">
                                {{$message}}
                            </div>
                        @enderror
                        <select name="pangkatGolongan" class="form-control" placeholder="Jabatan" style="margin-top: 12px" required>
                            <option hidden selected>Pangkat/Golongan</option>
                            <option value="Pembina / IV.a">Pembina / IV.a</option>
                            <option value="Penata Tk.I / III.d">Penata Tk.I / III.d</option>
                            <option value="Penata / III.c">Penata / III.c</option>
                            <option value="Penata Muda Tk.I / III.b">Penata Muda Tk.I / III.b</option>
                            <option value="Penata Muda / III.a">Penata Muda / III.a</option>
                            <option value="Pengatur Tk.I / II.d">Pengatur Tk.I / II.d</option>
                            <option value="Pengatur / II.c">Pengatur / II.c</option>
                        </select>
                        @error('pangkatGolongan')
                            <div class="text-danger mt-1">
                                {{$message}}
                            </div>
                        @enderror
                        <input type="password" placeholder="Password" class="form-control" style="margin-top: 12px" required name="password">
                        @error('password')
                            <div class="text-danger mt-1">
                                {{$message}}
                            </div>
                        @enderror
                        <button type="submit"  class="form-control btn-primary text-center" style="margin: 12px 0 12px 0;">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--  Sidebar  --}}
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel" style="border-radius: 0 10px 10px 0">
            {{--  Header  --}}
            <div class="offcanvas-header" style="padding-top:0; padding-bottom:0">
                <a class="text-decoration-none" href="/home">
                    <div class="input-group" style="background: none; border:none">
                        <span class="input-group-text" id="basic-addon1" style="background: none; border:none; width:50px; padding-left:0; padding-right:0"><img src="/img/ico/ternate hub.png" style="max-width: 50px;height: auto;"></span>
                        <span class="input-group-text" id="basic-addon2" style="background: none; border:none; text-align:center; margin-bottom:0"><h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">KPKNL TERNATE HUB</h5></span>
                    </div>
                </a>
            </div>
            <hr style="margin-top:0">
            {{--  Akhir Header  --}}
            {{-- DJKN Apps --}}
            <div class="row" style="padding: 0px;text-align:center; width:100%; margin:0">
                <h6 style="padding:0">APLIKASI DJKN</h6>
            </div>
            <hr>
            <div class="container-fluid" style="margin-bottom: 10px;">
                <div class="row">
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://aladin-vertikal-djkn.kemenkeu.go.id/"
                            target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/aladin.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                Aladin Vertikal
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://dianas.djkn.kemenkeu.go.id/"
                            target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/Dianas.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                Dianas
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="http://10.242.77.20/diklat" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/diklat.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                Diklat DJKN
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://pndjkn.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/Focus PN.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                Focus PN
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="http://www.djkn.kemenkeu.go.id/laporandjkn"
                            target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/kep-96.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center"> 
                                KEP-96
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://alika.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/alika.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                Alika
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <hr>
            {{-- Akhir DJKN Apps --}}
            {{-- Kementerian Keuangan Apps --}}
            <div class="row" style="padding: 0px;text-align:center; width:100%; margin:0">
                <h6 style="padding:0">APLIKASI KEMENTERIAN KEUANGAN</h6>
            </div>
            <hr>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://klc2.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/klc.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                KLC
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://oa.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/oa.svg" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                OA Kemenkeu
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://hris.e-prime.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img class="d-block" src="/img/ico/hris.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                HRIS
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://e-performance.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/eperf.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                E-Performance
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://jdih.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/JDIH.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                JDIH Kemenkeu
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://forms.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/formskemenkeu.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                Forms Kemenkeu
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            {{-- Akhir Kementerian Keuangan Apps --}}           
        </div>
    {{--  Akhir Sidebar  --}}
        {{--  Footer  --}}
        <div class="container-fluid fixed-bottom" style="height: 5vh">
            <div class="row" style="margin:0; padding: 0 37px 0 37px; height:100%">
                <div class="col-sm-12" style="background-color: rgba(240, 248, 255, 0.308); border-radius: 10px 10px 0 0">
                    <div class="row position-relative" style="height:100%">
                        <div class="position-absolute top-50 start-0 translate-middle-y" style="width:fit-content;height:100%">
                            <img src="/img/ico/ternate hub.png" height="100%">
                            <img src="/img/ico/kpknlternate.png" alt="" height="100%">
                        </div>
                        <div class="position-absolute top-50 start-50 translate-middle" style="; width:fit-content; ">
                            <p style="margin:0">Version : <a class="text-decoration-none" href="">1.0.0</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{--  Akhir Footer  --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>