<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Biryani' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Istok Web' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
<body style="background: linear-gradient(298.55deg, #4D4295 0%, #8470FE 41.63%, rgba(112, 160, 254, 0.88) 69.99%, rgba(112, 186, 254, 0.9) 96.89%); height: 100%">
    
    <div class="container-fluid">
        <div class="row" style="padding: 64px 0 0 37px">
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-4">
                        <div style=" background-color: #ffff; margin-bottom: 15px; border-radius: 10px;" >
                            <canvas id="kepuasanPelanggan" ></canvas>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div style="height: 445px; background-color: #ffff; border-radius: 10px">
                            <canvas id="capaianKinerja" height="100%"></canvas>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row" style="height: 414px; background-color: #ffff; border-radius: 10px; padding:0px; margin:0">
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
                    <div class="col-sm-4">
                        <div style="height: 414px; background-color: #ffff; border-radius: 10px">
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
                </div>
            </div>
            <div class="col-sm-3" style=" padding-right: 37px; padding-left: 4px">
                <div class="agenda" style="height: 874px; background-color: #ffffff4f; border-radius: 10px; padding: 0px 0 0 0px; max-height: 820px; overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                    <nav class="navbar navbar-light bg-light sticky-top" style="margin: 0px 0px 7px 0px; border-radius: 10px;">
                        <div class="container-fluid"> 
                            <input class="form-control" id="tanggalagenda" type="date">
                        </div>
                    </nav>



                    <div id='agenda'>
                        {{--  <div class="row" style="margin-bottom: 5px">
                            <div class="col-sm-2">
                                <img src="img/ico.png" style="height:50px" alt="">
                            </div>
                            <div class="col-sm-9" style="background-color: #ffffff; border-radius:10px">
                                <h1>Lorem, ipsum dolor.</h1>
                                <p>Lorem ipsum dolor sit amet.</p>
                                <h2>12 Januari 2022</h2>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-sm-2">
                                <img src="img/ico.png" style="height:50px" alt="">
                            </div>
                            <div class="col-sm-9" style="background-color: #ffffff; border-radius:10px">
                                <h1>Lorem, ipsum dolor.</h1>
                                <p>Lorem ipsum dolor sit amet.</p>
                                <h2>12 Januari 2022</h2>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-sm-2">
                                <img src="img/ico.png" style="height:50px" alt="">
                            </div>
                            <div class="col-sm-9" style="background-color: #ffffff; border-radius:10px">
                                <h1>Lorem, ipsum dolor.</h1>
                                <p>Lorem ipsum dolor sit amet.</p>
                                <h2>12 Januari 2022</h2>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-sm-2">
                                <img src="img/ico.png" style="height:50px" alt="">
                            </div>
                            <div class="col-sm-9" style="background-color: #ffffff; border-radius:10px">
                                <h1>Lorem, ipsum dolor.</h1>
                                <p>Lorem ipsum dolor sit amet.</p>
                                <h2>12 Januari 2022</h2>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-sm-2">
                                <img src="img/ico.png" style="height:50px" alt="">
                            </div>
                            <div class="col-sm-9" style="background-color: #ffffff; border-radius:10px">
                                <h1>Lorem, ipsum dolor.</h1>
                                <p>Lorem ipsum dolor sit amet.</p>
                                <h2>12 Januari 2022</h2>
                            </div>
                        </div>  --}}
                    </div>
                    
                </div>
                <nav class="navbar navbar-light bg-light sticky-bottom" style="margin: 0px 0px 7px 0px; border-radius: 10px;">
                    <div class="container-fluid"> 
                        <button class="btn btn-primary container-fluid">Tambah Agenda</button>
                    </div>
                </nav>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/apexchart.js"></script>
    <script src="js/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="{{asset('agenda/js/index.js')}}" type="text/javascript"></script>
</body>
</html>