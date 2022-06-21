function view(params) {
    $.ajax({
        type:'POST',
        url: '/reminder/'+params+'/view',
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            $('#viewReminderContent').empty()
            $('#viewReminderContent').append(
                `<div class="input-group mb-3">
                   <span class="input-group-text" id="basic-addon1">tanggal</span>
                    <input value="`+response.tanggal+`" disabled type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    <span class="input-group-text" id="basic-addon2">waktu</span>
                    <input value="`+response.waktu+`" disabled type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon2">
                </div>
                <div class="form-floating mb-3">
                    <textarea disabled type="email" class="form-control" id="floatingInput">`+response.pesan+`</textarea>
                    <label for="floatingInput">Pesan</label>
                </div>
                <div class="form-floating mb-3">
                    <div id="viewReminderTujuan" class="form-control scrollable" placeholder="Tujuan" style="height: 200px; overflow-y:auto">

                    </div>
                    <label for="pesan">Tujuan</label>
                </div>`
            )
            response.tujuan.forEach(element => {
                $('#viewReminderTujuan').append(`
                    <div class="input-group mb-2">
                        <span class="input-group-text" id="basic-addon1">-</span>
                        <input disabled type="text" class="form-control" value="`+element.nama+`">
                    </div>
                `)
            });
        }
    })
}