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
                    <div class="row" style="color:white;height: 15%;text-align: center; background: #595656; margin:0; border-radius: 20px 20px 0 0">
                        <h1>KPKNL TERNATE HUB</h1>
                    </div>
                    <div class="row" style="color:white;height: 25%;text-align: center; font-family: 'Roboto'; font-style: normal; font-weight: 400; font-size: 24px; margin: 0 12px 24px 12px">
                        <p>Silahkan tekan tombol dibawah untuk mengirimkan email verifikasi</p>
                    </div>
                    @if (session()->has('LoginErorr'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{session('LoginErorr')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="row" style="color:white;height: 45%;text-align: center; margin: 0 12px">
                        <div>
                            <form action="/reset-password" method="post">
                                @csrf
                                <input type="text" name="token" value="{{$token}}{{old('Nama')}}" hidden>
                                @error('token')
                                    <div class="text-danger mt-1">
                                        {{$message}}
                                    </div>
                                @enderror
                                <input class="form-control" type="email" name="email" placeholder="EMAIL" value="{{old('email')}}">
                                @error('email')
                                    <div class="text-danger mt-1">
                                        {{$message}}
                                    </div>
                                @enderror   
                                <input class="form-control" type="password" name="password" placeholder="password">
                                @error('password')
                                    <div class="text-danger mt-1">
                                        {{$message}}
                                    </div>
                                @enderror
                                <input class="form-control" type="password" name="password_confirmation">
                                @error('password_confirmation')
                                    <div class="text-danger mt-1">
                                        {{$message}}
                                    </div>
                                @enderror
                                <button class="btn btn-primary" type="submit">Kirim Email reset password</button>
                            </form>
                        </div>
                    </div>
                    <div class="row" style="color:white;height: 15%;text-align: center; background: #595656; margin:0; border-radius: 0 0 20px 20px">
                        <p>© 2022 KPKNL TERNATE.</p> 
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
