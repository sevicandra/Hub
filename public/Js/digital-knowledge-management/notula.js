function preview(params) {
    if (params) {
        $.ajax({
            url:'/digital-knowledge-management/notula/'+params,
            type:'GET',
            dataType:'JSON',
            success: function(result){
                $('#previewFrame').empty()
                $('#previewHeader').empty()
                $('#previewHeader').append(
                    `<h5 class="modal-title" id="staticBackdropLabel">`+result.agendaRapat+`</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>`
                )
                $('#previewFrame').append(`<iframe src="`+window.location.protocol + '//' + location.host+`/storage/`+result.file+`" frameBorder="0" scrolling="auto" height="100%" width="100%"></iframe>`)
                var preview = new bootstrap.Modal(document.getElementById('preview'), {
                    keyboard: false
                })
                preview.show()
            }
        })
    }
}

function updateNotula(params) {
    if (params) {
        $.ajax({
            url:'/digital-knowledge-management/notula/'+params+'/edit',
            type:'GET',
            dataType:'JSON',
            success: function(result){
                $('#updateNotulaHeader').empty()
                $('#updateNotulaHeader').append(`
                    <h5 class="modal-title" id="staticBackdropLabel">`+result.agendaRapat+`</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                `)
                $('#updateNotulacontent').empty()
                $('#updateNotulacontent').append(`
                    <form action="/digital-knowledge-management/notula/`+result.id+`" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="`+$(`meta[name="csrf-token"]`).attr(`content`)+`"></input>
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="tanggalNotula" name="tanggalNotula" placeholder="tanggal Notula" value="`+result.tanggalNotula+`" required>
                            <label for="tanggalNotula">Tanggal Notula</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="tanggalRapat" name="tanggalRapat" placeholder="tanggal Rapat" value="`+result.tanggalRapat+`" required>
                            <label for="tanggalRapat">Tanggal Rapat</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="agendaRapat" name="agendaRapat" placeholder="agenda Rapat" value="`+result.agendaRapat+`" required>
                            <label for="agendaRapat">agenda Rapat</label>
                        </div>
                        <input type="file" class="form-control" name="fileUpload">
                        <div class="row mt-2">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                `)
                var update = new bootstrap.Modal(document.getElementById('updateNotula'), {
                    keyboard: false
                })
                update.show()
            }
        })
    }
}

function hapusNotula(params) {
    if (params) {
        $.ajax({
            url:'/digital-knowledge-management/notula/'+params+'/edit',
            type:'GET',
            dataType:'JSON',
            success: function(result){
                $('#hapusNotulacontent').empty()
                $('#hapusNotulacontent').append(`
                    <h5>Anda Yakin Ingin Menghapus Notula `+result.agendaRapat+`</h5>
                    <form action="/digital-knowledge-management/notula/`+result.id+`" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="`+$(`meta[name="csrf-token"]`).attr(`content`)+`"></input>
                        <input type="hidden" name="_method" value="DELETE">
                        <div class="row mt-2">
                            <button class="btn btn-primary" type="submit">Hapus</button>
                        </div>
                    </form>
                `)
                var hapus = new bootstrap.Modal(document.getElementById('hapusNotula'), {
                    keyboard: false
                })
                hapus.show()
            }
        })
    }
}