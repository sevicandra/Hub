function profil(val){
    if(val){
        $.ajax({
            type: "GET", 
			url: "/satker/"+val+"/edit",
			dataType: "json",
            beforeSend: function() { $('#loading').removeAttr('hidden'), $('#dataloaded').attr('hidden','');},
            complete: function() { $('#loading').attr('hidden',''), $('#dataloaded').removeAttr('hidden') },
            success: function (response) {
                $("#kementerian"+response.satker.kementerian_id).attr('selected','');
                $('#updateProfilSatker').attr('action', 'satker/'+response.satker.id);
                $("#namaSatker").val(response.satker.namaSatker);
                $("#jabatanPimpinan").val(response.satker.jabatanPimpinan);
                if (response.profil) {
                    $("#alamat").val(response.profil.alamat);
                    $("#namaKepalaSatker").val(response.profil.namaKepalaSatker);
                    $("#noTeleponKepalaSatker").val(response.profil.noTeleponKepalaSatker);
                    $("#namaOperatorSatker").val(response.profil.namaOperator);
                    $("#noTeleponOperatorSatker").val(response.profil.noTeleponOperator);
                }else{
                    $("#alamat").val(null);
                    $("#namaKepalaSatker").val('');
                    $("#noTeleponKepalaSatker").val('');
                    $("#namaOperatorSatker").val('');
                    $("#noTeleponOperatorSatker").val('');
                    
                }
            }
        })
    }
}