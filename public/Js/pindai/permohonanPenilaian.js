function dowloadusulanSKST(val) {
    $('#permohonan_id').val(val);
    $.ajax({
        type: "Get", 
        url: "/timpenilai/"+val,
        dataType: "json",
        success: function(response){
            var x = 1
            $('#anggotaTim').empty();
            $.each(response, function(res, req){
                var value = "'" + req.id + "', '" + val +"'"
                $('#anggotaTim').append('<div class="row"><div class="row"><div class="col-sm-1">'+x+'</div><div class="col-sm-10">'+req.nama+' / '+req.NIP+'</div><div class="col-sm-1"><button onClick="hapusAnggota('+value+')" class="btn" type="button"><i class="bi bi-x-square"></i></button></div></div></div>')
                x++
            })
        },
    });
}

function pemberitahuan(val){
    $('#permohonan_penilaian_id').val(val);
}

$(document).ready(function(){   
    var x = 2; 
    $('#tambahTim').click(function () {
        $.ajax({
            type:'GET',
            url: '/listTim',
            dataType: "json",
            success: function(response){
                $('#namaTim').append('<div id="namaTim'+x+'" class="row"><label for="nama" class="col-sm-1 col-form-label"></label><div class="col-sm-10"><select id="listTim'+x+'"  name="nama[]" class="form-control" placeholder="Jabatan" style="margin-bottom: 12px" required></select></div><div class="col-sm-1"><button onClick="hapusTim('+x+')" class="btn" type="button"><i class="bi bi-x-square"></i></button></div></div>');
                $.each(response, function(res, req) {
                    $('#listTim'+x).append('<option value="'+req.id+'">'+req.nama+'</option>');
                });
                x++;
            }
        })
        
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

function hapusAnggota(val1, val2) {
    $.ajax({
        type: "POST",
        url: "/hapusanggota",
        dataType: "json",
        data: {user_id:val1,permohonanPenilaian_id:val2},
        success: function (response) {
            var x = 1
            $('#anggotaTim').empty();
            $.each(response, function(res, req){
                var value = "'" + req.id + "', '" + val2 +"'"
                $('#anggotaTim').append('<div class="row"><div class="row"><div class="col-sm-1">'+x+'</div><div class="col-sm-10">'+req.nama+' / '+req.NIP+'</div><div class="col-sm-1"><button onClick="hapusAnggota('+value+')" class="btn" type="button"><i class="bi bi-x-square"></i></button></div></div></div>')
                x++
            })
        }
    })
}

function penyampaianLaporan(val){
    $('#pemberitahuan_penilaian_id').val(val);
    $('#pemberitahuan_penilaian_id2').val(val);
}

function nilaiLimit(val){
    $.ajax({
        type: "POST",
        url: "/nilailimit",
        dataType: "json",
        data:{penyampaian_laporan_id:val},
        success: function (response){
            $('#listNilaiLimit').empty()
            $i=1;
            $.each(response, function (res, req) {
                var xx = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
                
                if (req.nilaiLimit === null) {
                    var barang = '<input name="barang_id[]" type="text" hidden value="'+req.id+'"></input><input  name="nilaiLimit[]" type="number">'
                }else{
                    var barang = xx.format(req.nilaiLimit)
                }
                
                $('#listNilaiLimit').append('<tr><td>'+$i+'</td><td>'+req.kodeBarang+'</td><td></td><td>'+req.NUP+'</td><td>'+xx.format(req.nilaiWajar)+'</td><td>'+barang+'</td></tr>')
            $i++
            })
        }
    })
}

function suratPersetujuan(val) {
    $('#penyampaian_laporan_id').val(val);
}