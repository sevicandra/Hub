$(document).ready(function(){ 
    var x =2
    $('#tambahLot').click(function () {
        $('#lotLelang').append(`
        <div class="input-group mb-3" id="lot`+x+`">
            <span class="input-group-text" id="namaLot">Nama Lot</span>
            <input id="inputNamaLot`+x+`" name='lot[]' type="text" class="form-control" aria-label="namaLot" aria-describedby="namaLot" required>
            <span class="input-group-text" id="nilaiLimit">Nilai Limit</span>
            <input id="inputNilaiLot`+x+`" name='nilai[]' type="text" class="form-control" aria-label="nilaiLimit" aria-describedby="nilaiLimit" required>
            <span onclick="deleteLot(`+x+`)" class="input-group-text btn" style="color: red"><i class="bi bi-folder-minus"></i></span>
        </div>`
        )
        x++
    })

})

function deleteLot(params) {
    var lot = 'lot'+params
    $('#'+lot).remove();
}

function inputBarang(params) {
    $('#permohonan_lelang_id').val(params)
}

function inputLot(params) {
    $('#permohonan_lelang_id').val(params)
    if (params) {
        $.ajax({
            type: "GET", 
			url: "/permohonan_lelang/"+params,
			dataType: "json",
            beforeSend: function() { $('#loading').removeAttr('hidden')},
            complete: function() { $('#loading').attr('hidden',''); },
            success: function(response){
                $('#listLotLelang').empty();
                var i = 1;
                $.each(response, function(res, req){
                    var aksi = `<div onclick="deleteLot('`+req.id+`')" type="submit" class="btn" style="color: red"><i class="bi bi-trash-fill"></i></div>`;
                    $("#listLotLelang").append(
                        `<div class="input-group mb-3" id="`+req.id+`">
                            <span class="input-group-text" id="namaLot">Nama Lot</span>
                            <input type="text" class="form-control" aria-label="namaLot" aria-describedby="namaLot" disabled value="`+req.namaLot+`">
                            <span class="input-group-text" id="nilaiLimit">Nilai Limit</span>
                            <input type="text" class="form-control" aria-label="nilaiLimit" aria-describedby="nilaiLimit" disabled value="`+req.limit+`">
                            `+aksi+`
                        </div>`
                    );
                    i++;
                })
            }
        });
    }
}

function deleteLot(params) {
    if (params) {
        $.ajax({
            type: "POST", 
			url: "/lotLelang/"+params,
			dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                _method:'DELETE',
            },
            beforeSend: function() { $('#loading').removeAttr('hidden')},
            complete: function() { $('#loading').attr('hidden',''); },
            success: function(response){
                if (response.status === 'success') {
                    $('#'+params).remove();
                    alert("This Action"+response.status);
                }else{
                    alert("This Action"+response.status);
                }
            }
        });
    }
}