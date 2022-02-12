<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <title>Document</title>
</head>
<body>
    <form action="cetak" method="POST">
        @csrf
        <div class="row" id='namaTim'>
            <div id="namaTim1">
                <label for="nama" class="col-sm-4 col-form-label">nama</label>
                <div class="col-sm-8">
                    <input name="nama[]" class="form-control" type="text" required>
                    <button onClick="hapusTim(1)" class="btn" type="button">X</button>
                </div>
            </div>
        </div>
        <button id="tambahTim" class="btn" type="button">+</i></button>
        <div class="row">
            <label for="lokasi" class="col-sm-4 col-form-label">lokasi</label>
            <div class="col-sm-8">
                <input name="lokasi" class="form-control" type="text" required>
            </div>
        </div>
        <div class="row">
            <label for="tanggalMulaiSurvei" class="col-sm-4 col-form-label">tanggal Mulai</label>
            <div class="col-sm-8">
                <input name="tanggalMulaiSurvei" class="form-control" type="date" required>
            </div>
        </div>
        <div class="row">
            <label for="tanggalSelesaiSurvei" class="col-sm-4 col-form-label">tanggal Selesai</label>
            <div class="col-sm-8">
                <input name="tanggalSelesaiSurvei" class="form-control" type="date" required>
            </div>
        </div>
            <div>
                <button type="submit" class="btn btn-primary" id='permohonan_id' name='permohonan_id' value=''>Simpan</button>
            </div>
        </div>
    </form>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){   
        var x = 2; 
        $('#tambahTim').click(function () {
            $('#namaTim').append('<div id="namaTim'+x+'"><label for="nama" class="col-sm-4 col-form-label">nama</label><div class="col-sm-8"><input name="nama[]" class="form-control" type="text" required><button onClick="hapusTim('+x+')" class="btn" type="button">X</button></div></div>');
            x++;
        });
    });

    
        
        function hapusTim(x){
            
            var namaTim= 'namaTim' + x;
            
            $('#'+namaTim+'').remove();
        }


  
</script>


</html>