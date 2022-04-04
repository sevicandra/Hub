<!DOCTYPE html>
<html lang="en">
    <head>
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
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
            body {
                background-image: url('/survei/img/background/bg.jpg');
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center;
            }
            .title{
                font-family: 'Roboto'; font-style: normal; font-weight: 400; font-size: 36px; line-height: 42px; display: flex; align-items: center; color: #FFFFFF;
            }
            .lable{
                margin-bottom:5px;font-family: 'Roboto'; font-style: normal; font-weight: 400; font-size: 24px; line-height: 28px; display: flex; align-items: center; color: #FFFFFF;
            }
            .sub-lable{
                margin-bottom:2px;font-family: 'Roboto'; font-style: normal; font-weight: 400; font-size: 12px; line-height: 14px; /* identical to box height */ display: flex; align-items: center; color: #FFFFFF;
            }
            .button input[type="radio"] {
                display: none;
            }
        </style>
    </head>
    <body> 
        <div class="modal fade" id="tombolSurvei" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tombolSurveiLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: none; background-color: #ffffff00;">
                    <div class="row" style="height:100%">
                        <div class="col" style="margin: auto;max-width: fit-content">
                            <button onClick="survei()" class="btn" style="background-color: #0B783A; color:#ffffff; font-size: 36px;font-family: 'Roboto'; font-style: normal; border-radius: 20px; padding: 20 10;">MULAI SURVEI</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="formSurvei" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="formSurveiLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: fit-content">
                <div class="modal-content" style="border: none; background-color: #ffffff00;">
                    <div class="modal-header" style="background: linear-gradient(90deg, #449AB5 0%, #033E50 100%); mix-blend-mode: normal; border-radius: 20px 20px 0px 0px;">
                        <button type="button" class="btn-close" onClick="tutupSurvei()"></button>
                    </div>
                    <div class="modal-body" style="background: rgba(9, 92, 92, 0.5); border-radius:0 0 20px 20px;">
                        <p class="title">SURVEI KEPUASAN PENGGUNA LAYANAN</p>
                        <div>
                            <form action="/survey" method="POST">
                                @csrf
                                <label class="form-label" for="">
                                    <p class="lable">Layanan Yang Diterima</p>
                                </label>
                                <select class="form-select" name="layanan" style="margin-bottom: 5px;" required>
                                    <option disabled default  hidden>Pilih Jenis Layanan</option>
                                    <option value="PKN">Pengelolaan Kekayaan Negara</option>
                                    <option value="PEN">Pelayanan Penilaian</option>
                                    <option value="LLG">Pelayanan Lelang</option>
                                    <option value="PPN">Pengurusan Piutang Negara</option>
                                    <option value="LLN">Lainnya</option>
                                </select>
                                <label class="form-label">
                                    <div>
                                        <p class="lable">Tangibles (Bukti Terukur)</p>
                                    </div>
                                    <div>
                                        <p class="sub-lable">menggambarkan fasilitas fisik, perlengkapan, dan tampilan area pelayanan</p>
                                    </div>
                                </label>
                                <div class="button" style="margin-bottom:10px; width: 40vw;">
                                    <input id="tang-1" type="radio" name="tangibles" value="1">
                                    <label style="width: 17%;" for="tang-1">
                                        <img style="width:100%" id="tangibles1" src="survei/img/ico/very-sad.png" >
                                    </label>
                                    <input id="tang-2" type="radio" name="tangibles" value="2">
                                    <label style="width: 17%;" for="tang-2">
                                        <img style="width:100%" id="tangibles2" src="survei/img/ico/sad.png">
                                    </label>
                                    <input id="tang-3" type="radio" name="tangibles" value="3">
                                    <label style="width: 17%;" for="tang-3">
                                        <img style="width:100%" id="tangibles3" src="survei/img/ico/normal.png">
                                    </label>
                                    <input id="tang-4" type="radio" name="tangibles" value="4">
                                    <label style="width: 17%;" for="tang-4">
                                        <img style="width:100%" id="tangibles4" src="survei/img/ico/happy.png">
                                    </label>
                                    <input id="tang-5" type="radio" name="tangibles" value="5">
                                    <label style="width: 17%;" for="tang-5">
                                        <img style="width:100%" id="tangibles5" src="survei/img/ico/very-happy.png">
                                    </label>
                                </div>
                                <label class="form-label">
                                    <div>
                                        <p class="lable">Reliability (Keandalan)</p>
                                    </div>
                                    <div>
                                        <p class="sub-lable">kemampuan untuk memberikan pelayanan yang dijanjikan secara akurat dan andal</p>
                                    </div>
                                </label>
                                <div class="button" style="margin-bottom:10px; width: 40vw;">
                                    <input id="reli-1" type="radio" name="reliability" value="1">
                                    <label style="width: 17%;" for="reli-1">
                                        <img style="width:100%" id="reliability1" src="survei/img/ico/very-sad.png" >
                                    </label>
                                    <input id="reli-2" type="radio" name="reliability" value="2">
                                    <label style="width: 17%;" for="reli-2">
                                        <img style="width:100%" id="reliability2" src="survei/img/ico/sad.png">
                                    </label>
                                    <input id="reli-3" type="radio" name="reliability" value="3">
                                    <label style="width: 17%;" for="reli-3">
                                        <img style="width:100%" id="reliability3" src="survei/img/ico/normal.png">
                                    </label>
                                    <input id="reli-4" type="radio" name="reliability" value="4">
                                    <label style="width: 17%;" for="reli-4">
                                        <img style="width:100%" id="reliability4" src="survei/img/ico/happy.png">
                                    </label>
                                    <input id="reli-5" type="radio" name="reliability" value="5">
                                    <label style="width: 17%;" for="reli-5">
                                        <img style="width:100%" id="reliability5" src="survei/img/ico/very-happy.png">
                                    </label>
                                </div>
                                <label class="form-label">
                                    <div>
                                        <p class="lable">Responsiveness (Daya Tanggap)</p>
                                    </div>
                                    <div>
                                        <p class="sub-lable">kesediaan untuk membantu pengguna layanan serta memberikan pelayanan yang tepat</p>
                                    </div>
                                </label>
                                <div class="button" style="margin-bottom:10px; width: 40vw;">
                                    <input id="resp-1" type="radio" name="responsiveness" value="1">
                                    <label style="width: 17%;" for="resp-1">
                                        <img style="width:100%" id="responsiveness1" src="survei/img/ico/very-sad.png" >
                                    </label>
                                    <input id="resp-2" type="radio" name="responsiveness" value="2">
                                    <label style="width: 17%;" for="resp-2">
                                        <img style="width:100%" id="responsiveness2" src="survei/img/ico/sad.png">
                                    </label>
                                    <input id="resp-3" type="radio" name="responsiveness" value="3">
                                    <label style="width: 17%;" for="resp-3">
                                        <img style="width:100%" id="responsiveness3" src="survei/img/ico/normal.png">
                                    </label>
                                    <input id="resp-4" type="radio" name="responsiveness" value="4">
                                    <label style="width: 17%;" for="resp-4">
                                        <img style="width:100%" id="responsiveness4" src="survei/img/ico/happy.png">
                                    </label>
                                    <input id="resp-5" type="radio" name="responsiveness" value="5">
                                    <label style="width: 17%;" for="resp-5">
                                        <img style="width:100%" id="responsiveness5" src="survei/img/ico/very-happy.png">
                                    </label>
                                </div>
                                <label class="form-label">
                                    <div>
                                        <p class="lable">Assurance (Jaminan)</p>
                                    </div>
                                    <div>
                                        <p class="sub-lable">rasa percaya serta keyakinan terhadap terhadap layanan yang diberikan</p>
                                    </div>
                                </label>
                                <div class="button" style="margin-bottom:10px; width: 40vw;">
                                    <input id="assu-1" type="radio" name="assurance" value="1">
                                    <label style="width: 17%;" for="assu-1">
                                        <img style="width:100%" id="assurance1" src="survei/img/ico/very-sad.png" >
                                    </label>
                                    <input id="assu-2" type="radio" name="assurance" value="2">
                                    <label style="width: 17%;" for="assu-2">
                                        <img style="width:100%" id="assurance2" src="survei/img/ico/sad.png">
                                    </label>
                                    <input id="assu-3" type="radio" name="assurance" value="3">
                                    <label style="width: 17%;" for="assu-3">
                                        <img style="width:100%" id="assurance3" src="survei/img/ico/normal.png">
                                    </label>
                                    <input id="assu-4" type="radio" name="assurance" value="4">
                                    <label style="width: 17%;" for="assu-4">
                                        <img style="width:100%" id="assurance4" src="survei/img/ico/happy.png">
                                    </label>
                                    <input id="assu-5" type="radio" name="assurance" value="5">
                                    <label style="width: 17%;" for="assu-5">
                                        <img style="width:100%" id="assurance5" src="survei/img/ico/very-happy.png">
                                    </label>
                                </div>
                                <label class="form-label">
                                    <div>
                                        <p class="lable">Empathy (Empati)</p>
                                    </div>
                                    <div>
                                        <p class="sub-lable">mencakup kepedulian serta perhatian individual kepada pengguna layanan</p>
                                    </div>
                                </label>
                                <div class="button" style="margin-bottom:10px; width: 40vw;">
                                    <input id="empa-1" type="radio" name="empathy" value="1">
                                    <label style="width: 17%;" for="empa-1">
                                        <img style="width:100%" id="empathy1" src="survei/img/ico/very-sad.png" >
                                    </label>
                                    <input id="empa-2" type="radio" name="empathy" value="2">
                                    <label style="width: 17%;" for="empa-2">
                                        <img style="width:100%" id="empathy2" src="survei/img/ico/sad.png">
                                    </label>
                                    <input id="empa-3" type="radio" name="empathy" value="3">
                                    <label style="width: 17%;" for="empa-3">
                                        <img style="width:100%" id="empathy3" src="survei/img/ico/normal.png">
                                    </label>
                                    <input id="empa-4" type="radio" name="empathy" value="4">
                                    <label style="width: 17%;" for="empa-4">
                                        <img style="width:100%" id="empathy4" src="survei/img/ico/happy.png">
                                    </label>
                                    <input id="empa-5" type="radio" name="empathy" value="5">
                                    <label style="width: 17%;" for="empa-5">
                                        <img style="width:100%" id="empathy5" src="survei/img/ico/very-happy.png">
                                    </label>
                                </div>
                                <button type="submit" class="btn" style="background-color: #0B783A; color:#ffffff; font-size: 36px;font-family: 'Roboto'; font-style: normal; border-radius: 20px; padding: 20 10;">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="survei/js/modals.js"></script>
        <script src="survei/js/main.js"></script>
    </body>
</html>