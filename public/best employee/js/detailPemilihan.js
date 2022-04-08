function detailPemilihan(params) {
    $.ajax({
        type: "GET", 
			url: "/best_employee/"+params,
			dataType: "json",
            success: function(response){
                $('.periodePemilihan').css("background-color", "#142542");
                $('.periodePemilihan').css("width", "99%");
                $('.periodePemilihan').css("border-radius", "11px");
                $('#'+params).css("background-color", "#4A81E0");
                $('#'+params).css("width", "100%");
                $('#'+params).css("border-radius", "11px 5px 5px 11px");
                $('#daftarNominasi').empty();
                $('#buttonSurvei').empty();
                var id = "'"+response.pemilihan.id+"'"
                if (response.user.jabatan === '11' || response.user.jabatan === '02'|| response.user.jabatan === '01') {
                    switch (response.pemilihan.status) {
                        case '1':
                            $('#buttonSurvei').append('<button onclick="pilihNominasi('+id+')" data-bs-toggle="modal" data-bs-target="#pemilihanNominasi" class="btn btn-success" class="btn btn-success">Tamban Nominasi</button>');
                            if (response.nominasi.length > 0 ) {
                                $('#buttonSurvei').append('<form action="/best_employee/'+params+'" class="d-inline" method="POST"><input type="hidden" name="_token" value="'+$('meta[name="csrf-token"]').attr('content')+'"><input type="hidden" name="_method" value="PATCH"><button name="action" value="mulaiSurvei" class="btn btn-success">Mulai Survei</button></form>')                      
                            }
                            break;
                        case '2':
                            $('#buttonSurvei').append('<form action="/best_employee/'+params+'" class="d-inline" method="POST"><input type="hidden" name="_token" value="'+$('meta[name="csrf-token"]').attr('content')+'"><input type="hidden" name="_method" value="PATCH"><button name="action" value="tutupSurvei" class="btn btn-success">Tutup Survei</button></form>');
                            break;
                    
                        default:
                            break;
                    }
                }
                var i = 1;
                $.each(_.orderBy(response.nominasi,'total', 'desc'), function (res, req) {
                    if (response.user.jabatan === '11' || response.user.jabatan === '02'|| response.user.jabatan === '01') {
                        var action = '<td><form action="/nominasiBestEmployee/'+req.nominasi_id+'" method="POST"> <input type="hidden" name="_token" value="'+$('meta[name="csrf-token"]').attr('content')+'"><input type="hidden" name="_method" value="DELETE"> <button class="btn" style="color:red"><i class="bi bi-trash3"></i></button> </form> </td>'
                    }else{
                        var action =""
                    }
                    $('#daftarNominasi').append('<tr><td>'+i+'</td><td>'+req.nama+'</td><td>'+req.produktifitasKerja+'</td><td>'+req.kedisiplinan+'</td><td>'+req.sikapKerja+'</td><td>'+req.total+'</td>'+action+'</tr>')
                    i++
                })
            }
    })
}

function pilihNominasi(params){
    $('#formNominasi').attr('action', 'best_employee/'+params)
}
