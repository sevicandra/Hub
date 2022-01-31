<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>KPKNL TERNATE HUB || LOGIN</title>
</head>
<body style="background-image: url('img/login.png'); background-repeat: no-repeat">
    <div class="container-fluid" style="padding: 270px 150px 200px 1299px;">
        <div class="row col-sm-12 form-control shadow-lg border-0" style="background-color:rgba(246, 245, 252, 0.25);background-position: top right; padding: 24px 0 20px">
            <h1 style="margin-bottom: 24px">KPKNL TERNATE HUB</h1>
            <form action="/register" method="POST">
                @csrf
                <input type="Nama" placeholder="Nama" class="form-control" style="margin-bottom: 12px" required name="Nama">
                <input type="email" placeholder="E-Mail" class="form-control" style="margin-bottom: 12px" required name="email">
                <input type="text" placeholder="NIP" class="form-control" style="margin-bottom: 12px" required name="NIP">
                {{--  <select name="Jabatan" class="form-control" placeholder="Jabatan" style="margin-bottom: 12px" required>
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
                    <option value="14">Pelaskana Seksi Kepatuhan Internal</option>
                </select>  --}}
                <input type="password" placeholder="Password" class="form-control" style="margin-bottom: 12px" required name="password">
                <input type="password2" placeholder="Re-enter Password" class="form-control" style="margin-bottom: 12px" required>
                <button type="submit"  class="form-control btn-primary text-center" style="margin-bottom:12px;">Register</button>
            </form>
        </div>
    </div>
</body>
</html>