<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Biryani' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Istok Web' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <link rel="stylesheet" href="/css/praktis/styles.css">
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid blue;
            border-right: 16px solid green;
            border-bottom: 16px solid red;
            border-left: 16px solid pink;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <meta charset="UTF-8">
    @section('head')

    @show
    <title>
        @if (isset($title))
            {{ $title }}
        @else
        TERNATE HUB
        @endif
    </title>
    @if (isset($favicon))
        <link rel="icon" type="image/x-icon" href="{{ $favicon }}">
    @else
    <link rel="icon" type="image/x-icon" href="/img/ico/ternate hub.png">
    @endif
</head>

<body
    style="background: linear-gradient(298.55deg, #4D4295 0%, #8470FE 41.63%, rgba(112, 160, 254, 0.88) 69.99%, rgba(112, 186, 254, 0.9) 96.89%); max-height:100vh; height:100vh">

    {{-- NAVBAR --}}
    <div class="container-fluid sticky-top" style="height: 5vh">
        <div class="row" style="padding: 0px 49px 0px 49px; height:100%">
            <div class="col-sm-12 bg-light"
                style="border-radius: 0 0 10px 10px; height:100%">
                <div class="row" style="height:100%">
                    <div class="col-sm-8" style="height:100%">
                        <button style="max-height: 100%" class="d-inline btn border-light bg-primary" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">
                            <i class="bi bi-list fa-sm"></i>
                        </button>
                    </div>
                    @if(isset($search))
                    <div style="height:100%" class="col-sm-4">
                        <form action="" style="height:100%" method="GET">
                            <div class="input-group" style="height:100%"> 
                                <input style="height:100%" type="text" name="key" class="form-control" id="autoSizingInputGroup" placeholder="Search">
                                <div style="height:100%" class="input-group-text"><button class="btn" type="submit">Search</button></div>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- Akhir NAVBAR --}}
    {{-- Content --}}
    <div id="loadingScreen" class="container-fluid" style="margin: 0.5vh 0 0.5vh 0; height: 89vh;display:block">
        <div class="container-fluid" style="padding: 30px 37px 0px 37px; height:100%">
            <div class="container-fluid" style="border-radius: 10px; background-color:aliceblue; height:100%">
                <div class="loader position-absolute top-50 start-50 translate-middle">

                </div>
            </div>
        </div>
    </div>

    <div id="content" class="container-fluid" style="margin: 0.5vh 0 0.5vh 0; height: 89vh;display:none">
        @yield('content')
    </div>
    {{-- Akhir Content --}}
    {{-- Sidebar --}}
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBackdrop"
        aria-labelledby="offcanvasWithBackdropLabel" style="border-radius: 0 10px 10px 0;">
        {{-- Header --}}
        <div class="offcanvas-header" style="padding-top:0; padding-bottom:0">
            <a class="text-decoration-none" href="/home">
                <div class="input-group" style="background: none; border:none">
                    <span class="input-group-text" id="basic-addon1" style="background: none; border:none; width:50px; padding-left:0; padding-right:0"><img src="/img/ico/ternate hub.png" style="max-width: 50px;height: auto;"></span>
                    <span class="input-group-text" id="basic-addon2" style="background: none; border:none; text-align:center; margin-bottom:0"><h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">KPKNL TERNATE HUB</h5></span>
                </div>
            </a>
            <Span>
                <form action="logout" method="POST">
                    @csrf
                    <button class="btn">Logout</button>
                </form>
            </Span>
        </div>
        <hr style="margin-top:0">
        {{-- Akhir Header --}}

        <div class="container-fluid scrollable"
            style="padding:0; max-height:100%; height:100%; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
            {{-- Modules Apps --}}
            <div class="row" style="padding: 0px;text-align:center; width:100%; margin:0">
                <h6 style="padding:0">MODULES</h6>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-4">
                    <a class="text-decoration-none" href="/pindai" target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/pindai.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            Pindai
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a class="text-decoration-none" href="/praktis" target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/praktis.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            Praktis
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a class="text-decoration-none" href="/satker" target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/profile satker.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            Profil Satker
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a class="text-decoration-none" href="/best_employee" target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/bestemployee.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center"> 
                            Best Employee
                        </div>
                    </a>
                </div>
                <div class="col-sm-4" style="margin-bottom: 10px">
                    <a class="text-decoration-none" href="http://10.122.1.46/MAP" target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/map.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            MAP
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a class="text-decoration-none"
                        href="https://drive.google.com/drive/folders/1dwWvD9mBVYTQizBgMZKA-CbXDJ_HpJpz?usp=sharing"
                        target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/keputusan.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            Keputusan Kepala Kantor
                        </div>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a class="text-decoration-none"
                        href="https://docs.google.com/spreadsheets/d/1h4BwAteerJJ1HT2DFMcMGHb2GVH8hM2AgULTbI_wgno/edit?usp=sharing"
                        target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/sewaBMN.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            Sewa BMN
                        </div>
                    </a>
                </div>
                @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') 
                <div class="col-sm-4">
                    <a class="text-decoration-none"
                        href="/user_management"
                        target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/usermanagement.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            Manajemen User
                        </div>
                    </a>
                </div>            
                @endif
            </div>
            <hr>
            {{-- Akhir Modules Apps --}}
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
    </div>
    {{-- Akhir Sidebar --}}
    {{-- Footer --}}
    <div class="container-fluid fixed-bottom" style="height: 5vh">
        <div class="row" style="margin:0; padding: 0 37px 0 37px; height:100%">
            <div class="col-sm-12" style="background-color: aliceblue; border-radius: 10px 10px 0 0">
                <div class="row">
                    <div class="col-sm-4">
                        <img src="/img/ico/ternate hub.png" style="height: 48px">
                        <img src="/img/ico/kpknlternate.png" alt="" height="48px">
                    </div>
                    <div class="col-sm-4 d-flex justify-content-center align-items-center">
                        <p style="margin:0">Version : <a class="text-decoration-none" href="">1.0.0</a> </p>
                    </div>
                    <div class="col-sm-4">
                        <img src="" alt="" height="48px">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Akhir Footer --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    @section('foot')

    @show
    <script type="text/javascript">
        $( window ).on('load', function() {
                $('#loadingScreen').css('display', 'none');
                $('#content').css('display', 'block')
            });
    </script>
</body>

</html>