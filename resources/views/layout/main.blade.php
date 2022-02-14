<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <meta charset="UTF-8">
    @section('head')
        
    @show
    <title>KPKNL TERNATE || HUB</title>
</head>
    <body style="background: linear-gradient(298.55deg, #4D4295 0%, #8470FE 41.63%, rgba(112, 160, 254, 0.88) 69.99%, rgba(112, 186, 254, 0.9) 96.89%); max-height:100vh; height:100vh"> 
        {{--  NAVBAR  --}}
        <div class="container-fluid sticky-top" style="height: 5vh">
            <div class="row" style="padding: 0px 49px 0px 49px; height:100%">
                <div class="col-sm-12 bg-light" style="border-radius: 0 0 10px 10px; padding-top: 0.5vh; padding-bottom: 0.5vh">
                    <div>
                        <button class="btn border-light bg-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">
                            {{--  <i class="bi bi-list fa-sm"></i>  --}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        {{--  Akhir NAVBAR  --}}
        <div class="container-fluid" style="margin: 0.5vh 0 0.5vh 0; height: 89vh">
            @yield('content')
        </div>
        {{--  Sidebar  --}}
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel" style="border-radius: 0 10px 10px 0;">
            {{--  Header  --}}
            <div class="offcanvas-header">
                <a class="text-decoration-none" href="/home">
                    <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">KPKNL TERNATE HUB</h5>
                </a>
                <Span>
                    <form action="logout" method="POST">
                        @csrf
                        <button class="btn">Logout</button>
                    </form>
                </Span>
            </div>
            <hr>
            {{--  Akhir Header  --}}

            <div class="container-fluid scrollable" style="padding:0; max-height:100%; height:100%; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
            {{--  Modules Apps --}}
                <div class="row" style="padding-left: 5px">
                    <h6>MODULES</h6>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-4">
                        <a class="text-decoration-none" href="/pindai" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly">
                                Pindai
                            </div>
                        </a>
                    </div>
                </div>
                <hr> 
            {{--  Akhir Modules Apps --}}
            {{--  Intranet Apps --}}
                <div class="row" style="padding-left: 5px">
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
                <div class="row" style="padding-left: 5px">
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
        </div>
        {{--  Akhir Sidebar  --}}
        {{--  Footer  --}}
        <div class="container-fluid fixed-bottom" style="height: 5vh">
            <div class="row" style="margin:0; padding: 0 37px 0 37px; height:100%">
                <div class="col-sm-12" style="background-color: aliceblue; border-radius: 10px 10px 0 0">
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="/img/ico/kpknlternate.png" alt="" height="48px">
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
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        @section('foot')
        
        @show
    </body>
</html>