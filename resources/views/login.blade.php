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
</body>
</html>