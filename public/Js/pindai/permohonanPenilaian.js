function dowloadusulanSKST(val) {
    console.log(val);
    $('#permohonan_id').val(val);
}

function pemberitahuan(val){
    $('#permohonan_penilaian_id').val(val);
}

$(document).ready(function(){   
    var x = 2; 
    $('#tambahTim').click(function () {
        $('#namaTim').append('<div id="namaTim'+x+'" class="row"><label for="nama" class="col-sm-4 col-form-label">nama</label><div class="col-sm-7"><input name="nama[]" class="form-control" type="text" required></div><div class="col-sm-1"><button onClick="hapusTim('+x+')" class="btn" type="button"><i class="bi bi-x-square"></i></button></div></div>');
        x++;
    });
});
   
function hapusTim(y){
    var namaTim= 'namaTim' + y;    
    $('#'+namaTim+'').remove();
}

function permohonanPenilaian(val){
    $('#permohonan_id').val(val);
}

function updateBarang(val){
    $('#laporan_penilaian_id').val(val);
}


$(document).ready(function(){
    $(":checkbox").change(function(){
        var data = $(this).val();
        if($(this).is(":checked")){
            $("#"+data).removeAttr('disabled');
        }else{
            $("#"+data).attr('disabled','');
        }
    })	
});

function detailLaporan(val){
    if (val) {
        
        $.ajax({
            type: "GET", 
			url: "/laporanpenilaian/"+val,
			dataType: "json",
            beforeSend: function() { $('#loading').removeAttr('hidden')},
            complete: function() { $('#loading').attr('hidden',''); },
            success: function(response){
                $('#listBarang').empty();
                var i = 1;
                $.each(response, function(res, req){
                    var aksi = '<form class="d-inline" action="/barang/'+req.id+'/edit"method="PATCH"> <button type="submit" class="btn" style="color: red"><i class="bi bi-trash-fill"></i></button></form>';
                    $("#listBarang").append('<tr><td>'+i+'</td><td>'+req.kodeBarang+'</td><td>'+req.NUP+'</td><td>'+req.nilaiWajar+'</td><td>'+aksi+'</td></tr>');
                    i++;
                })
            }
        });
    }
}

function penyampaianLaporan(val){
    $('#pemberitahuan_penilaian_id').val(val);
}
