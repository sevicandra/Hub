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
                console.log(response.barang);
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

function kirimRisalah(val) {
    $("#formKirimRisalah").attr("action", "/penetapan_lelang/"+val);
}