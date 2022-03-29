<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Biryani' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Istok Web' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <meta charset="UTF-8">
    <title>KPKNL TERNATE || HUB</title>
</head>
    <body style="background: #BBBABE; max-height:100vh; height:100vh"> 
        <div class="container-fluid">
            <div class="row" style="height: 100vh">
                <div class="col-sm-4" style="margin:auto; background: #DF9393; padding: 0; border-radius: 20px; height: 40%">
                    <div style="height: 15%; text-align: center; background:#595656; border-radius: 20px 20px 0 0; font-family: 'Sedan SC'; font-style: normal; font-weight: 400; font-size: 48px; line-height: 63px; color:white">
                        <h1 style="margin:0">KPKNL TERNATE HUB</h1>
                    </div>
                    <div style="color:white;height: 15%;text-align: center; font-family: 'SimSun'; font-style: normal; font-weight: 400; font-size: 48px; line-height: 63px; margin: 0 12px 24px 12px">
                        <h1>HI, {{auth()->user()->nama}}</h1>
                    </div>
                    <div style="font-family: 'SimSun'; font-style: normal;color:white;height: 55%;text-align: center; margin: 0 12px">
                        <h3>
                            Kami telah melangirimkan aktivasi akun pada {{auth()->user()->email}}, silahkan lakukan konfirmasi untuk menggunakan akun anda,
                        </h3>
                    </div>
                    <div style="color:white;height: 15%;text-align: center; background: #595656; margin:0; border-radius: 0 0 20px 20px">
                        <p style="margin:0">jika belum menerima email silahkan kilk <a href="/email/verify">di sini</a> melakukan permohonan pengiriman link aktivasi</p>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
