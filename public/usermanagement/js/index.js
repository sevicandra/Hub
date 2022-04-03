function userProfil(params) {
    $.ajax({
        type: "GET", 
        url: "/user_management/"+params,
        dataType: "json",
        success: function(response){
            $('#updateProfil').attr('action', "/user_management/"+params)
            $("#formGroupNama").val(response.nama)
            $("#formGroupNIP").val(response.NIP)
            $("#formGroupJabatan").val(response.jabatan)
            $("#formGroupPangkatGolongan").val(response.pangkatGolongan)
        }
    })
}