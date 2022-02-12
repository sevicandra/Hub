<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <title>KPKNL TERNATE HUB || LOGIN</title>
</head>
<body style="background-image: url('img/login.png'); background-repeat: no-repeat; max-height:100vh; height:100vh" >
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
        <div class="row" style="padding: 0px 10% 0px 10%;max-height: 90vh; height:90vh;">
            <div class="form-control shadow-lg border-0" style="background-color:rgba(246, 245, 252, 0.25);background-position: top right; width:435px; height:450px; margin:auto 0 auto auto">
                <h1 style="margin-bottom: 24px">KPKNL TERNATE HUB</h1>
                <p style="margin-bottom: 24px">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veritatis, quas! Id, excepturi?</p>
                <form action="/login" method="POST">
                    @csrf
                    <input type="text" placeholder="NIP" class="form-control" style="margin-bottom: 12px" required name="NIP">
                    <input type="password" placeholder="Password" class="form-control" style="margin-bottom: 12px" required name="password">
                    <select name="tahun" class="form-control" placeholder="Tahun" style="margin-bottom: 12px" required name="tahun">
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                      </select>
                    <button type="submit"  class="form-control btn-primary text-center" style="margin-bottom:12px;">Login</button>
                </form>
                <p>Dont have Account? <a href="/register">Register here!</a> </p>
            </div>
        </div>
    </div>
    {{--  Sidebar  --}}
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel" style="border-radius: 0 10px 10px 0">
            {{--  Header  --}}
            <div class="offcanvas-header">
                <a class="text-decoration-none" href="/home">
                    <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">KPKNL TERNATE HUB</h5>
                </a>
            </div>
            <hr>
            {{--  Akhir Header  --}}
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
        <div class="container-fluid fixed-bottom position-absolute">
            <div class="row" style="margin:0; padding: 0 37px 0 37px">
                <div class="col-sm-12" style="background-color: rgba(240, 248, 255, 0.308); border-radius: 10px 10px 0 0">
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
</body>
</html>