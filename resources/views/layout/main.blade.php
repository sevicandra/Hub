<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Biryani' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Istok Web' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <link rel="stylesheet" href="/css/praktis/styles.css">
    <style>
        .loader1 {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 5px solid blue;
            border-right: none;
            border-bottom: none;
            border-left: none;
            height: 130px;
            width: 130px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }
        .loader2 {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: none;
            border-right: 5px solid green;
            border-bottom: none;
            border-left: none;
            height: 140px;
            width: 140px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }
        .loader3 {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: none;
            border-right: none;
            border-bottom: 5px solid red;
            border-left: none;
            height: 150px;
            width: 150px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }
        .loader4 {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: none;
            border-right: none;
            border-bottom: none;
            border-left: 5px solid pink;
            height: 160px;
            width: 160px;
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
    style="background: linear-gradient(298.55deg, #30629b 0%, #4b7296 41.63%, rgba(77, 115, 190, 0.88) 69.99%, rgba(82, 140, 194, 0.9) 96.89%); max-height:100vh; height:100vh">

    {{-- NAVBAR --}}
    <div class="container-fluid sticky-top" style="height: 5vh">
        <div class="row" style="padding: 0px 49px 0px 49px; height:100%">
            <div class="col-sm-12"
                style="border-radius: 0 0 10px 10px; height:100%; background-color:rgba(255, 255, 255, 0.74)">
                <div class="row" style="height:100%">
                    <div class="col-sm-8" style="height:100%">
                        <button style="max-height: 100%; color:white;" class="d-inline btn border-light bg-primary" type="button" data-bs-toggle="offcanvas"
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
        <div class="container-fluid" style="padding: 0px 37px 0px 37px; height:100%">
            <div class="container-fluid position-relative" style="border-radius: 10px; height:100%; padding:0">
                <div class="position-absolute top-50 start-50 translate-middle" style="height: fit-content; width:fit-content">
                    <div class="position-relative" style="height: fit-content; width:fit-content">
                        <div class="position-absolute top-50 start-50 translate-middle" style="height: fit-content; width:fit-content">
                            <div class="loader1" style="padding: 0; margin:0">
    
                            </div>
                        </div>
                        <div class="position-absolute top-50 start-50 translate-middle" style="height: fit-content; width:fit-content">
                            <div class="loader2" style="padding: 0; margin:0">
    
                            </div>
                        </div>
                        <div class="position-absolute top-50 start-50 translate-middle" style="height: fit-content; width:fit-content">
                            <div class="loader3" style="padding: 0; margin:0">
    
                            </div>
                        </div>
                        <div class="position-absolute top-50 start-50 translate-middle" style="height: fit-content; width:fit-content">
                            <div class="loader4" style="padding: 0; margin:0">
    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="position-absolute top-50 start-50 translate-middle" style="padding: 0; margin:0">
                    <img src="/img/ico/ternate hub.png" height="120px">
                </div>
            </div>
        </div>
    </div>

    <div id="content" class="container-fluid" style="margin: 0.5vh 0 0.5vh 0; height: 89vh;display:none">
        @yield('content')
    </div>
    {{-- Akhir Content --}}

    @section('modals')
        
    @show


    {{-- Sidebar --}}
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBackdrop"
        aria-labelledby="offcanvasWithBackdropLabel" style="border-radius: 0 10px 10px 0;background-color:rgb(255, 255, 255);">
        {{-- Header --}}
        <div class="offcanvas-header" style="padding-top:0; padding-bottom:0">
            <a class="text-decoration-none" href="/home">
                <div class="input-group" style="background: none; border:none">
                    <span class="input-group-text" id="basic-addon1" style="background: none; border:none; width:50px; padding-left:0; padding-right:0"><img src="/img/ico/ternate hub.png" style="max-width: 50px;height: auto;"></span>
                    <span class="input-group-text" id="basic-addon2" style="background: none; border:none; text-align:center; margin-bottom:0"><h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">KPKNL TERNATE HUB</h5></span>
                </div>
            </a>
            <Span>

            </Span>
        </div>
        <hr style="margin-top:0; margin-bottom:5px">
        <div>
            <div class="d-flex">
                <div class="p-2 w-100 bd-highlight">
                    <h5>{{ auth()->user()->nama }}</h5>
                </div>
                <div class="p-2 flex-shrink-1 bd-highlight" style="padding: 0"><form action="logout" method="POST">@csrf<button class="btn" style="color:red; height:fit-content;width:fit-content; padding:0">
                    <h4 style="margin: 0"><i class="bi bi-box-arrow-right"></i></h4>
                    </button></form></div>
            </div>
        </div>
        <hr style="margin-top:0">
        {{-- Akhir Header --}}

        {{-- Content --}}
        <div class="container-fluid scrollable"
            style="padding:0; max-height:100%; height:100%; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
            {{-- Modules Apps --}}
            <div class="row" style="padding: 0px;text-align:center; width:100%; margin:0">
                <h6 style="padding:0">MODULES</h6>
            </div>
            <hr>
            <div class="row">
                {{-- Pindai --}}
                <div class="col-sm-4 mb-1">
                    <a class="text-decoration-none" href="/pindai" target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/pindai.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            PINDAI
                        </div>
                    </a>
                </div>
                {{-- Akhir Pindai --}}

                {{-- PSP --}}
                <div class="col-sm-4 mb-1">
                    <a class="text-decoration-none" href="/status-penggunaan" target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/PSP.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            PSP
                        </div>
                    </a>
                </div>
                {{-- Akhir PSP --}}

                {{-- Praktis --}}
                <div class="col-sm-4 mb-1">
                    <a class="text-decoration-none" href="/praktis" target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/praktis.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            PRAKTIS
                        </div>
                    </a>
                </div>
                {{-- Akhir Praktis --}}

                {{-- Profil Satker --}}
                <div class="col-sm-4 mb-1">
                    <a class="text-decoration-none" href="/satker" target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/profile satker.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            Profil Satker
                        </div>
                    </a>
                </div>
                {{-- Akhir Profil Satker --}}

                {{-- Buku Tamu Digital --}}
                <div class="col-sm-4 mb-1">
                    <a class="text-decoration-none" href="https://www.formlets.com/forms/2M31g7qfovbaM4qU/" target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/buku tamu digital.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            Buku Tamu Digital
                        </div>
                    </a>
                </div>
                {{-- Akhir Buku Tamu Digital --}}

                {{-- Best Employee --}}
                <div class="col-sm-4 mb-1">
                    <a class="text-decoration-none" href="/best_employee" target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/bestemployee.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center"> 
                            Best Employee
                        </div>
                    </a>
                </div>
                {{-- Akhir Best Employee --}}

                {{-- Best Employee --}}
                <div class="col-sm-4 mb-1">
                    <a class="text-decoration-none" href="/reminder" target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/reminder.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center"> 
                            Reminder
                        </div>
                    </a>
                </div>
                {{-- Akhir Best Employee --}}

                {{-- Digital Knowledge Management --}}
                <div class="col-sm-4 mb-1">
                    <a class="text-decoration-none"
                        href="digital-knowledge-management"
                        target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/Digital Knoledge Management.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            Digital Knowledge Management
                        </div>
                    </a>
                </div>
                {{-- Akhir Digital Knowledge Management --}}

                {{-- JFPP --}}
                {{-- <div class="col-sm-4 mb-1">
                    <a class="text-decoration-none"
                        href="JFPP"
                        target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/JFPP.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            JFPP
                        </div>
                    </a>
                </div> --}}
                {{-- Akhir JFPP --}}

                {{-- MAP --}}
                <div class="col-sm-4 mb-1">
                    <a class="text-decoration-none" href="http://10.122.1.46/MAP" target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/map.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            MAP
                        </div>
                    </a>
                </div>
                {{-- Akhir MAP --}}

                {{-- MPR --}}
                <div class="col-sm-4 mb-1">
                    <a class="text-decoration-none"
                        href="http://10.122.1.32/Sipirang" target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/mpr.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            Manajemen Peminjaman Ruangan
                        </div>
                    </a>
                </div>
                {{-- Akhir MPR --}}

                {{-- Simones --}}
                <div class="col-sm-4 mb-1">
                    <a class="text-decoration-none"
                        href="https://docs.google.com/spreadsheets/d/1h4BwAteerJJ1HT2DFMcMGHb2GVH8hM2AgULTbI_wgno/edit?usp=sharing"
                        target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/sewaBMN.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            SIMONES
                        </div>
                    </a>
                </div>
                {{-- Akhir Simones --}}

                {{-- SIMONA --}}
                <div class="col-sm-4 mb-1">
                    <a class="text-decoration-none"
                        href="https://docs.google.com/spreadsheets/d/10R0c8ifREKfGHQvc_KzEOulgL-XrVW203aNdt7Vmb5Y/edit#gid=748373855"
                        target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/simona.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            SIMONA
                        </div>
                    </a>
                </div>  
                {{-- Akhir Simona --}}

                {{-- Capaian Kinerja Lelang --}}
                <div class="col-sm-4 mb-1">
                    <a class="text-decoration-none"
                        href="https://docs.google.com/spreadsheets/d/1xW1bwVzUVCGYaGiFLViDLo--tF_AHkYy-WpcMdZLMeg/edit#gid=1907929457"
                        target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/cakalang.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            Capaian Kinerja Lelang
                        </div>
                    </a>
                </div>
                {{-- Akhir Capaian Kinerja Lelang --}}

                {{-- Capaian Manajemen Risiko --}}
                {{-- <div class="col-sm-4 mb-1">
                    <a class="text-decoration-none"
                        href="https://docs.google.com/presentation/d/1g5gG0UXjlPZIwMmdbDI28BIVQ5xvtcZZGpJgra2BARI/edit?usp=sharing"
                        target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/Manajemen Risiko.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            Manajemen Risiko
                        </div>
                    </a>
                </div> --}}
                {{-- Akhir Capaian Manajemen Risiko --}}

                {{-- Capaian Manajemen Risiko --}}
                <div class="col-sm-4 mb-1">
                    <a class="text-decoration-none"
                        href="https://docs.google.com/presentation/d/1fqiNV9kJ20N3wphTo3C7CaOMuIvodiVZKi68iZ_BeQc/edit#slide=id.g125079c9e82_0_563"
                        target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/Manajemen Risiko.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            Manajemen Risiko
                        </div>
                    </a>
                </div>
                {{-- Akhir Capaian Manajemen Risiko --}}

                {{-- Ternate Responsif --}}
                <div class="col-sm-4 mb-1">
                    <a class="text-decoration-none"
                        href="https://linktr.ee/ternate.responsif"
                        target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/ternate reponsif.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            Ternate Responsif
                        </div>
                    </a>
                </div>
                {{-- Akhir Ternate Responsif --}}

                {{-- E-Arsip Ternate --}}
                <div class="col-sm-4 mb-1">
                    <a class="text-decoration-none"
                        href="https://bit.ly/ArsipKpknlTernate"
                        target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/e arsip.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            E-Arsip Ternate
                        </div>
                    </a>
                </div>
                {{-- Akhir E-Arsip Ternate --}}

                {{-- User Management --}}
                @if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') 
                <div class="col-sm-4 mb-1">
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
                {{-- Akhir User Management --}}

                {{-- Ring Wise --}}
                @if (auth()->user()->jabatan === '01'||auth()->user()->jabatan === '06'||auth()->user()->jabatan === '15')
                <div class="col-sm-4 mb-1">
                    <a class="text-decoration-none"
                        href="https://docs.google.com/presentation/d/1mV6ske7UJGJUuIrkiN4U_Pr0iwfy_QjHBSPK0urxBJA/edit#slide=id.p5"
                        target="_blank">
                        <div class="d-flex justify-content-evenly">
                            <img src="/img/ico/Ring Wise.png" alt="" width="64px" height="64px">
                        </div>
                        <div class="d-flex justify-content-evenly" style="text-align: center">
                            Ring Wise
                        </div>
                    </a>
                </div>
                @endif
                {{-- Akhir Ring Wise --}}
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
                    <div class="col-sm-4 mb-1" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://lelang.go.id/"
                            target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/lelang.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                Lelang Indonesia
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4 mb-1" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://www.dropbox.com/home/dropbox%20kpknl%20ternate%202021"
                            target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/dropbox.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                Dropbox Lelang
                            </div>
                        </a>
                    </div>                    
                    <div class="col-sm-4 mb-1" style="margin-bottom: 10px">
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
                    <div class="col-sm-4 mb-1" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://dianas.kemenkeu.go.id/"
                            target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/Dianas.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                DIANAS
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4 mb-1" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="http://10.242.77.20/diklat" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/diklat.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                Diklat DJKN
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4 mb-1" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://pndjkn.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/Focus PN.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                Focus PN
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4 mb-1" style="margin-bottom: 10px">
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
                    <div class="col-sm-4 mb-1" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://alika.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/alika.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                ALIKA
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4 mb-1" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://sibankumdjkn.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/SIBANKUM.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                SIBANKUM
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4 mb-1" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://www.djkn.kemenkeu.go.id/cms" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/cms djkn.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                CMS DJKN
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
                    <div class="col-sm-4 mb-1" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://klc2.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/klc.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                KLC
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4 mb-1" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://oa.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/oa.svg" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                OA Kemenkeu
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4 mb-1" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://hris.e-prime.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img class="d-block" src="/img/ico/hris.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                HRIS
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4 mb-1" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://e-performance.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/eperf.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                E-Performance
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4 mb-1" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://sakti.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/sakti.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                SAKTI
                            </div>
                        </a>
                    </div>    
                    <div class="col-sm-4 mb-1" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://spanint.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/omspan.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                OM-SPAN
                            </div>
                        </a>
                    </div>                                      
                    <div class="col-sm-4 mb-1" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://jdih.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/JDIH.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                JDIH Kemenkeu
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4 mb-1" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://forms.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/formskemenkeu.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                Forms Kemenkeu
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4 mb-1" style="margin-bottom: 10px">
                        <a class="text-decoration-none" href="https://www.wise.kemenkeu.go.id/" target="_blank">
                            <div class="d-flex justify-content-evenly">
                                <img src="/img/ico/wise.png" alt="" width="64px" height="64px">
                            </div>
                            <div class="d-flex justify-content-evenly" style="text-align: center">
                                Wise Kemenkeu
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            {{-- Akhir Kementerian Keuangan Apps --}}
        </div>
        {{-- Akhir Content --}}
    </div>
    {{-- Akhir Sidebar --}}
    {{-- Footer --}}
    <div class="container-fluid fixed-bottom" style="height: 5vh">
        <div class="row" style="margin:0; padding: 0 37px 0 37px; height:100%">
            <div class="col-sm-12" style="background-color:rgba(255, 255, 255, 0.74); border-radius: 10px 10px 0 0;height:100%">
                <div class="row position-relative" style="height:100%">
                    <div class="position-absolute top-50 start-0 translate-middle-y" style="height:100%; width:fit-content">
                        <img src="/img/ico/ternate hub.png" height="100%">
                        <img src="/img/ico/kpknlternate.png" alt="" height="100%">
                    </div>
                    <div class="position-absolute top-50 start-50 translate-middle" style="; width:fit-content">
                        <p style="margin:0">Version : <a class="text-decoration-none" href="">1.2.0</a> </p>
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