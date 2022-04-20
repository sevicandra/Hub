function updateBarang(val){
    $('#permohonan_lelang_id').val(val);
    $("#pilihbarang").attr("action", "/permohonan_lelang/"+val);
}

function penetapan(val){
    $('#penetapanButton').val(val);
}

function inputBarangLelang(val){
    $('#risalah_id').val(val);
}

function detailpermohonan(val){
    if (val) {
        $.ajax({
            type: "GET", 
			url: "/permohonan_lelang/"+val,
			dataType: "json",
            beforeSend: function() { $('#loading').removeAttr('hidden')},
            complete: function() { $('#loading').attr('hidden',''); },
            success: function(response){
                $('#listBarang').empty();
                var i = 1;
                $.each(response, function(res, req){
                    var aksi = '<form class="d-inline" action="/permohonan_lelang/'+val+'/edit"method="PATCH"> <button name="barang_id" value="'+req.id+'" type="submit" class="btn" style="color: red"><i class="bi bi-trash-fill"></i></button></form>';
                    $("#listBarang").append('<tr><td>'+i+'</td><td>'+req.kodeBarang+'</td><td>'+req.NUP+'</td><td>'+aksi+'</td></tr>');
                    i++;
                })
            }
        });
    }
}

$(document).ready(function(){
    $(":checkbox").change(function(){
        var data = $(this).val();
        if($(this).is(":checked")){
            $("."+data).removeAttr('disabled');
        }else{
            $("."+data).attr('disabled','');
        }
    })
});

function barangLelang(val){
    if (val) {
        $.ajax({
            type: "GET", 
			url: "/risalah/"+val,
			dataType: "json",
            beforeSend: function() { $('#loading').removeAttr('hidden')},
            complete: function() { $('#loading').attr('hidden',''); },
            success: function(response){
                $('#listBarang').empty();
                var i = 0;
                var num = 1;
                while (i < response.barang.length) {
                    switch (response.status[i].status) {
                        case 1:
                            var status = "Laku"
                            break;
                        case 2:
                            var status = "TAP"
                            break;
                        case 3:
                            var status = "Wanprestasi"
                            break;
                    
                        default:
                            break;
                    }
                    var aksi = '<form class="d-inline" action="/barang_lelang/'+response.status[i].id+'/edit"method="PATCH"> <button type="submit" class="btn" style="color: red"><i class="bi bi-trash-fill"></i></button></form>';
                    $("#listBarang").append('<tr><td>'+num+'</td><td>'+response.barang[i].kodeBarang+'</td><td>'+response.barang[i].NUP+'</td><td>'+status+'</td><td>'+aksi+'</td></tr>');
                    num++;
                    i++;
                }
            }
        });
    }
}

function lotLelang(val){
    if (val) {
        $.ajax({
            type: "GET", 
			url: "/risalah/"+val,
			dataType: "json",
            beforeSend: function() { $('#loading').removeAttr('hidden')},
            complete: function() { $('#loading').attr('hidden',''); },
            success: function(response){
                $('#listBarang').empty();
                var i = 0;
                var num = 1;
                while (i < response.barang.length) {
                    switch (response.status[i].status) {
                        case 1:
                            var status = "Laku"
                            break;
                        case 2:
                            var status = "TAP"
                            break;
                        case 3:
                            var status = "Wanprestasi"
                            break;
                    
                        default:
                            break;
                    }
                    var aksi = '<form class="d-inline" action="/lot_lelang/'+response.status[i].id+'/edit"method="PATCH"> <button type="submit" class="btn" style="color: red"><i class="bi bi-trash-fill"></i></button></form>';
                    $("#listBarang").append('<tr><td>'+num+'</td><td>'+response.barang[i].namaLot+'</td><td>'+status+'</td><td>'+aksi+'</td></tr>');
                    num++;
                    i++;
                }
            }
        });
    }
}

function kirimRisalah(val) {
    $("#formKirimRisalah").attr("action", "/penetapan_lelang/"+val);
}

$('#jenisLelang').change(function () {
    $('#downloadPenetapanContainer').empty()
    switch ($(this).val()) {
        case 'OB':
            var elementmenit =''
            for (let index = 0; index <= 59; index++) {
                if (index <= 9) {
                    var menit = '0'+index
                }else{
                    var menit = index
                }
                var elementmenit = elementmenit + '<option value="'+menit+'">'+menit+'</option>';
            }
            var jam ='<option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option>'
            var tanggalLelang = '<div class="row"><label for="tanggalLelang" class="col-sm-6 col-form-label">Tanggal Lelang</label><div class="col-sm-6"><input name="tanggalLelang" class="form-control" type="date" required></div></div>'
            var tanggalPengumuman = '<div class="row"><label for="tanggalPengumuman" class="col-sm-6 col-form-label">Tanggal Pengumuman</label><div class="col-sm-6"><input name="tanggalPengumuman" class="form-control" type="date" required></div></div>'
            var waktuAwalPenawaran = '<div class="row"><label for="waktuAwalPenawaran" class="col-sm-6 col-form-label">Waktu Awal Penawaran</label><div class="col-sm-6"><select name="jamAwalPenawaran" class="form-control d-inline" style="width: 50px">'+jam+'</select><select name="menitAwalPenawaran" class="form-control d-inline" style="width: 50px">'+elementmenit+'</select><label for="waktuAwalPenawaran" class="col col-form-label">WIT</label></div></div>'
            var waktuAkhirPenawaran = '<div class="row"><label for="waktuAkhirPenawaran" class="col-sm-6 col-form-label">Waktu Akhir Penawaran</label><div class="col-sm-6"><select name="jamAkhirPenawaran" class="form-control d-inline" style="width: 50px">'+jam+'</select><select name="menitAkhirPenawaran" class="form-control d-inline" style="width: 50px">'+elementmenit+'</select><label for="waktuAwalPenawaran" class="col col-form-label">WIT</label></div></div>'
            var lokasi = '<div class="row"><label for="lokasi" class="col-sm-6 col-form-label">Lokasi Lelang</label><div class="col-sm-6"><textarea name="lokasi" type="text" rows="4" cols="50" class="form-control" required>Kantor Pelayanan Kekayaan Negara dan Lelang Ternate Jalan Yos Sudarso No. 333, Kota Ternate</textarea></div></div>'
            var button = '<div style="margin-top:10px"><button value="penetapanLelangOpen" type="submit" class="btn btn-primary" name="action">Cetak Penetapan</button> <button value="HPKB" type="submit" class="btn btn-primary" name="action">ND Penampaian</button></div>'
            $('#downloadPenetapanContainer').append(tanggalLelang+tanggalPengumuman+waktuAwalPenawaran+waktuAkhirPenawaran+lokasi+button)
            break;
        case 'CB':
            var elementmenit =''
            for (let index = 0; index <= 59; index++) {
                if (index <= 9) {
                    var menit = '0'+index
                }else{
                    var menit = index
                }
                var elementmenit = elementmenit + '<option value="'+menit+'">'+menit+'</option>';
            }
            var jam ='<option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option>'
            var tanggalLelang = '<div class="row"><label for="tanggalLelang" class="col-sm-6 col-form-label">Tanggal Lelang</label><div class="col-sm-6"><input name="tanggalLelang" class="form-control" type="date" required></div></div>'
            var tanggalPengumuman = '<div class="row"><label for="tanggalPengumuman" class="col-sm-6 col-form-label">Tanggal Pengumuman</label><div class="col-sm-6"><input name="tanggalPengumuman" class="form-control" type="date" required></div></div>'
            var waktuAkhirPenawaran = '<div class="row"><label for="waktuAkhirPenawaran" class="col-sm-6 col-form-label">Waktu Akhir Penawaran</label><div class="col-sm-6"><select name="jamAkhirPenawaran" class="form-control d-inline" style="width: 50px">'+jam+'</select><select name="menitAkhirPenawaran" class="form-control d-inline" style="width: 50px">'+elementmenit+'</select><label for="waktuAwalPenawaran" class="col col-form-label">WIT</label></div></div>'
            var lokasi = '<div class="row"><label for="lokasi" class="col-sm-6 col-form-label">Lokasi Lelang</label><div class="col-sm-6"><textarea name="lokasi" type="text" rows="4" cols="50" class="form-control" required>Kantor Pelayanan Kekayaan Negara dan Lelang Ternate Jalan Yos Sudarso No. 333, Kota Ternate</textarea></div></div>'
            var button = '<div style="margin-top:10px"><button value="penetapanLelangClosed" type="submit" class="btn btn-primary" name="action">Cetak Penetapan</button> <button value="HPKB" type="submit" class="btn btn-primary" name="action">ND Penampaian</button></div>'
            $('#downloadPenetapanContainer').append(tanggalLelang+tanggalPengumuman+waktuAkhirPenawaran+lokasi+button)
            break;
    }
});

function downloadPenetapanInput(val){
    $('#downloadPenetapanInput').val(val);
}