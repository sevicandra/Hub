<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Biryani' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Istok Web' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <meta charset="UTF-8">
    <style>
        h1{
            font-family: istokweb;
            font-weight: bold
        }
        .agenda::-webkit-scrollbar {
            display: none;
        }     
        /* Hide scrollbar for IE, Edge and Firefox */
        .agenda {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KPKNL TERNATE || HUB</title>
</head>
    <body style="background: linear-gradient(298.55deg, #4D4295 0%, #8470FE 41.63%, rgba(112, 160, 254, 0.88) 69.99%, rgba(112, 186, 254, 0.9) 96.89%); height: 100vh"> 
        {{--  NAVBAR  --}}
        <div class="container-fluid">
            <div class="row" style="padding: 0px 49px 0px 49px">
                <div class="col-sm-12 bg-light" style="border-radius: 0 0 10px 10px; padding-top: 5px; padding-bottom: 5px">
                    <div>
                        <button class="btn border-light bg-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">
                            <i class="bi bi-list"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        {{--  Akhir NAVBAR  --}}
        <div class="container-fluid">
            {{--  Dashboard  --}}
            <div class="row" style="padding: 10px 37px 9px 37px">
                <div class="col-sm-9">
                    {{--  Kepuasan Pengguna Layanan dan Capaian Kinerja Organisasi  --}}
                    <div class="row">
                        {{--  Kepuasan Pengguna Layanan  --}}
                        <div class="col-sm-4" style="; padding-right:5px">
                            <div style=" background-color: #ffff; margin-bottom: 10px; border-radius: 10px;height: 445px" >
                                <canvas id="kepuasanPelanggan" ></canvas>
                            </div>
                        </div>
                        {{--  Akhir Kepuasan Pengguna Layanan  --}}
                        {{--  Capaian Kinerja Organisasi  --}}
                        <div class="col-sm-8" style="; padding-left:5px">
                            <div style="height: 445px; background-color: #ffff; border-radius: 10px">
                                <canvas id="capaianKinerja" height="100%"></canvas>
                            </div>
                        </div>
                        {{--  Akhir Capaian Kinerja Organisasi  --}}
                    </div>
                    {{--  AKhir Kepuasan Pengguna Layanan dan Capaian Kinerja Organisasi  --}}
                    {{--  PNBP dan Jumlah Pengunjung  --}}
                    <div class="row">
                        {{--  PNBP  --}}
                        <div class="col-sm-8" style="; padding-right:5px">
                            <div class="row" style="height: 400px; background-color: #ffff; border-radius: 10px; padding:0px; margin:0">
                                <div>
                                    <h1>PNBP KPKNL Ternate</h1>
                                </div>
                                <div class="col-sm-4">
                                    <div id="PNBP1"></div>
                                </div>
                                <div class="col-sm-4">
                                    <div id="PNBP2"></div>
                                </div>
                                <div class="col-sm-4">
                                    <div id="PNBP3"></div>
                                </div>
                            </div>
                        </div>
                        {{--  Akhir PNBP  --}}
                        {{--  Jumlah Pengunjung  --}}
                        <div class="col-sm-4" style="; padding-left:5px">
                            <div style="height: 400px; background-color: #ffff; border-radius: 10px">
                                <div style="padding: 5px 0px 0px 10px">
                                    <h1>Jumlah Pengunjung</h1>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h2>Tanggal</h2>
                                        </div>
                                        <div class="col-sm-6">
                                            <h2>Rata-Rata</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--  Akhir Jumlah Pengunjung  --}}
                    </div>
                </div>
                {{--  Agenda  --}}
                <div class="col-sm-3" style=" padding-left: 4px">
                    <div class="agenda" style="height: 800px; background-color: #ffffff4f; border-radius: 10px; padding: 0px 0 0 0px; max-height: 820px; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                        <nav class="navbar navbar-light bg-light sticky-top" style="margin: 0px 0px 7px 0px; border-radius: 10px;">
                            <div class="container-fluid"> 
                                <input class="form-control" id="tanggalagenda" type="date">
                            </div>
                        </nav>
                        <div id='agenda'></div>
                    </div>
                    <nav class="navbar navbar-light bg-light sticky-bottom" style="margin: 0px 0px 7px 0px; border-radius: 10px;">
                        <div class="container-fluid"> 
                            <button class="btn btn-primary container-fluid">Tambah Agenda</button>
                        </div>
                    </nav>
                </div>
                {{--  Akhir Agenda  --}}
            </div>
            {{--  Akhir Dashboard  --}}
        </div>
        {{--  Sidebar  --}}
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel" style="border-radius: 0 10px 10px 0">
            {{--  Header  --}}
            <div class="offcanvas-header">
                <a class="text-decoration-none" href="/Home">
                    <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">KPKNL TERNATE HUB</h5>
                </a>
            </div>
            <hr>
            {{--  Akhir Header  --}}
            {{--  Modules Apps --}}
            <div class="container-fluid">
                <h6>MODULES</h6>
            </div>
            <hr>
            <div class="container-fluid" style="margin-bottom: 10px;">
                <div class="row">
                    <div class="col-sm-4">
                        <a class="text-decoration-none" href="/pindai">
                            <div class="d-flex justify-content-evenly">
                                <img src="" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly">
                                Pindai
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <hr> 
            {{--  Akhir Modules Apps --}}
            {{--  Intranet Apps --}}
            <div class="container-fluid">
                <h6>INTRANET</h6>
            </div>
            <hr>
            <div class="container-fluid" style="margin-bottom: 10px;">
                <div class="row">
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://aladin-vertikal-djkn.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly">
                                Aladin Vertikal
                            </div>
                        </a> 
                    </div>
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="http://10.10.1.197/Default.aspx" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly">
                                Simpeg
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="http://10.242.77.20/diklat" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly">
                                Diklat DJKN
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://pndjkn.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly">
                                Focus PN
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="http://www.djkn.kemenkeu.go.id/laporandjkn" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly">
                                KEP-96
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none"  href="http://10.122.1.46/MAP" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly">
                                MAP
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none d-block" href="http://10.122.1.46:81/login" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly">
                                Aplikasi Arsip
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <hr>
            {{--  Akhir Intranet Apps --}}
            {{--  Internet Apps  --}}
            <div class="container-fluid">
                <h6>INTERNET</h6>
            </div>
            <hr>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://alika.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly">
                                Alika
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://klc2.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/klc.png" alt="" width="64px" height="64px" >
                            </div>
                            <div class="d-flex justify-content-evenly">
                                KLC
                            </div>    
                        </a>
                    </div>
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://oa.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly">
                                OA Kemenkeu
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://hris.e-prime.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img class="d-block" src="/img/ico/hris.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly">
                                HRIS
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://e-performance.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/eperf.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly">
                                E-Performance
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            {{--  Akhir Internet Apps  --}}            
        </div>
        {{--  Akhir Sidebar  --}}
        {{--  Footer  --}}
        
        <div class="container-fluid fixed-bottom">
            <div class="row" style="margin:0; padding: 0 37px 0 37px">
                <div class="col-sm-12" style="background-color: aliceblue; border-radius: 10px 10px 0 0">
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="img/ico/kpknlternate.png" alt="" height="48px">
                        </div>
                        <div class="col-sm-4 d-flex justify-content-center align-items-center">
                            <p style="margin:0">Version :   <a class="text-decoration-none" href="">1.0.0</a> </p>
                        </div>
                        <div class="col-sm-4">
                            <img src="" alt="" height="48px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        {{--  Akhir Footer  --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="js/apexchart.js"></script>
        <script src="js/chart.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="{{asset('agenda/js/index.js')}}" type="text/javascript"></script>
    </body>
</html>