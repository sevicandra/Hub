function detailResponden(params) {

    $.ajax({
        type: "GET", 
			url: "/best_employee_responden/"+params,
			dataType: "json",
            success: function(response){
                $('.periodePemilihan').css("background-color", "#142542");
                $('.periodePemilihan').css("width", "99%");
                $('.periodePemilihan').css("border-radius", "11px");
                $('#'+params).css("background-color", "#4A81E0");
                $('#'+params).css("width", "100%");
                $('#'+params).css("border-radius", "11px 0 0 11px");
                $('#daftarResponden').empty();
                var i =1;
                $.each(_.uniq(response), function (res, req) {
                    $('#daftarResponden').append('<tr><td>'+i+'</td><td style="text-align:left">'+req+'</td></tr>')
                    i++
                })
            }
    })
}

function pilihNominasi(params){
    $('#formNominasi').attr('action', 'best_employee/'+params)
}
